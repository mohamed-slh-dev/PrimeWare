<?php

namespace App\Http\Controllers;

use App\Models\Optioncode;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PartnerSettingController extends Controller
{
    
    public function general() {

        $partner = Partner::find(session()->get('partner_id'));

        // cities - districts
        $cities = Optioncode::where('type', 'city')->get();
        $districts = Optioncode::where('type', 'district')->get();


        // return to view
        return view('partners.settings.general', compact('partner', 'cities', 'districts'));
         
    } //end general





    public function updategeneral(Request $request) {

    


        $partner = Partner::find(session()->get('partner_id'));


        // get value and update instantly
        $partner->name = $request->name;
        $partner->email = $request->email;
        $partner->phone = $request->phone;
        $partner->address = $request->address;
        $partner->locationlink = '@'. $request->locationlink;



        $partner->city_id = $request->city;
        $partner->district_id = $request->district;

        if (!empty($request->password)) {
            $partner->password = Hash::make($request->password);
        }



        // image
        // A - logo (not required)
        if (!empty($request->file('logo'))) {

            
            $logoname = time() . '-' . $request->file('logo')->getClientOriginalName();

            $request->file('logo')->move(public_path('assets/img/partners/logos'), $logoname);

            $partner->logo = $logoname;

            // change session logo
            session(['partner_logo' => $logoname]);

            
        }




        $partner->save();


        return redirect()->route('partner.general');

        
    } //end update general
}
