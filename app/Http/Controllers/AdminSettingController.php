<?php

namespace App\Http\Controllers;

use App\Models\Chargefee;
use App\Models\Department;
use App\Models\Optioncode;
use App\Models\Otherchargefee;
use App\Models\Partner;
use App\Models\Primeware;
use App\Models\Supplier;
use App\Models\Supplierchargefee;
use App\Models\User;
use App\Models\UserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminSettingController extends Controller
{
    

    // general settings
    public function generalsettings() {

        // get primeware info
        $primeware = Primeware::find(1); //always 1


        return view('admins.settings.general-settings', compact('primeware'));

    } //end general settings






    public function updategeneralsettings(Request $request) {

        // get primeware info
        $primeware = Primeware::find(1); //always 1


        // update 
        $primeware->name = $request->name;
        $primeware->phone = $request->phone;
        $primeware->email = $request->email;



        // save it
        $primeware->save();



        // add notification to UserNotification
        $notif = new UserNotification();

        $notif->shortinfo = "Primeware's Info Updated";
        $notif->longinfo = "Primeware Settings Has Been Updated By " . session('user_name');

        $notif->datetime = date('Y-m-d - h:i A');
        $notif->linkroute = "admin.generalsettings";

        $notif->user_id = session('user_id');
        $notif->partner_id = null;
        $notif->otherpartner_id = null;

        $notif->save();

        return redirect()->route('admin.generalsettings');

    } //end general settings










    // ===================================================

    // all service settings function
    public function servicesettings()
    {
        // get charges and depened cities
        $groupedcharges = Chargefee::all()->groupBy('partner_id');


        // get charges and depened cities
        $groupedsupplierscharges = Supplierchargefee::all()->groupBy('supplier_id');

        // dd($charges);
        
        $othercharges = Otherchargefee::paginate(10, ['*'], 'othercharges');

        $cities = Optioncode::where('type', 'city')->get();

        $partners = Partner::all();

        $suppliers = Supplier::all();


        // return to view
        return view('admins.settings.service-settings', compact('groupedcharges', 'groupedsupplierscharges', 'othercharges', 'cities', 'partners', 'suppliers'));

    } //end of all service settings



    





    // add charge 
    public function addcharge(Request $request) {

        // get city id + charge
        $partner = Partner::find($request->partnerid);

        $fees = [

            $request->dubaifees, //1
            $request->abudhabifees, //2
            $request->sharjahfees, //3
            $request->ajmanfees, //4
            $request->ummfees, //5
            $request->alainfees, //6
            $request->rakfees, //7

        ];


        $cities = [

            3, //1
            4, //2
            5, //3
            6, //4
            7, //5
            8, //6
            9, //7
        ];

        // add cities fees in db (now they are 7)
        for ($i=0; $i < count($cities); $i++) {

            // add new charge
            $charge = new Chargefee();

            $charge->partner_id = $partner->id;

            $charge->city_id = $cities[$i];
            $charge->fees = $fees[$i];


            // save charge
            $charge->save();

        } // end for loop
        



        // add notification to UserNotification
        $notif = new UserNotification();

        $notif->shortinfo = "New Restaurant's Charge Added";
        $notif->longinfo = "New Charge Has Been Added To ". $partner->name ." Restaurant By " . session('user_name');

        $notif->datetime = date('Y-m-d - h:i A');
        $notif->linkroute = "admin.servicesettings";

        $notif->user_id = session('user_id');
        $notif->partner_id = null;
        $notif->otherpartner_id = null;

        $notif->save();



        return redirect()->route('admin.servicesettings');

    } //end add charge






    // edit charge 
    public function editcharge(Request $request)
    {


        // get city id + charge
        $partner = Partner::find($request->partnerid);

        $fees = [

            $request->dubaifees, //1
            $request->abudhabifees, //2
            $request->sharjahfees, //3
            $request->ajmanfees, //4
            $request->ummfees, //5
            $request->alainfees, //6
            $request->rakfees, //7

        ];


        $cities = [

            3, //1
            4, //2
            5, //3
            6, //4
            7, //5
            8, //6
            9, //7
        ];

        // add cities fees in db (now they are 7)
        for ($i = 0; $i < count($cities); $i++) {

            // update charge
            $updatecharge = Chargefee::where('partner_id', $partner->id)
            ->where('city_id', $cities[$i])
            ->update([
                'fees' => $fees[$i]
            ]);



        } // end for loop




        // add notification to UserNotification
        $notif = new UserNotification();

        $notif->shortinfo = "Restaurant's Charge Updated";
        $notif->longinfo = "Charge Has Been Updated For " . $partner->name . " Restaurant By " . session('user_name');

        $notif->datetime = date('Y-m-d - h:i A');
        $notif->linkroute = "admin.servicesettings";

        $notif->user_id = session('user_id');
        $notif->partner_id = null;
        $notif->otherpartner_id = null;

        $notif->save();

        

        return redirect()->route('admin.servicesettings');

    } //end edit charge












    // add supplier charge
    public function addsuppliercharge(Request $request)
    {

        // get city id + charge
        $partner = Supplier::find($request->partnerid);

        $fees = [

            $request->dubaifees, //1
            $request->abudhabifees, //2
            $request->sharjahfees, //3
            $request->ajmanfees, //4
            $request->ummfees, //5
            $request->alainfees, //6
            $request->rakfees, //7

        ];


        $cities = [

            3, //1
            4, //2
            5, //3
            6, //4
            7, //5
            8, //6
            9, //7
        ];

        // add cities fees in db (now they are 7)
        for ($i = 0; $i < count($cities); $i++) {

            // add new charge
            $charge = new Supplierchargefee();

            $charge->supplier_id = $partner->id;

            $charge->city_id = $cities[$i];
            $charge->fees = $fees[$i];


            // save charge
            $charge->save();
        } // end for loop




        // add notification to UserNotification
        $notif = new UserNotification();

        $notif->shortinfo = "New Supplier's Charge Added";
        $notif->longinfo = "New Charge Has Been Added To Supplier " . $partner->name . " By " . session('user_name');

        $notif->datetime = date('Y-m-d - h:i A');
        $notif->linkroute = "admin.servicesettings";

        $notif->user_id = session('user_id');
        $notif->partner_id = null;
        $notif->otherpartner_id = null;

        $notif->save();



        return redirect()->route('admin.servicesettings');
    } //end add charge









    //edit supplier charge
    public function editsuppliercharge(Request $request)
    {


        // get city id + charge
        $partner = Supplier::find($request->partnerid);

        $fees = [

            $request->dubaifees, //1
            $request->abudhabifees, //2
            $request->sharjahfees, //3
            $request->ajmanfees, //4
            $request->ummfees, //5
            $request->alainfees, //6
            $request->rakfees, //7

        ];


        $cities = [

            3, //1
            4, //2
            5, //3
            6, //4
            7, //5
            8, //6
            9, //7
        ];

        // add cities fees in db (now they are 7)
        for ($i = 0; $i < count($cities); $i++) {

            // update charge
            $updatecharge = Supplierchargefee::where('supplier_id', $partner->id)
            ->where('city_id', $cities[$i])
            ->update([
                'fees' => $fees[$i]
            ]);
        } // end for loop




        // add notification to UserNotification
        $notif = new UserNotification();

        $notif->shortinfo = "Supplier's Charge Updated";
        $notif->longinfo = "Charge Has Been Updated For Supplier " . $partner->name . " By " . session('user_name');

        $notif->datetime = date('Y-m-d - h:i A');
        $notif->linkroute = "admin.servicesettings";

        $notif->user_id = session('user_id');
        $notif->partner_id = null;
        $notif->otherpartner_id = null;

        $notif->save();



        return redirect()->route('admin.servicesettings');
    } //end edit charge










    // add othercharge 
    public function addothercharge(Request $request)
    {

        // get city id + charge
        $city_id = $request->city;
        $carriage = $request->carriage;

        $vantodayfees = $request->vantodayfees;
        $vannextdayfees = $request->vannextdayfees;

        $biketodayfees = $request->biketodayfees;
        $bikenextdayfees = $request->bikenextdayfees;




        // add new charge
        $charge = new Otherchargefee();

        $charge->city_id = $city_id;

        $charge->vantodayfees = $vantodayfees;
        $charge->vannextdayfees = $vannextdayfees;

        $charge->biketodayfees = $biketodayfees;
        $charge->bikenextdayfees = $bikenextdayfees;  


        // save charge
        $charge->save();



        // add notification to UserNotification
        $notif = new UserNotification();

        $notif->shortinfo = "New Partner's Charge Added";
        $notif->longinfo = "New Partner's Charge Has Been Added By " . session('user_name');

        $notif->datetime = date('Y-m-d - h:i A');
        $notif->linkroute = "admin.servicesettings";

        $notif->user_id = session('user_id');
        $notif->partner_id = null;
        $notif->otherpartner_id = null;

        $notif->save();
        




        return redirect()->route('admin.servicesettings');
    } //end add charge







    // edit othercharge 
    public function editothercharge(Request $request)
    {


        // get the targeted othercharge
        $charge = Otherchargefee::find($request->charge_id);

        // get change info
        $vantodayfees = $request->vantodayfees;
        $vannextdayfees = $request->vannextdayfees;

        $biketodayfees = $request->biketodayfees;
        $bikenextdayfees = $request->bikenextdayfees;


        // change the info now and save
        $charge->vantodayfees = $vantodayfees;
        $charge->vannextdayfees = $vannextdayfees;

        $charge->biketodayfees = $biketodayfees;
        $charge->bikenextdayfees = $bikenextdayfees;  


        // save charge
        $charge->save();


        // add notification to UserNotification
        $notif = new UserNotification();

        $notif->shortinfo = "Partner's Charge Updated";
        $notif->longinfo = "Partner's Charge Has Been Updated By " . session('user_name');

        $notif->datetime = date('Y-m-d - h:i A');
        $notif->linkroute = "admin.servicesettings";

        $notif->user_id = session('user_id');
        $notif->partner_id = null;
        $notif->otherpartner_id = null;

        $notif->save();



        return redirect()->route('admin.servicesettings');
    } //end edit charge






}
