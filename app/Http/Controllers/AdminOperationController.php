<?php

namespace App\Http\Controllers;

use App\Models\Collectedorder;
use App\Models\Customer;
use App\Models\Driver;
use App\Models\Order;
use App\Models\Otherpartner;
use App\Models\Othersingleorder;
use App\Models\Partner;
use App\Models\Singleorder;
use App\Models\UserNotification;
use Illuminate\Http\Request;

class AdminOperationController extends Controller
{


    // operations all orders function
    public function allorders()
    {

        // get all orders + pag orders
        $orders = Order::orderBy('deliverydate', 'DESC')->get();

        $pagorders = Order::where('servicetype', 'subscription')
        ->orderBy('deliverydate', 'DESC')
        ->paginate(10, ['*'], 'orders');


        // special orders
        $pagspecialorders = Order::where('servicetype', 'special')
        ->orderBy('deliverydate', 'DESC')
        ->paginate(10, ['*'], 'special-deliveries');


        // get collected orders
        $collectedorders = Collectedorder::where('servicetype', 'subscription')
        ->orderBy('deliverydate', 'DESC')
        ->paginate(10, ['*'], 'collected-deliveries');



        // one time orders
        $singleorders = Singleorder::orderBy('deliverydate', 'DESC')->paginate(10, ['*'], 'single-deliveries');



        // othersingleorders
        $othersingleorders = Othersingleorder::orderBy('created_at', 'DESC')->paginate(10, ['*'], 'other-single-deliveries');


        // drivers + partners for filter
        $drivers = Driver::all();
        $partners = Partner::all();
        $otherpartners = Otherpartner::all();


        // return to view
        return view('admins.operations.all-orders', compact('orders', 'pagorders', 'drivers', 'partners', 'collectedorders', 'pagspecialorders', 'singleorders', 'othersingleorders', 'otherpartners'));

    } //end of operations all orders






    // search all orders
    public function searchallorders(Request $request) {


        // get all orders + pag orders
        $orders = Order::orderBy('deliverydate', 'DESC')->get();

        // filter here
        $filters = array();

         // id
         if ($request->id != null) {

            $filters["id"] = $request->id;
        }

        // status
        if ($request->status != "all") {

            $filters["status"] = $request->status;
        }

        // driver
        if ($request->driver != "all") {

            $filters["driver_id"] = $request->driver;
        }

        // partner
        if ($request->partner != "all") {

            $filters["partner_id"] = $request->partner;
        }


        $pagorders = Order::where('servicetype', 'subscription')
        ->where($filters)
        ->orderBy('deliverydate', 'DESC')
        ->paginate(10, ['*'], 'orders');



        // get collected orders
        $collectedorders = Collectedorder::where('servicetype', 'subscription')
        ->orderBy('deliverydate', 'DESC')
        ->paginate(10, ['*'], 'collected-deliveries');


        // special orders
        $pagspecialorders = Order::where('servicetype', 'special')
        ->orderBy('deliverydate', 'DESC')
        ->paginate(10, ['*'], 'special-deliveries');



        // one time orders
        $singleorders = Singleorder::orderBy('deliverydate', 'DESC')->paginate(10, ['*'], 'single-deliveries');



        // othersingleorders
        $othersingleorders = Othersingleorder::orderBy('created_at', 'DESC')->paginate(10, ['*'], 'other-single-deliveries');


        // drivers + partners for filter
        $drivers = Driver::all();
        $partners = Partner::all();
        $otherpartners = Otherpartner::all();


        // return to view
        return view('admins.operations.all-orders', compact('orders', 'pagorders', 'drivers', 'partners', 'collectedorders', 'pagspecialorders', 'singleorders', 'othersingleorders', 'otherpartners'));



    } //end of search all orders









