@extends('layouts.driver-app')

@section('content')

<div class="row mt-5 mx-0">
    <div class="col-12">
        <div class="card" style="background:rgb(42,42,42);">
            <form action="{{route('driver.get.search.by.distrect')}}" method="post">

                @method('POST')
                @csrf

                <div class="card-body p-4">
                    <div>
                  <label class="mt-3" style=" color: #fbbe00; ">Districts</label>
                    <select class="custom-control custom-select home-searchselect map-statusselect" name="district_id">
                        @foreach ($districts as $dist)
                    <option value="{{$dist->id}}">{{$dist->name}}</option>
                        @endforeach
                       
                           
                    </select>
                    </div>
                    
                  
                   
                     <div class="mt-3 text-center">
                   <button class="btn btn-warning" type="submit" style=" width: 200px; "> Search </button>
                    </div>
              </div><!--end card-body-->
            </form>
            </div><!--end card-->
     </div><!--end col-->

    </div>

 

    <div class="row mt-5 px-4" style="background:rgb(42,42,42);">
        
        @if ($deliveries)
        <!-- cards col -->
        <div class="col-sm-12" >
                
            @foreach ($deliveries as $delivery)
                
          
            
            <!-- card 1 -->
            <div class="card px-3 text-left home-middle-section home-middle-section-driver">

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
                        
                        <label for="coolerbag" class="font-weight-bold font-size-13">Cooler Bag</label>
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
                        <button class="btn btn-none index-delivery-button py-1 px-2 font-size-13">
                            Pick From Warehouse
                        </button>
                    </form>
                    </div>

                   

                    @elseif ($delivery->OrderStatus == 'picked from warehouse')
                   
                    <div class="col-6">
                        <button style="width: 100%" disabled class="btn btn-success  py-1 px-2 font-size-13">
                            Picked From Warehouse
                        </button>
                    </div>

                    <div class="col-6">
                    <a href="{{route('driver.delivery.deliver',[$delivery->order_id])}}">
                        <button class="btn btn-none index-delivery-button py-1 px-2 font-size-13">
                            Start Delivery
                        </button>
                    </a>
                    </div> 

                  

                    @elseif($delivery->OrderStatus == 'delivered')
                    <div class="col-12 text-center">
                        <button style="width: 200px" disabled class="btn btn-success py-1 px-2 font-size-13">
                           Deliverd
                        </button>
                    </div>

                    @elseif($delivery->OrderStatus == 'canceled')
                    <div  class="col-12 text-center">
                        <button style="width: 200px" disabled class="btn btn-danger py-1 px-2 font-size-13">
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
                        <button style="width: 100%" class="btn btn-none index-delivery-button py-1 px-2 font-size-13">
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

                        <button style="width: 100%;" class="btn btn-danger py-1 px-2 font-size-13">
                           Not Available
                        </button>
                        </form>
                    </div> 
                  
               
                    @endif
                
                   
                
                
                    {{-- <div class="col-6">
                        <button class="btn btn-none index-delivery-button py-1 px-2 font-size-13">
                            Start Delivery
                        </button>
                    </div> --}}
                </div>


            </div>
            <!-- card 1 -->

            @endforeach
            <!-- card 1 -->
            


        </div>
        <!-- end col 12 -->
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
        <!-- end col 12 -->



        <!-- end today button -->
        {{-- <div class="col-sm-12 mb-5 mt-4">

            <button class="btn btn-none text-uppercase index-delivery-button py-3 font-size-15 shadow">
                Complete Today
            </button>
        </div> --}}

    </div>
                      
@endsection