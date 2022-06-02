<?php

namespace App\Http\Controllers;

use App\Models\Chargefee;
use App\Models\Customer;
use App\Models\Optioncode;
use App\Models\Order;
use App\Models\Partner;
use App\Models\Singleorder;
use App\Models\UserNotification;
use Illuminate\Http\Request;

class PartnerDeliveryController extends Controller
{
    
    public function deliveries() {

        // get partner (id suppose to come from session)
        $partner = Partner::find(session()->get('partner_id'));


        // get - city - districts
        $cities = Optioncode::where('type', 'city')->get();
        $districts = Optioncode::where('type', 'district')->get();

        // customers
        $orders = Order::where('partner_id', session()->get('partner_id'))
        ->orderBy('deliverydate', 'DESC')
        ->paginate(10);

        $customers = Customer::where('partner_id', session()->get('partner_id'))->get();

        return view('partners.orders.all-orders', compact('partner', 'cities', 'districts', 'customers', 'orders'));

    }






    // search regular deliveries
    public function searchregulardeliveries(Request $request) {

        // get partner (id suppose to come from session)
        $partner = Partner::find(session()->get('partner_id'));


        // get - city - districts
        $cities = Optioncode::where('type', 'city')->get();
        $districts = Optioncode::where('type', 'district')->get();

        $filters = array();

        if ($request->id != null) {
            $filters["id"] = $request->id;
        }

        if ($request->status != "all") {
            $filters["status"] = $request->status;
        }

        if ($request->customer_id != "all") {
            $filters["customer_id"] = $request->customer_id;
        }

        // // regular orders
        // if ($request->status != "all") {

        //     $orders = Order::where([
        //         'partner_id' => session()->get('partner_id'),
        //         'customer_id' => $request->customer_id,
        //         'status' => $request->status
        //     ])
        //     ->orderBy('deliverydate', 'DESC')
        //     ->get();

        // } else {

        //     $orders = Order::where('partner_id', session()->get('partner_id'))
        //     ->where('customer_id', $request->customer_id)
        //     ->orderBy('deliverydate', 'DESC')
        //     ->get();
            
        // }

        $orders = Order::where('partner_id', session()->get('partner_id'))
        ->where($filters)
        ->orderBy('deliverydate', 'DESC')
        ->get();

        // customers
        $customers = Customer::where('partner_id', session()->get('partner_id'))->get();

        return view('partners.orders.all-orders', compact('partner', 'cities', 'districts', 'customers', 'orders'));

    }



    





    public function addsingleorder(Request $request)
    {

        // get info
        $name = $request->name;
        $phone = $request->phone;

        $address = $request->address;
        $locationlink = '@' . $request->locationlink;

        

        
        // ids
        $city_id = $request->city;
        $district_id = $request->district;
        $partner_id = $request->partner;


        // cash + charge fees
        $cashcollected = $request->cashcollected;
        $chargefees = Chargefee::where('partner_id', session('partner_id'))
        ->where('city_id', $city_id)->get();
        $chargefees = (!empty($chargefees[0]['fees']) ? $chargefees[0]['fees'] : 0);



        // service
        $servicetype = $request->servicetype;
        
        // dates
        $deliverydate = $request->deliverydate;

        
        $pickuptime = $request->pickuptime;
        $deliverytime = $request->deliverytime;


        // meal
        $meal = $request->meal;




        // insert into db without (driver id)
        $singleorder = new Singleorder();

        // general info
        $singleorder->customer_name = $name;
        $singleorder->customer_phone = $phone;
        $singleorder->customer_address = $address;
        $singleorder->customer_locationlink = $locationlink;


        // foregins
        $singleorder->city_id = $city_id;
        $singleorder->district_id = $district_id;
        $singleorder->partner_id = $partner_id;

        // cash + fees
        $singleorder->cashcollected = $cashcollected;
        $singleorder->chargefees = $chargefees;
        $singleorder->payedfees = $chargefees;


        // servicetype + status
        $singleorder->servicetype = $servicetype;
        $singleorder->status = "requested";


        // dates
        $singleorder->deliverydate = $deliverydate;

        $singleorder->pickuptime = $pickuptime;
        $singleorder->deliverytime = $deliverytime;

        // meal
        $singleorder->meal = $meal;



        // save to db
        $singleorder->save();






        // add notification to UserNotification
        $notif = new UserNotification();

        $notif->shortinfo = session('partner_name') . " Restaurant Added a New One-time Delivery";
        $notif->longinfo = session('partner_name') . " Restaurant Has Added a New One-time Delivery For Customer " . $singleorder->customer_name;

        $notif->datetime = date('Y-m-d - h:i A');
        $notif->linkroute = "";

        $notif->user_id = null;
        $notif->partner_id = session('partner_id');
        $notif->otherpartner_id = null;

        $notif->save();



        
        return redirect()->route('partner.deliveries');
    }







    // cancel order
    public function cancelorder(Request $request) {


        // get order id
        $order = Order::find($request->orderid);

        if ($order->status == "canceled") {

      
            $order->status = "not received";
       

        } else {

            // make it canceled
            $order->status = "canceled";

        }

        $order->save();


        return redirect()->route('partner.deliveries');

    } //end of cancel order






    // cancel single order
    public function cancelsingleorder(Request $request) {


        // get order id
        $order = Singleorder::find($request->orderid);

        if ($order->status == "canceled") {

              
            $order->status = "requested";
        

        } else {

            // make it canceled
            $order->status = "canceled";

        }
       
        $order->save();


        return redirect()->route('partner.deliveries');

    } //end of cancel order
}
