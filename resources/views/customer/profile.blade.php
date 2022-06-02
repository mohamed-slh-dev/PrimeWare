@extends('layouts.customer-app')

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
                    <a class="dropdown-item" href="{{route('customer.edit.profile')}}">
                        <i class="fas fa-user-edit"></i>Edit Profile
                    </a>

                <a class="dropdown-item" href="{{route('customer.logout')}}">
                        <i class="fas fa-door-open"></i>Logout

                    </a>
                </div>
            </div>
        </div>

    </div>




    <!-- main section row -->
    <div class="row align-items-center" style="background:rgb(42, 42, 42); padding: 10px 20px !important;">
    
        <h5 class="text-main-color py-3 mt-4">Customer info</h5>
        
        <div class="col-12 user-info-wrapper">

            <!-- Username -->
            <div class="row user-info-row align-items-center">
                <div class="col-auto">
                    <i class="fas fa-user"></i>
                </div>

                <div class="col-auto">
                    <p>Customer Name</p>
                <h5 class="text-offwhite-f p-0">{{$customerInfo->name}}</h5>
                   
                </div>
            </div>


            <!-- phone -->
            <div class="row user-info-row align-items-center">
                <div class="col-auto">
                    <i class="mdi mdi-phone" style="font-size: 26px; font-weight: bold;"></i>
                </div>
            
                <div class="col-auto">
                    <p>Phone Number</p>
                    <h5 class="text-offwhite-f p-0">{{$customerInfo->phone}}</h5>
                   
                </div>
            </div>



            <!-- address -->
            <div class="row user-info-row align-items-center">
                <div class="col-auto">
                    <i class="fas fa-home"></i>
                </div>
            
                <div class="col-auto">
                    <h5 class="text-offwhite-f pb-0">City: {{$customerInfo->city_name}}</h5>
                    <h5 class="text-offwhite-f p-0">District: {{$customerInfo->district_name}}</h5>
                    <p>{{$customerInfo->address}}</p>
                </div>
            </div>



            <!-- button -->
            <p>
            <a  href="{{route('customer.location.altr')}}"
                class="profile-location-button">
                    <i class="fas fa-search-plus"></i>
                    Current Location
                </a>
            </p>
            
        </div>
        <!-- end main col -->



    </div>
    <!-- end row -->








    <!-- main section bottom -->
    <div class="row align-items-center" style="background:rgb(42, 42, 42); padding: 10px 20px !important;">
    
        <h5 class="text-main-color py-3 mt-4">Subscription info</h5>
    
        <div class="col-12 user-info-wrapper">
    
            <!-- Sub Dates -->
            <div class="row user-info-row align-items-center">
                <div class="col-6">
                    <h5 class="text-offwhite-f">{{$customerInfo->start_date}}</h5>
                    <p>Start Date</p>
                </div>
    
                <div class="col-6">
                    <h5 class="text-offwhite-f">{{$customerInfo->end_date}}</h5>
                    <p>End Date</p>
                </div>
            </div>
    


            <!-- Sub Buttons -->
            {{-- <div class="row user-info-row align-items-center">
                <div class="col-6">
                    <p>
                        <a data-toggle="modal" data-target=".renew" class="profile-location-button">
                            Renew
                        </a>
                    </p>
                </div>
    
                <div class="col-6">
                    <p>
                        <a  data-toggle="modal" data-target=".freez" class="profile-location-button">
                            Freeze
                        </a>
                    </p>
                </div>
            </div> --}}

    
            <!-- button -->
            
    
        </div>
        <!-- end main col -->
    
    
    
    </div>
    <!-- end bottom row -->


</div>
<!-- container-fluid -->


