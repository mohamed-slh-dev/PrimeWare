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


        
        <div class="col-6">
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
        {{-- <div class="col-sm-12 mb-5"> 
            <input class="home-searchinput" type="text" name="" id="" placeholder="Search by Restaurant">
        </div> --}}



        <!-- rest box -->
        <div class="col-sm-12 mb-4 rest-carousal-col">

            <!-- rest -->
            @if ($restActive == 0 )
            <a href="{{route('driver.home')}}" class="active" style="background-image: url(assets/images/demofood.jpg);">
                <div>
                    <span>All Resturants</span>
                </div>
            </a>
            @foreach ($restaurants as $rest)
            <a href="{{route('driver.home.by.restaurant',[$rest->id])}}" class="" style="background-image: url({{asset('assets/img/partners/logos/'.$rest->logo)}});">
                    <div>
                    <span>{{$rest->name}}</span>
                    </div>
                </a>
                @endforeach
                <!-- rest -->
            @else

            <a href="{{route('driver.home')}}" style="background-image: url(assets/images/demofood.jpg);">
                <div>
                    <span>All Resturants</span>
                </div>
            </a>

            @foreach ($restaurants as $rest)
            @if ($restActive == $rest->id)

            <a href="{{route('driver.home.by.restaurant',[$rest->id])}}" class="active" style="background-image: url({{asset('assets/img/partners/logos/'.$rest->logo)}});">
                <div>
                <span>{{$rest->name}}</span>
                </div>
            </a>
            @else
            <a href="{{route('driver.home.by.restaurant',[$rest->id])}}" style="background-image: url({{asset('assets/img/partners/logos/'.$rest->logo)}});">
                <div>
                <span>{{$rest->name}}</span>
                </div>
            </a>
            @endif
           
                @endforeach
                <!-- rest -->
            @endif
       

          
           

        </div>
        <!-- end res box -->

       

    </div>
    <!-- end row middle -->





    <!-- middle section -->
    <div class="row px-4" style="background:rgb(42,42,42);">
        

        <!-- cards col -->
        <div class="col-sm-12" >
            @if ($driverHomeDelivery->count() > 0)
                
            @foreach ($driverHomeDelivery as $delivery)
                
          
            
            <!-- card 1 -->
            <div class="card px-3 text-left home-middle-section home-middle-section-driver" >

                <!-- info 3 -->
                <p class="font-size-12 font-weight-bold mb-2">
                    Order No. #{{$delivery->order_id}} 
                    <span class="text-muted ml-2"> ({{ucwords($delivery->OrderStatus)}})</span>
                </p>

                <p class="mb-1">
                    {{$delivery->customer_name}}
                </p>

                <p class="text-muted">
                    {{$delivery->address}} - {{$delivery->city}} - {{$delivery->district}} - block No 
                    {{$delivery->block_number}} - Flat No {{$delivery->flat_number}}
                </p>



                <!-- checkboxes  and cash-->
                <div class="row align-items-center">

                    <div class="col-6">
                        @if ($delivery->orderBag == 1)
                        <input class="mr-1" type="checkbox" checked disabled name="coolerbag" id="coolerbag"> 
                        @else
                        <input class="mr-1" type="checkbox" disabled name="coolerbag" id="coolerbag"> 

                        @endif
                        
                        <label for="coolerbag" class="font-weight-bold font-size-13 pb-1">Cooler Bag</label>
                    </div>


                    <div class="col-6">
                        <p class="mb-0 font-size-13 font-weight-bold">
                            <span class="home-cashamount mr-1"> {{$delivery->cash}} AED</span> <br> Cash Collection
                        </p>
                    </div>
                </div>





               

                <!-- status  and delivery button-->
                <div class="row align-items-center mt-3">
                    @if ($delivery->OrderStatus == 'delivered to warehouse')

                    <div class="col-12">
                        <form action="{{route('driver.delivery.status')}}" method="post">

                            @method('POST')
                            @csrf
    
                            <input type="hidden" name="delivery_id" value=" {{$delivery->order_id}} " id="">
                            <input type="hidden" name="status" value="picked from warehouse" id="">
                        <button class="btn btn-none index-delivery-button py-1 px-2 font-size-11">
                            Pick From Warehouse
                        </button>
                    </form>
                    </div>

                   

                    @elseif ($delivery->OrderStatus == 'picked from warehouse')
                   
                    <div class="col-6">
                        <button style="width: 100%; font-weight:bold" disabled class="btn btn-success  py-1 px-2 font-size-11">
                            Picked
                        </button>
                    </div>

                    <div class="col-6">
                    <a href="{{route('driver.delivery.deliver',[$delivery->order_id])}}">
                        <button class="btn btn-none index-delivery-button py-1 px-2 font-size-11">
                            Start Delivery
                        </button>
                    </a>
                    </div> 

                  

                    @elseif($delivery->OrderStatus == 'delivered')
                    <div class="col-12 text-center">
                        <button style="width: 200px;font-weight:bold" disabled class="btn btn-success py-1 px-2 font-size-11">
                           Deliverd
                        </button>
                    </div>

                    @elseif($delivery->OrderStatus == 'canceled')
                    <div  class="col-12 text-center">
                        <button style="width: 200px;font-weight:bold" disabled class="btn btn-danger py-1 px-2 font-size-11">
                           Canceled
                        </button>
                    </div>

                    @else
                   
                    <div class="col-6">
                        <form action="{{route('driver.delivery.status')}}" method="post">

                            @method('POST')
                            @csrf
    
                            <input type="hidden" name="delivery_id" value=" {{$delivery->order_id}} " id="">
                            <input type="hidden" name="status" value="picked from warehouse" id="">
                        <button style="width: 100%" class="btn btn-none index-delivery-button py-1 px-2 font-size-11">
                           Confirm Receiving
                        </button>
                        </form>
                    </div>

                    <div class="col-6">
                        <form action="{{route('driver.delivery.status')}}" method="post">

                            @method('POST')
                            @csrf
    
                            <input type="hidden" name="delivery_id" value=" {{$delivery->order_id}} " id="">
                            <input type="hidden" name="status" value="canceled" id="">

                        <button style="width: 100%; font-weight:bold " class="btn btn-danger py-1 px-2 font-size-11">
                           Not Available
                        </button>
                        </form>
                    </div> 
                  
               
                    @endif
                
                   
                
                
                    {{-- <div class="col-6">
                        <button class="btn btn-none index-delivery-button py-1 px-2 font-size-11">
                            Start Delivery
                        </button>
                    </div> --}}
                </div>


            </div>
            <!-- card 1 -->

            @endforeach

            @else
            <div class="col-sm-12" style="margin: 80px 0px 100px;">
                <div class="card text-center edit-view-cards home-middle-section">
                    <p class="mb-0">
                        <i class="fas fa-info"></i>
                    </p>
                    <div class="card-body text-offwhite-f middle-sec-fallback">
                        There is no delivery
                    </div>
                </div>
            </div>
            @endif
           




            <!-- card 1 -->
            


        </div>
        <!-- end col 12 -->



        <!-- end today button -->
        {{-- <div class="col-sm-12 mb-5 mt-4">

            <button class="btn btn-none text-uppercase index-delivery-button py-3 font-size-15 shadow">
                Complete Today
            </button>
        </div> --}}

    </div>






</div>
<!-- container-fluid -->

@endsection