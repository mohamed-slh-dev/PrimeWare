@extends('layouts.customer-app')

@section('content')

<div class="container-fluid">



    <!-- title section -->
    <div class="row align-items-center" style="background:rgb(51,51,51); padding: 0px 20px !important; ">


        <div class="col-auto">
        <a href="{{route('customer.profile')}}" class="menu-back-button">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>

        <div class="col-auto">
            <h3 class="ad-page-title mb-0">Edit Profile</h3>
        </div>

       

    </div>




    <!-- main section row -->
    <form action="{{ route('customer.update.profile') }}" method="post">

        @method('POST')
        @csrf
  
    <div class="row align-items-center"
        style="background:rgb(42, 42, 42); padding: 25px 20px !important;">

        <!-- name -->
        <div class="col-sm-12 profile-cols">
                
            <label for="name">Name</label>

            <p>
            <input class="custom-control profile-custom-inputs" type="text" name="name" id="name"
             value="{{$customerInfo->name}}">
            </p>
        </div>




        <!-- phone -->
        <div class="col-sm-12 profile-cols">
        
            <label for="phone">Phone</label>
        
            <p>
                <input class="custom-control profile-custom-inputs" type="text" name="phone" id="phone"
                 value="{{$customerInfo->phone}}">
            </p>
        </div>
        



        <!-- email -->
        <div class="col-sm-12 profile-cols">
        
            <label for="email">Email</label>
        
            <p>
                <input class="custom-control profile-custom-inputs" type="email" name="email" id="email" value="{{$customerInfo->email}}">
            </p>
        </div>


        <!-- address -->
        <div class="col-sm-12 profile-cols">
        
            <label for="address">Address</label>
        
            <p>
                <input class="custom-control profile-custom-inputs" type="text" name="address" id="address" value="{{$customerInfo->address}}">
            </p>
        </div>


        <!-- block number -->
        <div class="col-sm-12 profile-cols">
        
            <label for="block">Block Number</label>
        
            <p>
                <input class="custom-control profile-custom-inputs" type="text" name="block_number" id="block" value="{{$customerInfo->blocknumber}}">
            </p>
        </div>



        <!-- flat number -->
        <div class="col-sm-12 profile-cols">
        
            <label for="flatnumber">Flat Number</label>
        
            <p>
                <input class="custom-control profile-custom-inputs" type="text" name="flat_number" id="flatnumber" value="{{$customerInfo->flatnumber}}">
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
        <div class="col-sm-12 profile-cols">
        
            <button type="submit" style="width:100%; background-color: #fbbe00;" class="btn btn-warning mt-5">
                Save
            </button>
           

        </div>

    </div>
    <!-- end row -->
</form>


</div>
<!-- container-fluid -->

@endsection