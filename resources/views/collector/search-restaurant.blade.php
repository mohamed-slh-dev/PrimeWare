@extends('layouts.collector-app')

@section('content')

<div class="row mt-5 mx-0">
    <div class="col-12">
        <div class="card" style="background:rgb(42,42,42);">
            <form action="{{route('collector.search.restaurant')}}" method="post">

                @method('POST')
                @csrf

                <div class="card-body p-4">
                    <div>
                  <label class="mt-3" style=" color: #fbbe00; ">Restaurant</label>


                    <select class="custom-control custom-select home-searchselect" name="restaurant_id">
                        @foreach ($restaurants as $rest)
                    <option value="{{$rest->id}}">{{$rest->name}}</option>
                        @endforeach
                       
                           
                    </select>
                    </div>

                    <div>
                        <label class="mt-3" style=" color: #fbbe00; ">Select Date</label>

                        <input type="date" name="date" style=" color: #fbbe00; background: #2a2a2a; border: 1px solid rgb(196, 140, 0); " class="form-control " id="">
                    </div>
                    
                  
                   
                     <div class="mt-3 text-center">
                   <button class="btn btn-warning" type="submit" style=" width: 180px; background-color:rgb(254, 184, 0) !important; color:black "> Search </button>
                    </div>
              </div><!--end card-body-->
            </form>
            </div><!--end card-->
     </div><!--end col-->

    </div>

    @if ($queyCollectorOrdersByRest)

    <div class="row mt-4 mx-0">
        @foreach ($queyCollectorOrdersByRest as $order)
                       <div class="col-12">

                           <div class="card" style="background:rgb(42,42,42);">
                                   <div class="card-body p-4">
                                   <h5>Order No. #{{$order->order_id}}</h5>

                                   <h6 class="my-2">Order Date : {{$order->date}}</h6>
                                        <h6 class="font-size-17"> {{$order->customer_name}} </h6>
                                        <p class="text-warning mb-3">{{$order->customer_address}}- Block Number {{$order->block_number}} | Flat Number {{$order->flat_number}}</p>

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
                                                     
                                                       <button class="btn btn-none index-delivery-button py-1 px-2 font-size-13 mt-1 " style="color:black; width: 200px;" type="submit">Delivered To Warehouse</button>   
                                                       
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
                                            <button class="btn btn-none index-delivery-button py-1 px-2 font-size-13 mt-1" 
                                             style="color:white; background-color:#f02610; width: 170px; " type="submit">Canceled</button>  
                                            </div>

                                            
                                            @elseif($order->status == 'delivered to warehouse')
                                            <div class="col-12 text-center">
                                            <button class="btn btn-none index-delivery-button py-1 px-2 font-size-13 mt-1" 
                                             style="color:white; background-color:#52c770; width: 200px;" type="submit">Delivered To Warehouse</button>  
                                            </div>
                                        @endif
                                  
                                        
                                         </div><!--end card-body-->
                               </div><!--end card-->
                        </div><!--end col-->
                        @endforeach
                  
                       </div>
                       @endif
@endsection