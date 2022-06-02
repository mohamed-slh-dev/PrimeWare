<?php

namespace App\Http\Controllers;
use App\Models\Supplier;
use App\Models\Optioncode;
use App\Models\Product;
use App\Models\ProductFlavor;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Chargefee;
use App\Models\Driver;
use App\Models\DriverDistricts;
use App\Models\ProductDispatchFlavor;
use App\Models\Supplierchargefee;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
     // login
     public function login() {
         
        return view('logins.supplier');
        
    } //end login



    // logout
    public function logout(Request $request) {


        // delete permission (session) id + profile pic
        session()->forget('supplier_name');

        session()->forget('supplier_id');
        session()->forget('supplier_logo');
        session()->forget('supplier_lock');



        // redirect to login
        return redirect()->route('supplier.login');
        
    } //end logout

    

    public function checklogin(Request $request) {
    
          // username + password
          $email = $request->email;
          $password = $request->password;
  
          
          // get user using username
          $partner = Supplier::where('portalemail', $email)->first();
  
  
          // if found then check password (he pass)
          if ($partner && Hash::check($password, $partner->password)) {
  
  
              // put permission (session) id + profile pic
              session()->put('suppler_name', $partner->name);
  
              session()->put('supplier_id', $partner->id);
              session()->put('supplier_logo', $partner->logo);
              session()->put('supplier_lock', "unlocked");
         

        return redirect()->route('supplier.home');
        
    } // end of password correct


    // he don't pass
    else {

        // redirect to login again
        return redirect()->route('supplier.login');

    } //end of wrong password or user not found
        
    } //end login



    // ----------------------



    public function purchase()
    {

       // dependencies
        // get - city - districts
        $cities = Optioncode::where('type', 'city')->get();
        $districts = Optioncode::where('type', 'district')->get();

        $products = Product::all();

        
        $all_flavors = ProductFlavor::all();
        
        //get chargefees for the delivery price
        $chargefees = Supplierchargefee::all();

        return view('supplier.purchase', compact('cities', 'districts','products', 'all_flavors', 'chargefees'));

    } //end login






    public function addpurchase(Request $request)
    {

       

        $newpurchase = new Purchase();

        $newpurchase->fname = $request->fname;
        $newpurchase->lname = $request->lname;
        $newpurchase->email = $request->email;
        $newpurchase->phone = $request->phone;
        $newpurchase->address = $request->address;
        $newpurchase->block = $request->block;
        $newpurchase->floor = $request->floor;
        $newpurchase->flat = $request->flat;
        $newpurchase->location = $request->location;
        $newpurchase->status = 'not delivered';
        $newpurchase->city_id = $request->city;
        $newpurchase->district_id = $request->district;
        $newpurchase->location = '@'.$request->lat.', '.$request->long;


        // get driver id for this delivery + delivery date (is today)
        $newpurchase->delivery_date = date('Y-m-d');

        $drivers = Driver::where('type', "driver")->get();
        // filter based on district
        foreach ($drivers as $tempdriver) {

            $driver = DriverDistricts::where('district_id', $request->district)
            ->where('driver_id', $tempdriver->id)
            ->first();

            // driver found
            if (!empty($driver)) {

                $newpurchase->driver_id = $driver->id;
                break;
            }
        } //end of finding a driver




        $randomTracking = "";

        // generate random Tracking number
        while(true) {

            //two random letters A-Z
            $randomTracking .= "" . chr(rand(65, 90));
            $randomTracking .= "" . chr(rand(65, 90));

            $randomTracking .= "". rand(0, 9);
            $randomTracking .= "" . rand(0, 9);
            $randomTracking .= "" . rand(0, 9);
            $randomTracking .= "" . rand(0, 9);
            $randomTracking .= "" . rand(0, 9);


            // check if this number exists
            $checking = Purchase::where('tracking_number', $randomTracking)->count();

            if ($checking == 0) {
                break;
            }

        }

        $newpurchase->tracking_number = $randomTracking;

        $newpurchase->save();


        $totalprice = 0;
        for ($i=0; $i < count($request->input('flavor')) ; $i++) { 
            $purchase_flavor = new PurchaseItem ();
            $purchase_flavor->purchase_id = $newpurchase->id;
            $purchase_flavor->product_id =$request->input('product')[$i];
            $purchase_flavor->product_flavor_id =$request->input('flavor')[$i];
            $purchase_flavor->quantity =$request->input('quantity')[$i];

            $flavor = ProductFlavor::find($request->input('flavor')[$i]);
            $flavor->available -= $request->input('quantity')[$i];
            $flavor->save();

            $purchase_flavor->price =$request->input('quantity')[$i] *  $flavor->price;


            $totalprice += $purchase_flavor->price;
            $purchase_flavor->save();

        }

        $newpurchase->price =  $totalprice;
        $newpurchase->delivery_price = $request->input('summary-delivery-price-input');


        $newpurchase->save();



        return redirect()->route('supplier.purchaseInvoice', [$newpurchase->id]);

    }




    // ---------------------------------

    public function purchaseInvoice($purchaseid)
    {

        // dependencies
        $purchase = Purchase::find($purchaseid);


        return view('supplier.purchase-invoice', compact('purchase'));

    } //end login


    // ----------------------
    public function supplierHome()
    {

        return view('supplier.index');

    } //end login



    public function dashboard() {
    

        $products = Product::where('supplier_id', session('supplier_id'))->get();

        //get analytics
        $analytics = array();



        $analytics['dispatchedCount'] = 0;
        $analytics['receivedCount'] = 0;
        $analytics['availableCount'] = 0;
        $analytics['soldCount'] = 0;
        $analytics['damagedCount'] = 0;

        $analytics['cashCollection'] = 0;

        foreach ($products as $product) {


            foreach ($product->dispatches->where('status', '!=', 'canceled') as $dispatch) {

                foreach ($dispatch->flavors as $flavor) {

                    $analytics['dispatchedCount'] += $flavor->quantity;
                }
            }


            foreach ($product->flavors as $flavor) {

                $analytics['receivedCount'] += $flavor->received;
                $analytics['availableCount'] += $flavor->quantity;
                $analytics['soldCount'] += $flavor->sold;
                $analytics['damagedCount'] += $flavor->damaged;

            }
        }






        // ------ get all deliveries of this supplier

        // get all the products supplier has to do with
        $products = Product::where('supplier_id', session('supplier_id'))->get();

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
        $deliveriesCount = $purchases->count();
        $canceledCount = $purchases->where('status', 'canceled')->count();
        $deliveredCount = $purchases->where('status', 'delivered')->count();
        $cashCollection = $purchases->sum('cashcollection');



        return view('supplier.dashboard', compact('products', 'analytics','purchases', 'deliveriesCount', 'canceledCount', 'deliveredCount', 'cashCollection'));
        
        
    } //end login
}
