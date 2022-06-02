<?php

namespace App\Http\Controllers;

use App\Models\Otherpartner;
use App\Models\Othersingleorder;
use Illuminate\Http\Request;

class OtherPartnerPrimeController extends Controller
{
    

    public function prime() {


        // get this partner
        $partner = Otherpartner::find(session()->get('otherpartner_id'));

        // all orders
        $orders = Othersingleorder::all();

        // return to view
        return view('otherpartners.primes.about', compact('partner', 'orders'));

    }

}
