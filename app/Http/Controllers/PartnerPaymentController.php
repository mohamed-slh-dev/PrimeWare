<?php

namespace App\Http\Controllers;

use App\Models\Returnedcash;
use Illuminate\Http\Request;

class PartnerPaymentController extends Controller
{
    

    // returned cash (collectedcash page)
    public function collectedcash() {
        

        $collectedcashes = Returnedcash::where('partner_id', session()->get('partner_id'))
        ->where('status', 'not confirmed')
        ->paginate(10, ['*'], 'partner-collectedcash');


        return view('partners.payments.all-collectedcashes', compact('collectedcashes'));


    } //end of returned cash page







    // confirm returned cash (collectedcash page)
    public function confirmcollectedcash(Request $request)
    {

        // update status
        $collectedcash = Returnedcash::find($request->cash_id);

        $collectedcash->status = "confirmed";

        $collectedcash->save();


        return redirect()->route('partner.collectedcash');
    } //end of confirm returned cash page



}
