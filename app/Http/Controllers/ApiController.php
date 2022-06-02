<?php

namespace App\Http\Controllers;
use App\Models\Driver;
use App\Models\Order;
use App\Models\Othersingleorder;
use App\Models\Collectedorder;
use App\Models\Partner;
use App\Models\Customer;
use App\Models\Optioncode;
use App\Models\Ads;
use App\Models\DriverDistricts;
use App\Models\Returnedcash;
use App\Models\SingleOrder;
use App\Models\CustomerFreeze;
use App\Models\CustomerRenew;
use App\Models\DriverCustomerMessage;
use App\Models\PartnerCustomerMessage;
use App\Models\Message; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Carbon\Carbon;

use App\Traits\GeneralTraits;

class ApiController extends Controller
{
    use GeneralTraits;

    public function login()
    {   
        return returnError('You must login first');

    }

    public function driverlogin(Request $request)
    {
        // if found then check password (he pass)
       
        $credentials = request(['email', 'password']);

        $token = Auth::guard('drivers-api')->attempt($credentials);

        if (!$token) {
            return $this -> returnError('Unauthorized!');
        }

        $driver = Auth::guard('drivers-api')->user();
        $driver->driver_token = $token;

        $driver['licensepic'] = asset('assets/img/drivers/licenses').'/'. $driver['licensepic'];
        $driver['pic'] = asset('assets/img/drivers/profiles').'/'. $driver['pic'];
        
        Driver::where('id', $driver['id'])
        ->update([
         'onlinestatus' =>'online',
      ]);

        return response([
            'token'=>$token,
            'driver'=>$driver
            ]);
       
    }

    public function driverlogout(Request $request)
    {

        $token = $request -> header('auth-token');

        Driver::where('id', \Auth::user()->id)
        ->update([
         'onlinestatus' =>'offline',
      ]);

        if ($token) {
            JWTAuth::setToken($token)->invalidate();

        return response()->json(['message' => 'Successfully logged out']);
        
        }else{
            return response()->json(['message' => 'Something worng!']);
        }
       
    }

    public function driverInfo()
    { 
        
        $driverInfo = Driver::where('id',\Auth::user()->id)->first(); 

        $driverInfo['licensepic'] = asset('assets/img/drivers/licenses').'/'. $driverInfo['licensepic'];
        $driverInfo['pic'] = asset('assets/img/drivers/profiles').'/'. $driverInfo['pic'];

        ($driverInfo['shift'] == 'morning shift') ? $driverInfo['timing'] = '3:00 AM - 8:00 AM / 8:00 AM - 12:00 PM' : $driverInfo['timing'] = '3:00 PM - 9:00 PM'  ;

        return $this -> returnData('data',$driverInfo);

    }

    public function updateDriverInfo(Request $request)
    {
        Driver::where('id',\Auth::user()->id)
        ->update([
         'email' => $request->email,
         'phone' => $request->phone,
         'info' => $request->info 
      ]);

      if ($request->password != null) {
       
        Driver::where('id',\Auth::user()->id)
        ->update([
        'password' => Hash::make($request->password)
      ]);
      }

      return $this -> returnSuccess('Driver Info Updated Successfully');
    }
///////////////////////////////////////////////////Collector API//////////////////////////////////////////////// 
    public function CollectorOrdersHome()
    { 
        $ordersHome = array();
       
        $collectorOrders = Collectedorder::where('driver_id',\Auth::user()->id)
        ->join('partners','partners.id','=','collectedorders.partner_id')
        ->select('partners.name AS resturantName','partners.id AS resturantId','partners.address AS resturantAddress','partners.logo AS restlogo',
        'partners.locationlink AS resturantLocationLink')
        ->where('deliverydate',Carbon::now()->format('Y-m-d'))
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
       
        
    return response()->json([
        'status'=> 'true',
        'msg'=> '',
        'data' => $ordersHome,
        'restaurants' => $restaurants,
        'total_restaurants' => count($ordersHome),
        'total_deliveries' => $total_deliveries
    ]);
      

    }

    public function CollectorRestaurantLocationInfo(Request $request)
    { 
        $restaurantInfo = array();
       
        $restaurantLocationInfo = Collectedorder::join('partners','partners.id','=','collectedorders.partner_id')
        ->select('partners.name AS resturantName','partners.address AS resturantAddress','partners.phone AS resturantPhone','partners.locationlink AS resturantLocationLink','partners.id AS partner_id',)
        ->where('partners.id', $request->restaurant_id)
        ->first();

      
         if (strpos( $restaurantLocationInfo->resturantLocationLink, ',') !== false) {
            $str     =  $restaurantLocationInfo->resturantLocationLink;
            $temp1   = explode('@', $str, 2);
            $temp1   = explode(', ', $temp1[1]);
                
                $restaurantInfo['lat'] =$temp1[0];
                $restaurantInfo['long'] =$temp1[1];
            }else{
                $restaurantInfo['lat'] ='0.0';
                $restaurantInfo['long'] = '0.0';  
               
            }

        $restaurantInfo['restaurant_name'] = $restaurantLocationInfo->resturantName;
        $restaurantInfo['restaurant_id'] = $restaurantLocationInfo->partner_id;
        $restaurantInfo['deliveris'] = $restaurantLocationInfo->count();
        $restaurantInfo['address'] = $restaurantLocationInfo->resturantAddress;
       
        $restaurantInfo['phone'] = $restaurantLocationInfo->resturantPhone;

        return $this -> returnData('data',$restaurantInfo);

    }

