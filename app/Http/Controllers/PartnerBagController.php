<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class PartnerBagController extends Controller
{
    
    public function bags() {


        // customers
        $customers = Customer::where('partner_id', session()->get('partner_id'))
        ->paginate(9, ['*'], 'customers-bags');



        return view('partners.bags.all-bags', compact('customers'));

    }






    public function searchbags(Request $request) {
        

        // searchkey
        $searchkey = $request->searchinput;

        // customers
        $customers = Customer::where('partner_id', session()->get('partner_id'))
        ->where('name', 'LIKE', "%{$searchkey}%")
        ->get();



        return view('partners.bags.all-bags', compact('customers'));

    }
}
