<?php

namespace App\Http\Controllers;

use App\Models\Collectedorder;
use App\Models\Customer;
use App\Models\Driver;
use App\Models\Order;
use App\Models\Partner;
use App\Models\Singleorder;
use App\Models\UserNotification;
use Illuminate\Http\Request;

class AdminCustomerController extends Controller
{

    // all customers function
    public function customers()
    {
        // get partners (everything else is just a relation)
        $partners = Partner::paginate(10);


        // return to view
        return view('admins.customers.all-customers', compact('partners'));

    } //end of all customers




    // search customers function
    public function searchcustomermain(Request $request)
    {

        $searchkey = $request->searchinput;


        // get partners (everything else is just a relation)
        $partners = Partner::where('name', 'LIKE', "%{$searchkey}%")->get();


        // return to view
        return view('admins.customers.all-customers', compact('partners'));

    } //end of search customers





    // manage customers function
    public function managecustomers()
    {

        // get partners (everything else is just a relation)
        $partners = Partner::orderBy('created_at', 'DESC')->paginate(10);

        // customers without drivers
        $orders = Order::whereNull('driver_id')
        ->where('servicetype', 'special')
        ->orderBy('deliverydate', 'DESC')
        ->get();

        $orders = $orders->unique('customer_id');


        // singleorders
        $singleorders = Singleorder::whereNull('driver_id')
        ->orderBy('deliverydate', 'DESC')
        ->paginate(10, ['*'], 'single-deliveries');


        // get drivers
        $drivers = Driver::all();


        // get pagination drivers 
        $pagdrivers = Driver::orderBy('created_at', 'DESC')->paginate(5, ['*'], 'drivers');


        

        // return to view
        return view('admins.customers.manage-customers', compact('partners', 'orders', 'drivers', 'pagdrivers', 'singleorders'));
    } //end of manage customers





    
    // add special order driver function
    public function addspecialorderdriver(Request $request)
    {

        // edit special order driver id
        $updateorders = Order::whereNull('driver_id')
        ->where('customer_id', $request->id)
        ->update([
            'driver_id' => $request->driver
        ]);


        $updateorders = Collectedorder::whereNull('driver_id')
        ->where('customer_id', $request->id)
        ->update([
            'driver_id' => $request->driver
        ]);



        // add notification to UserNotification
        // get driver
        $driver = Driver::find($request->driver);

        $notif = new UserNotification();

        $notif->shortinfo = "A Driver Is Assigned To A Special Customer";
        $notif->longinfo = "Driver " . $driver->name . " Has Been Assigned To A Special Customer By " . session('user_name');

        $notif->datetime = date('Y-m-d - h:i A');
        $notif->linkroute = "";

        $notif->user_id = session('user_id');
        $notif->partner_id = null;
        $notif->otherpartner_id = null;

        $notif->save();


        
        // return to view
        return redirect()->route('admin.managecustomers');

    } //end of add special order driver












    // ------------------- extra
    // add one time order driver function  (customers page)
    public function addonetimeorderdriver(Request $request)
    {  

        // get order id + driver id
        $order_id = $request->order_id;
        $driver_id = $request->driver_id;


        // update 
        $updateorder = Singleorder::find($order_id)->update([

            'driver_id' => $driver_id

            ]);


        // add notification to UserNotification
        // get driver
        $driver = Driver::find($driver_id);

        $notif = new UserNotification();

        $notif->shortinfo = "A Driver Is Assigned To One-time Delivery";
        $notif->longinfo = "Driver " . $driver->name . " Has Been Assigned To One-time Delivery By " . session('user_name');

        $notif->datetime = date('Y-m-d - h:i A');
        $notif->linkroute = "";

        $notif->user_id = session('user_id');
        $notif->partner_id = null;
        $notif->otherpartner_id = null;

        $notif->save();

        
        // return to view
        return redirect()->route('admin.managecustomers');

    } //end of add one time order driver function (customers page function)

}
