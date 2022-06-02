<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Driver;
use App\Models\UserNotification;
use Illuminate\Http\Request;

class AdminAssetController extends Controller
{


    // all assets function
    public function assets()
    {
        // get assets
        $assets = Asset::orderBy('created_at', 'DESC')->paginate(10);



        // get all drivers
        $drivers = Driver::all();


        // return to view
        return view('admins.assets.all-assets', compact('assets', 'drivers'));

    } //end of all assets







    // search assets function
    public function searchassets(Request $request)
    {

        $searchkey = $request->searchinput;

        // search assets 
        $assets = Asset::where('name', 'LIKE', "%{$searchkey}%")
        ->orderBy('created_at', 'DESC')->get();


  
        // get all drivers
        $drivers = Driver::all();


        // return to view
        return view('admins.assets.all-assets', compact('assets', 'drivers'));

    } //end of search assets










    // add asset function
    public function addasset(Request $request)
    {
        

        // make new asset
        $asset = new Asset();

        // add info
        $asset->name = $request->name;
        $asset->model = $request->model;

        $asset->serialnumber = $request->serialnumber;
        $asset->status = $request->status;

        $asset->info = $request->info;


        // if there's a driver
        if (!empty($request->driver)) {

            $asset->driver_id = $request->driver;

        }


        // picture
        if (!empty($request->file('pic'))) {

            $picname = time() . '-' . $request->file('pic')->getClientOriginalName();

            $request->file('pic')->move(public_path('assets/img/assets/'), $picname);


            // add pic name to db
            $asset->pic = $picname;

        }




        // save asset
        $asset->save();



        // add notification to UserNotification
        $notif = new UserNotification();

        $notif->shortinfo = "New Asset Added";
        $notif->longinfo = "Asset: " . $asset->name . " Has Been Added By " . session('user_name');

        $notif->datetime = date('Y-m-d - h:i A');
        $notif->linkroute = "admin.assets";

        $notif->user_id = session('user_id');
        $notif->partner_id = null;
        $notif->otherpartner_id = null;

        $notif->save();

        


        // return to route
        return redirect()->route('admin.assets');

    } //end of add asset











    public function editassets(Request $request) {


        // find asset
        $asset = Asset::find($request->assetid);
        $drivers = Driver::all();


        return view('admins.assets.edit-asset', compact('asset', 'drivers'));


    } //end of edit function








    public function deleteassets(Request $request) {


        // delete asset
        $deleteasset = Asset::find($request->assetid)->delete();

        return redirect()->route('admin.assets');


    } //end of edit function







    // update assets
    public function updateassets(Request $request)
    {
        

        // find asset
        $asset = Asset::find($request->assetid);

        // add info
        $asset->name = $request->name;
        $asset->model = $request->model;

        $asset->serialnumber = $request->serialnumber;
        $asset->status = $request->status;

        $asset->info = $request->info;


        // if there's a driver
        if (!empty($request->driver)) {

            $asset->driver_id = $request->driver;

        }


        // picture
        if (!empty($request->file('pic'))) {

            $picname = time() . '-' . $request->file('pic')->getClientOriginalName();

            $request->file('pic')->move(public_path('assets/img/assets/'), $picname);


            // add pic name to db
            $asset->pic = $picname;

        }




        // save asset
        $asset->save();



        // add notification to UserNotification
        $notif = new UserNotification();

        $notif->shortinfo = "Asset Updated";
        $notif->longinfo = "Asset: " . $asset->name . " Has Been Updated By " . session('user_name');

        $notif->datetime = date('Y-m-d - h:i A');
        $notif->linkroute = "admin.assets";

        $notif->user_id = session('user_id');
        $notif->partner_id = null;
        $notif->otherpartner_id = null;

        $notif->save();

        


        // return to route
        return redirect()->route('admin.assets');

    } //end of add asset


}