    // search all orders
    public function searchcollectedorders(Request $request) {


        // get all orders + pag orders
        $orders = Order::orderBy('deliverydate', 'DESC')->get();

        $pagorders = Order::where('servicetype', 'subscription')
        ->orderBy('deliverydate', 'DESC')
        ->paginate(10, ['*'], 'orders');


        // filter here
        $filters = array();

         // id
         if ($request->id != null) {

            $filters["id"] = $request->id;
        }

        // status
        if ($request->status != "all") {

            $filters["status"] = $request->status;
        }


        // driver
        if ($request->driver != "all") {

            $filters["driver_id"] = $request->driver;
        }

        // partner
        if ($request->partner != "all") {

            $filters["partner_id"] = $request->partner;
        }





        // get collected orders
        $collectedorders = Collectedorder::where('servicetype', 'subscription')
        ->where($filters)
        ->orderBy('deliverydate', 'DESC')
        ->paginate(10, ['*'], 'collected-deliveries');


        // special orders
        $pagspecialorders = Order::where('servicetype', 'special')
        ->orderBy('deliverydate', 'DESC')
        ->paginate(10, ['*'], 'special-deliveries');


        // one time orders
        $singleorders = Singleorder::orderBy('deliverydate', 'DESC')->paginate(10, ['*'], 'single-deliveries');


        // othersingleorders
        $othersingleorders = Othersingleorder::orderBy('created_at', 'DESC')->paginate(10, ['*'], 'other-single-deliveries');


        // drivers + partners for filter
        $drivers = Driver::all();
        $partners = Partner::all();
        $otherpartners = Otherpartner::all();


        // return to view
        return view('admins.operations.all-orders', compact('orders', 'pagorders', 'drivers', 'partners', 'collectedorders', 'pagspecialorders', 'singleorders', 'othersingleorders', 'otherpartners'));



    } //end of search all orders











    // search other single orders
    public function searchothersingleorders(Request $request) {


        // get all orders + pag orders
        $orders = Order::orderBy('deliverydate', 'DESC')->get();

        $pagorders = Order::where('servicetype', 'subscription')
        ->orderBy('deliverydate', 'DESC')
        ->paginate(10, ['*'], 'orders');


        // filter here
        $filters = array();


        // id
        if ($request->id != null) {

            $filters["id"] = $request->id;
        }
        
        // status
        if ($request->status != "all") {

            $filters["status"] = $request->status;
        }


        // driver
        if ($request->driver != "all") {

            $filters["driver_id"] = $request->driver;
        }

        // partner
        if ($request->partner != "all") {

            $filters["otherpartner_id"] = $request->partner;
        }



        // othersingleorders
        $othersingleorders = Othersingleorder::where($filters)
        ->orderBy('created_at', 'DESC')
        ->paginate(10, ['*'], 'other-single-deliveries');




        // get collected orders
        $collectedorders = Collectedorder::where('servicetype', 'subscription')
        ->orderBy('deliverydate', 'DESC')
        ->paginate(10, ['*'], 'collected-deliveries');


        // special orders
        $pagspecialorders = Order::where('servicetype', 'special')
        ->orderBy('deliverydate', 'DESC')
        ->paginate(10, ['*'], 'special-deliveries');


        // one time orders
        $singleorders = Singleorder::orderBy('deliverydate', 'DESC')->paginate(10, ['*'], 'single-deliveries');


        


        // drivers + partners for filter
        $drivers = Driver::all();
        $partners = Partner::all();
        $otherpartners = Otherpartner::all();


        // return to view
        return view('admins.operations.all-orders', compact('orders', 'pagorders', 'drivers', 'partners', 'collectedorders', 'pagspecialorders', 'singleorders', 'othersingleorders', 'otherpartners'));



    } //end of search all orders





    // ===========================================================






