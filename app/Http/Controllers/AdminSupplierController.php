<?php

namespace App\Http\Controllers;
use App\Models\Optioncode;
use App\Models\Supplier;
use App\Models\UserNotification;
use App\Models\ProductDispatch;
use App\Models\ProductFlavor;
use App\Models\Product;




use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class AdminSupplierController extends Controller
{
    

    public function suppliers() {

        $suppliers = Supplier::orderBy('created_at', 'DESC')->paginate(6);

        $cities = Optioncode::where('type', 'city')->get();
        $districts = Optioncode::where('type', 'district')->get();

        return view('admins.suppliers.all-suppliers',compact('suppliers','cities','districts'));
    }



      // add supplier function
      public function addsupplier(Request $request)
      {
  
          // get data
          $name = $request->name;
          $phone = $request->phone;
          $password = $request->password;
          
          $email = $request->email;
          $portalemail = $request->portalemail;
  
          $startdate = $request->startdate;
          $enddate = $request->enddate;
  
  
          // ids
          // $type_id = $request->type;
          $city_id = $request->city;
          $district_id  = $request->district;
  
          $address = $request->address;
          $locationlink = '@' . $request->locationlink; //can be empty
  
          $info = $request->info; //can be empty
          $priority = $request->priority;
  
  
  
  
          // handle logo and contract files
          // A - logo (required)
          $logoname = time() . '-' . $request->file('logo')->getClientOriginalName();
  
          $request->file('logo')->move(public_path('assets/img/suppliers/logos'), $logoname);
  
  
          // A - contract (required)
          $contractname = time() . '-' . $request->file('contract')->getClientOriginalName();
  
          $request->file('contract')->move(public_path('assets/img/suppliers/contracts'), $contractname);
  
  
  
  
  
          // insert it inside the db
          $newpartner = new Supplier();
  
          // copy data to it
          $newpartner->name = $name;
          $newpartner->phone = $phone;
          $newpartner->password = Hash::make($password);
          $newpartner->email = $email;
          $newpartner->portalemail = $portalemail;
  
          $newpartner->startdate = $startdate;
          $newpartner->enddate = $enddate;
  
          $newpartner->address = $address;
          $newpartner->locationlink = $locationlink;
          $newpartner->info = $info;
  
  
          // $newpartner->type_id = $type_id;
          $newpartner->city_id = $city_id;
          $newpartner->district_id = $district_id;
  
          $newpartner->logo = $logoname;
          $newpartner->contract = $contractname;
          
          $newpartner->save();
  
  
  
          // add notification to UserNotification
          $notif = new UserNotification();
  
          $notif->shortinfo = "New Supplier Added";
          $notif->longinfo = "Supplier " . $newpartner->name . " Has Been Added By " . session('user_name');
  
          $notif->datetime = date('Y-m-d - h:i A');
          $notif->linkroute = "admin.suppliers";
  
          $notif->user_id = session('user_id');
          $notif->partner_id = null;
          $notif->otherpartner_id = null;
  
          $notif->save();
  




          //add the default value for each city charge
  
  
          // redirect to route partners
          return redirect()->route('admin.suppliers');
  
      } //end of add partner


    // =======================================


    public function managesuppliers() {

        $suppliers = Supplier::orderBy('created_at', 'DESC')->paginate(6);

        
        $cities = Optioncode::where('type', 'city')->get();
        $districts = Optioncode::where('type', 'district')->get();

        return view('admins.suppliers.manage-suppliers',compact('suppliers','cities','districts'));
    }





    // add supplier function
    public function updatesupplier(Request $request)
    {

        // get data
        $name = $request->name;
        $phone = $request->phone;
        $password = $request->password;

        $email = $request->email;
        $portalemail = $request->portalemail;

        $startdate = $request->startdate;
        $enddate = $request->enddate;


        // ids
        // $type_id = $request->type;
        $city_id = $request->city;
        $district_id  = $request->district;

        $address = $request->address;
        $locationlink = '@' . $request->locationlink; //can be empty

        $info = $request->info; //can be empty
        $priority = $request->priority;




        // handle logo and contract files
        // A - logo (required)





        // insert it inside the db
        $newpartner =  Supplier::find($request->supplier_id);

        // copy data to it
        $newpartner->name = $name;
        $newpartner->phone = $phone;
        $newpartner->email = $email;


        $newpartner->startdate = $startdate;
        $newpartner->enddate = $enddate;

        $newpartner->address = $address;
        $newpartner->locationlink = $locationlink;
        $newpartner->info = $info;


        // $newpartner->type_id = $type_id;
        $newpartner->city_id = $city_id;
        $newpartner->district_id = $district_id;


        if ($request->file('logo')) {
            $logoname = time() . '-' . $request->file('logo')->getClientOriginalName();

            $request->file('logo')->move(public_path('assets/img/suppliers/logos'), $logoname);

            $newpartner->logo = $logoname;
        }


        if ($request->file('contract')) {
            // A - contract (required)
            $contractname = time() . '-' . $request->file('contract')->getClientOriginalName();

            $request->file('contract')->move(public_path('assets/img/suppliers/contracts'), $contractname);

            $newpartner->contract = $contractname;
        }



        $newpartner->save();



        // redirect to route partners
        return redirect()->route('admin.managesuppliers');
    } //end of add partner




    // ======================================= IN customer tab (now)


    public function customersorders()
    {
        return view('admins.customers.customers-orders');
    }








    // ======================================= IN operation tab (now)


    public function dispatchedproducts()
    {
        $products_dispatch = ProductDispatch::where('status','pending')->get();

        return view('admins.operations.dispatched-products',compact('products_dispatch'));
    }



    // received
    public function receiveproducts(Request $request){

        $product_dispatch = ProductDispatch::find($request->product_dispatch);
        $product_dispatch->status = 'received';
        $product_dispatch->save();

        foreach ($product_dispatch->flavors as $flavor) {
            $product_flavor = ProductFlavor::find($flavor->product_flavor_id);
            $product_flavor->received += $request->input('flavor_dispatch_' . $flavor->id);
            $product_flavor->available += $request->input('flavor_dispatch_'.$flavor->id);
            $product_flavor->damaged += $flavor->quantity -  $request->input('flavor_dispatch_'.$flavor->id);

            $product_flavor->save();

        }

        return redirect()->back();
    }







    public function cancelproducts($dispatchid){

        $product_dispatch = ProductDispatch::find($dispatchid);
        $product_dispatch->status = 'canceled';
        $product_dispatch->save();

        foreach ($product_dispatch->flavors as $flavor) {
            
            $product_flavor = ProductFlavor::find($flavor->product_flavor_id);

            $product_flavor->quantity += $flavor->quantity;

            $product_flavor->save();

        }

        return redirect()->back();
    }






    // ======================================= IN operation tab (now)


    public function inventoryproducts()
    {
        $products = ProductDispatch::all();


        //get analytics
        $analytics = array();


        $analytics['dispatchedCount'] = 0;


        foreach ($products->where('status', '!=', 'canceled') as $dispatch) {

            foreach ($dispatch->flavors as $flavor) {

                $analytics['dispatchedCount'] += $flavor->quantity;
            }
        }




        
        $analytics['receivedCount'] = ProductFlavor::sum('received'); //change the received value to the actually received one or add col

        $analytics['availableCount'] = ProductFlavor::sum('available'); //now in stock
        $analytics['soldCount'] = ProductFlavor::sum('sold'); //now sold

        $analytics['cashCollection'] = 0;




        return view('admins.operations.inventory-products',compact('products', 'analytics'));
    }



    

    public function singleproduct($id)
    {
        $product = Product::find($id);



        $analytics['dispatchedCount'] = 0;
        $analytics['receivedCount'] = 0;
        $analytics['availableCount'] = 0;
        $analytics['soldCount'] = 0;
        $analytics['cashCollection'] = 0;

        if ($product->dispatches) {

            foreach ($product->dispatches->where('status', '!=', 'canceled') as $dispatch) {

                foreach ($dispatch->flavors as $flavor) {

                    $analytics['dispatchedCount'] += $flavor->quantity;
                }
            }

        }


        foreach ($product->flavors as $flavor) {

            $analytics['receivedCount'] += $flavor->received;
            $analytics['availableCount'] += $flavor->available;
            $analytics['soldCount'] += $flavor->sold;
        }

        
        return view('admins.operations.single-product',compact('product', 'analytics'));
    }


}