    public function CollectorOrdersByRestaurants(Request $request)
    { 
        $ordersByRest = array();

        $queyCollectorOrdersByRest = Collectedorder::where('driver_id',\Auth::user()->id)
        ->where('collectedorders.partner_id',$request->restaurant_id)
        ->join('customers','customers.id','=','collectedorders.customer_id')
        ->join('optioncodes AS cityCode','cityCode.id','=','customers.city_id')
        ->join('optioncodes AS districtCode','districtCode.id','=','customers.district_id')
        ->select('collectedorders.id AS order_id','customers.name AS customer_name','customers.address AS Address','cityCode.name AS city',
        'districtCode.name AS district','customers.blocknumber AS blcok_number','customers.flatnumber AS flat_number','collectedorders.bag AS bag','collectedorders.status AS status')
        ->where('deliverydate',Carbon::now()->format('Y-m-d'))
        ->get();

        foreach ($queyCollectorOrdersByRest as $order) {
           $order['status'] = ucwords($order['status']);
        }

        

        return $this -> returnData('data',$queyCollectorOrdersByRest);

    }

    public function CollectedOrdersByRestaurantsSearchByCustomer(Request $request)
    { 
        $customerId = Customer::where('name', 'LIKE', "%{$request->customer_name}%")->first();
        if ($customerId) {
            $queryCollectedOrdersByRest = Collectedorder::where('driver_id',\Auth::user()->id)
            ->where('customer_id', $customerId->id)
            ->where('collectedorders.partner_id',$request->restaurant_id)
            ->join('customers','customers.id','=','collectedorders.customer_id')
            ->join('optioncodes AS cityCode','cityCode.id','=','customers.city_id')
            ->join('optioncodes AS districtCode','districtCode.id','=','customers.district_id')
            ->select('collectedorders.id AS order_id','customers.name AS customer_name','customers.address AS Address','cityCode.name AS city',
            'districtCode.name AS district','customers.blocknumber AS blcok_number','customers.flatnumber AS flat_number','collectedorders.bag AS bag','collectedorders.status AS status')
            ->where('deliverydate',Carbon::now()->format('Y-m-d'))
            ->get();
            return $this -> returnData('data',$queryCollectedOrdersByRest,'true');

              
        foreach ($queryCollectedOrdersByRest as $order) {
            $order['status'] = ucwords($order['status']);
         }
    
        }else{
            $queryCollectedOrdersByRest= array();
            return $this -> returnData('data',$queryCollectedOrdersByRest,'No Results Found!');
        }
        

     
        return $this -> returnData('data',$queryCollectedOrdersByRest);

    }

    public function UpdateCollectedOrderStatus(Request $request)
    {
        if ($request->status == 'Received From Restaurant') {
            Collectedorder::where('order_id',$request->order_id)
            ->update([
             'status' =>  strtolower($request->status),
             'bag' => $request->bag,
             'updatedate' => Carbon::now()
          ]);
    
          Order::where('id',$request->order_id)
          ->update([
           'status' => strtolower($request->status),
           'bag' => $request->bag,
           'updatedate' => Carbon::now()
        ]);
        }else
        {
            Collectedorder::where('order_id',$request->order_id)
            ->update([
             'status' =>  strtolower($request->status),
             'updatedate' => Carbon::now()
          ]);
    
          Order::where('id',$request->order_id)
          ->update([
           'status' => strtolower($request->status),
           'updatedate' => Carbon::now()
        ]);
      }

      return $this -> returnSuccess('Order Status Updated Successfully');
    }

    public function returnCash(Request $request)
    {
        $rest = $request->restaurant_id;
        $cash = $request->cash_amount;

        $returnCash = new Returnedcash();

        $returnCash->amount = $cash;
        $returnCash->partner_id = $rest;
        $returnCash->driver_id = \Auth::user()->id;
        $returnCash->date =  \Carbon\Carbon::now()->format('Y-m-d');

        $returnCash->save();

     return $this -> returnSuccess('Returned Cash Amount Added Successfully');
    }


    public function CollectorRestaurantChat(Request $request)
    {
        $msgs = Message::where('partner_id', $request->restaurant_id)
        ->where('driver_id',\Auth::user()->id)
        ->get();

        foreach ($msgs as $msg) {
            ($msg->type == 'sender') ?   $msg->type = 'partner' : $msg->type =  $msg->type ;
         }

        return $this-> returnData('data',$msgs);

    }

    public function collectorRestaurantSend(Request $request)
    {
        $check = Message::create([
            'message'=>$request->message,
            'type'=>'driver',
            'date'=>Carbon::now(),
            'driver_id'=>\Auth::user()->id,
            'partner_id'=>$request->restaurant_id,
        ]);


        if ($check) {

       // add notification to UserNotification
        // $notif = new UserNotification();

        // $notif->shortinfo = " Restaurant Added a New Customer";
        // $notif->longinfo = session('partner_name') . " Restaurant Has Added ". $request->name ." As a New Customer";

        // $notif->datetime = date('Y-m-d - h:i A');
        // $notif->linkroute = "";

        // $notif->user_id = null;
        // $notif->partner_id = session('partner_id');
        // $notif->otherpartner_id = null;

        // $notif->save();

           return $this->returnSuccess('Sent');
        }
    }

////////////////////////////////////////Driver API's//////////////////////////////////////////////////////