    // operations today orders function
    public function todayorders()
    {

        $todaydate = date('Y-m-d');
        
        $orders = Order::where('deliverydate', $todaydate)->paginate(10);
        
        // customers (to get days orders count)
        $displayorders = Order::orderBy('deliverydate', 'DESC')->get();

        // get days orders count
        $sunorders = 0;
        $monorders = 0;
        $tueorders = 0;
        $wedorders = 0;
        $thuorders = 0;
        $friorders = 0;
        $satorders = 0;


        foreach ($displayorders as $order) {

            $orderday = 1 + date('w', strtotime($order->deliverydate));
            
            // sunday
            if ($orderday == 1) {
                $sunorders++;
            }

            // monday
            if ($orderday == 2) {
                $monorders++;
            }

            // tuesday
            if ($orderday == 3) {
                $tueorders++;
            }

            // wednesday
            if ($orderday == 4) {
                $wedorders++;
            }

            // thursday
            if ($orderday == 5) {
                $thuorders++;
            }

            // friday
            if ($orderday == 6) {
                $friorders++;
            }

            // saturday
            if ($orderday == 7) {
                $satorders++;
            }
        } //end of days counter


        

        // drivers + partners
        $partners = Partner::all();
        $drivers = Driver::all();



        // return to view
        return view('admins.operations.today-orders', compact('partners', 'drivers', 'orders', 'displayorders', 'sunorders', 'monorders', 'tueorders', 'wedorders', 'thuorders', 'friorders', 'satorders'));
        
    } //end of operations today orders










    // operations search today orders function
    public function searchtodayorders(Request $request)
    {

        $todaydate = date('Y-m-d');


        // filter here 
        $filters = array();

         // id
         if ($request->id != null) {

            $filters["id"] = $request->id;
        }

        // driver
        if ($request->driver != "all") {

            $filters["driver_id"] = $request->driver;
        }

        // partner
        if ($request->partner != "all") {

            $filters["partner_id"] = $request->partner;
        }


        // apply filter array
        $orders = Order::where('deliverydate', $todaydate)
        ->where($filters)
        ->paginate(10);
        




        // customers (to get days orders count)
        $displayorders = Order::orderBy('deliverydate', 'DESC')->get();

        // get days orders count
        $sunorders = 0;
        $monorders = 0;
        $tueorders = 0;
        $wedorders = 0;
        $thuorders = 0;
        $friorders = 0;
        $satorders = 0;


        foreach ($displayorders as $order) {

            $orderday = 1 + date('w', strtotime($order->deliverydate));
            
            // sunday
            if ($orderday == 1) {
                $sunorders++;
            }

            // monday
            if ($orderday == 2) {
                $monorders++;
            }

            // tuesday
            if ($orderday == 3) {
                $tueorders++;
            }

            // wednesday
            if ($orderday == 4) {
                $wedorders++;
            }

            // thursday
            if ($orderday == 5) {
                $thuorders++;
            }

            // friday
            if ($orderday == 6) {
                $friorders++;
            }

            // saturday
            if ($orderday == 7) {
                $satorders++;
            }
        } //end of days counter


        

        // drivers + partners
        $partners = Partner::all();
        $drivers = Driver::all();



        // return to view
        return view('admins.operations.today-orders', compact('partners', 'drivers', 'orders', 'displayorders', 'sunorders', 'monorders', 'tueorders', 'wedorders', 'thuorders', 'friorders', 'satorders'));
        
    } //end of operations search today orders








    // ==============================================================



    // operations health function
    public function healthoperations()
    {

        // get orders that don't have divers
        $orders = Order::whereNull('driver_id')
        ->orderBy('deliverydate', 'DESC')
        ->get();


        $orders = $orders->unique('customer_id');


        // get collectedorders that don't have divers
        $collectedorders = Collectedorder::whereNull('driver_id')
        ->orderBy('deliverydate', 'DESC')
        ->get();

        $collectedorders = $collectedorders->unique('customer_id');



        // get singleorders that don't have divers
        $singleorders = Singleorder::whereNull('driver_id')
        ->orderBy('deliverydate', 'DESC')
        ->paginate(10, ['*'], 'singleorders');

        


        // othersingle orders from partners
        $othersingleorders = Othersingleorder::whereNull('driver_id')
        ->orderBy('created_at', 'DESC')
        ->paginate(10, ['*'], 'othersingleorders');


        // get drivers
        $drivers = Driver::all();
        

        // return to view
        return view('admins.operations.health-operations', compact('orders', 'collectedorders', 'drivers', 'singleorders', 'othersingleorders'));


    } //end of operations health




    

