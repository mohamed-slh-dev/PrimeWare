@extends('layouts.driver-app')

@section('content')

<div class="container-fluid">

                        
    <!-- upper section -->
    <div class="row align-items-center" style="background:rgb(51,51,51);">



        <div class="col-md-8 col-sm-7 col-6">
            <div class="card-body home-upper-date px-0">
                <p style="font-weight: bold" class="mb-0"> {{$todayDate}}</p>
            </div>
    </div>

    <div class="col-md-4 col-sm-5 col-6 text-right">
        <div class="card-body home-upper-date home-upper-date-driver">
            <img src="{{ asset('assets/partners/assets/images/Prime-logo1.png') }}" alt="">
        </div>
    </div>


        
    <div class=" col-6">
        <div class="card text-center edit-view-cards view-card-bg ">
        <a href="{{route('driver.home')}}">
            <div class="card-body text-offwhite-f">
                Total Deliveries
            <h3 class="text-info mt-2">{{$driverHomeDelivery->count()}}</h3>
            </div>
        </a>
        </div>
    </div>
    
    <div class="col-6">
        <div class="card text-center edit-view-cards view-card-bg">
           <a href=" {{route('driver.orders')}} ">
            <div class="card-body text-offwhite-f">
                Total Orders
                <h3 class="text-info mt-2">{{$driverHomeOrders->count()}}</h3>
            </div>
           </a>
           
        </div>
    </div>
        

    </div>
    <!-- end row -->




    <div class="row px-4 pt-4" style="background-color:#2a2a2a">

        <!-- search input -->
        {{-- <div class="col-sm-12 mb-4"> 
            <input class="home-searchinput" type="text" name="" id="" placeholder="Search Orders">
        </div> --}}

    </div>
    <!-- end row middle -->





    <!-- tabs row -->
    <div class="row px-4 pt-4 home-tabs-row" style="background-color:#2a2a2a">
    
        <!-- search input -->
        <div class="col-4 mb-5">
            <button id="all-orders-button" class="btn btn-none active orders-buttons">
               <p style="height: 35px"> All Orders</p>
                 {{$driverHomeOrders->count()}}
            </button>
        </div>
        
        <!-- search input -->
        <div class="col-4 mb-5">
            <button id="received-orders-button" class="btn btn-none orders-buttons">
               <p style="height: 35px">Received Orders</p> 
                 {{$driverHomeOrders->where('status','picked from pickup')->count()}}
            </button>
        </div>



        <!-- search input -->
        <div class="col-4 mb-5">
            <button id="delivered-orders-button" class="btn btn-none orders-buttons">
               <p style="height: 35px"> Delivered Orders</p>
                 {{$driverHomeOrders->where('status','delivered')->count()}}
            </button>
        </div>


    </div>
    <!-- end tabs row -->





    <!-- middle section -->
    <div class="row px-4" style="background:rgb(42,42,42);">
        

        <!-- 1- all orders col -->
        <div class="col-sm-12 all-orders-col orders-cols">

            @foreach ($driverHomeOrders as $order)
            <div class="card px-3 text-left home-middle-section home-middle-section-driver">

            <!-- info 3 -->
            <p class="font-size-12 font-weight-bold mb-2">
                Order No. #{{$order->id}}
            </p>

            <p class="mb-1">
                {{$order->customer_name}}
            </p>

            <p class="text-muted">
                {{$order->customer_address}}
            </p>




            <!-- status  and delivery button-->
            <div class="row align-items-center mt-3">
                @if ($order->status == 'requested')
                <div class="col-6">
                    <a href="https://www.google.com/maps/search/?api=1&query={{ ltrim($order->pickup_locationlink, '@') }}" target="_blank">

                      
                    <button type="submit" class="btn btn-success index-status-button py-1 px-2 font-size-13 cursor-pointer-f">
                        <i class="fa fa-location-arrow"></i> Pickup Location
                    </button>
                
                </a>
                </div>
            
            
                <div class="col-6">
                    <form action="{{route('driver.order.status')}}" method="post">
                        @method('POST')
                        @csrf

                    <input type="hidden" name="order_id" value="{{$order->id}}" id="">
                    <input type="hidden" name="status" value="picked from pickup" id="">

                    <button type="submit" class="btn btn-none index-delivery-button py-1 px-2 font-size-13">
                        Pick From Pickup
                    </button>
                </form>
                </div>
                @elseif($order->status == 'picked from pickup') 
                <div class="col-12">
                    <a href="https://www.google.com/maps/search/?api=1&query={{ ltrim($order->customer_locationlink, '@') }}" target="_blank">
                        
                    <button type="submit" class="btn btn-success index-status-button py-1 px-2 font-size-13 cursor-pointer-f">
                        <i class="fa fa-location-arrow"></i> Customer Location
                    </button>
              
                </a>
                </div>
            
            
                <div class="col-12 mt-4">
                    <form action="{{route('driver.order.status')}}" method="post">

                        @method('POST')
                        @csrf

                    <input type="hidden" name="order_id" value="{{$order->id}}" id="">
                    <select name="status" class="custom-control custom-select home-searchselect map-statusselect" id="">
                        <option value="" selected="" class="d-none">Order Status</option>
                        
                        <option style="color: green;" value="delivered">Delivered</option>
                        <option style="color: red;" value="canceled">Canceled</option>
                    </select>

                    <button type="submit" class="btn btn-none index-delivery-button mt-3 py-1 px-2 font-size-13">
                      Update
                    </button>
                </form>
                   
                </div>
                @elseif( $order->status == 'delivered')
                <div class="col-12 mt-4">
                <button type="submit" disabled style="width: 100%" class="btn btn-success py-1 px-2 font-size-13">
                    {{$order->status}}
                  </button>
                </div>
                  @elseif( $order->status == 'canceled')
                  <div class="col-12 mt-4">
                  <button type="submit" disabled style="width: 100%" class="btn btn-danger py-1 px-2 font-size-13">
                      {{$order->status}}
                    </button>
                  </div>
                @endif
            
               
            </div>


        </div>
        <!-- card 1 -->
            @endforeach
            
            <!-- card 1 -->


        </div>
        <!-- end 1- all orders col -->


        <!-- 2- received orders col -->
        <div class="col-sm-12 received-orders-col orders-cols d-none">
        
            @foreach ($driverHomeOrders->where('status', 'picked from pickup') as $order)

            <div class="card px-3 text-left home-middle-section home-middle-section-driver">

                <!-- info 3 -->
                <p class="font-size-12 font-weight-bold mb-2">
                    Order No. #{{$order->id}}
                </p>
    
                <p class="mb-1">
                    {{$order->customer_name}}
                </p>
    
                <p class="text-muted">
                    {{$order->customer_address}}
                </p>
    
    
    
    
                <!-- status  and delivery button-->
                <div class="row align-items-center mt-3">
                    @if ($order->status == 'requested')
                    <div class="col-6">
                        <a href="https://www.google.com/maps/search/?api=1&query={{ ltrim($order->pickup_locationlink, '@') }}" target="_blank">
    
                          
                        <button type="submit" class="btn btn-success index-status-button py-1 px-2 font-size-13 cursor-pointer-f">
                            <i class="fa fa-location-arrow"></i> Pickup Location
                        </button>
                    
                    </a>
                    </div>
                
                
                    <div class="col-6">
                        <form action="{{route('driver.order.status')}}" method="post">
                            @method('POST')
                            @csrf
    
                        <input type="hidden" name="order_id" value="{{$order->id}}" id="">
                        <input type="hidden" name="status" value="picked from pickup" id="">
    
                        <button type="submit" class="btn btn-none index-delivery-button py-1 px-2 font-size-13">
                            Pick From Pickup
                        </button>
                    </form>
                    </div>
                    @elseif($order->status == 'picked from pickup') 
                    <div class="col-12">
                        <a href="https://www.google.com/maps/search/?api=1&query={{ ltrim($order->customer_locationlink, '@') }}" target="_blank">
                            
                        <button type="submit" class="btn btn-success index-status-button py-1 px-2 font-size-13 cursor-pointer-f">
                            <i class="fa fa-location-arrow"></i> Drop Off Location
                        </button>
                  
                    </a>
                    </div>
                
                
                    <div class="col-12 mt-4">
                        <form action="{{route('driver.order.status')}}" method="post">
    
                            @method('POST')
                            @csrf
    
                        <input type="hidden" name="order_id" value="{{$order->id}}" id="">
                        <select name="status" class="custom-control custom-select home-searchselect map-statusselect" id="">
                            <option value="" selected="" class="d-none">Order Status</option>

                            <option style="color: green;" value="delivered">Delivered</option>
                            <option style="color: red;" value="canceled">Canceled</option>
                        </select>
    
                        <button type="submit" class="btn btn-none index-delivery-button mt-3 py-1 px-2 font-size-13">
                          Update
                        </button>
                    </form>
                       
                    </div>
                    @elseif( $order->status == 'delivered')
                    <div class="col-12 mt-4">
                    <button type="submit" disabled style="width: 100%" class="btn btn-success py-1 px-2 font-size-13">
                        {{$order->status}}
                      </button>
                    </div>
                      @elseif( $order->status == 'canceled')
                      <div class="col-12 mt-4">
                      <button type="submit" disabled style="width: 100%" class="btn btn-danger py-1 px-2 font-size-13">
                          {{$order->status}}
                        </button>
                      </div>
                    @endif
                
                   
                </div>
    
    
            </div>
            <!-- card 1 -->

                
            @endforeach
            <!-- card 1 -->
    
        </div>
        <!-- end 2 received orders -->

        <!-- 3- delivered orders col -->
        <div class="col-sm-12 delivered-orders-col orders-cols d-none">
        
            <!-- card 1 -->
            
        
        
        
            <!-- card 1 -->
            @foreach ($driverHomeOrders->where('status', 'delivered') as $order)
            
            <div class="card px-3 text-left home-middle-section home-middle-section-driver">

                <!-- info 3 -->
                <p class="font-size-12 font-weight-bold mb-2">
                    Order No. #{{$order->id}}
                </p>
    
                <p class="mb-1">
                    {{$order->customer_name}}
                </p>
    
                <p class="text-muted">
                    {{$order->customer_address}}
                </p>
    
    
    
    
                <!-- status  and delivery button-->
                <div class="row align-items-center mt-3">
                   
                    <div class="col-12 mt-4">
                        <button type="submit" disabled style="width: 100%" class="btn btn-success py-1 px-2 font-size-13">
                            {{$order->status}}
                          </button>
                        </div>
                  
                   
                </div>
    
    
            </div>
            <!-- card 1 -->
        @endforeach
        <!-- card 1 -->
    
        </div>
        <!-- end 3 Delivered orders -->



    </div>
    <!-- row -->

</div>
<!-- container-fluid -->

@endsection

@section('scripts')

<script src="{{asset('assets/general-js/custom.js')}}"></script>
    
@endsection