    public function DriverHomeDeliveries()
    { 
        $driverHomeDelivery = Order::where('driver_id',\Auth::user()->id)
        ->join('customers','customers.id','=','orders.customer_id')
        ->join('optioncodes AS cityCode','cityCode.id','=','customers.city_id')
        ->join('optioncodes AS districtCode','districtCode.id','=','customers.district_id')
        ->select('orders.id AS order_id','orders.bag AS orderBag','orders.cashcollected AS cash','orders.status AS OrderStatus','customers.id AS customer_id','customers.name AS customer_name','customers.locationlink AS link','customers.address AS customer_address','cityCode.name AS city',
        'districtCode.name AS district','customers.blocknumber AS block_number','customers.phone AS phone','customers.flatnumber AS flat_number')
        ->where('deliverydate',Carbon::now()->format('Y-m-d'))
        ->get();

        $homeDeliveries = array();
        $i = 0;
        foreach ($driverHomeDelivery as $delivery) {
            $homeDeliveries[$i]['delivery_id'] = $delivery->order_id;
            $homeDeliveries[$i]['cash_collection'] = $delivery->cash;
            $homeDeliveries[$i]['bag'] = $delivery->orderBag;
            $homeDeliveries[$i]['status'] = ucwords($delivery->OrderStatus);
            $homeDeliveries[$i]['customer_id'] = $delivery->customer_id;
            $homeDeliveries[$i]['customer_name'] = $delivery->customer_name;
            $homeDeliveries[$i]['customer_phone'] = $delivery->phone;
            $homeDeliveries[$i]['address'] = $delivery->customer_address;
            $homeDeliveries[$i]['city'] = $delivery->city;
            $homeDeliveries[$i]['district'] = $delivery->district;
            $homeDeliveries[$i]['flat_number'] = $delivery->flat_number;
            $homeDeliveries[$i]['block_number'] = $delivery->block_number;
            
            if (strpos($delivery->link, ',') !== false) {
                $str     = $delivery->link;
                $temp1   = explode('@', $str, 2);
                $temp1   = explode(', ', $temp1[1]);
                
                $homeDeliveries[$i]['lat'] =$temp1[0];
                $homeDeliveries[$i]['long'] =$temp1[1];
            }else{
                $homeDeliveries[$i]['lat'] ='0.0';
                $homeDeliveries[$i]['long'] ='0.0';
            }
            $i++;
        }

        $restaurants = Partner::select('id','name','logo')->get();
        foreach ($restaurants as $rest) {
            $rest['logo'] = asset('assets/img/partners/logos').'/'. $rest['logo'];
        }

        $driverHomeOrders = Othersingleorder::where('driver_id',\Auth::user()->id)
        ->select('id')->get();

    return response()->json([
        'status'=> 'true',
        'msg'=> '',
        'data' => $homeDeliveries,
        'total_deliveries' => count($homeDeliveries),
        'total_orders' => $driverHomeOrders->count()
    ]);

    }