    // add order driver in operation health function
    public function addorderdriver(Request $request)
    {

        // add driver to the customer in both orders and collected orders
        $customer_id = $request->customer_id;
        $driver_id = $request->driver_id;


        // update orders + collectedorders
        $updateorders = Order::whereNull('driver_id')
        ->where('customer_id', $customer_id)->update([
            'driver_id' => $driver_id
        ]);




        // add notification to UserNotification
        $customer = Customer::find($customer_id);
        $driver = Driver::find($driver_id);

        $notif = new UserNotification();

        $notif->shortinfo = "Driver is Assigned To A Restaurant's Delivery/Deliveries";
        $notif->longinfo = $customer->partner->name . " Restaurant Delivery/Deliveries Has Been Assigned To Driver " . $driver->name . " By " . session('user_name');

        $notif->datetime = date('Y-m-d - h:i A');
        $notif->linkroute = "";

        $notif->user_id = session('user_id');
        $notif->partner_id = null;
        $notif->otherpartner_id = null;

        $notif->save();


        
        

        // return to route (health page)
        return redirect()->route('admin.healthoperations');


    } //end of add order driver in operations health






    // add collectedorder driver in operation health function
    public function addcollectedorderdriver(Request $request)
    {

        // add driver to the customer in both orders and collected orders
        $customer_id = $request->customer_id;
        $driver_id = $request->driver_id;


        // update collectedorders
        $updatecollectedorders = Collectedorder::whereNull('driver_id')
        ->where('customer_id', $customer_id)->update([
            'driver_id' => $driver_id
        ]);



        // add notification to UserNotification
        $customer = Customer::find($customer_id);
        $driver = Driver::find($driver_id);

        $notif = new UserNotification();

        $notif->shortinfo = "Driver is Assigned To A Restaurant's Collection Delivery/Deliveries";
        $notif->longinfo = $customer->partner->name . " Restaurant Collection Delivery/Deliveries Has Been Assigned To Driver " . $driver->name . " By " . session('user_name');

        $notif->datetime = date('Y-m-d - h:i A');
        $notif->linkroute = "";

        $notif->user_id = session('user_id');
        $notif->partner_id = null;
        $notif->otherpartner_id = null;

        $notif->save();
        

        // return to route (health page)
        return redirect()->route('admin.healthoperations');


    } //end of add order driver in operations health










    // add singleorders driver in operation health function
    public function addsingleordersdriver(Request $request)
    {

        // add driver to the customer in both orders and collected orders
        $order_id = $request->order_id;
        $driver_id = $request->driver_id;


        // update collectedorders
        $updatesingleedorders = Singleorder::where('id', $order_id)->update([
            'driver_id' => $driver_id
        ]);


        // add notification to UserNotification
        $singleorder = Singleorder::find($order_id);
        $driver = Driver::find($driver_id);

        $notif = new UserNotification();

        $notif->shortinfo = "Driver is Assigned To A Restaurant's One-time Delivery";
        $notif->longinfo = $singleorder->partner->name . " Restaurant One-time Delivery Has Been Assigned To Driver " . $driver->name . " By " . session('user_name');

        $notif->datetime = date('Y-m-d - h:i A');
        $notif->linkroute = "";

        $notif->user_id = session('user_id');
        $notif->partner_id = null;
        $notif->otherpartner_id = null;

        $notif->save();



        // return to route (health page)
        return redirect()->route('admin.healthoperations');


    } //end of add singleorders driver in operations health








