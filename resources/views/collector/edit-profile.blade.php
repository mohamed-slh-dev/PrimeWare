@extends('layouts.collector-app')

@section('content')

<div class="container-fluid">



    <!-- title section -->
    <div class="row align-items-center" style="background:rgb(51,51,51); padding: 0px 20px !important; ">


        <div class="col-auto">
        <a href="{{route('collector.profile')}}" class="menu-back-button">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>

        <div class="col-auto">
            <h3 class="ad-page-title mb-0">Edit Profile</h3>
        </div>

       

    </div>




    <!-- main section row -->
    <form action="{{ route('collector.update.profile') }}" method="post">

        @method('POST')
        @csrf
  
    <div class="row align-items-center"
        style="background:rgb(42, 42, 42); padding: 25px 20px !important;">

        <!-- name -->
        <div class="col-sm-12 profile-cols">
                
            <label for="name">E-mail</label>

            <p>
            <input class="custom-control profile-custom-inputs" type="email" name="email" 
             value="{{$driverInfo->email}}">
            </p>
        </div>




        <!-- phone -->
        <div class="col-sm-12 profile-cols">
        
            <label for="phone">Phone</label>
        
            <p>
                <input class="custom-control profile-custom-inputs" type="text" name="phone" id="phone"
                 value="{{$driverInfo->phone}}">
            </p>
        </div>
        

        <!-- flat number -->
        <div class="col-sm-12 profile-cols">
        
            <label for="flatnumber">Info</label>
        
            <p>
                <input class="custom-control profile-custom-inputs" type="text" name="info" id="flatnumber" value="{{$driverInfo->info}}">
            </p>
        </div>


        <!-- password number -->
        <div class="col-sm-12 profile-cols">
        
            <label for="password">Password</label>
        
            <p>
                <input class="custom-control profile-custom-inputs" type="password" name="password" id="password" value="">
            </p>
        </div>


        <!-- password number -->
        <div class="col-sm-12 profile-cols">
        
            <label for="confirmpassword">Confirm Password</label>
        
            <p>
                <input class="custom-control profile-custom-inputs" type="password" name="confirmpassword" id="confirmpassword" value="">
            </p>
        </div>




        <!-- password number -->
        <div class="col-sm-12 profile-cols text-center">
        
            <button type="submit" style=" width: 200px; background-color:rgb(254, 184, 0) !important; color:black " class="btn btn-warning mt-3 py-2">
                Save
            </button>
           

        </div>

    </div>
    <!-- end row -->
</form>


</div>
<!-- container-fluid -->

@endsection