    public function DriverHomeDeliveriesByRestaurant(Request $request)
    { 
        if ($request->restaurant_id == 0) {
            $driverHomeDelivery = Order::where('driver_id',\Auth::user()->id)
            ->join('customers','customers.id','=','orders.customer_id')
            ->join('optioncodes AS cityCode','cityCode.id','=','customers.city_id')
            ->join('optioncodes AS districtCode','districtCode.id','=','customers.district_id')
            ->select('orders.id AS order_id','orders.bag AS bag','orders.cashcollected','orders.status','customers.id AS customer_id','customers.name AS customer_name','customers.locationlink AS link','customers.address AS Address','cityCode.name AS city',
            'districtCode.name AS district','customers.blocknumber AS block_number','customers.phone AS phone','customers.flatnumber AS flat_number')
            ->where('deliverydate',Carbon::now()->format('Y-m-d'))
            ->get();
    
        }else{
            $driverHomeDelivery = Order::where('driver_id',\Auth::user()->id)
            ->join('customers','customers.id','=','orders.customer_id')
            ->join('optioncodes AS cityCode','cityCode.id','=','customers.city_id')
            ->join('optioncodes AS districtCode','districtCode.id','=','customers.district_id')
            ->select('orders.id AS order_id','orders.bag AS bag','orders.cashcollected','orders.status','customers.id AS customer_id','customers.name AS customer_name','customers.locationlink AS link','customers.address AS Address','cityCode.name AS city',
            'districtCode.name AS district','customers.blocknumber AS block_number','customers.phone AS phone','customers.flatnumber AS flat_number')
            ->where('orders.partner_id','=',$request->restaurant_id)
            ->where('deliverydate',Carbon::now()->format('Y-m-d'))
            ->get();
    
        }
       
        $homeDeliveries  =array();
        $i = 0;
        foreach ($driverHomeDelivery as $delivery) {
            $homeDeliveries[$i]['delivery_id'] = $delivery->order_id;
            $homeDeliveries[$i]['cash_collection'] = $delivery->cashcollected;
            $homeDeliveries[$i]['bag'] = $delivery->bag;
            $homeDeliveries[$i]['status'] = ucwords($delivery->status) ;
            $homeDeliveries[$i]['customer_id'] = $delivery->customer_id;
            $homeDeliveries[$i]['customer_name'] = $delivery->customer_name;
            $homeDeliveries[$i]['customer_phone'] = $delivery->phone;
            $homeDeliveries[$i]['address'] = $delivery->Address;
            $homeDeliveries[$i]['city'] = $delivery->city;
            $homeDeliveries[$i]['district'] = $delivery->district;
            $homeDeliveries[$i]['flat_number'] = $delivery->flat_number;
            $homeDeliveries[$i]['block_number'] = $delivery->block_number;

            if (strpos($delivery->link, ',') !== false) {
                $str     = $delivery->link;
                $temp1   = explode('@', $str, 2);
                $temp1   = explode(', ', $temp1[1]);
                
                $homeDeliveries[$i]['lat'] =$temp1[0];
                $homeDeliveries[$i]['long'] =$temp1[1];
            }else{
                 
                $homeDeliveries[$i]['lat'] ='0.0';
                $homeDeliveries[$i]['long'] ='0.0';
            }

            $i++;
           
        }

        $restaurants = Partner::select('id','name','logo')->get();
        foreach ($restaurants as $rest) {
            $rest['logo'] = asset('assets/img/partners/logos').'/'. $rest['logo'];
        }

        
        $driverHomeOrders = Othersingleorder::where('driver_id',\Auth::user()->id)
        ->select('id')->get();

         return response()->json([
        'status'=> 'true',
        'msg'=> '',
        'data' => $homeDeliveries,
        'restaurants' => $restaurants,
        'total_deliveries' => count($homeDeliveries),
        'total_orders' => $driverHomeOrders->count()
    ]);
   

    }

    
    public function DriverHomeOrders()
    { 
        $driverHomeOrders = Othersingleorder::where('driver_id',\Auth::user()->id)
         ->select('id','customer_name','customer_phone' ,'customer_address','customer_locationlink','pickuplocationlink AS pickup_locationlink','status')->get();

         $homeOrders = array();
         $i = 0;
        foreach ($driverHomeOrders as $order) {
            $homeOrders[$i]['order_id'] = $order->id;
            $homeOrders[$i]['status'] = ucwords($order->status) ;
            $homeOrders[$i]['customer_name'] = $order->customer_name;
            $homeOrders[$i]['customer_phone'] = $order->customer_phone;
            $homeOrders[$i]['address'] = $order->customer_address;

            if (strpos($order->customer_locationlink, ',') !== false) {
                $str     = $order->customer_locationlink;
                $temp1   = explode('@', $str, 2);
                $temp1   = explode(', ', $temp1[1]);
                
                $homeOrders[$i]['customer_lat'] =$temp1[0];
                $homeOrders[$i]['customer_long'] =$temp1[1];
            }else{
                 
                $homeOrders[$i]['customer_lat'] ='0.0';
                $homeOrders[$i]['customer_long'] ='0.0';
            }

            if (strpos($order->pickup_locationlink, ',') !== false) {
                $str     = $order->pickup_locationlink;
                $temp1   = explode('@', $str, 2);
                $temp1   = explode(', ', $temp1[1]);
                $homeOrders[$i]['pickup_lat'] =$temp1[0];
                $homeOrders[$i]['pickup_long'] =$temp1[1];
            }else{
                 
                $homeOrders[$i]['pickup_lat'] ='0.0';
                $homeOrders[$i]['pickup_long'] ='0.0';
            }

            $i++;
           
        }

        $driverHomeDelivery = Order::where('driver_id',\Auth::user()->id)
        ->where('deliverydate',Carbon::now()->format('Y-m-d'))
        ->get();

         return response()->json([
        'status'=> 'true',
        'msg'=> '',
        'data' => $homeOrders,
        'total_deliveries' => $driverHomeDelivery->count(),
        'total_orders' => count($homeOrders)
       
    ]);
   

  

    }

    public function DriverHomeOrdersDeliverd()
    { 
        $driverHomeOrders = Othersingleorder::where('driver_id',\Auth::user()->id)
         ->select('id','customer_name','customer_phone','customer_address','customer_locationlink','pickuplocationlink AS pickup_locationlink','status')
         ->where('status','Delivered')
         ->get();

         $driverHomeOrdersCounter = Othersingleorder::where('driver_id',\Auth::user()->id)
         ->select('id','customer_name','customer_phone','customer_address','customer_locationlink','pickuplocationlink AS pickup_locationlink','status')
         ->get();

         $homeOrders = array();
         $i = 0;
        foreach ($driverHomeOrders as $order) {
            $homeOrders[$i]['order_id'] = $order->id;
            $homeOrders[$i]['status'] = ucwords($order->status) ;
            $homeOrders[$i]['customer_name'] = $order->customer_name;
            $homeOrders[$i]['customer_phone'] = $order->customer_phone;
            $homeOrders[$i]['address'] = $order->customer_address;

            if (strpos($order->customer_locationlink, ',') !== false) {
                $str     = $order->customer_locationlink;
                $temp1   = explode('@', $str, 2);
                $temp1   = explode(', ', $temp1[1]);
                
                $homeOrders[$i]['customer_lat'] =$temp1[0];
                $homeOrders[$i]['customer_long'] =$temp1[1];
            }else{
                 
                $homeOrders[$i]['customer_lat'] ='0.0';
                $homeOrders[$i]['customer_long'] ='0.0';
            }

            if (strpos($order->pickup_locationlink, ',') !== false) {
                $str     = $order->pickup_locationlink;
                $temp1   = explode('@', $str, 2);
                $temp1   = explode(', ', $temp1[1]);
                $homeOrders[$i]['pickup_lat'] =$temp1[0];
                $homeOrders[$i]['pickup_long'] =$temp1[1];
            }else{
                 
           $homeOrders[$i]['pickup_lat'] ='0.0';
            $homeOrders[$i]['pickup_long'] ='0.0';
            }

            $i++;
           
        }

        $driverHomeDelivery = Order::where('driver_id',\Auth::user()->id)
        ->where('deliverydate',Carbon::now()->format('Y-m-d'))
        ->get();

        return response()->json([
            'status'=> 'true',
            'msg'=> '',
            'data' => $homeOrders,
            'total_deliveries' => $driverHomeDelivery->count(),
            'total_orders' => count($driverHomeOrdersCounter)
           
        ]);
       
       

    }
    
