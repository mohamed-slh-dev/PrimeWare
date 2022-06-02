@extends('layouts.collector-app')

@section('content')

<div class="container-fluid">

                
                
    <!-- title section -->
    <div class="row align-items-center" style="background:rgb(51,51,51);">
        
        <div class="col-9">
            <h3 class="ad-page-title">Profile</h3>
        </div>

        <div class="col-3 text-right">
            <div class="dropdown show">
                <a class="btn dropdown-toggle profile-dd-button" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                </a>
            
                <div class="dropdown-menu dropdown-menu-right custom-dd-menu" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="{{route('collector.edit.profile')}}">
                        <i class="fas fa-user-edit"></i>Edit Profile
                    </a>

                    <a class="dropdown-item" href="{{route('collector.logout')}}">
                        <i class="fas fa-door-open"></i>Logout

                    </a>
                </div>
            </div>
        </div>

    </div>




    <!-- main section row -->
    <div class="row align-items-center" style="background:rgb(42, 42, 42); padding: 10px 20px !important;">

        <div class="col-auto profile-logocol">
            <img src="{{asset('assets/img/drivers/profiles/'.$driverInfo->pic)}}" alt="">
            <i class="fa fa-cog"></i>
        </div>

        <div class="col-auto profile-logocol">
        <h4 style="color: rgb(254, 184, 0)">{{$driverInfo->name}}</h4>
            <p class="mb-0">{{$driverInfo->type}} - ({{ucwords($driverInfo->shift)}})</p> 
        </div>

    </div>


    <!-- main section row -->
    <div class="row align-items-center" style="background:rgb(42, 42, 42); padding: 10px 20px !important;">
    
        <h5 class="text-main-color py-3 mt-4">Driver info</h5>
        
        <div class="col-12 user-info-wrapper">



            <!-- phone -->
            <div class="row user-info-row align-items-center">
                <div class="col-auto">
                    <i class="fas fa-phone"></i>
                </div>
            
                <div class="col-auto">
                    <p>Phone Number</p>
                    <h5 class="text-offwhite-f p-0">{{$driverInfo->phone}}</h5>
                   
                </div>
            </div>



            <!-- address -->
            <div class="row user-info-row align-items-center">
                <div class="col-auto">
                    <i class="fas fa-home"></i>
                </div>
            
                <div class="col-auto">
                    <p>Address</p>
                    <h5 class="text-offwhite-f p-0">{{$driverInfo->info}}</h5>

                   
                </div>
            </div>




            <!-- lic -->
            <div class="row user-info-row align-items-center">
                <div class="col-auto">
                    <i class="fas fa-id-card"></i>
                </div>
            
                <div class="col-auto">
                    <p>Driving License</p>
                    <h5 class="text-offwhite-f p-0">{{$driverInfo->drivinglicense}}</h5>
            
                   
                </div>
            </div>


            <!-- lic -->
            <div class="row user-info-row align-items-center">
                <div class="col-auto">
                    <i class="fas fa-car"></i>
                </div>
            
                <div class="col-auto">
                    <p>Plate Number</p>
                    <h5 class="text-offwhite-f p-0">{{$driverInfo->platenumber}}</h5>
            
                   
                </div>
            </div>
            
        </div>
        <!-- end main col -->






        <h5 class="text-main-color py-3 mt-4">Driving License</h5>


        <div class="col-12 user-info-wrapper text-center">
        <img src="{{asset('assets/img/drivers/licenses/'.$driverInfo->licensepic)}}" alt="" class="drivinglicensepic">
        </div>



    </div>
    <!-- end row -->





</div>
<!-- container-fluid -->

@endsection