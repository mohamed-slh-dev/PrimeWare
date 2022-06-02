<?php

namespace App\Http\Controllers;
use App\Models\Driver;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Othersingleorder;
use App\Models\Collectedorder;
use App\Models\Partner;
use App\Models\Returnedcash;


use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class CollectorAppController extends Controller
{
    public function index(){
        return view('collector.login');
    }

    public function checkLogin(Request $request)
    {
         // username + password
         $email = $request->email;
         $password = $request->password;
 
         
         // get user using username
         $driver = Driver::where('email', $email)->where('type','collector')->first();

         if ($driver && Hash::check($password, $driver->password)) {
            session()->put('collector_id', $driver->id);
             return redirect()->route('collector.home');
         }else{
            return redirect()->route('collector.login');
         }
       
    }

    public function home()
    {
        if ( !(session()->get('collector_id')) ) {
            return view('collector.login');
          }

        $ordersHome = array();
       
        $collectorOrders = Collectedorder::where('driver_id',session()->get('collector_id'))
        ->join('partners','partners.id','=','collectedorders.partner_id')
        ->select('partners.name AS resturantName','partners.id AS resturantId','partners.address AS resturantAddress','partners.logo AS restlogo',
        'partners.locationlink AS resturantLocationLink')
        ->where('deliverydate',Carbon::now(+'4')->format('Y-m-d'))
        ->get()
        ->groupBy('resturantName');

        if ($collectorOrders->count() > 0) {
            $restaurantNames =  $collectorOrders;

            $i = 0;
     
         foreach ($restaurantNames as $restaurant => $collectorOrders){
     
                      $ordersHome[$i]['restaurantName'] =$restaurant;
                      $ordersHome[$i]['restaurantId'] =$restaurantNames[$restaurant][0]->resturantId;
                      $ordersHome[$i]['logo'] = asset('assets/img/partners/logos').'/'. $restaurantNames[$restaurant][0]->restlogo;
                      $ordersHome[$i]['address'] =$restaurantNames[$restaurant][0]->resturantAddress;
                      $ordersHome[$i]['location'] =$restaurantNames[$restaurant][0]->resturantLocationLink;

                      if (strpos($restaurantNames[$restaurant][0]->resturantLocationLink, ',') !== false) {
                         $str     = $restaurantNames[$restaurant][0]->resturantLocationLink;
                         $temp1   = explode('@', $str, 2);
                         $temp1   = explode(', ', $temp1[1]);
                         
                         $ordersHome[$i]['lat'] =$temp1[0];
                         $ordersHome[$i]['long'] =$temp1[1];
                     }else{
                          
                         $ordersHome[$i]['lat'] ='0.0';
                         $ordersHome[$i]['long'] ='0.0';
                     }
     
                      $ordersHome[$i]['delivers'] = $restaurantNames[$restaurant]->count();
                  $i++;   
           }

           $total_deliveries = 0;
          for ($i=0; $i < count($ordersHome) ; $i++) { 
            $total_deliveries += $ordersHome[$i]['delivers'];
          }
          
        }else{
            $total_deliveries =  0;
        }
     
        $restaurants = Partner::select('id','name')->get();
       
        $total_restaurants = count($ordersHome);

        $todayDate = Carbon::now(+'4')->format('D d-M-Y');


        return view('collector.home',compact('ordersHome', 'restaurants', 'total_restaurants','total_deliveries','todayDate'));
        
      
    }


    public function CollectorOrdersByRestaurants($restaurant_id)
    { 
        if ( !(session()->get('collector_id')) ) {
            return view('collector.login');
          }
        $ordersByRest = array();

        $queyCollectorOrdersByRest = Collectedorder::where('driver_id',session()->get('collector_id'))
        ->where('collectedorders.partner_id',$restaurant_id)
        ->join('customers','customers.id','=','collectedorders.customer_id')
        ->join('optioncodes AS cityCode','cityCode.id','=','customers.city_id')
        ->join('optioncodes AS districtCode','districtCode.id','=','customers.district_id')
        ->select('collectedorders.order_id AS order_id','customers.name AS customer_name','customers.address AS Address','cityCode.name AS city',
        'districtCode.name AS district','customers.blocknumber AS block_number','customers.flatnumber AS flat_number','collectedorders.bag AS bag','collectedorders.status AS status')
        ->where('deliverydate',Carbon::now(+'4')->format('Y-m-d'))
        ->orderBy('status','desc')
        ->get();

        $partner_info = Partner::where('id', $restaurant_id)->first();

        return view('collector.resturant-deliveris',compact('queyCollectorOrdersByRest','partner_info','restaurant_id'));

    }

    public function CollectorOrdersByRestaurantsFillter(Request $request)
    { 
      $restaurant_id = $request->restaurant_id;

        if ( !(session()->get('collector_id')) ) {
            return view('collector.login');
          }
        $ordersByRest = array();

        $queyCollectorOrdersByRest = Collectedorder::where('driver_id',session()->get('collector_id'))
        ->where('collectedorders.partner_id',$restaurant_id)
        ->join('customers','customers.id','=','collectedorders.customer_id')
        ->join('optioncodes AS cityCode','cityCode.id','=','customers.city_id')
        ->join('optioncodes AS districtCode','districtCode.id','=','customers.district_id')
        ->select('collectedorders.order_id AS order_id','customers.name AS customer_name','customers.address AS Address','cityCode.name AS city',
        'districtCode.name AS district','customers.blocknumber AS block_number','customers.flatnumber AS flat_number','collectedorders.bag AS bag','collectedorders.status AS status')
        ->where('deliverydate',Carbon::now(+'4')->format('Y-m-d'))
        ->where('status',$request->status)
        ->orderBy('status','desc')
        ->get();

        $partner_info = Partner::where('id',$restaurant_id)->first();

        return view('collector.resturant-deliveris',compact('queyCollectorOrdersByRest','partner_info','restaurant_id'));

    }

   
    public function updateDeliveryStatus(Request $request)
    {
        if ( !(session()->get('collector_id')) ) {
            return view('collector.login');
          }

        if ($request->bag == 'on') {
           $bag = 1;
        }else{
            $bag = 0;
        }
       
        if ($request->status == 'received from restaurant') {
            Collectedorder::where('order_id',$request->order_id)
            ->update([
             'status' =>  strtolower($request->status),
             'bag' =>$bag,
             'updatedate' => Carbon::now(+'4')
          ]);
    
          Order::where('id',$request->order_id)
          ->update([
           'status' => strtolower($request->status),
           'bag' =>$bag,
           'updatedate' => Carbon::now(+'4')
        ]);
        }else{
            Collectedorder::where('order_id',$request->order_id)
            ->update([
             'status' =>  strtolower($request->status),
             'updatedate' => Carbon::now(+'4')
          ]);
    
          Order::where('id',$request->order_id)
          ->update([
           'status' => strtolower($request->status),
           'updatedate' => Carbon::now(+'4')
        ]);
      }

      return redirect()->back()->with('success','Order Status Updated Successfully');
    }

    public function returnCash()
    {
        if ( !(session()->get('collector_id')) ) {
            return view('collector.login');
          }
        $restaurants = Partner::select('id','name')->get();
        return view('collector.cash-return',compact('restaurants'));
    }

    public function returnCashAmount(Request $request)
    {
        if ( !(session()->get('collector_id')) ) {
            return view('collector.login');
          }

        $rest = $request->restaurant_id;
        $cash = $request->cash_amount;

        $returnCash = new Returnedcash();

        $returnCash->amount = $cash;
        $returnCash->partner_id = $rest;
        $returnCash->driver_id = session()->get('collector_id');
        $returnCash->date =  Carbon::now(+'4')->format('Y-m-d');

        $returnCash->save();

        return redirect()->back()->with('success','Returned Cash Amount Added Successfully');
    }

    public function searchRestaurant()
    {
        if ( !(session()->get('collector_id')) ) {
            return view('collector.login');
          }

        $queyCollectorOrdersByRest = null;
        $restaurants = Partner::select('id','name')->get();
        return view('collector.search-restaurant',compact('restaurants','queyCollectorOrdersByRest'));
    }

    public function getSearchRestaurant(Request $request)
    {
        if ( !(session()->get('collector_id')) ) {
            return view('collector.login');
          }

          if ($request->date) {
           $date = $request->date;
          }else{
            $date  = Carbon::now(+'4')->format('Y-m-d');
          }
        $ordersByRest = array();

        $queyCollectorOrdersByRest = Collectedorder::where('driver_id',session()->get('collector_id'))
        ->where('collectedorders.partner_id',$request->restaurant_id)
        ->join('customers','customers.id','=','collectedorders.customer_id')
        ->join('optioncodes AS cityCode','cityCode.id','=','customers.city_id')
        ->join('optioncodes AS districtCode','districtCode.id','=','customers.district_id')
        ->select('collectedorders.id AS order_id', 'collectedorders.deliverydate AS date','customers.name AS customer_name','customers.address AS Address','cityCode.name AS city',
        'districtCode.name AS district','customers.blocknumber AS block_number','customers.flatnumber AS flat_number','collectedorders.bag AS bag','collectedorders.status AS status')
        ->where('deliverydate',$date)
        ->get();

        $restaurants = Partner::select('id','name')->get();

        return view('collector.search-restaurant',compact('queyCollectorOrdersByRest','restaurants'));
    }

    public function profile()
    {
        if ( !(session()->get('collector_id')) ) {
            return view('collector.login');
          }

        $driverInfo = Driver::where('id',session()->get('collector_id'))->first(); 

        return view('collector.profile',compact('driverInfo'));
    }

    public function editProfile()
    {
        if ( !(session()->get('collector_id')) ) {
            return view('collector.login');
          }

        $driverInfo = Driver::where('id',session()->get('collector_id'))->first(); 

        return view('collector.edit-profile',compact('driverInfo'));
    }

    public function updateProfile(Request $request)
    {
        if ( !(session()->get('collector_id')) ) {
            return view('collector.login');
          }

        Driver::where('id',session()->get('collector_id'))
        ->update([
         'email' => $request->email,
         'phone' => $request->phone,
         'info' => $request->info 
      ]);

      if ($request->password != null) {
        
        if ($request->password === $request->confirmpassword) {
            Driver::where('id',session()->get('collector_id'))
        ->update([
        'password' => Hash::make($request->password)
      ]);
        }else{
            return redirect()->route('collector.edit.profile')->with('warning','password not match');
        }
        
       }

       return redirect()->route('collector.profile')->with('success','Driver Info Updated Successfully');

    }

    public function logout(){
      session()->forget('collector_id');
      return redirect()->route('collector.login');
    }

}
