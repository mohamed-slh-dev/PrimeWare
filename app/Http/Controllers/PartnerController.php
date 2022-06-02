<?php

namespace App\Http\Controllers;

use App\Models\Chargefee;
use App\Models\Collectedorder;
use App\Models\Customer;
use App\Models\Driver;
use App\Models\DriverDistricts;
use App\Models\Order;
use App\Models\Partner;
use App\Models\PartnerNotification;
use App\Models\User;
use App\Models\UserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PartnerController extends Controller
{
    

    // login
    public function login(Request $request) {
    
        return view('logins.partner');
        
    } //end login


    // logout
    public function logout(Request $request) {


        // delete permission (session) id + profile pic
        session()->forget('partner_name');

        session()->forget('partner_id');
        session()->forget('partner_logo');
        session()->forget('partner_lock');



        // redirect to login
        return redirect()->route('partner.login');
        
    } //end logout





    
    // checkuser login function
    public function checkuser(Request $request) {

        // username + password
        $email = $request->email;
        $password = $request->password;

        
        // get user using username
        $partner = Partner::where('portalemail', $email)->first();


        // if found then check password (he pass)
        if ($partner && Hash::check($password, $partner->password)) {


            // put permission (session) id + profile pic
            session()->put('partner_name', $partner->name);

            session()->put('partner_id', $partner->id);
            session()->put('partner_logo', $partner->logo);
            session()->put('partner_lock', "unlocked");


            // redirect to dashboard
            return redirect()->route('partner.dashboard');

        } // end of password correct


        // he don't pass
        else {

            // redirect to login again
            return redirect()->route('partner.login');

        } //end of wrong password or user not found


        
    } //end of checkuser login function










    // partner lock screen
    public function partnerlock() {


        session()->put('partner_lock', "locked");


        return view('partners.lockedscreen');

    } // end of lock the screen





    // partner lock screen
    public function partnerunlock(Request $request) {

        // check password
        $partner = Partner::find(session('partner_id'));

        // matched
        if (Hash::check($request->password, $partner->password)) {

            session()->put('partner_lock', "unlocked");

            return redirect()->route('partner.dashboard');

        }


        // not matched
        return view('partners.lockedscreen');

        

    } // end of lock the screen










    // ================================================



    // dashboad function
    public function dashboard() {

        
        // get customers + Orders
        $customers = Customer::where('partner_id', session()->get('partner_id'))->get();
        
        $orders = Order::where('partner_id', session()->get('partner_id'))
        ->orderBy('deliverydate', 'DESC')
        ->get();

        // paginated customers and orders
        $pagcustomers = Customer::where('partner_id', session()->get('partner_id'))->paginate(10, ['*'], 'customers');

        $pagorders = Order::where('partner_id', session()->get('partner_id'))
        ->orderBy('deliverydate', 'DESC')
        ->paginate(10, ['*'], 'orders');



        // counter for the chart in dashboard page
        $doc = 1 + $orders->where('status', 'delivered')->count();
        $coc = 1 + $orders->where('status', 'canceled')->count();


        // return to view
        return view('partners.dashboard', compact('customers', 'orders', 'pagcustomers', 'pagorders', 'doc', 'coc'));


    } //end of dashboard




    

    // renew customer
    public function renewcustomer(Request $request) {

        // get customers + Orders
        $customer = Customer::find($request->id);

        // from request
        $renewdate = $request->renewdate;
        $cashcollected = $request->extracash;
        $deliverydaysnumber = $request->extradays;


        // check if renew date is less than last delivery date
        $startdate = $customer->orders->max('deliverydate');
        if ($renewdate <= $startdate) {

            return redirect()->route('partner.dashboard');
            
        }



        // vars needed below
        // service time - type - delivery days
        $servicetiming = $customer->servicetiming;
        $servicetype = $customer->servicetype;

        $deliverydays = $customer->deliverydays;

        // city - district
        $district_id = $customer->district_id;
        $city_id = $customer->city_id;


        // add cashcollected to total
        $customer->cashcollected += $cashcollected;
        

        // get total fees (update customer instantly)
        $chargefees = Chargefee::where('partner_id', session('partner_id'))
        ->where('city_id', $city_id)->get();
        $chargefees = (!empty($chargefees[0]['fees']) ? $chargefees[0]['fees'] : 0);
        $totalfees = $chargefees * $deliverydaysnumber;

        $customer->totalfees += $totalfees;
        $customer->save();
        

        // partner id - driver id - collector id
        $partner_id = $customer->orders[0]->partner->id;
        $driver_id = (!empty($customer->orders[0]->driver->id) ? $customer->orders[0]->driver->id : null);
        $collector_id = (!empty($customer->collectedorders[0]->driver->id) ? $customer->collectedorders[0]->driver->id : null);



        // get last order date
        $startdate = $renewdate;



        // insert new orders
        // =========================================================


        //  2- insert orders
        $assigneddays = 0;
        $plusday = 0;


        // difference between date
        $diff = time() - strtotime($startdate);
        $diff = round($diff / (60 * 60 * 24));
        
        // if its (negative) then there's deliveries undone yet
        if ($diff < 0) {
            $plusday = abs(intval($diff)) + 2;
        } 
        
        // all deliveries done and finished start from 0
        else {
            $plusday = 1;
        }


        // used in collectedorders
        $firstorderid = 0;

        for ($i = 0; $i < $deliverydaysnumber; $i++) {


            // 2- save orders in db
            $neworder = new Order();

            // foregin keys
            $neworder->partner_id = $partner_id;
            $neworder->customer_id = $customer->id;
            $neworder->driver_id = $driver_id;
         


            // general info
            $neworder->servicetype = $servicetype; //same as customers
            $neworder->servicetiming = $servicetiming; //same as customers

            $neworder->status = "not received"; //default status


            // only in first order
            if ($i == 0) {

                $neworder->cashcollected = $cashcollected;
            } else {

                $neworder->cashcollected = 0;
            }



            $chargefees = Chargefee::where('partner_id', session('partner_id'))
            ->where('city_id', $city_id)->get();
            $neworder->chargefees = (!empty($chargefees[0]['fees']) ? $chargefees[0]['fees'] : 0);

            $neworder->bag = 0; //default 0
            $neworder->info = ""; //default empty





            // current day of week number should match one of ($deliverydays) numbers
            while (true) {

                // get day of week in integer 1-7 (actually return 0-6)
                $todayinweek = 1 + date('w', strtotime('+' . $plusday . ' day'));

                
                // add plusday
                $plusday++;

                // check if it matches
                if (str_contains($deliverydays, $todayinweek)) {

                    // return the previous day (Cause its matched)
                    $plusday--;

                    // get current date and add 0 to it
                    $neworder->deliverydate = date('Y-m-d', strtotime('+' . $plusday . ' day'));
                    $neworder->updatedate = "";

                    // increase assigneddays + plusday again
                    $assigneddays++;
                    $plusday++;

                    break;
                } //end of day match


            } //end while





            // save order to db
            $neworder->save();


            // get firstorderid
            if ($assigneddays == 1) {
                $firstorderid = $neworder->id;
            }

        } //end for loop






        // =========================================================

        // 3- insert collectedorders

        // get the order driver first
        // pre - get morning shift drivers
        $assigneddays = 0;
        $plusday = 0;

        // difference between date
        $diff = time() - strtotime($startdate);
        $diff = round($diff / (60 * 60 * 24));

        // if its (negative) then there's deliveries undone yet
        if ($diff < 0) {
            $plusday = abs(intval($diff)) + 2;
        }

        // all deliveries done and finished start from 0
        else {
            $plusday = 1;
        }



        for ($i = 0; $i < $deliverydaysnumber; $i++) {


            // 2- save orders in db
            $newcollectedorder = new Collectedorder();

            // foregin keys
            $newcollectedorder->order_id = $firstorderid;
            $newcollectedorder->partner_id = $partner_id;
            $newcollectedorder->customer_id = $customer->id;
            $newcollectedorder->driver_id = $collector_id;
       


            // general info
            $newcollectedorder->servicetype = $servicetype; //same as customers
            $newcollectedorder->servicetiming = $servicetiming; //same as customers

            $newcollectedorder->status = "not received"; //default status

            // $newcollectedorder->cashcollected = $cashcollected;

            $chargefees = Chargefee::where('partner_id', session('partner_id'))
            ->where('city_id', $city_id)->get();
            $newcollectedorder->chargefees = (!empty($chargefees[0]['fees']) ? $chargefees[0]['fees'] : 0);

            $newcollectedorder->bag = 0; //default 0
            $newcollectedorder->info = ""; //default empty



            // current day of week number should match one of ($deliverydays) numbers
            while (true) {

                // get day of week in integer 1-7 (actually return 0-6)
                $todayinweek = 1 + date('w', strtotime('+' . $plusday . ' day'));

                // add plusday
                $plusday++;

                // check if it matches
                if (str_contains($deliverydays, $todayinweek)) {


                    // return the previous day (Cause its matched)
                    $plusday--;

                    // A- morning shif -> previous day
                    if ($servicetiming == "3:00 AM - 8:00 AM" || $servicetiming == "8:00 AM - 12:00 PM") {

                        // get current date and add plusdays to it
                        $newcollectedorder->deliverydate = date('Y-m-d', strtotime('+' . $plusday - 1 . ' day'));
                        $newcollectedorder->updatedate = "";
                    } //end of morning shift -> previous day


                    // B- night shift -> same day
                    else {

                        // get current date and add plusdays to it
                        $newcollectedorder->deliverydate = date('Y-m-d', strtotime('+' . $plusday . ' day'));
                        $newcollectedorder->updatedate = "";
                    } //end of night shift -> same day



                    // increase assigneddays + plusday again
                    $assigneddays++;
                    $plusday++;

                    break;
                } //end of day match


            } //end while




            // save order to db
            $newcollectedorder->save();

            // increase firstorderid
            $firstorderid++;

        } //end for loop





        // add notification to UserNotification
        $notif = new UserNotification();

        $notif->shortinfo = session('partner_name') . " Restaurant Added a New Customer's Delivery/Deliveries";
        $notif->longinfo = session('partner_name') . " Restaurant Has Added a New Delivery/Deliveries For Customer " . $customer->name;

        $notif->datetime = date('Y-m-d - h:i A');
        $notif->linkroute = "";

        $notif->user_id = null;
        $notif->partner_id = session('partner_id');
        $notif->otherpartner_id = null;

        $notif->save();



        // return to view
        return redirect()->route('partner.dashboard');


    } //end of renew customer










    // remove notification
    public function removenotifications(Request $request) {


        // make all seen = 0 
        $updatenotification = PartnerNotification::where('partner_id', session('partner_id'))
        ->where('seen', 1)->update([
            'seen' => 0
        ]);

        return response()->json($updatenotification);



    } //end of remove notification



}
