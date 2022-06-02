<?php

namespace App\Http\Controllers;

use App\Models\Collectedorder;
use App\Models\Customer;
use App\Models\Driver;
use App\Models\Order;
use App\Models\Othersingleorder;
use App\Models\Partner;
use App\Models\Returnedbag;
use App\Models\Singleorder;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Product;

use App\Models\User;
use App\Models\UserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{



    // login
    public function login(Request $request) {
    
        return view('logins.admin');
        
    } //end login



    // logout
    public function logout(Request $request) {


        // delete permission (session) id + profile pic
        session()->forget('user_name');

        session()->forget('user_id');
        session()->forget('user_avatar');
        session()->forget('user_lock');


        // redirect to login
        return redirect()->route('admin.login');
        
    } //end logout




    
    // checkuser login function
    public function checkuser(Request $request) {

        // email + password
        $email = $request->email;
        $password = $request->password;


        // get user using email
        $user = User::where('email', $email)->first();


        // if found then check password (he pass)
        if ($user && Hash::check($password, $user->password)) {

            // put permission (session) id + profile pic
            session()->put('user_name', $user->name);

            session()->put('user_id', $user->id);
            session()->put('user_lock', "unlocked");


            if (empty($user->avatar)) {

                session()->put('user_avatar', 'avatar.png');

            } else {
                
                session()->put('user_avatar', $user->avatar);

            }

            // redirect to dashboard
            return redirect()->route('admin.dashboard');

        } // end of password correct


        // he don't pass
        else {

            // redirect to login again
            return redirect()->route('admin.login');

        } //end of wrong password or user not found


        
    } //end of checkuser login function










    // admin lock screen
    public function adminlock() {


        session()->put('user_lock', "locked");


        return view('admins.lockedscreen');

    } // end of lock the screen



    // admin lock screen
    public function adminunlock(Request $request) {

        // check password
        $user = User::find(session('user_id'));

        // matched
        if (Hash::check($request->password, $user->password)) {

            session()->put('user_lock', "unlocked");

            return redirect()->route('admin.dashboard');

        }


        // not matched
        return view('admins.lockedscreen');

        

    } // end of lock the screen


    // ==============================================




    // dashboad function
    public function dashboard() {


        // orders + pagorders
        $orders = Order::all();

        // order of today
        $todaydate = date('Y-m-d');
        $todayorders = Order::where('deliverydate', $todaydate)->paginate(10, ['*'], 'today-deliveries');


        // collectedorders
        $collectedorders = Collectedorder::orderBy('deliverydate', 'DESC')->paginate(10, ['*'], 'collected-deliveries');
        $collectedordersbags = Collectedorder::all()->sum('bag');


        // singleorders
        $singleorders = Singleorder::whereNull('driver_id')
        ->orderBy('deliverydate', 'DESC')
        ->paginate(10, ['*'], 'single-deliveries');


        // singleorders for partners
        $othersingleorders = Othersingleorder::whereNull('driver_id')
        ->orderBy('deliverydate', 'DESC')
        ->paginate(10, ['*'], 'partners-single-deliveries');



        
        // partners
        $partners = Partner::orderBy('created_at', 'DESC')->get();
        $customers = Customer::orderBy('created_at', 'DESC')->get();


        $drivers = Driver::orderBy('created_at', 'DESC')->get();

        // get pagination drivers 
        $pagdrivers = Driver::orderBy('created_at', 'DESC')->paginate(5, ['*'], 'drivers');
      



        // drivers who are collectors
        $collectordrivers = Driver::where('type', 'collector')
        ->orderBy('created_at', 'DESC')->paginate(10, ['*'], 'collectors');

        // returned bags
        $allbags = Customer::all()->sum('totalbags');
        
        $returnedbags = Returnedbag::all();

        

        // get user activity from usenotifications tabe
        $activities = UserNotification::whereNotNull('user_id')
        ->orderBy('created_at', 'DESC')->get();




        // counter for the chart in dashboard page
        $temporders = Order::all();

        $doc = 1 + $temporders->where('status', 'delivered')->count();
        $coc = 1 + $temporders->where('status', 'canceled')->count();



         // ------ get all deliveries of this supplier

        // get all the products supplier has to do with
        $products = Product::all();

        $productsArray = [];
        $i = 0;
        foreach ($products as $product) {
            $productsArray[$i] = $product->id;
            $i++;
        }

        //get all purchase item them compare product id
        $purchaseItems = PurchaseItem::whereIn('product_id', $productsArray)->get();

        // get purchase id unique + copy the ids into aray
        $purchaseItemsUnique = $purchaseItems->unique('purchase_id');

        $purchaseItemsUniqueArray = [];
        $i = 0;
        foreach ($purchaseItemsUnique as $item) {
            $purchaseItemsUniqueArray[$i] = $item->purchase_id;
            $i++;
        }



        // get the purchases using the unqiue purchase items
        $purchases = Purchase::whereIn('id', $purchaseItemsUniqueArray)->get();
            

        // return to view
        return view('admins.dashboard', compact('orders', 'todayorders', 'collectedorders', 'returnedbags', 'allbags', 'partners', 'customers', 'drivers', 'pagdrivers', 'collectedordersbags', 'collectordrivers', 'singleorders', 'othersingleorders', 'doc', 'coc', 'activities', 'purchases'));

    } //end of dashboard












    // ------------------- extra
    // add one time order driver function  (dashboard page)
    public function addonetimeorderdriver(Request $request)
    {  

        // get order id + driver id
        $order_id = $request->order_id;
        $driver_id = $request->driver_id;


        // update 
        $updateorder = Singleorder::find($order_id)->update([

            'driver_id' => $driver_id

            ]);

        // return to view
        return redirect()->route('admin.dashboard');

    } //end of add one time order driver function (dashboard page function)






    // add other singleorders driver in operation health function
    public function addothersingleordersdrivermain(Request $request)
    {

        // add driver to the order
        $order_id = $request->order_id;
        $driver_id = $request->driver_id;


        // update othesingle
        $updatesingleedorders = Othersingleorder::where('id', $order_id)->update([
            'driver_id' => $driver_id
        ]);
        

        // return to route (health page)
        return redirect()->route('admin.dashboard');


    } //end of add other singleorders driver in operations health









    // remove notification
    public function removenotifications(Request $request) {


        // make all seen = 0 
        $updatenotification = UserNotification::where('seen', 1)->update([
            'seen' => 0
        ]);

        return response()->json($updatenotification);



    } //end of remove notification

}
