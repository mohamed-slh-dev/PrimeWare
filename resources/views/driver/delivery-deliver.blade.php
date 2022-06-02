@extends('layouts.driver-app')

@section('content')
<div class="container-fluid" style="background:rgb(42, 42, 42);">



    <!-- title section -->
    <div class="row align-items-center"
        style="background:rgb(51,51,51); padding: 0px 20px !important; ">


        <div class="col-auto">
        <a href="{{route('driver.home')}}" class="menu-back-button">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>

        <div class="col-auto">
        <h3 class="ad-page-title mb-0">ORDER #{{$delivery_info->order_id}}</h3>
        </div>



    </div>




    <!-- main section row -->
    <div class="rowalign-items-center"
        style="background:rgb(42, 42, 42); padding: 0px 0px 20px 0px !important;">


            <!-- uppermapcol -->
            <div class="col-12 uppermapcol active px-0">

                <!--map div-->
                <div id="map"></div>
                <br>
            

                <button class="btn uppermapbutton">    
                    <i class="fa fa-chevron-up toggleicon"></i>
                </button>
            </div>
            


            <!-- lowermapcol appear when map is active -->
            <div class="col-12 lowermapcol mt-5">
                
                <div class="row">
                    <div class="col-6 text-right">
                        
                        <a href="tel:{{$delivery_info->phone}}" class="btn">
                            <i class="fa fa-phone-alt mr-2"></i>Call
                        </a>

                    </div>

                    <div class="col-6 text-left">
                    <a href="{{route('driver.customer.chat',[$delivery_info->order_id])}}" class="btn">
                            <i class="fa fa-comment mr-2"></i>Chat
                        </a>
                    </div>

                    <div class="col-12 text-center">
                        <a href="https://www.google.com/maps/search/?api=1&query={{ ltrim($delivery_info->link, '@') }}" target="_blank" style="width: 60%" class="btn mt-4">
                            <i class="fas fa-map-marker-alt mr-2"></i>Open Via Google Map
                        </a>
                    </div>

                </div>
                
            </div>
            <!-- end lowermapcol -->







            <!-- maincontentcol appear when map is inactive -->
            <div class="col-12 maincontentcol mt-5 d-none">
                

                <!-- card 1 -->
                <div class="card px-3 text-left home-middle-section home-middle-section-driver">
                
                    <!-- info 3 -->
                    <p class="font-size-12 font-weight-bold mb-2" style="color:rgb(254, 184, 0);">
                        Delivered To
                    </p>
                
                    <p class="mb-3 font-weight-bold">
                     Address : {{$delivery_info->address}} - block No. {{$delivery_info->block_number}} - Flat No. {{$delivery_info->flat_number}}    <br>
                      {{$delivery_info->city}} - {{$delivery_info->district}}
                    </p>
                
                    <form action="{{route('driver.delivery.deliver.status')}}" method="post" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                  
                    
                    <input type="hidden" name="delivery_id"  value="{{$delivery_info->order_id}}">

                    <p class="font-size-12 font-weight-bold mb-2" style="color:rgb(254, 184, 0);">
                      Returned Bag
                    </p>
                    
                    <div class="d-block mb-4">
                        <input class="home-searchinput map-priceinput" value="0" type="number" name="returned_bags" id="" placeholder="Returaned bags">
                    </div>

                    
                    <p class="font-size-12 font-weight-bold mb-2" style="color:rgb(254, 184, 0);">
                        Cash Collected
                    </p>
                    
                    <div class="d-block mb-4">
                        <input class="home-searchinput map-priceinput" value="0" type="number" name="cash" id="" placeholder="20 AED">
                    </div>




                    <div class="d-block mb-3">
                        <select placeholder="Search by District" class="custom-control custom-select home-searchselect map-statusselect" required name="status" id="">
                            <option value="" selected="" class="d-none">Order Status</option>
                        
                            <option style="color:green;" value="delivered">Delivered</option>
                            <option style="color:red;" value="canceled">Cancel</option>
                        
                        </select>
                    </div>
                    
                
                
                    <!-- status  and delivery button-->
                    <div class="row align-items-center">
            
                
                        <div class="col-12">
                            <label for="imginput" class="btn btn-none index-delivery-button py-3 px-2 font-size-13">
                                <i class="fa fa-camera facamera mr-2" style="font-size: 15px !important;"></i>Upload Photo
                            </label>

                            <input class="d-none" type="file" name="pic" id="imginput">

                        </div>

                        <div class="col-12 text-center mt-3">
                            
                    <button type="submit " style="width: 60%" class="btn btn-none index-delivery-button py-1 px-2 font-size-15">
                       Update Status
                    </button>
                        </div>
                    </div>
                </form>
                
                </div>
                <!-- card 1 -->
                
            
            </div>
            <!-- end maincontentcol -->



    </div>
    <!-- end row -->




</div>
<!-- container-fluid -->
@endsection

@section('scripts')

<script src="{{asset('assets/general-js/custom.js')}}"></script>


<script
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBR2HIEq1bixHiWwg4t4AyQvElMzApekCQ&callback=initMap&libraries=&v=weekly"
async
></script>




<script>

let map;
var lat = {!! json_encode($lat) !!};
var long = {!! json_encode($long) !!};

function initMap() {
  const mapOptions = {
    zoom: 14,
    center: { lat: lat, lng: long },
  };
  map = new google.maps.Map(document.getElementById("map"), mapOptions);
  const marker = new google.maps.Marker({
    // The below line is equivalent to writing:
    // position: new google.maps.LatLng(-34.397, 150.644)
    position: { lat: lat, lng: long },
    map: map,
  });
  // You can use a LatLng literal in place of a google.maps.LatLng object when
  // creating the Marker object. Once the Marker object is instantiated, its
  // position will be available as a google.maps.LatLng object. In this case,
  // we retrieve the marker's position using the
  // google.maps.LatLng.getPosition() method.
  const infowindow = new google.maps.InfoWindow({
    content: "<p>Marker Location:" + marker.getPosition() + "</p>",
  });
  google.maps.event.addListener(marker, "click", () => {
    infowindow.open(map, marker);
  });
}


</script>
    
@endsection

@section('head')

<style type="text/css">
    #map {
        width: 100%;
        height: 100%;
    }
</style>
    
@endsection