    // add other singleorders driver in operation health function
    public function addothersingleordersdriver(Request $request)
    {

        // add driver to the order
        $order_id = $request->order_id;
        $driver_id = $request->driver_id;


        // update othesingle
        $updatesingleedorders = Othersingleorder::where('id', $order_id)->update([
            'driver_id' => $driver_id
        ]);


        // add notification to UserNotification
        $singleorder = Othersingleorder::find($order_id);
        $driver = Driver::find($driver_id);

        $notif = new UserNotification();

        $notif->shortinfo = "Driver is Assigned To A Restaurant's One-time Delivery";
        $notif->longinfo = "Partner " . $singleorder->otherpartner->name . " Delivery Has Been Assigned To Driver " . $driver->name . " By " . session('user_name');

        $notif->datetime = date('Y-m-d - h:i A');
        $notif->linkroute = "";

        $notif->user_id = session('user_id');
        $notif->partner_id = null;
        $notif->otherpartner_id = null;

        $notif->save();

        // return to route (health page)
        return redirect()->route('admin.healthoperations');


    } //end of add other singleorders driver in operations health









    // ================================================================







    // all payments
    public function payments()
    {


        // get customers when totalfees != 0 
        $customers = Customer::where('totalfees', '>', 0)->paginate(10, ['*'], 'regular-customers');

        // single orders
        $singleorders = Singleorder::where('chargefees', '>', 0)->paginate(10, ['*'], 'single-orders');


        // get other partners orders
        $otherorders = Othersingleorder::where('chargefees', '>', 0)->paginate(10, ['*'], 'other-orders');
        
        
        // partners to show above
        $partners = Partner::all();


        // (payments page)
        return view('admins.operations.payments', compact('customers', 'otherorders', 'singleorders', 'partners'));


    } //end all payments





    // confirm payments
    public function confirmpayment(Request $request)
    {


        // update customer 
        $customers = Customer::where('partner_id', $request->partner_id)->get();
        $payedfees = 0;

        foreach ($customers as $customer) {

            //  get payed fees
            $payedfees += $customer->totalfees;

            // make fees = 0
            $customer->totalfees = 0;
            $customer->save();

        }


        // singleorder payment too
        $orders = Singleorder::where('partner_id', $request->partner_id)->get();

        foreach ($orders as $order) {

            //  get payed fees
            $payedfees += $order->chargefees;

            $order->chargefees = 0;

            $order->save();

        } //end for loop

        


        // update payed fees
        $partner = Partner::find($request->partner_id);
        $partner->payedfees += $payedfees;
        $partner->save();


        


        // add notification to UserNotification
        $notif = new UserNotification();

        $notif->shortinfo = "Restaurant's Payment Confirmed";
        $notif->longinfo = $partner->name . " Restaurant Charge Fee Has Been Confirmed By " . session('user_name');

        $notif->datetime = date('Y-m-d - h:i A');
        $notif->linkroute = "";

        $notif->user_id = session('user_id');
        $notif->partner_id = null;
        $notif->otherpartner_id = null;

        $notif->save();
      

        // (payments page)
        return redirect()->route('admin.payments');


    } //end confirm payment





    // confirm single payments
    public function confirmsinglepayment(Request $request)
    {


        // update singleorder 
        $order = Singleorder::find($request->orderid);

        // make fees = 0
        $order->chargefees = 0;


        $order->save();


        // add notification to UserNotification
        $notif = new UserNotification();

        $notif->shortinfo = "Restaurant's Payment Confirmed";
        $notif->longinfo = $order->partner->name . " Restaurant Charge Fees For One-time Delivery To Customer " . $order->customer_name . " Has Been Confirmed By " . session('user_name');

        $notif->datetime = date('Y-m-d - h:i A');
        $notif->linkroute = "";

        $notif->user_id = session('user_id');
        $notif->partner_id = null;
        $notif->otherpartner_id = null;

        $notif->save();


        // (payments page)
        return redirect()->route('admin.payments');


    } //end confirm single payment









