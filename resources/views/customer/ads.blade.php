@extends('layouts.customer-app')

@section('content')

<div class="container-fluid">

                
                
    <!-- title section -->
    <div class="row align-items-center" style="background:rgb(51,51,51);">

        <h3 class="ad-page-title">More</h3>

    </div>




    <!-- main section -->
    <div class="row align-items-center" style="background:rgb(42, 42, 42); padding: 10px 20px !important;">
    
        <h5 class="text-main-color py-3">Find out our new offers</h5>
        

        @foreach ($ads as $ad)
            
       
        <!-- single (repeat) -->
        <div class="col-12 rest-menu-col" style="background-image: url({{asset('assets/img/partners/ads/'.$ad->pic)}});">


            <!-- overlay -->
            <div class="rest-overlay">

                <!-- new button -->
                <p class="text-right">
                    <button class="btn rest-new-button">
                       {{$ad->label}}
                    </button>
                </p>



                <h5 class="text-white rest-bottom-note">
                   {{$ad->title}}
                </h5>

                <p class="text-white mb-0">
                   {{$ad->price}}
                </p>
            </div>
            
        </div>
        <!-- end single col -->

        @endforeach

    </div>
    <!-- end row -->
</div>
<!-- container-fluid -->

@endsection