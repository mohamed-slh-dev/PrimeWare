@extends('layouts.collector-app')

@section('content')
<div class="pb-3">
<div style="height : 23vh; background-image: url('{{asset('assets/img/partners/logos/'.$partner_info->logo)}}'); background-position: center; background-size: cover; background-repeat: no-repeat; opacity: 1; position:relative; ">

    

    
     <div class="pt-2 pb-2 mb-2 d-block text-center" style="background:rgba(42, 42, 42, 0.795);">
        <h3 class="pt-4 text-white" style="color: white !important;"> {{$partner_info->name}} </h3>
        <p class="font-size-15" style="color: #fbbe00; font-weight:bold">{{$queyCollectorOrdersByRest->count()}} Deliveries</p>
    </div>
   
        
    </div>
         

       
     </div>


     <div class="row mt-4 mx-0">
         <div class="col-12 mb-3">
         <form action="{{route('collector.restaurant.orders.filtter',[$restaurant_id])}}" method="POST">
            @csrf
            <input type="hidden" name="restaurant_id" value="{{$restaurant_id}}" id="">
            <div>
                <label class="mt-3" style=" color: #fbbe00; ">Search by status</label>
                <select class="custom-control custom-select home-searchselect" name="status">
                    <option value="not received">Not Received</option>
                    <option value="received from restaurant">Received From Restaurant</option>
                    <option value="delivered to warehouse">Delivered To Warehouse</option>
                    <option value="canceled">Canceled</option>
                </select>

                <div class="mt-3 text-center">
                    <button class="btn btn-warning" type="submit" style=" width: 180px; background-color:rgb(254, 184, 0) !important; color:black "> Search </button>
                     </div>
            </div>

        </form>
         </div>


         @foreach ($queyCollectorOrdersByRest as $order)
                        <div class="col-12">
                            <div class="card" style="background:rgb(42,42,42);">
                                    <div class="card-body p-4">
                                    <h6>Order No. #{{$order->order_id}}</h6>
                                         <h6 class="font-size-17"> {{$order->customer_name}} </h6>
                                         <p class="text-warning">{{$order->customer_address}}- Block Number : {{$order->block_number}} | Flat Number : {{$order->flat_number}}</p>

                                         @if ($order->status == 'not received')
                                        <form action="{{route('collector.delivery.status')}}" method="post">

                                            @method('POST')
                                            @csrf

                                    <input type="checkbox"  name="bag"  id="cooler-{{$order->order_id}}">
                                         <label for="cooler-{{$order->order_id}}">Cooler Bag</label><br>
                                       
                                        

                                           <div class="row text-left align-items-center mt-1">
                                            <div class="col-12 col-sm-6 col-md-4">

                                                 

                                                    <input type="hidden" name="order_id" value="{{$order->order_id}}" id="">

                                                   
                                                    <select name="status" id="" class="custom-control custom-select home-searchselect" style="height: 41px;">
                                                        <option value="received from restaurant">Confirm Receving</option>
                                                        <option value="canceled" >Canceled</option>
                                                    </select>
                                             
                                                      
                                                    
                                            </div>


                                            <div class="mt-3 mt-sm-0 col-12 col-sm-4 text-center text-sm-left">

                                                <button class="btn btn-warning w-md" type="submit"
                                                style="background-color:transparent !important; color: #fbbe00 " type="submit">Update Status</button>

                                            </div>
                                                 {{-- <div class="col-6">
                                                  
                                                        <input type="hidden" id="cooler-{{$order->order_id}}" value="1">

                                                        <input type="hidden" name="delivery_id" value="{{$order->order_id}}" id="">

                                                        <input type="hidden" name="status" value="canceled" id="">
                                                 <button class="btn btn-sm btn-danger " 
                                                       style="color:black; width: 130px;">Cancel</button> 

                                                   
                                            </div> --}}
                                           </div>
                                         </form>
                                        
                                    
                                         @elseif($order->status == 'received from restaurant')
                                             <form action="{{route('collector.delivery.status')}}" method="post">

                                                @method('POST')
                                                @csrf
    
    
                                               <div class="row text-center">
                                                <div class="col-12">
    
                                                     
    
                                                        <input type="hidden" name="order_id" value="{{$order->order_id}}" id="">
    
                                                        <input type="hidden" name="status" value="delivered to warehouse" id="">
                                                      
                                                        <button class="btn btn-none index-delivery-button py-1 px-2 font-size-13 mt-1 " 
                                                        style="color:black; width: 200px;" type="submit">Deliver To Warehouse</button>   
                                                        
                                                </div>
                                                     {{-- <div class="col-6">
                                                      
                                                            <input type="hidden" id="cooler-{{$order->order_id}}" value="1">
    
                                                            <input type="hidden" name="delivery_id" value="{{$order->order_id}}" id="">
    
                                                            <input type="hidden" name="status" value="canceled" id="">
                                                     <button class="btn btn-sm btn-danger " 
                                                           style="color:black; width: 130px;">Cancel</button> 
    
                                                       
                                                </div> --}}
                                               </div>
                                             </form> 
                                      
                                             @elseif($order->status == 'canceled')
                                             <div class="col-12 text-center">
                                             <button disabled class="btn btn-none index-delivery-button py-1 px-2 font-size-13 mt-1" 
                                             style="color:white; background-color:#f02610; width: 170px; " type="submit">Canceled</button>  
                                             </div>

                                             
                                             @elseif($order->status == 'delivered to warehouse')
                                             <div class="col-12 text-center">
                                             <button disabled class="btn btn-none index-delivery-button py-1 px-2 font-size-13 mt-1" 
                                             style="color:white; background-color:#52c770; width: 200px;" type="submit">Delivered To Warehouse</button>  
                                             </div>
                                         @endif
                                   
                                         
                                          </div><!--end card-body-->
                                </div><!--end card-->
                         </div><!--end col-->
                         @endforeach
                   
                        </div>
@endsection

@section('scripts')
   
<script>

function bag_check()
{
  if (document.getElementById('xxx').checked) 
  {
      document.getElementById('totalCost').value = 10;
  } else {
      calculate();
  }
}
</script>


@endsection