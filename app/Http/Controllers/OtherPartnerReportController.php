<?php

namespace App\Http\Controllers;

use App\Models\Othersingleorder;
use Illuminate\Http\Request;

class OtherPartnerReportController extends Controller
{


    // all deliveries
    public function alldeliveryreports()
    {


        $orders = Othersingleorder::where('otherpartner_id', session()->get('otherpartner_id'))
            ->orderBy('created_at', 'DESC')
            ->paginate(10, ['*'], 'partner-reports');


        return view('otherpartners.reports.all-orders', compact('orders'));

    } //end function







    // search all deliveries
    public function searchalldeliveryreports(Request $request)
    {

        // get status + order id
        $status = $request->status;
        $orderid = $request->orderid;


        // 1- if there's order id
        if (!empty($orderid)) {

            // no status filter
            if ($status == "all") {
                $orders = Othersingleorder::where('otherpartner_id', session()->get('otherpartner_id'))
                ->where('id', $orderid)
                ->orderBy('created_at', 'DESC')
                ->get();

            } else {
                $orders = Othersingleorder::where('otherpartner_id', session()->get('otherpartner_id'))
                ->where('id', $orderid)
                ->where('status', $status)
                ->orderBy('created_at', 'DESC')
                ->get();
            }
        

        }

        // 2- order id is empty
        else {

            // no status filter
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

          
        }



        return view('otherpartners.reports.all-orders', compact('orders'));

    } //end function



}
