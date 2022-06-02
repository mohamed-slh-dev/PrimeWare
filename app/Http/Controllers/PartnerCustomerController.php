<?php

namespace App\Http\Controllers;

use App\Models\Chargefee;
use App\Models\Collectedorder;
use App\Models\Customer;
use App\Models\CustomerConfirmedPayment;
use App\Models\CustomerFreeze;
use App\Models\CustomerRenew;
use App\Models\Driver;
use App\Models\DriverCustomerMessage;
use App\Models\DriverDistricts;
use App\Models\Optioncode;
use App\Models\Order;
use App\Models\PartnerCustomerMessage;
use App\Models\UserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PartnerCustomerController extends Controller
{

    // all customers function
    public function customers()
    {

        // get customers (monthly)
        $customers = Customer::where('partner_id', session()->get('partner_id'))->paginate(6);

        // get - city - districts
        $cities = Optioncode::where('type', 'city')->get();
        $districts = Optioncode::where('type', 'district')->get();


        // customers list
        $customerslist = Customer::where('partner_id', session()->get('partner_id'))->get();

        // return to view
        return view('partners.customers.all-customers', compact('customers', 'cities', 'districts', 'customerslist'));
        
    } //end of all customers






    









    // add customers function
    public function addcustomer(Request $request)
    {   


        // 1- get data and save to db
        $name = $request->name;
        $phone = $request->phone;

        if (!empty($request->password)) {
            $newpassword = $request->password;
        } else {
            $newpassword = "123456";
        }

        $address = $request->address;
        
        $flatnumber = $request->flatnumber;
        $blocknumber = $request->blocknumber;

        $locationlink = '@' . $request->locationlink; //can be empty
        $info = $request->info; //can be empty


        // service info
        $servicetype = $request->servicetype; //subscription - special
        $servicetiming = $request->servicetiming; //dates same as the input value


        // ids
        $city_id = $request->city;
        $district_id  = $request->district;



        // extra : partner id
        $partner_id = $request->partner;

        // --------------------------------------------------

        // delivery days number + deliverydays (1234567)
        $deliverydaysnumber = $request->deliverydaysnumber;

        // get the checked days
        $deliverydays = "";

        // 1- sunday
        $deliverydays .= (is_null($request->suncheck) ? "" : "1");

        // 2- monday
        $deliverydays .= (is_null($request->moncheck) ? "" : "2");

        // 3- tuesday
        $deliverydays .= (is_null($request->tuecheck) ? "" : "3");

        // 4- wednesday
        $deliverydays .= (is_null($request->wedcheck) ? "" : "4");

        // 5- thursday
        $deliverydays .= (is_null($request->thucheck) ? "" : "5");

        // 6- friday
        $deliverydays .= (is_null($request->fricheck) ? "" : "6");

        // 2- saturday
        $deliverydays .= (is_null($request->satcheck) ? "" : "7");


        // ---------------------------------------------------




        // substartdate + enddate
        $substartdate = $request->substartdate;
        $subenddate = $request->subenddate;

        $cashcollected = $request->cashcollected;

        // total fees
        $chargefees = Chargefee::where('partner_id', session('partner_id'))
        ->where('city_id', $city_id)->get();
        $chargefees = (!empty($chargefees[0]['fees']) ? $chargefees[0]['fees'] : 0);

        $totalfees = $chargefees * $deliverydaysnumber;
        
    
        // linkcustomer (foregin key can be null)
        $linkedcustomer = $request->linkcustomer;



        // special customer checkbox
        if (!is_null($request->specialcheck)) {

            $servicetype = "special"; //change the type
        }

        // specialpickuptime - specialdeliverytime (can be null)
        $specialpickuptime = $request->specialpickuptime;
        $specialdeliverytime = $request->specialdeliverytime;
        




        // save the customer into db
        $newcustomer = new Customer();

        $newcustomer->name = $name;
        $newcustomer->phone = $phone;
        $newcustomer->email = $request->email;

        $newcustomer->password = Hash::make($newpassword);
        $newcustomer->address = $address;

        $newcustomer->info = $info;
        $newcustomer->locationlink = $locationlink;


        $newcustomer->flatnumber = $flatnumber;
        $newcustomer->blocknumber = $blocknumber;

        $newcustomer->servicetype = $servicetype;
        $newcustomer->servicetiming = $servicetiming;

        $newcustomer->deliverydaysnumber = $deliverydaysnumber;
        $newcustomer->deliverydays = $deliverydays;

        $newcustomer->cashcollected = $cashcollected;
        $newcustomer->totalfees = $totalfees;


        $newcustomer->substartdate = $substartdate;
        $newcustomer->subenddate = $subenddate;



        // special customer fields (can be null)
        $newcustomer->specialpickuptime = $specialpickuptime;
        $newcustomer->specialdeliverytime = $specialdeliverytime;


        // foregins
        $newcustomer->linkedcustomer = $linkedcustomer; //can be null

        $newcustomer->city_id = $city_id;
        $newcustomer->district_id = $district_id;
        $newcustomer->partner_id = $partner_id;

        

        // save to db
        $newcustomer->save();


        // =========================================================


        //  2- insert orders

        // get the order driver first
        // pre - get morning shift drivers
        $drivers = null; $driver = null;

        if ($servicetiming == "3:00 AM - 8:00 AM" || $servicetiming == "8:00 AM - 12:00 PM") {

            $drivers = Driver::where('type', "driver")
            ->where('shift', 'morning shift')
            ->get();
        } //end of morning shift

        // get night shift drivers
        else {

            $drivers = Driver::where('type', "driver")
            ->where('shift', 'night shift')
            ->get();
        }

      

        // filter based on district
        foreach ($drivers as $tempdriver) {

            $driver = DriverDistricts::where('district_id', $district_id)
            ->where('driver_id', $tempdriver->id)
            ->first();

            // driver found
            if (!empty($driver)) {
                break;
            }
        } //end of finding a driver

      
        $assigneddays = 0;
        $plusday = 0;


        // difference between date
        $diff = time() - strtotime($substartdate);
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

        for ($i=0; $i < $deliverydaysnumber; $i++) { 


            // 2- save orders in db
            $neworder = new Order();

            // foregin keys
            $neworder->partner_id = $partner_id;
            $neworder->customer_id = $newcustomer->id;




            // if special no driver
            if ($servicetype != "special") {

                $neworder->driver_id = (!empty($driver) ? $driver->driver_id : null);

            }


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
            while(true) {

                // get day of week in integer 1-7 (actually return 0-6)
                $todayinweek = 1 + date('w', strtotime('+'. $plusday .' day'));
                
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
        $drivers = null;
        $driver = null;

        if ($servicetiming == "3:00 AM - 8:00 AM" || $servicetiming == "8:00 AM - 12:00 PM"
        ) {

            $drivers = Driver::where('type', "collector")
            ->where('shift', 'night shift')
            ->get();
        } //end of morning shift

        // get night shift drivers
        else {

            $drivers = Driver::where('type', "collector")
            ->where('shift', 'morning shift')
            ->get();
        }


        // filter based on district
        foreach ($drivers as $tempdriver) {

            $driver = DriverDistricts::where('district_id', $district_id)
            ->where('driver_id', $tempdriver->id)
            ->first();

            // driver found
            if (!empty($driver)) {
            break;
             }
        } //end of finding a driver


       
     


        $assigneddays = 0;
        $plusday = 0;


        // difference between date
        $diff = time() - strtotime($substartdate);
        $diff = round($diff / (60 * 60 * 24));

        // if its (negative) then there's deliveries undone yet
        if ($diff < 0) {
            $plusday = abs(intval($diff)) + 2;
        }

        // all deliveries done and finished start from 0
        else {
            $plusday = 1;
        }




        for ($i=0; $i < $deliverydaysnumber; $i++) { 


            // 2- save orders in db
            $newcollectedorder = new Collectedorder();

            // foregin keys
            $newcollectedorder->order_id = $firstorderid;
            $newcollectedorder->partner_id = $partner_id;
            $newcollectedorder->customer_id = $newcustomer->id;

    

            if ($servicetype != "special") {

                $newcollectedorder->driver_id = (!empty($driver) ? $driver->driver_id : null);
                
            }

        
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
            while(true) {

                // get day of week in integer 1-7 (actually return 0-6)
                $todayinweek = 1 + date('w', strtotime('+'. $plusday .' day'));
                
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





        // add this customer to confrimedpayment
        // $newconfirmedpayment = new CustomerConfirmedPayment();
        // $newconfirmedpayment->customer_id = $newcustomer->id;
        // $newconfirmedpayment->save();







        // add notification to UserNotification
        $notif = new UserNotification();

        $notif->shortinfo = session('partner_name') . " Restaurant Added a New Customer";
        $notif->longinfo = session('partner_name') . " Restaurant Has Added ". $request->name ." As a New Customer";

        $notif->datetime = date('Y-m-d - h:i A');
        $notif->linkroute = "";

        $notif->user_id = null;
        $notif->partner_id = session('partner_id');
        $notif->otherpartner_id = null;

        $notif->save();




        
        // return to home (customer route)
        return redirect()->route('partner.customers');
        
    } //end of add customer






    // search customer function
    public function searchcustomermain(Request $request)
    {

        $searchkey = $request->searchinput;

        // search customers (monthly)
        $customers = Customer::where('name', 'LIKE', "%{$searchkey}%")->get();

        // get - city - districts
        $cities = Optioncode::where('type', 'city')->get();
        $districts = Optioncode::where('type', 'district')->get();

        // customers list
        $customerslist = Customer::all();

        // return to view
        return view('partners.customers.all-customers', compact('customers', 'cities', 'districts', 'customerslist'));

    } //end of all customers








    

    // edit customer function
    public function editcustomer(Request $request)
    {
        // get customer
        $driver = Customer::find($request->id);

        // get - city - districts
        $cities = Optioncode::where('type', 'city')->get();
        $districts = Optioncode::where('type', 'district')->get();

        
        // customer districts
        $driverdistricts = DriverDistricts::where('driver_id', $request->id)->get();
        $ddlist = "";

        foreach ($driverdistricts as $dd) {

            $ddlist .= "".$dd->district_id;
        }

        
        // return to view
        return view('admins.drivers.edit-drivers', compact('driver', 'cities', 'districts', 'ddlist'));
        
    } //end of edit customer



    // ----------------------------------------




    // manage customers function
    public function managecustomers()
    {

        // get customers (monthly)
        $customers = Customer::where('partner_id', session()->get('partner_id'))->paginate(10);

        // return to view
        return view('partners.customers.manage-customers', compact('customers'));
        
    } //end of manage customers




    // search customer function
    public function searchcustomer(Request $request)
    {

        $searchkey = $request->searchinput;

        // search customers (monthly)
        $customers = Customer::where('partner_id', session()->get('partner_id'))
        ->where('name', 'LIKE', "%{$searchkey}%")
        ->get();

        // return to view
        return view('partners.customers.manage-customers', compact('customers'));

    } //end of all customers








    // renew customer
    public function renewcustomermain(Request $request) {

        // get customers + Orders
        $customer = Customer::find($request->id);

        // from request
        $renewdate = $request->renewdate;
        $cashcollected = $request->extracash;
        $deliverydaysnumber = $request->extradays;



        // check if renew date is less than last delivery date
        $startdate = $customer->orders->max('deliverydate');
        if ($renewdate <= $startdate) {

            return redirect()->route('partner.managecustomers');
            
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
        $notif->longinfo = session('partner_name') . " Restaurant Has Added a New Delivery/Deliveries For Customer ". $customer->name;

        $notif->datetime = date('Y-m-d - h:i A');
        $notif->linkroute = "";

        $notif->user_id = null;
        $notif->partner_id = session('partner_id');
        $notif->otherpartner_id = null;

        $notif->save();


        // return to view
        return redirect()->route('partner.managecustomers');


    } //end of renew customer













    // freeze customer orders
    public function freezeorders(Request $request) {

        // get date (freeze from - to)
        $freezefrom = $request->freezefrom;
        $freezeto = $request->freezeto;
       
        // convert date to my date type
        $freezefrom = date('Y-m-d' , strtotime($freezefrom));
        $freezeto = date('Y-m-d', strtotime($freezeto));


        // get customer
        $customer_id = $request->customer_id;
        $customer = Customer::find($customer_id);

        
        // get last order date
        $startdate = $customer->orders->max('deliverydate');
    
      


        
        // check if there's ordes between these date and same customer
        // 1- current orders
        $orders = Order::where('customer_id', $customer_id)
        ->where('deliverydate', '>=', $freezefrom)
        ->Where('deliverydate', '<=', $freezeto)
        ->get();


        $deliverydaysnumber = $orders->count();
        $deliverydays = $customer->deliverydays;

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





        // assign the orders to new date
        foreach ($orders as $order) {
        


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
                    $order->deliverydate = date('Y-m-d', strtotime('+' . $plusday . ' day'));

                    // increase assigneddays + plusday again
                    $assigneddays++;
                    $plusday++;

                    break;
                } //end of day match

            
                
            } //end while


            
            // save order date
            $order->save();


        } //end foreach loop
        





        //2 - collectedorders edit in correspond
        foreach ($orders as $order) {


            // get collectedorders with same id of these orders (cause they the same)
            $collectedorder = Collectedorder::find($order->id);

            
            // A- morning shif -> previous day
            if ($order->servicetiming == "3:00 AM - 8:00 AM" || $order->servicetiming == "8:00 AM - 12:00 PM") {


                $datebefore = date('Y-m-d', strtotime($order->deliverydate . ' -1 day'));


                $collectedorder->deliverydate = $datebefore;



            }

            // B- night shift -> same day
            else {


                $collectedorder->deliverydate = $order->deliverydate;

            }



            // save collectedorder date
            $collectedorder->save();


        } //end forloop




        // add notification to UserNotification
        $notif = new UserNotification();

        $notif->shortinfo = session('partner_name') . " Restaurant Freezed Customer's Delivery/Deliveries";
        $notif->longinfo = session('partner_name') . " Restaurant Has Freezed Delivery/Deliveries For Customer " . $customer->name;

        $notif->datetime = date('Y-m-d - h:i A');
        $notif->linkroute = "";

        $notif->user_id = null;
        $notif->partner_id = session('partner_id');
        $notif->otherpartner_id = null;

        $notif->save();
        


        // redirect to managecustomer
        return redirect()->route('partner.managecustomers');


    } //end of freeze customer orders










    // edit customer
    public function customerinfo($customer_id)
    {
        // get - city - districts
        $cities = Optioncode::where('type', 'city')->get();
        $districts = Optioncode::where('type', 'district')->get();
        //customer info
        $customer_info = Customer::where('id', $customer_id)->first();

        $orders = Order::where('customer_id', $customer_id)->paginate(10, ['*'], 'orders');

        return view('partners.customers.customer-info', compact('customer_info', 'cities', 'districts', 'orders'));
    }
    


    // update customer 
    public function updatecustomerinfo(Request $request)
    {

        $customer = Customer::find($request->customer_id);

        $customer->name = $request->name;
        $customer->phone = $request->phone;
        $customer->email = $request->email;

        $customer->locationlink = '@' . $request->location_link;
        $customer->address = $request->address;
        $customer->city_id = $request->city;
        $customer->district_id = $request->district;
        $customer->blocknumber = $request->block_no;
        $customer->flatnumber = $request->flat_no;
        $customer->info = $request->more_info;



        // reset password (optional)
        if (!empty($request->password)) {

            $customer->password = Hash::make($request->password);
            
        }


        $customer->save();

        return redirect()->route('partner.customer.info', [$request->customer_id])->with('success', 'Customer Info updated Successfully');
    }
















    // delivery days
    public function updatecustomerdeliverydays(Request $request)
    {



        
        // update deliveryd days
        $customer = Customer::find($request->customer_id);


        
        $customer->deliverydaysnumber = $request->deliverydays;


        $customer->save();




        



        



        $renewdate = $customer->substartdate;
        $cashcollected = 0;
        $deliverydaysnumber = $request->deliverydays;




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






        // delete customer orders and collected orders
        $delete = CustomerConfirmedPayment::where('customer_id', $request->customer_id)->delete();
        $delete = CustomerFreeze::where('customer_id', $request->customer_id)->delete();
        $delete = CustomerRenew::where('customer_id', $request->customer_id)->delete();

        $delete = DriverCustomerMessage::where('customer_id', $request->customer_id)->delete();
        $delete = PartnerCustomerMessage::where('customer_id', $request->customer_id)->delete();

        $deleteorders = Collectedorder::where('customer_id', $request->customer_id)->delete();
        $deleteorders = Order::where('customer_id', $request->customer_id)->delete();




        // insert new orders
        // =========================================================


        //  2- insert orders
        $assigneddays = 0;
        $plusday = 0;


        // difference between date
        $diff = time() - strtotime($customer->substartdate);
        $diff = round($diff / (60 * 60 * 24));


        // if its (negative) then there's deliveries undone yet
        if ($diff < 0) {
            $plusday = abs(intval($diff)) + 1;
        }

        // all deliveries done and finished start from 0
        else {
            $plusday = -1 * intval($diff - 1);
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

                $neworder->cashcollected = $customer->cashcollected;
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
        $diff = time() - strtotime($customer->substartdate);
        $diff = round($diff / (60 * 60 * 24));


        // if its (negative) then there's deliveries undone yet
        if ($diff < 0) {
            $plusday = abs(intval($diff)) + 1;
        }

        // all deliveries done and finished start from 0
        else {
            $plusday = -1 * intval($diff - 1);
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
                        $newcollectedorder->deliverydate = date('Y-m-d', strtotime('+' . ($plusday - 1) . ' day'));
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

        $notif->shortinfo = session('partner_name') . " Restaurant Deleted and Recreated Customer's Delivery/Deliveries";
        $notif->longinfo = session('partner_name') . " Restaurant Has Deleted and Recreated a New Delivery/Deliveries For Customer " . $customer->name;

        $notif->datetime = date('Y-m-d - h:i A');
        $notif->linkroute = "";

        $notif->user_id = null;
        $notif->partner_id = session('partner_id');
        $notif->otherpartner_id = null;

        $notif->save();




        return redirect()->route('partner.customer.info', [$request->customer_id])->with('success', 'Customer Info updated Successfully');
    }



    








    // ======================================================


    // renew requests page
    public function renewrequests() {

        // get renew requests
        $requests = CustomerRenew::orderBy('created_at', 'ASC')
        ->paginate(10, ['*'], 'requests');

        return view('partners.customers.renew-customers', compact('requests'));

    } //end renew customers requests page






    // renew customers
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

            return redirect()->route('partner.renewrequests');
            
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





        // delete requested deliveries from db
        $deletestatus = CustomerRenew::find($request->requestid)->delete();






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
        return redirect()->route('partner.renewrequests');


    } //end renew customers












    // delete customer
    public function deletecustomer(Request $request) {


        $customer = Customer::find($request->id);


        // delete orders and collection orders
        $othercustomerslinked = Customer::where('linkedcustomer', $customer->id)->update([
            'linkedcustomer' => null,
        ]);


        // customer id tables
        $delete = CustomerConfirmedPayment::where('customer_id', $request->id)->delete();
        $delete = CustomerFreeze::where('customer_id', $request->id)->delete();
        $delete = CustomerRenew::where('customer_id', $request->id)->delete();

        $delete = DriverCustomerMessage::where('customer_id', $request->id)->delete();
        $delete = PartnerCustomerMessage::where('customer_id', $request->id)->delete();

        $deleteorders = Collectedorder::where('customer_id', $request->id)->delete();
        $deleteorders = Order::where('customer_id', $request->id)->delete();




        // add notification to UserNotification
        $notif = new UserNotification();

        $notif->shortinfo = session('partner_name') . " Restaurant Deleted a Customer";
        $notif->longinfo = session('partner_name') . " Restaurant Has Deleted a Customer Named " . $customer->name;

        $notif->datetime = date('Y-m-d - h:i A');
        $notif->linkroute = "";

        $notif->user_id = null;
        $notif->partner_id = session('partner_id');
        $notif->otherpartner_id = null;

        $notif->save();





        // delete customer itself
        $customer = Customer::find($request->id)->delete();




        return redirect()->route('partner.customers');



    } //end of delete customer 








    // ========================================================


    // freeze requests page
    public function freezerequests() {

        // get renew requests
        $requests = CustomerFreeze::orderBy('created_at', 'ASC')
        ->paginate(10, ['*'], 'requests');

        return view('partners.customers.freeze-customers', compact('requests'));

    } //end renew customers requests page







    // freeze requests page
    public function confirmfreezerequest(Request $request) {



        // get date (freeze from - to)
        $freezefrom = $request->freezefrom;
        $freezeto = $request->freezeto;
       
        // convert date to my date type
        $freezefrom = date('Y-m-d' , strtotime($freezefrom));
        $freezeto = date('Y-m-d', strtotime($freezeto));


        // get customer
        $customer_id = $request->id;
        $customer = Customer::find($customer_id);

        
        // get last order date
        $startdate = $customer->orders->max('deliverydate');
    
      


        
        // check if there's ordes between these date and same customer
        // 1- current orders
        $orders = Order::where('customer_id', $customer_id)
        ->where('deliverydate', '>=', $freezefrom)
        ->Where('deliverydate', '<=', $freezeto)
        ->get();


        $deliverydaysnumber = $orders->count();
        $deliverydays = $customer->deliverydays;

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





        // assign the orders to new date
        foreach ($orders as $order) {
        


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
                    $order->deliverydate = date('Y-m-d', strtotime('+' . $plusday . ' day'));

                    // increase assigneddays + plusday again
                    $assigneddays++;
                    $plusday++;

                    break;
                } //end of day match

            
                
            } //end while


            
            // save order date
            $order->save();


        } //end foreach loop
        





        //2 - collectedorders edit in correspond
        foreach ($orders as $order) {


            // get collectedorders with same id of these orders (cause they the same)
            $collectedorder = Collectedorder::find($order->id);

            
            // A- morning shif -> previous day
            if ($order->servicetiming == "3:00 AM - 8:00 AM" || $order->servicetiming == "8:00 AM - 12:00 PM") {


                $datebefore = date('Y-m-d', strtotime($order->deliverydate . ' -1 day'));


                $collectedorder->deliverydate = $datebefore;



            }

            // B- night shift -> same day
            else {


                $collectedorder->deliverydate = $order->deliverydate;

            }



            // save collectedorder date
            $collectedorder->save();


        } //end forloop




        // add notification to UserNotification
        $notif = new UserNotification();

        $notif->shortinfo = session('partner_name') . " Restaurant Freezed Customer's Delivery/Deliveries";
        $notif->longinfo = session('partner_name') . " Restaurant Has Freezed Delivery/Deliveries For Customer " . $customer->name;

        $notif->datetime = date('Y-m-d - h:i A');
        $notif->linkroute = "";

        $notif->user_id = null;
        $notif->partner_id = session('partner_id');
        $notif->otherpartner_id = null;

        $notif->save();

        



        // delete renew requests
        $requests = CustomerFreeze::find($request->requestid)->delete();


        return redirect()->route('partner.freezerequests');

    } //end renew customers requests page



}
