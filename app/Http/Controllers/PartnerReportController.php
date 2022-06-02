<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Singleorder;
use Illuminate\Http\Request;

class PartnerReportController extends Controller
{
    



    // all deliveries
    public function alldeliveryreports()
    {


        $orders = Order::where('partner_id', session()->get('partner_id'))
            ->orderBy('created_at', 'DESC')
            ->paginate(10, ['*'], 'orders-reports');

        $singleorders = Singleorder::where('partner_id', session()->get('partner_id'))
            ->orderBy('created_at', 'DESC')
            ->paginate(10, ['*'], 'singleorders-reports');



        // customers
        $customers = Customer::all();

        return view('partners.reports.all-orders', compact('orders', 'singleorders', 'customers'));

    } //end function







    // search all deliveries
    public function searchalldeliveryreports(Request $request)
    {

        // get status + order id
        $status = $request->status;
        $orderid = $request->orderid;
        $customerid = $request->customerid;


        $filters = array();

        if ($customerid != "all") {
            $filters['customer_id'] = $customerid;
        }

        if ($status != "all") {
            $filters['status'] = $status;
        }

        if (!empty($orderid)) {
            $filters['id'] = $orderid;
        }


    
      

        //make filters
        $orders = Order::where('partner_id', session()->get('partner_id'))
        ->where($filters)
        ->orderBy('created_at', 'DESC')
        ->get();





        // single orders untouched
        $singleorders = Singleorder::where('partner_id', session()->get('partner_id'))
        ->orderBy('created_at', 'DESC')
        ->get();



        // customers
        $customers = Customer::all();


        return view('partners.reports.all-orders', compact('orders', 'singleorders', 'customers'));

    } //end function











    // search all deliveries
    public function searchallsingledeliveryreports(Request $request)
    {

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

   

      

        // single orders filtering
        $singleorders = Singleorder::where('partner_id', session()->get('partner_id'))
        ->where($filters)
        ->orderBy('created_at', 'DESC')
        ->get();




        //same orders
        $orders = Order::where('partner_id', session()->get('partner_id'))
        ->orderBy('created_at', 'DESC')
        ->get();



        // customers
        $customers = Customer::all();


        return view('partners.reports.all-orders', compact('orders', 'singleorders', 'customers'));

    } //end function
}
