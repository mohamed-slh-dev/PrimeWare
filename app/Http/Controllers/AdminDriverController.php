<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Collectedorder;
use App\Models\Driver;
use App\Models\DriverCustomerMessage;
use App\Models\DriverDistricts;
use App\Models\Message;
use App\Models\Optioncode;
use App\Models\Order;
use App\Models\Othersingleorder;
use App\Models\Returnedbag;
use App\Models\Returnedcash;
use App\Models\Singleorder;
use App\Models\UserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminDriverController extends Controller
{


    // all drivers function
    public function drivers()
    {

        // get drivers
        $drivers = Driver::orderBy('created_at', 'DESC')->paginate(6);

        // get - city - districts
        $cities = Optioncode::where('type', 'city')->get();
        $districts = Optioncode::where('type', 'district')->get();

        // return to view
        return view('admins.drivers.all-drivers', compact('drivers', 'cities', 'districts'));

    } //end of all drivers






    public function deletedriver(Request $request)
    {

        $driver = Driver::find($request->id);


        // depends
        $delete = Asset::where('driver_id', $request->id)->update([
            'driver_id'=> null,
        ]);


        $delete = Collectedorder::where('driver_id', $request->id)->update([
            'driver_id' => null,
        ]);
        $delete = Order::where('driver_id', $request->id)->update([
            'driver_id' => null,
        ]);
        $delete = Singleorder::where('driver_id', $request->id)->update([
            'driver_id' => null,
        ]);
        $delete = Othersingleorder::where('driver_id', $request->id)->update([
            'driver_id' => null,
        ]);
        

        $delete = Returnedbag::where('driver_id', $request->id)->update([
            'driver_id' => null,
        ]);
        $delete = Returnedcash::where('driver_id', $request->id)->update([
            'driver_id' => null,
        ]);


        $delete = DriverCustomerMessage::where('driver_id', $request->id)->delete();
        $delete = Message::where('driver_id', $request->id)->delete();

        $delete = DriverDistricts::where('driver_id', $request->id)->delete();




        // delete driver himself
        $delete = Driver::find($request->id)->delete();


        return redirect()->route('admin.drivers');


    } //end delete driver







    // add driver function
    public function adddriver(Request $request)
    {

       
        // get data
        $name = $request->name;
        $phone = $request->phone;
        $license = $request->license;

        $type = $request->type;
        $shift = $request->shift;

        $info = $request->info; //can be empty
        

        // ids
        $city_id = $request->city;



        // handle picture and car picture files
        // A - picture (required)
        $ppname = time() . '-' . $request->file('pic')->getClientOriginalName();

        $request->file('pic')->move(public_path('assets/img/drivers/profiles'), $ppname);


        // B - license pic (required)
        $licpic = time() . '-' . $request->file('licpic')->getClientOriginalName();

        $request->file('licpic')->move(public_path('assets/img/drivers/licenses'), $licpic);


     





        // insert it inside the db
        $newdriver = new Driver();

        // copy data to it
        $newdriver->name = $name;
        $newdriver->phone = $phone;

        $newdriver->drivinglicense = $license;

        $newdriver->password = Hash::make($request->password);
        $newdriver->email =  $request->email;

        $newdriver->type = $type;
        $newdriver->shift = $shift;

        $newdriver->info = $info; //can be empty

        // ids foregin
        $newdriver->city_id = $city_id;
        

        // files
        $newdriver->pic = $ppname;
        $newdriver->licensepic = $licpic;

        $newdriver->save();




        // save districts choosen (DriverDistricts) (multipe)
        foreach ($request->districts as $district) {
            
            // create and save
            $driverDistrict = new DriverDistricts();

            $driverDistrict->driver_id = $newdriver->id;
            $driverDistrict->district_id = $district;

           
            $driverDistrict->save();

        } //end of adding district x driver to db





        // add notification to UserNotification
        $notif = new UserNotification();

        $notif->shortinfo = "New Driver Added";
        $notif->longinfo = "Driver " . $newdriver->name . " Has Been Added By " . session('user_name');

        $notif->datetime = date('Y-m-d - h:i A');
        $notif->linkroute = "admin.drivers";

        $notif->user_id = session('user_id');
        $notif->partner_id = null;
        $notif->otherpartner_id = null;

        $notif->save();



        // redirect to route drivers
        return redirect()->route('admin.drivers');

    } //end of add driver







    // search drivers function
    public function searchdrivermain(Request $request)
    {
        $searchkey = $request->searchinput;

        // search drivers 
        $drivers = Driver::where('name', 'LIKE', "%{$searchkey}%")
        ->orderBy('created_at', 'DESC')
        ->get();


        // get - city - districts
        $cities = Optioncode::where('type', 'city')->get();
        $districts = Optioncode::where('type', 'district')->get();

        // return to view
        return view('admins.drivers.all-drivers', compact('drivers', 'cities', 'districts'));

    } //end of search drivers





    // ---------------------------------------




    // manage drivers function
    public function managedrivers()
    {

        // get drivers
        $drivers = Driver::orderBy('created_at', 'DESC')->paginate(10);

        // return to view
        return view('admins.drivers.manage-drivers', compact('drivers'));

    } //end of manage drivers





    // search drivers function
    public function searchdriver(Request $request)
    {
        $searchkey = $request->searchinput;

        // search drivers 
        $drivers = Driver::where('name', 'LIKE', "%{$searchkey}%")
        ->orderBy('created_at', 'DESC')
        ->get();


        // return to view
        return view('admins.drivers.manage-drivers', compact('drivers'));

    } //end of search drivers






    // edit driver function
    public function editdriver(Request $request)
    {
        // get driver
        $driver = Driver::find($request->id);

        if ($driver->type == 'driver') {
            // bagorders
        $orders = Order::where('driver_id', $request->id)->paginate(15);
        }else{
             // bagorders
        $orders = Collectedorder::where('driver_id', $request->id)->paginate(15);
        }

      

        // get - city - districts
        $cities = Optioncode::where('type', 'city')->get();
        $districts = Optioncode::where('type', 'district')->get();

        
        // driver districts
        $driverdistricts = DriverDistricts::where('driver_id', $request->id)->get();
        
        $ddlist = "";

        foreach ($driverdistricts as $dd) {

            $ddlist .= ",".$dd->district_id.",";
        }
     
      

        // return to view
        return view('admins.drivers.edit-drivers', compact('driver', 'orders', 'cities', 'districts', 'ddlist'));
        
    } //end of edit driver










    // add driver function
    public function updatedriver(Request $request)
    {

        // get data
        $name = $request->name;
        $phone = $request->phone;
        $platenumber = $request->platenumber;
        $license = $request->license;

        $type = $request->type;
        $shift = $request->shift;

        $info = $request->info; //can be empty
        

        // ids
        $city_id = $request->city;



        // handle picture and car picture files
        // A - pic (not required)
        if (!empty($request->file('pic'))) {

            $ppname = time() . '-' . $request->file('pic')->getClientOriginalName();

            $request->file('pic')->move(public_path('assets/img/drivers/profiles'), $ppname);

        }




        // B - license pic (not required)
        if (!empty($request->file('licpic'))) {

            $licpic = time() . '-' . $request->file('licpic')->getClientOriginalName();

            $request->file('licpic')->move(public_path('assets/img/drivers/licenses'), $licpic);
        }




        // C - car pic (not required)
        if (!empty($request->file('carpic'))) {

            $carpicname = time() . '-' . $request->file('carpic')->getClientOriginalName();

            $request->file('carpic')->move(public_path('assets/img/drivers/cars'), $carpicname);
        }
        





        // update it inside the db
        $driver = Driver::find($request->id);

        // copy data to it
        $driver->name = $name;
        $driver->phone = $phone;

        $driver->drivinglicense = $license;
        $driver->platenumber = $platenumber;

        $driver->type = $type;
        $driver->shift = $shift;

        $driver->info = $info; //can be empty

        // ids foregin
        $driver->city_id = $city_id;
        

        // files
        if (!empty($ppname))
            $driver->pic = $ppname;

        if (!empty($licpic))
            $driver->licensepic = $licpic;


        if (!empty($carpicname))
            $driver->carpic = $carpicname;


        
        $driver->save();



        // delete all drivers district and add them again
        $deletedistricts = DriverDistricts::where('driver_id', $request->id)->delete();

        
        // update districts choosen (DriverDistricts) (multipe)
        foreach ($request->districts as $district) {
            
            // create and save
            $driverDistrict = new DriverDistricts();

            $driverDistrict->driver_id = $request->id;
            $driverDistrict->district_id = $district;

            $driverDistrict->save();

        } //end of adding district x driver to db





        // add notification to UserNotification
        $notif = new UserNotification();

        $notif->shortinfo = "Driver's Info Updated";
        $notif->longinfo = "Driver " . $driver->name . " Has Been Updated By " . session('user_name');

        $notif->datetime = date('Y-m-d - h:i A');
        $notif->linkroute = "admin.managedrivers";

        $notif->user_id = session('user_id');
        $notif->partner_id = null;
        $notif->otherpartner_id = null;

        $notif->save();



        // redirect to route drivers
        return redirect()->route('admin.managedrivers');

    } //end of add driver






    // ------------------------------



    // request drivers function
    public function requestdrivers()
    {

        // return to view
        return view('admins.drivers.request-drivers');
    } //end of request drivers






    // -------------------------------------





    // setting drivers function
    public function settingdrivers()
    {

        // return to view
        return view('admins.drivers.setting-drivers');
        
    } //end of setting drivers


}