<div class="modal fade freez" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content" style=" background-color:#404040">
             <div class="modal-header">
               <h6>Freezing</h6>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
              </div>
                         <div class="modal-body" >
                            <form action="{{ route('customer.freez') }}" method="post">
                                   <div class="row">
                                  
                                        {{-- method fields --}}
                                        @method('POST')
                                        @csrf
                                        <div class="col-sm-6 col-12 p-3">
                                            <label for="">Starting</label>
                                            <input type="date" required class="form-control" name="start_date">
                                        </div>
                                        <div class="col-sm-6 col-md-12 p-3">
                                            <label for="">End</label>
                                            <input type="date" required class="form-control" name="end_date">
                                        </div>
                                     <div class="col-12 text-center mt-5">
                                            <button class="btn btn-sm btn-warning profile-location-button showpage-action-buttons text-center" style="">Freez</button>
                                     </div>
                            </div> 
                        </form>
                    </div>
              </div><!-- /.modal-content -->
       </div><!-- /.modal-dialog -->
 </div><!-- /.modal -->


 <div class="modal fade renew" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content" style=" background-color:#404040">
             <div class="modal-header">
               <h6>Renew</h6>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                                </button>
                                               </div>
                                               <div class="modal-body">
                                   <form action="{{ route('customer.renew') }}" method="post">
                                     {{-- method fields --}}
                                     @method('POST')
                                     @csrf          
                                   <div class="row">
                                   
                                       
                                        <div class="col-6 p-3">
                                            <label for="">Starting</label>
                                            <input type="date" required class="form-control" name="start_date">
                                        </div>
                                        <div class="col-6  p-3">
                                            <label for="">End</label>
                                            <input type="date" required class="form-control" name="end_date">
                                        </div>  
                                        <div class="col-sm-12 p-3">
                                            <label for="">Number Of Deliveries</label>
                                            <input type="number" required class="form-control" name="deliveries">
                                        </div>

                                            <div class="col-12 text-center">
                                                <button class="btn btn-sm btn-warning profile-location-button showpage-action-buttons text-center" style="">Renew</button>
                                            </div>
                                   
                             </div>
                        </form> 
                    </div>
              </div><!-- /.modal-content -->
       </div><!-- /.modal-dialog -->
 </div><!-- /.modal -->


 <div class="modal fade location" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style=" background-color:#404040">
             <div class="modal-header">
               <h6>Update Location</h6>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
              </div>
                         <div class="modal-body" >
                            <form action="{{ route('customer.update.location') }}" method="post">
                                   <div class="row">
                                  
                                        {{-- method fields --}}
                                        @method('POST')
                                        @csrf
                     <input type="hidden" class="form-control" id="lat_input" name="lat" >
                      <input type="hidden"  class="form-control" id="long_input" name="long" >


               <h4>Select a location!</h4><br>
        
        <!--map div-->
        <div id="map"></div>
        <br>
        <div class="col-12 text-center my-4">
            <button id="confirmPosition" class="btn btn-sm btn-warning profile-location-button showpage-action-buttons text-center" style="">Confirm Position</button>
        </div>
       

        <br>
        <div class="col-12 text-center">
            <p><span id="onIdlePositionView"></span></p>
        </div>
      
        
       
                            </div> 
                        </form>
                    </div>
              </div><!-- /.modal-content -->
       </div><!-- /.modal-dialog -->
 </div><!-- /.modal -->

 
@endsection


@section('scripts')
<script>
     // Get element references
  var confirmBtn = document.getElementById('confirmPosition');
  var onClickPositionView = document.getElementById('onClickPositionView');
  var onIdlePositionView = document.getElementById('onIdlePositionView');

  // Initialize locationPicker plugin
  var lp = new locationPicker('map', {
    setCurrentPosition: true, // You can omit this, defaults to true
  }, {
    zoom: 15 // You can set any google map options here, zoom defaults to 15
  });

  // Listen to button onclick event
  confirmBtn.onclick = function () {
    // Get current location and show it in HTML
    var location = lp.getMarkerPosition();
    document.getElementById('lat_input').value = location.lat;
    document.getElementById('long_input').value = location.lng;
    onClickPositionView.innerHTML = 'The chosen location is ' + location.lat + ',' + location.lng;
   
  };    

  // Listen to map idle event, listening to idle event more accurate than listening to ondrag event
  google.maps.event.addListener(lp.map, 'idle', function (event) {
    // Get current location and show it in HTML
    var location = lp.getMarkerPosition();
    onIdlePositionView.innerHTML = 'The chosen location is ' + location.lat + ',' + location.lng;

  });

</script>  
@endsection

@section('head')
<script type="text/javascript"
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBR2HIEq1bixHiWwg4t4AyQvElMzApekCQ"></script>
<script src="https://unpkg.com/location-picker/dist/location-picker.min.js"></script>
<style type="text/css">
#map {
width: 100%;
height: 480px;
}
</style>
@endsection