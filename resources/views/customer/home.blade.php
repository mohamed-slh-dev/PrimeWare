@extends('layouts.customer-app')

@section('content')

<div class="container-fluid">

                        
    <!-- upper section -->
    <div class="row align-items-center" style="background:rgb(51,51,51);">



        <div class="col-md-8 col-sm-7 col-6">
                <div class="card-body home-upper-date px-0">
                    <p style="font-weight: bold" class="mb-0"> {{$todayDate}}</p>
                </div>
        </div>

        <div class="col-md-4 col-sm-5 col-6">
            <div class="card-body home-upper-date">
                <img src="{{ asset('assets/partners/assets/images/Prime-logo1.png') }}" alt="">
            </div>
        </div>



        <div class="col-4">
            <a  data-toggle="modal" data-target=".cash">
            <div class="card text-center edit-view-cards view-card-bg" >
                <div class="mb-2 card-body text-offwhite-f">
                    <p style="height: 30px"> Cash Collection </p> 
                <h3 class="text-danger mt-2">{{$cashCollection}}</h3> 
                </div>
            </div>
            </a>
        </div>

        <div class="col-4">
            <a href="{{route('customer.canceled.deliveries')}}">
            <div class="card text-center edit-view-cards view-card-bg" >
                <div class="mb-2 card-body text-offwhite-f">
                    <p style="height: 30px"> Cancelled Deliveries </p>  
                <h3 class="text-info mt-2">{{$canceledOrders}}</h3>
                </div>
            </div>
            </a>
        </div>

        <div class="col-4">
            <a  data-toggle="modal" data-target=".bags">
            <div class="card text-center edit-view-cards view-card-bg" >
                <div class="mb-2 card-body text-offwhite-f">
                    <p style="height: 30px"> Bags On Hand </p> 
                    <h3 class="text-info mt-2"> {{$bags}} </h3>
                </div>
            </div>
            </a>
        </div>
        

        <div class="col-4">
            <div class="card text-center edit-view-cards view-card-bg">
                <div class="mb-2 card-body text-offwhite-f">
                    <p style="height: 30px"> Today Delivery </p> 
                    <h3 class="text-danger mt-2">
                        @if ($todayOrder)
                        1
                         @else 
                         0
                        @endif 
                     </h3>
                </div>
            </div>
        </div>
        
        <div class="col-4">
            <a href="{{route('customer.coming.deliveris')}}">
            <div class="card text-center edit-view-cards view-card-bg">
                <div class="mb-2 card-body text-offwhite-f">
                    <p style="height: 30px">  Coming Deliveries </p>  
                <h3 class="text-info mt-2">{{$totalDeliveries->where('deliverydate', '>' , Carbon\Carbon::now()->format('Y-m-d'))->count()}}</h3>
                </div>
            </div>
        </a>
           
        </div>
        
        <div class="col-4">
            <a href="{{route('customer.all.deliveris')}}">
            <div class="card text-center edit-view-cards view-card-bg">
                <div class="mb-2 card-body text-offwhite-f">
                    <p style="height: 30px">All Deliveries</p> 
                    <h3 class="text-info mt-2"> {{$totalDeliveries->count()}} </h3>
                </div>
            </div>
            </a>
        </div>
        

    </div>
    <!-- end row -->







    <!-- middle section -->
    <div class="row align-items-center" style="background:rgb(42,42,42);">

        @if ($todayOrder)
        <div class="col-sm-12" style="margin: 80px 0px 100px;">
            <div class="card" style=" background-color:#404040">
                    <div class="card-body p-4">
                    <p class="mt-3" style="font-weight: bold; color:#fbbe00">Order No #{{$todayOrder->order_id}}</p>
                         <p class="mt-3">Delivery Time : <span style="font-weight: bold; color:#fbbe00">{{$todayOrder->delivery_time}}</span> </p>
                         <p class="mt-3">Driver Name : {{$todayOrder->driver_name}}</p>
                         @if ($todayOrder->bag == 1 )
                         <input type="checkbox" disabled id="cooler1" name="cooler1" checked value="1">
                         <label for="cooler1" class="ml-3">Cooler Bag</label><br>
                         @else
                         <input type="checkbox" disabled id="cooler1" name="cooler1" value="1">
                         <label for="cooler1" class="ml-3">Cooler Bag</label><br> 
                         @endif
                        

                            <p class="mt-3"> <span style="font-weight: bold;color:#fbbe00">{{$todayOrder->cash}} AED</span>  Cash Collection </p>
                          

                            @if ($todayOrder->status == 'delivered' || $todayOrder->status == 'canceled')
                            <div class="row text-center mt-3">
                               
                                <div class="col-sm-6 text-center">
                                    <p class="text-center">
                                        @if ($todayOrder->status == 'delivered')
                                        <button class="btn btn-none index-delivery-button py-1 px-2 font-size-13 mt-1" 
                                        style="color:white; background-color:#52c770; width: 200px;" type="submit"> Deliverd</button> 
                                        @elseif($todayOrder->status == 'canceled')
                                        <button class="btn btn-none index-delivery-button py-1 px-2 font-size-13 mt-1" 
                                        style="color:white; background-color:#f02610; width: 200px;" type="submit"> Canceled</button> 
                                        @endif
                                      
                                    </p>
                                </div>

                                <div class="col-sm-6 text-center ">
                                    <p class="text-center">
                                        @if (!empty($todayOrder->receivedpic))
                                        <img style="border: 2px solid #ffa500;" src=" {{asset('assets/img/partners/delivery-pics/'.$todayOrder->receivedpic)}}" alt="" width="150" height="130">
                                        @else
                                        No Delivered photo
                                        @endif
                                    </p>
                                </div>

                               </div>
                                
                            @else
                            <div class="row text-center mt-3">
                                @if ($orderOnGoing == 1)
                                <div class="col-12 text-center my-3">
                                    <button class="btn btn-warning" style="background-color:#ffa500;color:black; width:200px; font-weight:bold" disabled> On The Way... </button>
                                   
                                </div>
                                
                                @endif
                             
                                <div class="col-6 text-center ">
                                    <p class="text-center" >
                                        <a style="font-weight: bold;" href="tel:{{$todayOrder->driver_phone}}" class="profile-location-button showpage-action-buttons">
                                            <i class="mdi mdi-phone" ></i> Call
                                        </a>
                                    </p>
                                </div>
                                <div class="col-6 text-center">
                                    <p class="text-center">
                                        <a style="font-weight: bold;" href="{{route('customer.driver.chat', [$todayOrder->order_id]) }}" class="profile-location-button showpage-action-buttons">
                                            <i class="mdi mdi-chat-processing"></i> Chat
                                        </a>
                                    </p>
                                </div>
                               </div>
                            @endif

                         

                          </div><!--end card-body-->
                </div><!--end card-->
         </div><!--end col-->
        @else
        <div class="col-sm-12" style="margin: 80px 0px 100px;">
            <div class="card text-center edit-view-cards home-middle-section">
                <p class="mb-0">
                    <i class="fas fa-info"></i>
                </p>
                <div class="card-body text-offwhite-f middle-sec-fallback">
                    There is no delivery today
                </div>
            </div>
        </div>
        @endif

    </div>

</div>
<!-- container-fluid -->

<div class="modal fade cash" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content" style=" background-color:#404040">
             <div class="modal-header">
               <h6>Cash Collection Amount</h6>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
              </div>
                         <div class="modal-body" >
                          
                                   <div class="row">
                                  
                                     <div class="col-12 text-center mt-5">
                                          <h3>{{$cashCollection}}</h3>
                                     </div>
                            </div> 
                      
                    </div>
              </div><!-- /.modal-content -->
       </div><!-- /.modal-dialog -->
 </div><!-- /.modal -->

 <div class="modal fade bags" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content" style=" background-color:#404040">
             <div class="modal-header">
               <h6>Bags On Hand</h6>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
              </div>
                         <div class="modal-body" >
                          
                                   <div class="row">
                                  
                                     <div class="col-12 text-center mt-5">
                                          <h3>{{$bags}}</h3>
                                     </div>
                            </div> 
                      
                    </div>
              </div><!-- /.modal-content -->
       </div><!-- /.modal-dialog -->
 </div><!-- /.modal -->
    
@endsection