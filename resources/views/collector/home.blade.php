@extends('layouts.collector-app')

@section('content')
    




<div class="container-fluid" style="background:rgb(51,51,51);">




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
                <div class="card-body text-offwhite-f">
                    Deliveries
                    <h3 class="text-info mt-2" style="font-size: 31px !important;">{{ $total_deliveries }}</h3>
                </div>
            </div>
        </div>
    
        <div class="col-6">
            <div class="card text-center edit-view-cards view-card-bg">
                <div class="card-body text-offwhite-f">
                    Restaurants
                    <h3 class="text-info mt-2" style="font-size: 31px !important;">{{$total_restaurants}}</h3>
                </div>
            </div>
        </div>
    

    
    </div>
    <!-- end row -->


         
         

    <div class="row px-4 pt-4" style="background-color:#2a2a2a">
    
        <!-- search input -->
        <div class="col-sm-12 mb-0">
            {{-- <form class="app-search ">
                <input type="text" class="home-searchinput" placeholder="Search by resturant">
                <span class="fa fa-search" style="margin-top: 7px; margin-right: 10px;"></span>
            </form> --}}
        </div>

    </div>



    

     <div class="row pt-0" style="background: rgb(42, 42, 42);">
        
        
        @if (count($ordersHome) > 0 )
       
        @foreach ($ordersHome as $order)

        <div class="col-12 px-4 ">
            <div class="card py-2 pb-4 mb-0" style="background:rgb(42,42,42);">
                    <div class="card-body p-0 border-all-radius" >
                            
                            <div class="row border-all-radius align-items-center" >
                                
                                <div class="col-12 col-sm-4" >
                                    <img src="{{$order['logo']}}" class="mr-3 thumb-md align-self-center border-all-radius object-fit-lg object-fit-xs" width="100%" height="210" alt="..." style="object-fit: contain; object-position:center; max-height: 210px;">
                                </div>

                                <div class="col-12 col-sm-8 text-center text-sm-left pb-4 pb-sm-0" >
                                    <h5 class="mt-3 mb-2" style="color :#fbbe00"> {{$order['restaurantName']}} </h5>

                                    <p class=" mb-0 font-size-16 text-white-50" style="color:white;"><i class="fas fa-map-marker-alt mr-2 font-size-17" style=" color: #fbbe00;"></i>{{$order['address']}}</p>


                                    <p class=" mb-0 mt-2 font-size-16 text-white-50" style="color:white;"><i class="fa fa-box-open mr-2 font-size-17" style=" color: #fbbe00;"></i>
                                        {{$order['delivers']}} Deliveries</p>


                                    <!-- location  and deliveries button-->
                                    <div class="row align-items-center mt-3 pr-sm-2">
                                    
                                        <div class="col-6 text-center p-3">
                                            
                                            <a href="https://www.google.com/maps/search/?api=1&query={{ ltrim($order['location'], '@') }}" target="_blank"
                                                class="btn btn-none index-delivery-button py-1 px-2 font-size-13"><i class="fa fa-map-marker-alt mr-2" style="background: transparent !important;border: none !important; color: black;"></i>Location</a>
                                        </div>
                                    
                                    
                                        <div class="col-6 text-center p-3">
                                            <a href="{{route('collector.restaurant.orders',[$order['restaurantId']])}}" class="btn btn-none index-delivery-button py-1 px-2 font-size-13">Pick
                                                Deliveries</a>
                                        </div>
                                    </div>
                                    
                                    
                                </div>
                                {{-- end right col --}}


                            </div>
                            {{-- end row (repeat) --}}

    
                                                          
                    </div><!--end card-body-->
                </div><!--end card-->
         </div><!--end col-->
         @endforeach
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
@endsection