    // all payments
    public function otherpayments()
    {


        // get other partners orders
        $otherorders = Othersingleorder::where('chargefees', '>', 0)->paginate(10, ['*'], 'other-orders');

        $partners = Otherpartner::all();


        // (payments page)
        return view('admins.operations.partners-payment', compact('otherorders', 'partners'));

    }





    // confirm other payments
    public function confirmotherpayment(Request $request)
    {



        // singleorder payment too
        $orders = Othersingleorder::where('otherpartner_id', $request->partner_id)
        ->where('paymentstatus', 'not paid')->get();

        $payedfees = 0;


        foreach ($orders as $order) {

            //  get payed fees
            $payedfees += $order->chargefees;

            $order->paymentstatus = "paid";


            $order->save();
        } //end for loop




        // update payed fees
        $partner = Otherpartner::find($request->partner_id);
        $partner->payedfees += $payedfees;
        $partner->save();



        // add notification to UserNotification
        $notif = new UserNotification();

        $notif->shortinfo = "Partner's Payment Confirmed";
        $notif->longinfo = "Partner " . $order->otherpartner->name . " Charge Fees Has Been Confirmed By " . session('user_name');

        $notif->datetime = date('Y-m-d - h:i A');
        $notif->linkroute = "";

        $notif->user_id = session('user_id');
        $notif->partner_id = null;
        $notif->otherpartner_id = null;

        $notif->save();



        // (payments page)
        return redirect()->route('admin.otherpayments');


    } //end confirm other payment

    










    // =======================================================



    // tracking function
    public function tracking() {


        // for statistics
        $restaurantOrders = Order::all();
        $restaurantSingleOrders = Singleorder::all();

        $partnerOrders = Othersingleorder::all();

        // pending orders + delivered orders
        $pendingTotal = $restaurantOrders->where('status', '!=', 'delivered')->count() + $restaurantSingleOrders->where('status', '!=', 'delivered')->count() + $partnerOrders->where('status', '!=', 'delivered')->count();

        $deliveredTotal = $restaurantOrders->where('status', 'delivered')->count() + $restaurantSingleOrders->where('status', 'delivered')->count() + $partnerOrders->where('status', 'delivered')->count();



        // fot filters
        $drivers = Driver::all();

        return view('admins.operations.tracking', compact('drivers', 'restaurantOrders', 'restaurantSingleOrders', 'partnerOrders', 'deliveredTotal', 'pendingTotal'));


    } //end of tracking






    // filter tracking 
    public function filtertracking(Request $request) {


        // for statistics
        $restaurantOrders = Order::all();
        $restaurantSingleOrders = Singleorder::all();

        $partnerOrders = Othersingleorder::all();

        // pending orders + delivered orders
        $pendingTotal = $restaurantOrders->where('status', '!=', 'delivered')->count() + $restaurantSingleOrders->where('status', '!=', 'delivered')->count() + $partnerOrders->where('status', '!=', 'delivered')->count();

        $deliveredTotal = $restaurantOrders->where('status', 'delivered')->count() + $restaurantSingleOrders->where('status', 'delivered')->count() + $partnerOrders->where('status', 'delivered')->count();


        



        // for statistics
        // get orders with chosen driver only
        $filters = array();

        //driver filter
        if (!empty($request->driverid)) {

            $filters['driver_id'] = $request->driverid;

            $restaurantOrders = Order::where($filters)->get();
            $restaurantSingleOrders = Singleorder::where($filters)->get();

            $partnerOrders = Othersingleorder::where($filters)->get();

        }


        // no filter
        else {

            $restaurantOrders = Order::all();
            $restaurantSingleOrders = Singleorder::all();

            $partnerOrders = Othersingleorder::all();

        }
        



        // from filters
        $drivers = Driver::all();

        return view('admins.operations.tracking', compact('drivers', 'restaurantOrders', 'restaurantSingleOrders', 'partnerOrders', 'deliveredTotal', 'pendingTotal'));


    } //end of filter tracking
    


}