    public function DriverHomeOrdersReceived()
    { 
        $driverHomeOrders = Othersingleorder::where('driver_id',\Auth::user()->id)
         ->select('id','customer_name','customer_phone','customer_address','customer_locationlink','pickuplocationlink AS pickup_locationlink','status')
         ->where('status','picked from pickup')
         ->get();

         $driverHomeOrdersCounter = Othersingleorder::where('driver_id',\Auth::user()->id)
         ->select('id','customer_name','customer_phone','customer_address','customer_locationlink','pickuplocationlink AS pickup_locationlink','status')
         ->get();

         $homeOrders = array();
         $i = 0;
        foreach ($driverHomeOrders as $order) {
            $homeOrders[$i]['order_id'] = $order->id;
            $homeOrders[$i]['status'] = ucwords($order->status) ;
            $homeOrders[$i]['customer_name'] = $order->customer_name;
            $homeOrders[$i]['customer_phone'] = $order->customer_phone;
            $homeOrders[$i]['address'] = $order->customer_address;

            if (strpos($order->customer_locationlink, ',') !== false) {
                $str     = $order->customer_locationlink;
                $temp1   = explode('@', $str, 2);
                $temp1   = explode(', ', $temp1[1]);
                
                $homeOrders[$i]['customer_lat'] =$temp1[0];
                $homeOrders[$i]['customer_long'] =$temp1[1];
            }else{
                 
                $homeOrders[$i]['customer_lat'] ='0.0';
                $homeOrders[$i]['customer_long'] ='0.0';
            }

            if (strpos($order->pickup_locationlink, ',') !== false) {
                $str     = $order->pickup_locationlink;
                $temp1   = explode('@', $str, 2);
                $temp1   = explode(', ', $temp1[1]);
                $homeOrders[$i]['pickup_lat'] =$temp1[0];
                $homeOrders[$i]['pickup_long'] =$temp1[1];
            }else{
                 
                $homeOrders[$i]['pickup_lat'] ='0.0';
                $homeOrders[$i]['pickup_long'] ='0.0';
            }

            $i++;
           
        }

       $driverHomeDelivery = Order::where('driver_id',\Auth::user()->id)
        ->where('deliverydate',Carbon::now()->format('Y-m-d'))
        ->get();
        
        return response()->json([
            'status'=> 'true',
            'msg'=> '',
            'data' => $homeOrders,
            'total_deliveries' => $driverHomeDelivery->count(),
             'total_orders' => count($driverHomeOrdersCounter)
           
        ]);
       

    }


    public function DriverUpdateDeliveryStatus(Request $request)
    {
        if ($request->status == 'Delivered' || $request->status == 'Canceled' ) {
            $customer_order = Order::where('id',$request->order_id)
            ->first();
     
            $customer_current_bags = Customer::where('id',$customer_order->customer_id)
            ->first();

            $customer_total_bags =  $customer_order->bag +  $customer_current_bags->totalbags;
            if ($request->returned_bag == 1) {
                $customer_total_bags--;
               }
        
               $update_bags = Customer::where('id',$customer_order->customer_id)
               ->update([
                'totalbags' => $customer_total_bags
             ]);
        }
       

       $check = Order::where('id',$request->order_id)
        ->update([
         'status' => strtolower($request->status), 
         'updatedate' => Carbon::now()
      ]);
        if ($check) {
            return $this -> returnSuccess('Delivery Status Updated Successfully');
        }else{
            return $this -> returnError('Delivery Status NOT Updated');
        }
    }


    public function uploadDeliveryPic(Request $request)
    {
        
            $ext = $request->file('pic')->getClientOriginalExtension();
            $picname = 'delivery-pic-'.time().'.'.$ext;

            $request->file('pic')->move(public_path('assets/img/partners/delivery-pics'), $picname);

            
       $check = Order::where('id',$request->delivery_id)
       ->update([
        'receivedpic' => $picname
     ]);

     if ($check) {
        return $this->returnSuccess('Picture uploaded successfully');
     }else{
        return $this->returnError('Picture not uploaded');
     }

    

    }

    public function DriverUpdateOrderStatus(Request $request)
    {

       $check = Othersingleorder::where('id',$request->order_id)
        ->update([
         'status' => strtolower($request->status),
         'updatedate' => Carbon::now()
      ]);

      if ($check) {
        return $this -> returnSuccess('Delivery Status Updated Successfully');
    }else{
        return $this -> returnError('Delivery Status NOT Updated');
    }

    }

