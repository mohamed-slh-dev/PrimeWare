<?php

namespace App\Http\Controllers;

use App\Models\Othersingleorder;
use Illuminate\Http\Request;

class OtherPartnerPaymentController extends Controller
{



    // returned cash (collectedcash page)
    public function collectedcash()
    {


        $orders = Othersingleorder::where('otherpartner_id', session()->get('otherpartner_id'))
        ->where('paymentstatus', 'not paid')
        ->orderBy('created_at', 'DESC')
        ->paginate(10, ['*'], 'partner-collectedcash');


        return view('otherpartners.payments.all-collectedcashes', compact('orders'));

    } //end of returned cash page







    // confirm returned cash (collectedcash page)
    public function confirmcollectedcash(Request $request)
    {

        // update status
        $order = Othersingleorder::find($request->order_id);

        $order->paymentstatus = "paid";

        $order->save();


        return redirect()->route('otherpartner.collectedcash');
        
    } //end of confirm returned cash page



}
