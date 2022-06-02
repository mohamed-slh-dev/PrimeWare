<?php

namespace App\Http\Controllers;

use App\Models\Chargefee;
use App\Models\Collectedorder;
use App\Models\Customer;
use App\Models\CustomerConfirmedPayment;
use App\Models\CustomerFreeze;
use App\Models\CustomerRenew;
use App\Models\DriverCustomerMessage;
use App\Models\Message;
use App\Models\Optioncode;
use App\Models\Order;
use App\Models\Partner;
use App\Models\Ads;
use App\Models\PartnerCustomerMessage;
use App\Models\PartnerNotification;
use App\Models\Returnedbag;
use App\Models\Returnedcash;
use App\Models\Singleorder;
use App\Models\UserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminPartnerController extends Controller
{


    // all partners function
    public function partners()
    {

        // get partners
        $partners = Partner::orderBy('created_at', 'DESC')->paginate(6);

        // get types - city - districts
        $types = Optioncode::where('type', 'partnertype')->get();
        $cities = Optioncode::where('type', 'city')->get();
        $districts = Optioncode::where('type', 'district')->get();



        // return to view
        return view('admins.partners.all-partners', compact('partners', 'types', 'cities', 'districts'));

    } //end of all partners







    // add partner function
    public function addpartner(Request $request)
    {

        // get data
        $name = $request->name;
        $phone = $request->phone;
        $password = $request->password;
        
        $email = $request->email;
        $portalemail = $request->portalemail;

        $startdate = $request->startdate;
        $enddate = $request->enddate;


        // ids
        $type_id = $request->type;
        $city_id = $request->city;
        $district_id  = $request->district;

        $address = $request->address;
        $locationlink = '@'.$request->locationlink; //can be empty

        $info = $request->info; //can be empty




        // handle logo and contract files
        // A - logo (required)
        $logoname = time() . '-' . $request->file('logo')->getClientOriginalName();

        $request->file('logo')->move(public_path('assets/img/partners/logos'), $logoname);


        // A - contract (required)
        $contractname = time() . '-' . $request->file('contract')->getClientOriginalName();

        $request->file('contract')->move(public_path('assets/img/partners/contracts'), $contractname);





        // insert it inside the db
        $newpartner = new Partner();

        // copy data to it
        $newpartner->name = $name;
        $newpartner->phone = $phone;
        $newpartner->password = Hash::make($password);
        $newpartner->email = $email;
        $newpartner->portalemail = $portalemail;

        $newpartner->startdate = $startdate;
        $newpartner->enddate = $enddate;

        $newpartner->address = $address;
        $newpartner->locationlink = $locationlink;
        $newpartner->info = $info;

        $newpartner->type_id = $type_id;
        $newpartner->city_id = $city_id;
        $newpartner->district_id = $district_id;

        $newpartner->logo = $logoname;
        $newpartner->contract = $contractname;
        
        $newpartner->save();




        // add notification to UserNotification
        $notif = new UserNotification();

        $notif->shortinfo = "New Restaurant Added";
        $notif->longinfo = $newpartner->name . " Restaurant Has Been Added By " . session('user_name');

        $notif->datetime = date('Y-m-d - h:i A');
        $notif->linkroute = "admin.partners";

        $notif->user_id = session('user_id');
        $notif->partner_id = null;
        $notif->otherpartner_id = null;

        $notif->save();

        
        
        // redirect to route partners
        return redirect()->route('admin.partners');

    } //end of add partner







    // search partners function
    public function searchpartnermain(Request $request)
    {
        $searchkey = $request->searchinput;
        
        // search partners 
        $partners = Partner::where('name', 'LIKE', "%{$searchkey}%")
        ->orderBy('created_at', 'DESC')
        ->get();


        // get types - city - districts
        $types = Optioncode::where('type', 'partnertype')->get();
        $cities = Optioncode::where('type', 'city')->get();
        $districts = Optioncode::where('type', 'district')->get();

        // return to view
        return view('admins.partners.all-partners', compact('partners', 'types', 'cities', 'districts'));
        
    } //end of search partners





    // -------------------------------------



    // manage partners function
    public function managepartners()
    {
        // get partners
        $partners = Partner::orderBy('created_at', 'DESC')->paginate(10);


        // return to view
        return view('admins.partners.manage-partners', compact('partners'));
        
    } //end of manage partners







    // search partners function
    public function searchpartner(Request $request)
    {
        $searchkey = $request->searchinput;

        // search partners 
        $partners = Partner::where('name', 'LIKE', "%{$searchkey}%")
        ->orderBy('created_at', 'DESC')
        ->get();


        // return to view
        return view('admins.partners.manage-partners', compact('partners'));

    } //end of search partners



    





    // edit partner function
    public function editpartner(Request $request)
    {
        // get partner
        $partner = Partner::find($request->id);


        // get types - city - districts
        $types = Optioncode::where('type', 'partnertype')->get();
        $cities = Optioncode::where('type', 'city')->get();
        $districts = Optioncode::where('type', 'district')->get();


        // return to view
        return view('admins.partners.edit-partners', compact('partner', 'types', 'cities', 'districts'));
        
    } //end of edit partner







    // update partner function
    public function updatepartner(Request $request)
    {

        // get update info
        $name = $request->name;
        $phone = $request->phone;
        $password = $request->password;

        $email = $request->email;
        $portalemail = $request->portalemail;

        $startdate = $request->startdate;
        $enddate = $request->enddate;


        // ids
        $type_id = $request->type;
        $city_id = $request->city;
        $district_id  = $request->district;

        $address = $request->address;
        $locationlink = '@' . $request->locationlink; //can be empty

        $info = $request->info; //can be empty




        // handle logo and contract files
        // A - logo (not required)
        if (!empty($request->file('logo'))) {
            $logoname = time() . '-' . $request->file('logo')->getClientOriginalName();

            $request->file('logo')->move(public_path('assets/img/partners/logos'), $logoname);
        }


        if (!empty($request->file('contract'))) {
            // A - contract (not required)
            $contractname = time() . '-' . $request->file('contract')->getClientOriginalName();

            $request->file('contract')->move(public_path('assets/img/partners/contracts'), $contractname);
        }
        



        // update the partner
        $partner = Partner::find($request->id);

        // copy data to it
        $partner->name = $name;
        $partner->phone = $phone;
        
        if (!empty($password)) {

            $partner->password = Hash::make($password);
        }
        

        $partner->email = $email;
        $partner->portalemail = $portalemail;

        $partner->startdate = $startdate;
        $partner->enddate = $enddate;

        $partner->address = $address;
        $partner->locationlink = $locationlink;
        $partner->info = $info;

        $partner->type_id = $type_id;
        $partner->city_id = $city_id;
        $partner->district_id = $district_id;

        if (!empty($logoname)) 
            $partner->logo = $logoname;
        
        if (!empty($contractname))
            $partner->contract = $contractname;



        $partner->save();



        // add notification to UserNotification
        $notif = new UserNotification();

        $notif->shortinfo = "Restaurant's Info Updated";
        $notif->longinfo = $partner->name . " Restaurant Has Been Updated By " . session('user_name');

        $notif->datetime = date('Y-m-d - h:i A');
        $notif->linkroute = "admin.managepartners";

        $notif->user_id = session('user_id');
        $notif->partner_id = null;
        $notif->otherpartner_id = null;

        $notif->save();


        // return to view
        return redirect()->route('admin.managepartners');
        
    } //end of update partner




    // ----------




    public function deletepartner(Request $request)
    {


        $partner = Partner::find($request->id);



        $allcustomers = Customer::where('partner_id', $request->id)->get();

        foreach ($allcustomers as $customer) {

            // delete orders and collection orders
            $othercustomerslinked = Customer::where('linkedcustomer', $customer->id)->update([
                'linkedcustomer' => null,
            ]);


            // customer id tables
            $delete = CustomerConfirmedPayment::where('customer_id', $customer->id)->delete();
            $delete = CustomerFreeze::where('customer_id', $customer->id)->delete();
            $delete = CustomerRenew::where('customer_id', $customer->id)->delete();

            $delete = DriverCustomerMessage::where('customer_id', $customer->id)->delete();
            $delete = PartnerCustomerMessage::where('customer_id', $customer->id)->delete();

            $deleteorders = Collectedorder::where('customer_id', $customer->id)->delete();
            $deleteorders = Order::where('customer_id', $customer->id)->delete();

            $deleteorders = Ads::where('partner_id', $customer->id)->delete();


            // delete customer itself
            $deletecustomer = Customer::find($customer->id)->delete();


        } //end customer deleting that belong to this partner




        // delete relation
        $delete = Collectedorder::where('partner_id', $request->id)->delete();
        $delete = Order::where('partner_id', $request->id)->delete();
        $delete = Singleorder::where('partner_id', $request->id)->delete();

        $delete = Message::where('partner_id', $request->id)->delete();
        $delete = PartnerCustomerMessage::where('partner_id', $request->id)->delete();

        $delete = PartnerNotification::where('partner_id', $request->id)->delete();
        $delete = UserNotification::where('partner_id', $request->id)->delete();


        $delete = Returnedbag::where('partner_id', $request->id)->delete();
        $delete = Returnedcash::where('partner_id', $request->id)->delete();

        $delete = Ads::where('partner_id', $request->id)->delete();

        $deletepartner = Partner::find($request->id)->delete();


        // redirect to route partners
        return redirect()->route('admin.partners');

    } //end delete partner




    // ----------------------------------------





    // request partners function
    public function requestpartners() {

        // get partners
        $resturants = DB::table('requests')
        ->where('type', 'Restaurant')
        ->get();

     
        // return to view
        return view('admins.partners.request-partners', compact('resturants'));

        
        
    } //end of request partners








    
} //end of controller
