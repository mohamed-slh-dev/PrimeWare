<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Optioncode;
use App\Models\Otherpartner;
use App\Models\OtherpartnerNotification;
use App\Models\Othersingleorder;
use App\Models\UserNotification;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class AdminOtherPartnerController extends Controller
{
    


    // all partners function
    public function otherpartners()
    {

        // get partners
        $partners = Otherpartner::orderBy('created_at', 'DESC')->paginate(6);


        // get types - city - districts
        $types = Optioncode::where('type', 'partnertype')->get();
        $cities = Optioncode::where('type', 'city')->get();
        $districts = Optioncode::where('type', 'district')->get();



        // return to view
        return view('admins.otherpartners.all-partners', compact('partners', 'types', 'cities', 'districts'));

    } //end of all partners







    // add partner function
    public function addotherpartner(Request $request)
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
        // $type_id = $request->type;
        $city_id = $request->city;
        $district_id  = $request->district;

        $address = $request->address;
        $locationlink = '@' . $request->locationlink; //can be empty

        $info = $request->info; //can be empty
        $priority = $request->priority;




        // handle logo and contract files
        // A - logo (required)
        $logoname = time() . '-' . $request->file('logo')->getClientOriginalName();

        $request->file('logo')->move(public_path('assets/img/partners/logos'), $logoname);


        // A - contract (required)
        $contractname = time() . '-' . $request->file('contract')->getClientOriginalName();

        $request->file('contract')->move(public_path('assets/img/partners/contracts'), $contractname);





        // insert it inside the db
        $newpartner = new Otherpartner();

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
        $newpartner->priority = $priority;


        // $newpartner->type_id = $type_id;
        $newpartner->city_id = $city_id;
        $newpartner->district_id = $district_id;

        $newpartner->logo = $logoname;
        $newpartner->contract = $contractname;
        
        $newpartner->save();



        // add notification to UserNotification
        $notif = new UserNotification();

        $notif->shortinfo = "New Partner Added";
        $notif->longinfo = "Partner " . $newpartner->name . " Has Been Added By " . session('user_name');

        $notif->datetime = date('Y-m-d - h:i A');
        $notif->linkroute = "admin.otherpartners";

        $notif->user_id = session('user_id');
        $notif->partner_id = null;
        $notif->otherpartner_id = null;

        $notif->save();



        // redirect to route partners
        return redirect()->route('admin.otherpartners');

    } //end of add partner







    // search partners function
    public function searchotherpartnermain(Request $request)
    {
        $searchkey = $request->searchinput;
        
        // search partners 
        $partners = Otherpartner::where('name', 'LIKE', "%{$searchkey}%")
        ->orderBy('created_at', 'DESC')
        ->get();


        // get types - city - districts
        $types = Optioncode::where('type', 'partnertype')->get();
        $cities = Optioncode::where('type', 'city')->get();
        $districts = Optioncode::where('type', 'district')->get();

        // return to view
        return view('admins.otherpartners.all-partners', compact('partners', 'types', 'cities', 'districts'));
        
    } //end of search partners










    // ----------




    public function deleteotherpartner(Request $request)
    {


        $partner = Otherpartner::find($request->id);


        // depends
        $delete = OtherpartnerNotification::where('otherpartner_id', $request->id)->delete();
        $delete = Othersingleorder::where('otherpartner_id', $request->id)->delete();
        $delete = UserNotification::where('otherpartner_id', $request->id)->delete();


        $partner = Otherpartner::find($request->id)->delete();


        // redirect to route partners
        return redirect()->route('admin.otherpartners');
        

    } //end delete partner


    // -------------------------------------



    // manage partners function
    public function manageotherpartners()
    {
        // get partners
        $partners = Otherpartner::orderBy('created_at', 'DESC')->paginate(10);


        // return to view
        return view('admins.otherpartners.manage-partners', compact('partners'));
        
    } //end of manage partners







    // search partners function
    public function searchotherpartner(Request $request)
    {
        $searchkey = $request->searchinput;

        // search partners 
        $partners = Otherpartner::where('name', 'LIKE', "%{$searchkey}%")
        ->orderBy('created_at', 'DESC')
        ->get();


        // return to view
        return view('admins.otherpartners.manage-partners', compact('partners'));

    } //end of search partners



    





    // edit partner function
    public function editotherpartner(Request $request)
    {
        // get partner
        $partner = Otherpartner::find($request->id);


        // get types - city - districts
        $types = Optioncode::where('type', 'partnertype')->get();
        $cities = Optioncode::where('type', 'city')->get();
        $districts = Optioncode::where('type', 'district')->get();


        // return to view
        return view('admins.otherpartners.edit-partners', compact('partner', 'types', 'cities', 'districts'));
        
    } //end of edit partner







    // update partner function
    public function updateotherpartner(Request $request)
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
        // $type_id = $request->type;
        $city_id = $request->city;
        $district_id  = $request->district;

        $address = $request->address;
        $locationlink = '@' . $request->locationlink; //can be empty

        $info = $request->info; //can be empty
        $priority = $request->priority;




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
        $partner = Otherpartner::find($request->id);

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
        $partner->priority = $priority;
        
        // $partner->type_id = $type_id;

        $partner->city_id = $city_id;
        $partner->district_id = $district_id;

        if (!empty($logoname)) 
            $partner->logo = $logoname;
        
        if (!empty($contractname))
            $partner->contract = $contractname;



        $partner->save();


        // add notification to UserNotification
        $notif = new UserNotification();

        $notif->shortinfo = "Partner's Info Updated";
        $notif->longinfo = "Partner " . $partner->name . " Has Been Updated By " . session('user_name');

        $notif->datetime = date('Y-m-d - h:i A');
        $notif->linkroute = "admin.manageotherpartners";

        $notif->user_id = session('user_id');
        $notif->partner_id = null;
        $notif->otherpartner_id = null;

        $notif->save();



        // return to view
        return redirect()->route('admin.manageotherpartners');
        
    } //end of update partner










    // ----------------------------------------





    // request partners function
    public function requestotherpartners()
    {

        // get partners
        $partners = DB::table('requests')
        ->where('type', 'Partner')
        ->get();

        
        // return to view
        return view('admins.otherpartners.request-partners', compact('partners'));
    } //end of request partners



}
