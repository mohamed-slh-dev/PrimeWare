@extends('layouts.customer-app')

@section('content')
<div class="container-fluid">
<form action="{{ route('customer.update.location') }}" method="post">
  <div class="row">
 
       {{-- method fields --}}
       @method('POST')
       @csrf
<input type="hidden" class="form-control" id="lat_input" name="lat" >
<input type="hidden"  class="form-control" id="long_input" name="long" >


<h4 class="m-3">Select a location!</h4><br>
<div class="col-12 text-center my-4">
  <button id="currentLoc" type="button" style="width:auto" class="btn btn-sm p-2 btn-outline-warning profile-location-button showpage-action-buttons text-center" > <i class="fas fa-map-marker-alt "></i> My Current location</button>
  </div>
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

currentLoc.onclick = function () {
 
  var lp = new locationPicker('map', {
 setCurrentPosition: true, // You can omit this, defaults to true
}, {
 zoom: 15 // You can set any google map options here, zoom defaults to 15
});

};

// Listen to button onclick event
confirmBtn.onclick = function () {
 // Get current location and show it in HTML and put it on inputs
 var location = lp.getMarkerPosition();
 document.getElementById('lat_input').value = location.lat;
 document.getElementById('long_input').value = location.lng;
 onClickPositionView.innerHTML = 'The chosen location is ' + location.lat + ',' + location.lng;
 onIdlePositionView.innerHTML = 'The chosen location is ' + location.lat + ',' + location.lng;


};    

// Listen to map idle event, listening to idle event more accurate than listening to ondrag event
google.maps.event.addListener(lp.map, 'idle', function (event) {
 // Get current location and show it in HTML
 var location = lp.getMarkerPosition();
 onIdlePositionView.innerHTML = 'The chosen location is ' + location.lat + ',' + location.lng;

});

</script>  
    
@endsection