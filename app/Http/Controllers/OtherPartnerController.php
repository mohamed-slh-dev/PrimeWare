<?php

namespace App\Http\Controllers;

use App\Models\Otherpartner;
use App\Models\OtherpartnerNotification;
use App\Models\Othersingleorder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class OtherPartnerController extends Controller
{
    

    // login
    public function login(Request $request) {
    
        return view('logins.otherpartner');
        
    } //end login


    // logout
    public function logout(Request $request) {


        // delete permission (session) id + profile pic
        session()->forget('otherpartner_name');

        session()->forget('otherpartner_id');
        session()->forget('otherpartner_logo');
        session()->forget('otherpartner_lock');


        // redirect to login
        return redirect()->route('otherpartner.login');
        
    } //end logout





    
    // checkuser login function
    public function checkuser(Request $request) {

        // username + password
        $email = $request->email;
        $password = $request->password;

        
        // get user using username
        $partner = Otherpartner::where('portalemail', $email)->first();


        // if found then check password (he pass)
        if ($partner && Hash::check($password, $partner->password)) {


            // put permission (session) id + profile pic
            session()->put('otherpartner_name', $partner->name);

            session()->put('otherpartner_id', $partner->id);
            session()->put('otherpartner_logo', $partner->logo);
            session()->put('otherpartner_lock', "unlocked");


            // redirect to dashboard
            return redirect()->route('otherpartner.dashboard');

        } // end of password correct


        // he don't pass
        else {

            // redirect to login again
            return redirect()->route('otherpartner.login');

        } //end of wrong password or user not found


        
    } //end of checkuser login function








    // other partner lock screen
    public function otherpartnerlock() {


        session()->put('otherpartner_lock', "locked");


        return view('otherpartners.lockedscreen');

    } // end of lock the screen



    // other partner lock screen
    public function otherpartnerunlock(Request $request) {

        // check password
        $partner = Otherpartner::find(session('otherpartner_id'));

        // matched
        if (Hash::check($request->password, $partner->password)) {

            session()->put('otherpartner_lock', "unlocked");

            return redirect()->route('otherpartner.dashboard');

        }


        // not matched
        return view('otherpartners.lockedscreen');

        

    } // end of lock the screen





    // ================================================






    // dashboad function
    public function dashboard() {

        
        // all partners orders (single orders)
        $orders = Othersingleorder::where('otherpartner_id', session()->get('otherpartner_id'))
        ->orderBy('created_at', 'DESC')
        ->paginate(10, ['*'], 'orders');



        // counter for the chart in dashboard page
        $temporders = Othersingleorder::all();

        $doc = 1 + $temporders->where('status', 'delivered')->count();
        $coc = 1 + $temporders->where('status', 'canceled')->count();

        


        // return to view
        return view('otherpartners.dashboard', compact('orders','doc', 'coc'));


    } //end of dashboard









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


        return redirect()->route('otherpartner.dashboard');

    } //end of cancel delivery









    // remove notification
    public function removenotifications(Request $request) {


        // make all seen = 0 
        $updatenotification = OtherpartnerNotification::where('otherpartner_id', session('otherpartner_id'))
        ->where('seen', 1)
        ->update([
            'seen' => 0
        ]);

        return response()->json($updatenotification);



    } //end of remove notification



} //end of controller