    public function DriverHomeDeliverisByDistrict(Request $request)
    { 
        $ordersByRest = array();

        if ($request->district_id == 0) {
           
        $driverHomeDelivery = Order::where('driver_id',\Auth::user()->id)
        ->join('customers','customers.id','=','orders.customer_id')
        ->join('optioncodes AS cityCode','cityCode.id','=','customers.city_id')
        ->join('optioncodes AS districtCode','districtCode.id','=','customers.district_id')
        ->select('orders.id AS order_id','orders.bag AS bag','orders.cashcollected','orders.status','customers.name AS customer_name','customers.id AS customer_id','customers.locationlink AS link','customers.address AS Address','cityCode.name AS city',
        'districtCode.name AS district','customers.blocknumber AS block_number','customers.flatnumber AS flat_number') 
        ->where('deliverydate',Carbon::now()->format('Y-m-d'))
        ->get();
        }else{
            
        $driverHomeDelivery = Order::where('driver_id',\Auth::user()->id)
        ->join('customers','customers.id','=','orders.customer_id')
        ->join('optioncodes AS cityCode','cityCode.id','=','customers.city_id')
        ->join('optioncodes AS districtCode','districtCode.id','=','customers.district_id')
        ->select('orders.id AS order_id','orders.bag AS bag','orders.cashcollected','orders.status','customers.name AS customer_name','customers.id AS customer_id','customers.locationlink AS link','customers.address AS Address','cityCode.name AS city',
        'districtCode.name AS district','customers.blocknumber AS block_number','customers.flatnumber AS flat_number')
        ->where('customers.district_id','=',$request->district_id)   
        ->where('deliverydate',Carbon::now()->format('Y-m-d'))
        ->get();
        }

  
        $homeDeliveries  =array();
        $i = 0;
        foreach ($driverHomeDelivery as $delivery) {
            $homeDeliveries[$i]['delivery_id'] = $delivery->order_id;
            $homeDeliveries[$i]['cash_collection'] = $delivery->cashcollected;
            $homeDeliveries[$i]['bag'] = $delivery->bag;
            $homeDeliveries[$i]['status'] = ucwords($delivery->status) ;
            $homeDeliveries[$i]['customer_id'] = $delivery->customer_id;
            $homeDeliveries[$i]['customer_name'] = $delivery->customer_name;
            $homeDeliveries[$i]['address'] = $delivery->Address;
            $homeDeliveries[$i]['city'] = $delivery->city;
            $homeDeliveries[$i]['district'] = $delivery->district;
            $homeDeliveries[$i]['flat_number'] = $delivery->flat_number;
            $homeDeliveries[$i]['block_number'] = $delivery->block_number;
         
            if (strpos($delivery->link, ',') !== false) {
                $str     = $delivery->link;
                $temp1   = explode('@', $str, 2);
                $temp1   = explode(', ', $temp1[1]);
                
                $homeDeliveries[$i]['lat'] =$temp1[0];
                $homeDeliveries[$i]['long'] =$temp1[1];
            }else{
                 
                $homeDeliveries[$i]['lat'] ='0.0';
                $homeDeliveries[$i]['long'] ='0.0';
            }

            $i++;
           
        }
    

    $districts = DriverDistricts::where('driver_id',\Auth::user()->id )
    ->join('optioncodes', 'optioncodes.id', '=', 'driver_districts.district_id')
    ->select('optioncodes.name','optioncodes.id')
    ->get();

    $driverHomeOrders = Othersingleorder::where('driver_id',\Auth::user()->id)->get();
    return response()->json([
        'status'=> 'true',
        'msg'=> '',
        'data' => $homeDeliveries,
        'districts' => $districts,
        'total_deliveries' => $driverHomeDelivery->count(),
        'total_orders' => $driverHomeOrders->count()
       
    ]);

    }

    public function driverCustomerChat(Request $request)
    {
        $msgs = DriverCustomerMessage::where('customer_id', $request->customer_id)
        ->where('driver_id',\Auth::user()->id)
        ->where('delivery_id',$request->delivery_id)
        ->get();

        return $this-> returnData('data',$msgs);

    }

    public function driverCustomerSend(Request $request)
    {
        $check = DriverCustomerMessage::create([
            'message'=>$request->message,
            'type'=>'driver',
            'date'=>Carbon::now(+4)->format('Y-m-d - g:i A'),
            'driver_id'=>\Auth::user()->id,
            'customer_id'=>$request->customer_id,
            'delivery_id'=>$request->delivery_id
        ]);

        if ($check) {
           return $this->returnSuccess('Sent');
        }
    }

   ////////////////////////////////////// Customers API's////////////////////////////////////////////////////////

   public function CustomerLogin(Request $request)
   {
       // if found then check password (he pass)
      
       $credentials = request(['email', 'password']);
     
       $token = Auth::guard('customers-api')->attempt($credentials);
    
     
       if (!$token) {
           return $this -> returnError('Unauthorized!');
       }

       $customer = Auth::guard('customers-api')->user();
       $data = array();
       $data['id'] =  $customer['id'];
       $data['name'] =  $customer['name'];
       $data['phone'] =  $customer['phone'];
       $data['address'] =  $customer['address'];
       $data['token'] =  $token;

       $customer-> customer_token = $token;

       
       return response([
           'token'=>$token,
           'customer'=>$data
           ]);
      
   }

   public function CustomerHome(){
       
    $todayOrder = Order::join('customers','customers.id','=','orders.customer_id')
    ->join('drivers','drivers.id','=','orders.driver_id')
    ->select('orders.id AS order_id','orders.bag AS bag','orders.cashcollected AS cash','customers.servicetiming AS delivery_time','drivers.name AS driver_name','drivers.phone AS driver_phone','drivers.id AS driver_id')
    ->where('orders.customer_id', \Auth::user()->id )
    ->where('deliverydate',Carbon::now()->format('Y-m-d'))
    ->first();

    $cashCollection  = Order::where('orders.customer_id', \Auth::user()->id )
    ->sum('cashcollected');

    $canceledOrders =  Order::where('orders.customer_id', \Auth::user()->id )->where('status','canceled')->count();

    $bags  = Customer::where('id', \Auth::user()->id )
    ->select('totalbags')
    ->first();

    $totalDeliveries =  Order::where('orders.customer_id', \Auth::user()->id )->count();

    $coming  = Order::where('orders.customer_id', \Auth::user()->id )
    ->where('deliverydate', '>', Carbon::now()->format('Y-m-d'))->count();

    $data = array();
   
      $data['orders'] = $todayOrder;
      $data['cash_collection'] = (int)$cashCollection ;
      $data['canceled_orders'] = (int)$canceledOrders ;
      $data['bag_on_hand'] = (int)$bags->totalbags ;
      $data['total_deliveries'] = (int)$totalDeliveries ;
      $data['comming_deliveris'] = (int)$coming ;

    return response()->json([
        'status'=> 'true',
        'msg'=> '',
        'data' => $data 
    ]);
   }

