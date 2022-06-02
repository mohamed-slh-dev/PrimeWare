<?php

namespace App\Http\Controllers;

use App\Models\Optioncode;
use App\Models\Otherchargefee;
use App\Models\Otherpartner;
use App\Models\Othersingleorder;
use App\Models\UserNotification;
use Illuminate\Http\Request;

class OtherPartnerDeliveryController extends Controller
{
    

    public function deliveries() {


        // get - city - districts
        $cities = Optioncode::where('type', 'city')->get();
        $districts = Optioncode::where('type', 'district')->get();

        // orders
        $orders = Othersingleorder::where('otherpartner_id', session()->get('otherpartner_id'))
        ->orderBy('created_at', 'DESC')
        ->paginate(10);

  
        return view('otherpartners.orders.all-orders', compact('cities', 'districts', 'orders'));

    }








    public function searchregulardeliveries(Request $request) {


        // get - city - districts
        $cities = Optioncode::where('type', 'city')->get();
        $districts = Optioncode::where('type', 'district')->get();

        // get filters
        $fromdate = $request->fromdate;
        $todate = $request->todate;
        $status = $request->status;


        // default orders
        if ($status == "all") {
            $orders = Othersingleorder::where('otherpartner_id', session()->get('otherpartner_id'))
            ->orderBy('created_at', 'DESC')
            ->get();
        } else {
            $orders = Othersingleorder::where('otherpartner_id', session()->get('otherpartner_id'))
            ->where('status', $status)
            ->orderBy('created_at', 'DESC')
            ->get();
        }
        



        // both not empty
        if (!empty($fromdate) && !empty($todate)) {

            if ($status == "all") {
                $orders = Othersingleorder::where('otherpartner_id', session()->get('otherpartner_id'))
                ->where('deliverydate', '>=', $fromdate)
                ->where('deliverydate', '<=', $todate)
                ->orderBy('created_at', 'DESC')
                ->get();
            } else {
                $orders = Othersingleorder::where('otherpartner_id', session()->get('otherpartner_id'))
                ->where('deliverydate', '>=', $fromdate)
                ->where('deliverydate', '<=', $todate)
                ->where('status', $status)
                ->orderBy('created_at', 'DESC')
                ->get();
            }
            
        }

        // from date
        elseif (!empty($fromdate)) {

            if ($status == "all") {
                $orders = Othersingleorder::where('otherpartner_id', session()->get('otherpartner_id'))
                ->where('deliverydate', '>=', $fromdate)
                ->orderBy('created_at', 'DESC')
                ->get();
            } else {
                $orders = Othersingleorder::where('otherpartner_id', session()->get('otherpartner_id'))
                ->where('deliverydate', '>=', $fromdate)
                ->where('status', $status)
                ->orderBy('created_at', 'DESC')
                ->get();
            }

        }

        // to date only
        elseif (!empty($todate)) {

            if ($status == "all") {
                $orders = Othersingleorder::where('otherpartner_id', session()->get('otherpartner_id'))
                ->where('deliverydate', '<=', $todate)
                ->orderBy('created_at', 'DESC')
                ->get();
            } else {
                $orders = Othersingleorder::where('otherpartner_id', session()->get('otherpartner_id'))
                ->where('deliverydate', '<=', $todate)
                ->where('status', $status)
                ->orderBy('created_at', 'DESC')
                ->get();
            }
        }
        

  
        return view('otherpartners.orders.all-orders', compact('cities', 'districts', 'orders'));

    }

    





