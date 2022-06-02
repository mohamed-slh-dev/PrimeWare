<?php

namespace App\Http\Controllers;

use App\Models\Othersingleorder;
use App\Models\Partner;
use App\Models\Primeware;
use App\Models\Ads;

use Illuminate\Http\Request;

class PartnerPrimeController extends Controller
{
    


    public function prime() {


        // get this partner
        $partner = Partner::find(session()->get('partner_id'));

        // primeware info
        $primeware = Primeware::find(1);

        // return to view
        return view('partners.primes.about', compact('partner', 'primeware'));

    }
    



    public function updateprime(Request $request) {


        // get this partner
        $partner = Partner::find(session()->get('partner_id'));


        // update it
        $partner->collectiontimingfrom = $request->morningtiming;
        $partner->collectiontimingto = $request->eveningtiming;


        // save it
        $partner->save();

        // return to view
        return redirect()->route('partner.prime');

    }

    //Ads

    public function ads() {

        // get this partner
        $ads = Ads::where('partner_id',session()->get('partner_id'))->get();

        // return to view
        return view('partners.primes.ads', compact('ads'));

    }

    public function addads(Request $request) {

        $new_ads = new Ads();

        $new_ads->title = $request->title;
        $new_ads->price = $request->price;
        $new_ads->label = $request->label;
        $new_ads->partner_id = session()->get('partner_id');

        $pic = time() . '-' . $request->file('pic')->getClientOriginalName();

        $request->file('pic')->move(public_path('assets/img/partners/ads'), $pic);

        $new_ads->pic = $pic;

        $new_ads->save();

        // get this partner
        $ads = Ads::where('partner_id',session()->get('partner_id'))->get();

        // return to view
        return redirect()->back();

    }

    public function deleteads(Request $request)
    {
        $deleteads = Ads::where('id', $request->ads_id)->delete();

        return redirect()->back();
    }
}
