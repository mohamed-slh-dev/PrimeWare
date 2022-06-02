<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Otherpartner;
use App\Models\Othersingleorder;
use App\Models\Partner;
use App\Models\Singleorder;
use Illuminate\Http\Request;

class AdminReportController extends Controller
{
    

    // restaurants reports
    public function restaurantsreports() {

        // all regular orders
        $orders = Order::orderBy('deliverydate', 'ASC')->paginate(10, ['*'], 'regular-deliveries');


        // single orders
        $singleorders = Singleorder::orderBy('deliverydate', 'ASC')->paginate(10, ['*'], 'single-deliveries');


        // for filters
        $partners = Partner::all();

        return view('admins.reports.all-orders', compact('orders', 'singleorders', 'partners'));

    }








    // restaurants reports
    public function searchrestaurantsreports(Request $request) {


        // get status + order id
        $status = $request->status;
        $partnerid = $request->partnerid;



        $filters = array();


        if ($status != "all") {
            $filters['status'] = $status;
        }

        if ($partnerid != "all") {
            $filters['partner_id'] = $partnerid;
        }

        // all regular orders
        $orders = Order::where($filters)
        ->orderBy('deliverydate', 'ASC')
        ->paginate(10, ['*'], 'regular-deliveries');


        // continue ...

        // single orders
        $singleorders = Singleorder::orderBy('deliverydate', 'ASC')->paginate(10, ['*'], 'single-deliveries');


        // for filters
        $partners = Partner::all();


        return view('admins.reports.all-orders', compact('orders', 'singleorders', 'partners'));

    }














    // restaurants single reports
    public function searchsinglerestaurantsreports(Request $request) {


        // get status + order id
        $status = $request->status;
        $orderid = $request->orderid;



        $filters = array();


        if ($status != "all") {
            $filters['status'] = $status;
        }

        if (!empty($orderid)) {
            $filters['id'] = $orderid;
        }



        // single orders
        $singleorders = Singleorder::where($filters)
        ->orderBy('deliverydate', 'ASC')->paginate(10, ['*'], 'single-deliveries');


        // continue ...


        // all regular orders
        $orders = Order::orderBy('deliverydate', 'ASC')
        ->paginate(10, ['*'], 'regular-deliveries');

        


        // for filters
        $partners = Partner::all();

        return view('admins.reports.all-orders', compact('orders', 'singleorders', 'partners'));

    }














    // =============================================



    // partners reports
    public function partnersreports() {


        // single orders
        $singleorders = Othersingleorder::orderBy('deliverydate', 'ASC')->paginate(10, ['*'], 'single-deliveries');


        // for filters
        $partners = Otherpartner::all();

        return view('admins.reports.all-singleorders', compact('singleorders', 'partners'));

    }







    // partners single reports
    public function searchpartnersreports(Request $request) {


        // get status + order id
        $status = $request->status;
        $orderid = $request->orderid;
        $partnerid = $request->partnerid;


        $filters = array();


        if ($status != "all") {
            $filters['status'] = $status;
        }

        if (!empty($orderid)) {
            $filters['id'] = $orderid;
        }


        if ($partnerid != "all") {
            $filters['otherpartner_id'] = $partnerid;
        }



        // single orders
        $singleorders = Othersingleorder::where($filters)
        ->orderBy('deliverydate', 'ASC')->paginate(10, ['*'], 'single-deliveries');


        // continue ...


        // for filters
        $partners = Otherpartner::all();

        return view('admins.reports.all-singleorders', compact('singleorders', 'partners'));

    }












    // =============================================



    // payments reports
    public function paymentsreports() {


        
        $partners = Partner::all();

        $orders = [];
        $singleorders = [];


        $chosenpartner = "";

        return view('admins.reports.all-payments', compact('partners', 'chosenpartner', 'orders', 'singleorders'));

    } //end payments reports






    // restaurants reports
    public function searchpaymentsreports(Request $request) {


        // get status + order id
        $status = $request->status;
        $partnerid = $request->partnerid;


        // start date + end date fiilters
        $startdate = $request->startdate;
        $enddate = $request->enddate;

        
        $filters = array();


        if ($status != "all") {
            $filters['status'] = $status;
        }

            
        $filters['partner_id'] = $partnerid;



        // all regular orders
        $orders = Order::where($filters)
        ->orderBy('deliverydate', 'ASC')
        ->get();

        if (!empty($startdate)) {
            $orders = $orders->where('deliverydate', '>=', $startdate);
        }

        if (!empty($enddate)) {
            $orders = $orders->where('deliverydate', '<=', $enddate);
        }




        // get singleorders
        $singleorders = Singleorder::where($filters)
        ->orderBy('deliverydate', 'ASC')
        ->get();

        if (!empty($startdate)) {
            $singleorders = $singleorders->where('deliverydate', '>=', $startdate);
        }

        if (!empty($enddate)) {
            $singleorders = $singleorders->where('deliverydate', '<=', $enddate);
        }




        $chosenpartner = Partner::find($partnerid);

        // for filters
        $partners = Partner::all();


        return view('admins.reports.all-payments', compact('orders', 'chosenpartner', 'partners', 'singleorders'));

    }





} //end contorller