    // add single delivery
    public function addsingleorder(Request $request)
    {


        // get the other partner info
        $partner = Otherpartner::find($request->otherpartner); 




        // get info

        // customer info
        $name = $request->name;
        $phone = $request->phone;
        $address = $request->address;
        $customerlocationlink = '@' . $request->customerlocationlink;


        // order reference id
        $refid = $request->refid;


        // service
        $servicetype = "single order";


        // pickup location
        $pickuplocationlink = $request->pickuplocationlink;

        // same partner location link
        if ($pickuplocationlink == "currentlocation") {

            $pickuplocationlink = $partner->locationlink;
        }

        // other location link
        else {

            $pickuplocationlink = '@' . $request->otherpickuplocationlink;
        }




        // package content type
        $packagetype = $request->packagetype;

        // other package type
        if ($packagetype == "other") {

            $packagetype = $request->otherpackagetype;
        }



        // pickup time / delivery time
        $pickuptime = $request->pickuptime;
        $deliverytime = $request->deliverytime;


        // today or tmw 
        $deliverydate = $request->deliverydate;
        $todaydate = date('Y-m-d');



        // bike or van 
        $carrier = $request->vehicle;
        $numberofvans = 0;


        // city - district - partner id
        $city_id = $request->city;
        $district_id = $request->district;
        $partner_id = $request->otherpartner;


        // charge fees
        $chargefees = Otherchargefee::where('city_id', $city_id)->get();


        // 1- today and van
        if ($deliverydate == $todaydate && $carrier == "van") {

            $chargefees = (!empty($chargefees[0]['vantodayfees']) ? $chargefees[0]['vantodayfees'] : 0);

            $numberofvans = $request->numberofvans;

        }

        // 2- nextday and van
        elseif ($deliverydate != $todaydate && $carrier == "van") {

            $chargefees = (!empty($chargefees[0]['vannextdayfees']) ? $chargefees[0]['vannextdayfees'] : 0);

            $numberofvans = $request->numberofvans;

        }




        // 1- today and bike
        if ($deliverydate == $todaydate && $carrier == "bike") {

            $chargefees = (!empty($chargefees[0]['biketodayfees']) ? $chargefees[0]['biketodayfees'] : 0);

            

        }

        // 2- any nextdays and bike
        elseif ($deliverydate != $todaydate && $carrier == "bike") {

            $chargefees = (!empty($chargefees[0]['bikenextdayfees']) ? $chargefees[0]['bikenextdayfees'] : 0);

        }



        // ==================== save to db
        


        // insert into db without (driver id)
        $singleorder = new Othersingleorder();


        // general info
        $singleorder->referenceid = $refid;
        $singleorder->customer_name = $name;
        $singleorder->customer_phone = $phone;
        $singleorder->customer_address = $address;
        $singleorder->customer_locationlink = $customerlocationlink;


        // foregins
        $singleorder->city_id = $city_id;
        $singleorder->district_id = $district_id;
        $singleorder->otherpartner_id = $partner_id;

        // cash + fees
        $singleorder->chargefees = $chargefees;

        // servicetype + status + payment status
        $singleorder->servicetype = $servicetype;
        $singleorder->status = "requested";
        $singleorder->paymentstatus = "not paid";


        // dates
        $singleorder->deliverydate = $deliverydate;

        $singleorder->pickuptime = $pickuptime;
        $singleorder->deliverytime = $deliverytime;
        $singleorder->pickuplocationlink = $pickuplocationlink;
        
        // carriage (van - bike)
        $singleorder->carriage = $carrier;
        $singleorder->numberofcarriage = $numberofvans;

        

        // package type
        $singleorder->packagetype = $packagetype;


        // comment
        $singleorder->info = $request->info;


        // save to db
        $singleorder->save();



        // add notification to UserNotification
        $notif = new UserNotification();

        $notif->shortinfo = "Partner " . session('otherpartner_name') . " Added a New Delivery";
        $notif->longinfo = "Partner " . session('otherpartner_name') . " Has Added a New Delivery For Customer " . $singleorder->customer_name;

        $notif->datetime = date('Y-m-d - h:i A');
        $notif->linkroute = "";

        $notif->user_id = null;
        $notif->partner_id = null;
        $notif->otherpartner_id = session('otherpartner_id');

        $notif->save();


        return redirect()->route('otherpartner.deliveries');


    } //end of add single delivery








    // cancel delivery
    public function cancelsingleorder(Request $request) {


        // get order id
        $order = Othersingleorder::find($request->orderid);

        if ($order->status == "canceled") {

            $order->status = "requested";

        } else {

            // make it canceled
            $order->status = "canceled";
        }

        $order->save();


        return redirect()->route('otherpartner.deliveries');

    } //end of cancel delivery

}