   public function AllDeliveries(){
       
    $AllDeliveries = Order::join('customers','customers.id','=','orders.customer_id')
    ->leftjoin('drivers','drivers.id','=','orders.driver_id')
    ->select('orders.id AS order_id','orders.bag AS bag','orders.cashcollected AS cash','customers.servicetiming AS delivery_time','drivers.name AS driver_name','drivers.phone AS driver_phone','drivers.id AS driver_id')
    ->where('orders.customer_id', \Auth::user()->id )
    ->get();

    $cashCollection  = Order::where('orders.customer_id', \Auth::user()->id )
    ->sum('cashcollected');

    $canceledOrders =  Order::where('orders.customer_id', \Auth::user()->id )->where('status','canceled')->count();

    $bags  = Customer::where('id', \Auth::user()->id )
    ->select('totalbags')
    ->first();

    $totalDeliveries =  Order::where('orders.customer_id', \Auth::user()->id )->count();

    $coming  = Order::where('orders.customer_id', \Auth::user()->id )
    ->where('deliverydate', '>', Carbon::now()->format('Y-m-d'))->count();

    $data = array();
   
    $data['orders'] = $AllDeliveries;
    $data['cash_collection'] = (int)$cashCollection ;
    $data['canceled_orders'] = (int)$canceledOrders ;
    $data['bag_on_hand'] = (int)$bags->totalbags ;
    $data['total_deliveries'] = (int)$totalDeliveries ;
    $data['comming_deliveris'] = (int)$coming ;

    return response()->json([
        'status'=> 'true',
        'msg'=> '',
        'data' => $data
    ]);
   }

   public function ComingDeliveries(){
       
    $comingDeliveris = Order::join('customers','customers.id','=','orders.customer_id')
    ->leftjoin('drivers','drivers.id','=','orders.driver_id')
    ->select('orders.id AS order_id','orders.bag AS bag','orders.cashcollected AS cash','customers.servicetiming AS delivery_time','drivers.name AS driver_name','drivers.phone AS driver_phone','drivers.id AS driver_id')
    ->where('orders.customer_id', \Auth::user()->id )
    ->where('deliverydate', '>', Carbon::now()->format('Y-m-d'))
    ->get();

    $cashCollection  = Order::where('orders.customer_id', \Auth::user()->id )
    ->sum('cashcollected');

    $canceledOrders =  Order::where('orders.customer_id', \Auth::user()->id )->where('status','canceled')->count();

    $bags  = Customer::where('id', \Auth::user()->id )
    ->select('totalbags')
    ->first();

    $totalDeliveries =  Order::where('orders.customer_id', \Auth::user()->id )->count();

    $coming  = Order::where('orders.customer_id', \Auth::user()->id )
    ->where('deliverydate', '>', Carbon::now()->format('Y-m-d'))->count();


    $data['orders'] = $comingDeliveris;
    $data['cash_collection'] = (int)$cashCollection ;
    $data['canceled_orders'] = (int)$canceledOrders ;
    $data['bag_on_hand'] = (int)$bags->totalbags ;
    $data['total_deliveries'] = (int)$totalDeliveries ;
    $data['comming_deliveris'] = (int)$coming ;

    return response()->json([
        'status'=> 'true',
        'msg'=> '',
        'data' => $data
    ]);
   }

   public function CustomerProfile()
   {
    $customerInfo = Customer::where('customers.id',\Auth::user()->id)
    ->join('optioncodes AS cityCode','cityCode.id','=','customers.city_id')
    ->join('optioncodes AS districtCode','districtCode.id','=','customers.district_id')
    ->select('customers.name','customers.phone','customers.address', 'customers.flatnumber AS flat_number','customers.blocknumber AS block_number','customers.substartdate AS start_date','customers.subenddate AS end_date','customers.email','cityCode.name AS city_name','districtCode.name AS district_name','customers.locationlink AS location')
    ->first(); 

    if (strpos($customerInfo['location'], ',') !== false) {
        $str     = $customerInfo['location'];
        $temp1   = explode('@', $str, 2);
        $temp1   = explode(', ', $temp1[1]);
        
        $customerInfo['lat'] =$temp1[0];
        $customerInfo['long'] =$temp1[1];
    }else{
         
        $customerInfo['lat'] ='0.0';
        $customerInfo['long'] ='0.0';
    }

    return $this -> returnData('data',$customerInfo);

   }

   public function updateProfile(Request $request)
   {
    
    Customer::where('id',\Auth::user()->id)
    ->update([
     'name' => $request->name,
     'phone' => $request->phone,
     'email' => $request->email,
     'address' => $request->address,
     'blocknumber' => $request->block_number,
     'flatnumber' => $request->flat_number
    
  ]);

  if ($request->password != null) {
       
    Customer::where('id',\Auth::user()->id)
    ->update([
    'password' => Hash::make($request->password)
  ]);
  }

    return $this -> returnSuccess('Profile updated successfully');

   }

