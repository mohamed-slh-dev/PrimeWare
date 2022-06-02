<?php

namespace App\Http\Controllers;

use App\Models\Optioncode;
use App\Models\Product;
use App\Models\ProductFlavor;
use App\Models\ProductDispatch;
use App\Models\ProductDispatchFlavor;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SupplierProductController extends Controller
{
    
    public function products() {
        
        $products = Product::where('hidden', 'false')
        ->where('supplier_id',session('supplier_id'))->get();



        //get analytics
        $analytics = array();


        $analytics['dispatchedCount'] = 0;
        $analytics['receivedCount'] = 0;
        $analytics['availableCount'] = 0;
        $analytics['soldCount'] = 0;
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

            }
        }

    

        return view('supplier.products.all-products',compact('products', 'analytics'));


    
    }


    public function addproduct(Request $request) {

        $newproduct = new Product ();

        $newproduct->name = $request->name;
        $newproduct->ingredients = $request->ingredients;
        $newproduct->supplier_id = $request->supplier;

        $newproduct->img = time() . '-' . $request->file('img')->getClientOriginalName();
        $request->file('img')->move(public_path('assets/supplier/images/products/'),  $newproduct->img);

        $newproduct->save();

        for ($k = 0; $k < count($request->input('flavor_name')); $k++) {


                $newflavor = new ProductFlavor();
                $newflavor->product_id = $newproduct->id;

                $newflavor->name = $request->input('flavor_name')[$k];
                $newflavor->price = $request->input('flavor_price')[$k];
                $newflavor->quantity = $request->input('flavor_quantity')[$k];
                $newflavor->cals = $request->input('flavor_cals')[$k];
                $newflavor->proteins = $request->input('flavor_proteins')[$k];
                $newflavor->fats = $request->input('flavor_fats')[$k];
                $newflavor->carbs = $request->input('flavor_carbs')[$k];

                $newflavor->received = 0;
                $newflavor->available = 0;
                $newflavor->sold = 0;
                $newflavor->damaged = 0;

                $newflavor->save(); 

        } //end for loop for adding meal components

        return redirect()->back();

    }




    public function editproduct($id)
    {
        $product = Product::find($id);

        
        //get analytics
        $analytics = array();

        // Dont forget to keep "Total Amount" ready in delivery we only accept cash.

        $analytics['dispatchedCount'] = 0;
        $analytics['receivedCount'] = 0;
        $analytics['availableCount'] = 0;
        $analytics['soldCount'] = 0;
        $analytics['cashCollection'] = 0;


        foreach ($product->dispatches->where('status', '!=', 'canceled') as $dispatch) {

            foreach ($dispatch->flavors as $flavor) {

                $analytics['dispatchedCount'] += $flavor->quantity;
            }
        }


        foreach ($product->flavors as $flavor) {

            $analytics['receivedCount'] += $flavor->received;
            $analytics['availableCount'] += $flavor->quantity;
            $analytics['soldCount'] += $flavor->sold;
        }

        return view('supplier.products.edit-product',compact('product','id', 'analytics'));
    }






    // delete product
    public function deleteproduct($id) {

        $product = Product::find($id);

        $product->hidden = "true";
        $product->save();


        return redirect()->back();


    }

    

    // update product
    public function updateproduct(Request $request) {

        $product = Product::find($request->product_id);

        $product->name = $request->name;
        $product->ingredients = $request->ingredients;
        $product->supplier_id = $request->supplier;

        if (!empty($request->file('img'))) {
       
            $product->img = time() . '-' . $request->file('img')->getClientOriginalName();
            $request->file('img')->move(public_path('assets/supplier/images/products/'),  $product->img);
        }
      
        $product->save();


        $product_flavors = ProductFlavor::where('product_id',$request->product_id)->get();

        $k = 0;

        foreach ($product_flavors as $flavor) {

            $flavor->name = $request->input('flavor_name')[$k];
            $flavor->price = $request->input('flavor_price')[$k];
            $flavor->quantity = $request->input('flavor_quantity')[$k];
            $flavor->cals = $request->input('flavor_cals')[$k];
            $flavor->proteins = $request->input('flavor_proteins')[$k];
            $flavor->fats = $request->input('flavor_fats')[$k];
            $flavor->carbs = $request->input('flavor_carbs')[$k];
            $flavor->save();

            $k++;
        }
       

        return redirect()->back();

    }


    public function dispatchproduct(Request $request){

        $dispatch = new ProductDispatch ();

        $dispatch->product_id = $request->product;
        $dispatch->status = 'pending';

        $dispatch->save();

        $product_flavors = ProductFlavor::where('product_id',$request->product )->get();

        foreach ($product_flavors as $flavor) {
          

            if ($request->input('dispatch_flavor_quantity_'.$flavor->id) > 0 && !empty ($request->input('dispatch_flavor_quantity_'.$flavor->id)) ) {
                 
                $dispatch_flavor = new ProductDispatchFlavor ();

                $dispatch_flavor->product_dispatch_id = $dispatch->id;
          
                $dispatch_flavor->product_flavor_id = $request->input('flavor_id_'.$flavor->id);

                $dispatch_flavor->quantity = $request->input('dispatch_flavor_quantity_'.$flavor->id);
    

                $product_price = ProductFlavor::where('id', $request->input('flavor_id_'.$flavor->id))->first();
                
                $dispatch_flavor->price = $product_price->price * $dispatch_flavor->quantity;
    
                $dispatch_flavor->save();

                $flavor->quantity -= $request->input('dispatch_flavor_quantity_'.$flavor->id);
                $flavor->save();
            }
          

        }
       

        return redirect()->back();

    }

    // --------------------------


    // manage products
    public function manageproducts()
    {
        
        $products = Product::where('supplier_id',session('supplier_id'))->get();

        return view('supplier.products.manage-products',compact('products'));
    }

    







    // --------------------------


    // deliveries 
    public function deliveries()
    {

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


        return view('supplier.orders.all-orders', compact('purchases', 'deliveriesCount', 'canceledCount', 'deliveredCount', 'cashCollection'));

    }





    // ------------------------


    // deliveries 
    public function filterDeliveries(Request $request)
    {



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



        // get filter
        $filters = array();

        if ($request->status != "all") {

            $filters["status"] = $request->status;
        }

        
        // get from date and to date
        $fromdate = (!empty($request->fromdate) ? $request->fromdate : "0000-00-00");
        $todate = (!empty($request->todate) ? $request->todate : "5000-12-30");


        // get the purchases using the unqiue purchase items
        $purchases = Purchase::where($filters)
        ->where('delivery_date', '>=', $fromdate)
        ->where('delivery_date', '<=', $todate)
        ->whereIn('id', $purchaseItemsUniqueArray)->get();


        




        $deliveriesCount = $purchases->count();
        $canceledCount = $purchases->where('status', 'canceled')->count();
        $deliveredCount = $purchases->where('status', 'delivered')->count();
        $cashCollection = $purchases->sum('cashcollection');

        
        return view('supplier.orders.all-orders', compact('purchases', 'deliveriesCount', 'canceledCount', 'deliveredCount', 'cashCollection'));


    }





    // --------------------------


    // reports products
    public function reports()
    {
        return view('supplier.reports.all-orders');
    }






    // --------------------------


    // reports products
    public function settings()
    {

        // get supplier info
        $supplier = Supplier::find(session('supplier_id'));

        // get - city - districts
        $cities = Optioncode::where('type', 'city')->get();
        $districts = Optioncode::where('type', 'district')->get();
        

        return view('supplier.settings.general', compact('supplier', 'cities', 'districts'));
    }







    public function updatesettings(Request $request)
    {




        $partner = Supplier::find(session()->get('supplier_id'));


        // get value and update instantly
        $partner->name = $request->name;
        $partner->email = $request->email;
        $partner->phone = $request->phone;
        $partner->address = $request->address;
        $partner->locationlink = '@' . $request->locationlink;



        $partner->city_id = $request->city;
        $partner->district_id = $request->district;

        if (!empty($request->password)) {
            $partner->password = Hash::make($request->password);
        }



        // image
        // A - logo (not required)
        if (!empty($request->file('logo'))) {


            $logoname = time() . '-' . $request->file('logo')->getClientOriginalName();

            $request->file('logo')->move(public_path('assets/img/suppliers/logos'), $logoname);

            $partner->logo = $logoname;

            // change session logo
            session(['supplier_logo' => $logoname]);
        }




        $partner->save();


        return redirect()->route('supplier.settings');

    } //end update general

}
