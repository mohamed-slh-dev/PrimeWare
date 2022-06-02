<?php

namespace App\Http\Controllers;
use App\Models\Driver;
use App\Models\Order;
use App\Models\Othersingleorder;
use App\Models\Partner;
use App\Models\Customer;
use App\Models\DriverCustomerMessage;


use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class DriverAppController extends Controller
{
    public function index(){
        return view('driver.login');
    }

    public function checkLogin(Request $request)
    {
         // username + password
         $email = $request->email;
         $password = $request->password;
 
         
         // get user using username
         $driver = Driver::where('email', $email)->where('type','driver')->first();

         if ($driver && Hash::check($password, $driver->password)) {
            session()->put('driver_id', $driver->id);
             return redirect()->route('driver.home');
         }else{
            return redirect()->route('driver.login');
         }
       
    }

    public function home()
    {
        if ( !(session()->get('driver_id')) ) {
            return view('driver.login');
          }

        $driverHomeDelivery = Order::where('driver_id',session()->get('driver_id'))
        ->join('customers','customers.id','=','orders.customer_id')
        ->join('optioncodes AS cityCode','cityCode.id','=','customers.city_id')
        ->join('optioncodes AS districtCode','districtCode.id','=','customers.district_id')
        ->select('orders.id AS order_id','orders.bag AS orderBag','orders.cashcollected AS cash','orders.status AS OrderStatus','customers.id AS customer_id','customers.name AS customer_name','customers.locationlink AS link','customers.address AS customer_address','cityCode.name AS city',
        'districtCode.name AS district','customers.blocknumber AS block_number','customers.phone AS phone','customers.flatnumber AS flat_number')
        ->where('deliverydate',Carbon::now(+'4')->format('Y-m-d'))
        ->orderBy('customer_name','asc')
        ->get();

        $restaurants = Partner::select('id','name','logo')->get();

        $driverHomeOrders = Othersingleorder::where('driver_id',session()->get('driver_id'))
        ->select('id')->get();

        $todayDate = Carbon::now(+'4')->format('D d-M-Y');

        $restActive = 0;

        return view('driver.home',compact('driverHomeDelivery','restaurants','driverHomeOrders','todayDate','restActive'));
    }

    public function homeByRest($rest_id)
    {
        if ( !(session()->get('driver_id')) ) {
            return view('driver.login');
          }

        $driverHomeDelivery = Order::where('driver_id',session()->get('driver_id'))
        ->join('customers','customers.id','=','orders.customer_id')
        ->join('optioncodes AS cityCode','cityCode.id','=','customers.city_id')
        ->join('optioncodes AS districtCode','districtCode.id','=','customers.district_id')
        ->select('orders.id AS order_id','orders.bag AS orderBag','orders.cashcollected AS cash','orders.status AS OrderStatus','customers.id AS customer_id','customers.name AS customer_name','customers.locationlink AS link','customers.address AS customer_address','cityCode.name AS city',
        'districtCode.name AS district','customers.blocknumber AS block_number','customers.phone AS phone','customers.flatnumber AS flat_number')
        ->where('deliverydate',Carbon::now(+'4')->format('Y-m-d'))
        ->where('orders.partner_id',$rest_id)
        ->orderBy('customer_name','asc')
        ->get();

        
        $restaurants = Partner::select('id','name','logo')->get();

        $driverHomeOrders = Othersingleorder::where('driver_id',session()->get('driver_id'))
        ->select('id')->get();

        $todayDate = Carbon::now(+'4')->format('D d-M-Y');

        $restActive = $rest_id;

        return view('driver.home',compact('driverHomeDelivery','restaurants','driverHomeOrders','todayDate','restActive'));
    }

    public function DriverUpdateDeliveryStatus(Request $request)
    {
        if ( !(session()->get('driver_id')) ) {
            return view('driver.login');
          }

        if ($request->status == 'Delivered' || $request->status == 'Canceled' ) {
            $customer_order = Order::where('id',$request->delivery_id)
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
       

       $check = Order::where('id',$request->delivery_id)
        ->update([
         'status' => strtolower($request->status), 
         'updatedate' => Carbon::now(+'4')
      ]);
        if ($check) {
            return redirect()->back()->with('success','Order Status Updated Successfully');
        }else{
            return redirect()->back()->with('error','Error! Order Status Not Updated');
        }
    }

    public function  DriverUpdateDeliveryDeliverStatus (Request $request)
    {
        if ( !(session()->get('driver_id')) ) {
            return view('driver.login');
          }
       
            $customer_order = Order::where('id',$request->delivery_id)
            ->first();
     
            $customer_info = Customer::where('id',$customer_order->customer_id)
            ->first();

            $customer_total_bags =  $customer_order->bag +  $customer_info->totalbags;

           
            $customer_total_bags = $customer_total_bags - $request->returned_bags;
             
              
               $update_bags = Customer::where('id',$customer_order->customer_id)
               ->update([
                'totalbags' => $customer_total_bags,
                'cashcollected' => $customer_info->cashcollected - $request->cash
             ]);
                
             if (!empty($request->file('pic'))) {
                $ext = $request->file('pic')->getClientOriginalExtension();
                $picname = 'delivery-pic-'.$request->delivery_id.'-'.time().'.'.$ext;
    
                $request->file('pic')->move(public_path('assets/img/partners/delivery-pics'), $picname);
    
                Order::where('id',$request->delivery_id)
                ->update([
                    'receivedpic' => $picname
                ]);
      }
       

       $check = Order::where('id',$request->delivery_id)
        ->update([
         'status' => strtolower($request->status), 
         'cashcollected' => strtolower($request->cash),
         'updatedate' => Carbon::now(+'4')
      ]);
        if ($check) {
          return redirect()->route('driver.home')->with('success','Delivery Status Updated successfully');
        }else{
            return redirect()->back()->with('error','Error! Order Status Not Updated');
        }
    }

    public function deliveryDeliver($delivery_id)
    {
        if ( !(session()->get('driver_id')) ) {
            return view('driver.login');
          }

        $delivery_info = Order::where('orders.id',$delivery_id)
        ->join('customers','customers.id','=','orders.customer_id')
        ->join('optioncodes AS cityCode','cityCode.id','=','customers.city_id')
        ->join('optioncodes AS districtCode','districtCode.id','=','customers.district_id')
        ->select('customers.locationlink AS link','customers.address AS Address','cityCode.name AS city',
        'districtCode.name AS district','customers.blocknumber AS block_number','customers.phone AS phone','customers.flatnumber AS flat_number','orders.id AS order_id')
        ->first();

        if (strpos($delivery_info->link, ',') !== false) {
            $str     = $delivery_info->link;
            $temp1   = explode('@', $str, 2);
            $temp1   = explode(', ', $temp1[1]);
            
            $lat =(int) $temp1[0];
            $long =(int)$temp1[1];
        }else{
             
            $lat =0.0;
            $long =0.0;
        }
        
        return view('driver.delivery-deliver',compact('delivery_info','lat','long'));

    }
    public function orders()
    {
        if ( !(session()->get('driver_id')) ) {
            return view('driver.login');
          }

        $driverHomeOrders = Othersingleorder::where('driver_id',session()->get('driver_id'))
        ->select('id','customer_name','customer_phone' ,'customer_address','customer_locationlink','pickuplocationlink AS pickup_locationlink','status')->get();

        $driverHomeDelivery = Order::where('driver_id',session()->get('driver_id'))
        ->where('deliverydate',Carbon::now(+'4')->format('Y-m-d'))
        ->get();

        $todayDate = Carbon::now(+'4')->format('D d-M-Y');

        return view('driver.orders',compact('driverHomeDelivery','driverHomeOrders','todayDate'));

    }

    public function DriverUpdateOrderStatus(Request $request)
    {

        if ( !(session()->get('driver_id')) ) {
            return view('driver.login');
          }

       $check = Othersingleorder::where('id',$request->order_id)
        ->update([
         'status' => strtolower($request->status),
         'updatedate' => Carbon::now(+'4')
      ]);

      if ($check) {
        return redirect()->back()->with('status','Delivery Status Updated Successfully');
    }else{
        return redirect()->back()->with('error','Delivery Status Not Updated!');
    }

    }

     public function driverCustomerChat($delivery_id)
    {
        if ( !(session()->get('driver_id')) ) {
            return view('driver.login');
          }

        $msgs = DriverCustomerMessage::where('driver_id',session()->get('driver_id'))
        ->where('delivery_id',$delivery_id)
        ->get();

        return view('driver.customer-chat',compact('msgs','delivery_id'));

    }

    public function driverCustomerSend(Request $request)
    {
        if ( !(session()->get('driver_id')) ) {
            return view('driver.login');
          }

        $customer = Order::where('id',$request->delivery_id)->first();

        $check = DriverCustomerMessage::create([
            'message'=>$request->message,
            'type'=>'driver',
            'date'=>Carbon::now(+'4')->format('Y-m-d - g:i A'),
            'driver_id'=>session()->get('driver_id'),
            'customer_id'=>$customer->customer_id,
            'delivery_id'=>$request->delivery_id
        ]);

        if ($check) {
            return redirect()->back();
        }
    }

    public function searchByDistrict()
    {
        if ( !(session()->get('driver_id')) ) {
            return view('driver.login');
          }

        $districts = Order::join('customers', 'customers.id', '=', 'orders.customer_id')
        ->join('optioncodes', 'optioncodes.id', '=', 'customers.district_id')
        ->select('optioncodes.name','optioncodes.id')
        ->where('driver_id',session()->get('driver_id') )
        ->where('deliverydate',Carbon::now(+'4')->format('Y-m-d'))
        ->get();
        $deliveries = null;

        return view('driver.search-by-district',compact('districts','deliveries'));
    }

    public function getSearchByDistrict(Request $request)
    {
        if ( !(session()->get('driver_id')) ) {
            return view('driver.login');
          }

        $districts = Order::join('customers', 'customers.id', '=', 'orders.customer_id')
        ->join('optioncodes', 'optioncodes.id', '=', 'customers.district_id')
        ->select('optioncodes.name','optioncodes.id')
        ->where('driver_id',session()->get('driver_id') )
        ->where('deliverydate',Carbon::now(+'4')->format('Y-m-d'))
        ->get();

        $deliveries = Order::where('driver_id',session()->get('driver_id'))
        ->join('customers','customers.id','=','orders.customer_id')
        ->join('optioncodes AS cityCode','cityCode.id','=','customers.city_id')
        ->join('optioncodes AS districtCode','districtCode.id','=','customers.district_id')
        ->select('orders.id AS order_id','orders.bag AS orderBag','orders.cashcollected AS cash','orders.status AS OrderStatus','customers.id AS customer_id','customers.name AS customer_name','customers.locationlink AS link','customers.address AS customer_address','cityCode.name AS city',
        'districtCode.name AS district','customers.blocknumber AS block_number','customers.phone AS phone','customers.flatnumber AS flat_number')
        ->where('deliverydate',Carbon::now(+'4')->format('Y-m-d'))
        ->where('customers.district_id', $request->district_id)
        ->orderBy('customer_name','asc')
        ->get();

        return view('driver.search-by-district',compact('districts','deliveries'));

    }

    public function profile()
    {
        if ( !(session()->get('driver_id')) ) {
            return view('driver.login');
          }

        $driverInfo = Driver::where('id',session()->get('driver_id'))->first(); 

        return view('driver.profile',compact('driverInfo'));
    }

    public function editProfile()
    {
        if ( !(session()->get('driver_id')) ) {
            return view('driver.login');
          }

        $driverInfo = Driver::where('id',session()->get('driver_id'))->first(); 

        return view('driver.edit-profile',compact('driverInfo'));
    }

    public function updateProfile(Request $request)
    {
        if ( !(session()->get('driver_id')) ) {
            return view('driver.login');
          }

        Driver::where('id',session()->get('driver_id'))
        ->update([
         'email' => $request->email,
         'phone' => $request->phone,
         'info' => $request->info 
      ]);

      if ($request->password != null) {
        
        if ($request->password === $request->confirmpassword) {
            Driver::where('id',session()->get('driver_id'))
        ->update([
        'password' => Hash::make($request->password)
      ]);
        }else{
            return redirect()->route('driver.edit.profile')->with('warning','password not match');
        }
        
       }

       return redirect()->route('driver.profile')->with('success','Driver Info Updated Successfully');
    }

    public function logout(){
        session()->forget('driver_id');
        return redirect()->route('driver.login');
    }

}