   public function myRestaurant()
   {

     $totalDeliveries =  Order::where('orders.customer_id', \Auth::user()->id )->count();

     $rest = Customer::join('partners','partners.id', '=','customers.partner_id')
     ->where('customers.id',\Auth::user()->id)
    ->select('substartdate AS start_date','subenddate AS end_date','partners.name AS restaruant_name','partners.logo AS logo','partners.locationlink AS link','partners.phone AS phone','partners.id AS partner_id')
    ->first(); 

  

    $data = array();
    $data['deliveris'] = $totalDeliveries;
    $data['start_date'] =  $rest['start_date'];
    $data['end_date'] = $rest['end_date'];
    $data['restaurant_name'] = $rest['restaruant_name'];
    $data['restaurant_phone'] = $rest['phone'];
    $data['restaurant_id'] = $rest['partner_id'];
    $data['logo'] = asset('assets/img/partners/logos').'/'. $rest['logo'];

    if (strpos($rest->link, ',') !== false) {
        $str     = $rest->link;
        $temp1   = explode('@', $str, 2);
        $temp1   = explode(', ', $temp1[1]);
        
        $data['lat'] =$temp1[0];
        $data['long']=$temp1[1];
    }else{
         
        $data['lat'] ='0.0';
        $data['long'] ='0.0';
    }

    return response()->json([
        'status'=> 'true',
        'msg'=> '',
        'data' => $data
    ]);

   }

   public function ads()
   {
    $parnter_id = Customer::where('id',\Auth::user()->id )->first();
    $ads = Ads::where('partner_id', $parnter_id->partner_id)->select('title','price','label','pic')->get();

   foreach ($ads as $ad) {
      $ad['pic'] = asset('assets/img/partners/ads').'/'. $ad['pic'];
   }

    return $this->returnData('data',$ads);
   }

   public function freez(Request $request)
   {

    CustomerFreeze::create([
        'customer_id' => \Auth::user()->id,
        'startingdate' =>$request->start_date,
        'endingdate' =>$request->end_date
    ]);

    return $this->returnSuccess('Freezing date added successfully');
    
   }

   public function renew(Request $request)
   {

    CustomerRenew::create([
        'customer_id' => \Auth::user()->id,
        'startdate' =>$request->start_date,
        'enddate' =>$request->end_date,
        'deliveriescount' =>$request->deliveries
    ]);

    return $this->returnSuccess('Renew request added successfully');
    
   }

   public function updateLocation(Request $request)
   {
       $link = '@'.$request->lat.', '.$request->long;

   Customer::where('id',\Auth::user()->id)
    ->update([
     'locationlink' => $link  
  ]);

    return $this->returnSuccess('Location updated successfully');
    
   }

   public function customerLogout(Request $request)
   {

       $token = $request -> header('auth-token');

       if ($token) {
           JWTAuth::setToken($token)->invalidate();

       return response()->json(['message' => 'Successfully logged out']);
       
       }else{
           return response()->json(['message' => 'Something worng!']);
       }
      
   }

   public function customerDriverChat(Request $request)
   {
       $customer_driver = Order::where('customer_id',\Auth::user()->id)
       ->where('driver_id','!=',null)
       ->first();
        ($customer_driver) ? $driver  = $customer_driver->driver_id : $driver = 0 ;

       $msgs = DriverCustomerMessage::where('driver_id', $driver)
       ->where('customer_id',\Auth::user()->id)
       ->where('delivery_id',$request->delivery_id)
       ->get();

       return $this-> returnData('data',$msgs);

   }

   public function customerDriverSend(Request $request)
   {
    $customer_driver = Order::where('customer_id',\Auth::user()->id)
    ->where('driver_id','!=',null)
    ->first();
    ($customer_driver) ? $driver  = $customer_driver->driver_id : $driver = null ;

       $check = DriverCustomerMessage::create([
           'message'=>$request->message,
           'type'=>'customer',
           'date'=>Carbon::now(+4)->format('Y-m-d - g:i A'),
           'customer_id'=>\Auth::user()->id,
           'driver_id'=>$driver,
           'delivery_id'=>$request->delivery_id,
       ]);

       if ($check) {
          return $this->returnSuccess('Sent');
       }
   }

   public function customerPartnerChat()
   {
       $customer_partner = Order::where('customer_id',\Auth::user()->id)->first();

        ($customer_partner) ? $partner  = $customer_partner->partner_id : $partner = 0 ;

       $msgs = PartnerCustomerMessage::where('partner_id', $partner)
       ->where('customer_id',\Auth::user()->id)
       ->orderby('created_at', 'asc')
       ->get();

       foreach ($msgs as $msg) {
          ($msg->type == 'sender') ?   $msg->type = 'partner' : $msg->type =  $msg->type ;
       }

       return $this-> returnData('data',$msgs);

   }

   public function customerPartnerSend(Request $request)
   {

    $customer_partner = Order::where('customer_id',\Auth::user()->id)->first();

    ($customer_partner) ? $partner  = $customer_partner->partner_id : $partner = null ;

       $check = PartnerCustomerMessage::create([
           'message'=>$request->message,
           'type'=>'customer',
           'date'=>Carbon::now(+4)->format('Y-m-d - g:i A'),
           'customer_id'=>\Auth::user()->id,
           'partner_id'=>$partner,
       ]);

       if ($check) {
          return $this->returnSuccess('Sent');
       }
   }
  
}
