<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>PrimeWare</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="PrimeWare Delivery Management system" name="description" />
    <meta content="TRUTH" name="author" />


    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/admins/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet"
        type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/admins/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/admins/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

    {{-- Other Style --}}
    <link href="{{ asset('assets/general.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/general-style.css') }}" rel="stylesheet" type="text/css" />


    {{-- only for supplier --}}
    <link href="{{ asset('assets/custom-customer.css') }}" rel="stylesheet" type="text/css" />



    <!-- maps -->
    <script type="text/javascript"
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBR2HIEq1bixHiWwg4t4AyQvElMzApekCQ"></script>
    <script src="https://unpkg.com/location-picker@1.1.1/dist/location-picker.min.js"></script>
    <style type="text/css">
        #map {
            width: 100%;
            height: 480px;
            border: 1px solid white;
            border-radius: 5px;
        }

        * {
            scrollbar-width: thin;
        }


        .validation
        {
        color: black !important;
        margin-bottom: 20px;
        top: 0px;
        position: absolute;
        top: -32px;
        left: 95px;
        background-color: #ffffffeb;
        font-weight: 500;
        padding: 4px 9px;
        font-size: 13px;
        border-radius: 2px;
        }

    </style>

    
    <!-- end map -->



</head>




<body>



    {{-- pass the flavor and product to js --}}

    <script>
        
        var productsArray = @json($products);
        var flavorsArray = @json($all_flavors);
        var chargesArray = @json($chargefees);


    </script>


    {{-- end js --}}




    <div class="pt-5">
        <div class="container">
            
        <form action="{{route('supplier.addpurchase')}}" method="POST" id="myform">

            @csrf

            <div class="row">




                    <!-- tab 1 -->
                    <div id="tab-1" class="col-12 tab">
                    
                        

                        {{-- multistep form tab-2 checking --}}
                        <input type="hidden" class="tab-field-1" value="0">


                        <div class="row">
                    
                            <div class="col-12 text-center mt-4 mb-4">
                                <h4 class="cs-font-size-sm-21 cs-font-size-26">Products</h4>
                                <p class="text-secondary" style="font-size:17px;">Choose products and flavors</p>
                            </div>
                    
                    
                    
                            <div class="col-12">
                                <div class="row align-items-start text-center">
                    
                                    @php
                                        $i = 1;
                                    @endphp

                                    @foreach ($products as $product)
                                        
                                  
                                    <!-- card (repeat products)  -->
                                    <label class="col-sm-12 col-md-6 col-lg-4 cs-product-card">
            
                                        
            
                                        <div class="card card-group-row__card text-center o-hidden card--raised ">
            
                                            <div class="card-body d-flex flex-column">
                                                <div class=" mb-16pt">
            
                                                    <div class="d-block">
            
                                                    </div>
            
                                                    <span class="w-64 h-64 icon-holder icon-holder--outline-accent rounded-circle d-inline-flex mb-16pt mt-3">

                                                        <img width="150" height="150"
                                                            src="{{ asset('assets/supplier/images/products/'.$product->img) }}">
                                                    </span>


                                                    {{-- name --}}
                                                    <h4 class="mb-8pt carousal-card-heading mt-2">{{$product->name}}</h4>

                                                    {{-- cals --}}
                                                    {{-- <h6 class="mb-0 text-success" style="font-size:13px !important;">Price: {{$product->price}} (AED)</h6> --}}

                                                    <hr class="mt-2 w-50" style="border-color: whitesmoke">
                                                    {{-- Ingredients --}}
                                                    <h6 style="font-size: 14px !important;">Ingredients</h6>
                                                    <p class="mb-2"
                                                        style="font-weight: 600 !important; font-size: 13px !important; overflow:hidden; height: auto;">
                                                        {{$product->ingredients}}</p>

                                                    <div class="d-block text-center mb-4">
                                                        <a class="btn btn-secondary py-1 px-2 cs-font-size-12" data-toggle="modal" data-target=".facts-modal-{{$product->id}}">
                                                            Show Facts
                                                        </a>
                                                    </div>
                                                    
                                                    
                                                    {{-- hidden product id --}}
                                                <input type="hidden" id="add-flavor-product-{{$i}}" value="{{$product->id}}">


                                                {{-- hidden product available quantity for each flavor --}}
                                                @foreach ($product->flavors as $flavor)
                                                    <input type="hidden" id="product-available-quantity-{{$i}}-{{ $flavor->id }}" value="{{$flavor->available}}">
                                                @endforeach


                                                    {{-- flavor row --}}
                                                    <div class="row align-items-center mb-3" style="position: relative">
                                                        <div class="col-5">
                                                        <select name="product_flavor[]" id="add-flavor-select-{{$i}}" required="" class="form-control custom-select">
                                                                @foreach ($product->flavors as $flavor)
                                                                <option value="{{$flavor->id}}">{{$flavor->name}}</option>
                                                                @endforeach
                                                             
                                                            </select>
                                                        </div>
                                                        
                                                        <div class="col-4">
                                                        <input type="number" name="flavor_quantity[]" id="add-flavor-quantity-{{$i}}" class="form-control add-flavor-quantity" min="1" value="1">
                                                        </div>

                                                        <div class="col-3">
                                                        <button type="button" id="add-flavor-button-{{$i}}" class="btn btn-success w-100 add-flavor-button">
                                                                Add
                                                            </button>
                                                           
                                                        </div>
                                                    </div>
                                                    {{-- end row --}}




                                                    <!-- input quantity 1 -->
                                                <div id="flavor-wrapper-{{$i}}" class="flavor-wrapper" style="max-height: 136px; overflow:auto;">

                                                        
                                                    
                                                    </div>
                                                    {{-- end wrapper --}}

                                                    
                                                </div>
            
                                            </div>
            
            
                                        </div>
            
                                    </label>
                                    <!-- end card -->

                                  @php
                                      $i++ ;
                                  @endphp
                                    @endforeach
                                    
                    
                                </div>
                                {{-- end row --}}
                    
                    
                                
                    
                    
                            </div>
                            {{-- end col 12 --}}
                    
                    
                        </div>
                        {{-- end row --}}
            
        
                    </div>
                    <!-- end tab 2 -->









                    <div id="tab-2" class="col-12 tab" style="display:none">
                    
                    
                        <div class="row">
                    
                            <div class="col-12 text-center mt-4 mb-4">
                                <h4 class="cs-font-size-sm-21 cs-font-size-26">Please fill your contact info.</h4>
                            </div>
                    
                    
                    
                    
                            <!-- fname -->
                            <div class="col-12 col-md-5 offset-md-1 mb-2">
                                <input type="text" name="fname" class="form-control signup-input text-center mb-4 cs-select tab-field-2"
                                    placeholder="First Name" required>
                            </div>
                    
                            <!-- lname -->
                            <div class="col-12 col-md-5 mb-2">
                                <input type="text" name="lname" class="form-control signup-input text-center mb-4 cs-select tab-field-2"
                                    placeholder="Last Name" required>
                            </div>
                    
                    
                    
                    
                    
                            <!-- email -->
                            <div class="col-12 col-md-5 offset-md-1 mb-2">
                                <input type="email" name="email" class="form-control signup-input text-center mb-4 cs-select tab-field-2"
                                    placeholder="E-mail">
                            </div>
                    
                            <!-- hear from us -->
                            {{-- <div class="col-5 mb-2">
                                <select class="custom-select form-control signup-select mb-4 cs-select" name="" id="">
                                    <option value="" class="d-none" selected="">How you heard about us</option>
                    
                                    <option value="">Friend</option>
                                    <option value="">Family</option>
                                    <option value="">Doctor</option>
                                </select>
                            </div> --}}
                    
                    
                    
                    
                            <!-- phone -->
                            <div class="col-12 col-md-5 mb-2">
                                <input type="text" name="phone" class="form-control signup-input text-center mb-4 cs-select tab-field-2"
                                    placeholder="Mobile Number" required>
                            </div>
                    
                    
                            <!-- area -->
                            <div class="col-12 col-md-5 offset-md-1 mb-2">
                    
                                <select id="cityselect" required="" name="city"
                                    class="custom-select form-control signup-select mb-4 cs-select tab-field-2">
                    
                                    <option value="" selected="" class="d-none">City</option>
                    
                                    @foreach ($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endforeach
                    
                                </select>
                            </div>
                    
                    
                    
                            {{-- district --}}
                            <div class="col-12 col-md-5 mb-2">
                    
                    
                    
                                <select id="districtselect" required="" name="district"
                                    class="custom-select form-control signup-select mb-4 cs-select tab-field-2">
                    
                                    <option value="" selected="" class="d-none">District</option>
                    
                                    @foreach ($districts as $district)
                    
                                    <option class="d-none all-districts city-{{ $district->samedistrict->city_id }}"
                                        value="{{ $district->id }}">
                                        {{ $district->name }}
                                    </option>
                    
                                    @endforeach
                    
                                </select>
                            </div>
                    
                    
                    
                        </div>
                        <!-- end row -->
                    
                    </div>
                    <!-- end tab 1 -->






                    <!-- tab 3 -->
                    <div id="tab-3" class="col-12 tab" style="display:none">
                    
                    
                        <div class="row">
                    
                            <div class="col-12 text-center mt-4 mb-4">
                                <h4 class="cs-font-size-sm-21 cs-font-size-26">Confirm Delivery Address</h4>
                            </div>
                           
                    
                            <!-- email -->
                            <div class="col-12 col-md-5 offset-md-1 mb-2">
                                <input type="text" name="address" class="form-control signup-input text-center mb-4 cs-select tab-field-3" placeholder="Address">
                            </div>
                    

                            <!-- phone -->
                            <div class="col-12 col-md-5 mb-2">
                                <input type="number" name="block" class="form-control signup-input text-center mb-4 cs-select tab-field-3" placeholder="Block No."
                                    required>
                            </div>
                    


                            <!-- email -->
                            <div class="col-12 col-md-5 offset-md-1 mb-2">
                                <input type="number" name="floor" class="form-control signup-input text-center mb-4 cs-select tab-field-3" placeholder="Floor/Villa">
                            </div>
                    

                            <!-- phone -->
                            <div class="col-12 col-md-5 mb-2">
                                <input type="number" name="flat" class="form-control signup-input text-center mb-4 cs-select tab-field-3" placeholder="Flat No."
                                    required>
                            </div>
                    
                            
                            <div class="col-12">
                                <hr class="w-50" style="border-color:lightgrey">
                            </div>


                            {{-- map content --}}
                            <div class="col-12 mb-4">

                                <h5 class="text-center mb-3">Choose your current address or drag from a nearest landmak on map</h5>


                                
                                {{-- buttons --}}
                                <div class="text-center">

                                    <button id="currentLoc" type="button" class="btn btn-primary mr-2"><i class="fas fa-map-marked mr-2"></i>Current Location</button>

                                    <button id="confirmPosition" type="button" class="btn btn-outline-success">Confirm Position</button>

                                    {{-- confirm position value --}}
                                    <input type="hidden" id="confirmPositionInput" value="0">


                                    <!-- hidden marks -->
                                    <p class="d-none"><span id="onIdlePositionView"></span></p>
                                    
                                </div>

                            </div>



                            {{-- map --}}
                            <div class="col-12 col-md-10 offset-md-1">
                                <div id="map"></div>
                            </div>

                            
                            <br>
                            <div class="col-12 text-center">
                            <p><span id="onIdlePositionView"></span></p>
                            </div>
                               
                            <input type="hidden" class="form-control" id="lat_input" name="lat" >
                            <input type="hidden"  class="form-control" id="long_input" name="long" >
                    
                    
                        </div>
                        <!-- end row -->
                    
                    </div>
                    <!-- end tab 3 -->










                    <!-- tab 4 -->
                    <div id="tab-4" class="col-12 tab" style="display:none">
                    
                    
                        <div class="row px-2 px-md-0">
                    
                            <div class="col-12 text-center mt-4 mb-4">
                                <h4 class="cs-font-size-sm-21 cs-font-size-26">Summary</h4>
                            </div>
                    
                            

                            {{-- col 12 --}}
                            <div class="col-12 col-md-10 offset-md-1" style="background-color:#253242; border:1px solid #fcbc1278; border-radius:5px;">


                                {{-- product 1 --}}
                                <div class="row align-items-center mt-4 pb-3" style="border-bottom:1px solid #1e2835;">
                                    <div class="col-8 col-md-9" style="border-right:2px solid #fcbc1278;">
                                        <h5 class="ml-2 mb-0 cs-font-size-sm-17 cs-font-size-19" id="summary-products-wrapper"></h5>
                                        <p class="ml-2 mt-2" id="summary-flavors-wrapper">
                                            {{-- <span class="flavor-summary-span">Chocolate<span class="text-warning ml-1">(23)</span></span> --}}

                                        
                                        </p>
                                    </div>

                                    <div class="col-4 col-md-3">
                                        <p class="ml-2 mb-0 font-weight-bold" style="font-size:17px" id="summary-products-price"></p>
                                    </div>
                                </div>
                                {{-- end product 1 --}}
                                








                                {{-- delivery charge (fixed) --}}
                                <div class="row align-items-center mt-4 pb-3" style="border-bottom:1px solid #1e2835;">
                                    <div class="col-8 col-md-9" style="border-right:2px solid #fcbc1278;; height: 68px; display:flex; align-items:center;">
                                        <h5 class="ml-2 mb-0 cs-font-size-sm-17 cs-font-size-19">Delivery Charge</h5>
                                        
                                    </div>
                                
                                    <div class="col-4 col-md-3">
                                        <p class="ml-2 mb-0 font-weight-bold" style="font-size:17px" id="summary-delivery-price"></p>

                                        {{-- hidden input for delivery price --}}
                                        <input type="hidden" name="summary-delivery-price-input" id="summary-delivery-price-input">
                                    </div>
                                </div>
                                {{-- end product 2 --}}







                                {{-- result --}}
                                <div class="row align-items-center pt-3 pb-3" style="border-bottom:1px solid #1e2835; background-color:whitesmoke; border-bottom-left-radius: 3px; border-bottom-right-radius: 3px;">

                                    <div class="col-8 col-md-9" style="border-right:2px solid #fcbc1278;; height: 60px; display:flex; align-items:center;">
                                        <h5 class="ml-2 mb-0 text-semiblack-f cs-font-size-sm-18 cs-font-size-19">Total Amount</h5>
                                
                                    </div>
                                
                                    <div class="col-4 col-md-3">
                                        <p class="ml-2 mb-0 font-weight-bold text-semiblack-f d-inline-block cs-font-size-sm-16" style="font-size:17px; text-decoration: underline" id="summary-total-price"></p>
                                    </div>
                                </div>
                                {{-- end product 2 --}}



                            </div>
                            {{-- end col 10 --}}





                            <div class="col-12 col-md-10 offset-md-1 px-0 mt-3">

                                <div class="d-block text-left">
                                    <label for="" class="d-inline-block text-capitalize" style="font-size:17px;"><input type="checkbox" name="" id="" class="d-inline-block mr-2" disabled checked style="width: 20px; height: 17px;">Cash on delivery</label>
                                </div>


                            </div>




                            
                    
                        </div>
                        <!-- end row -->
                    
                    </div>
                    <!-- end tab 4 -->



                    <!-- next and previous buttons -->
                    <div class="col-12 text-right mt-4">
                        <div class="row">
                            <div class="col-12 col-md-11 text-right">
                                <button class="btn btn-outline-secondary px-5 mr-2" type="button" id="prevBtn"
                                    onclick="nextPrev(-1)">Previous</button>
                                <button class="btn btn-primary px-5" type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                            </div>
                        </div>
                    
                    </div>
                    
                    
                    
                    
                    <!-- Circles which indicates the steps of the form: -->
                    <div class="col-12 mt-5 text-center">
                        <span class="step"></span>
                        <span class="step"></span>
                        <span class="step"></span>
                    </div>

                  
             
            </div>

            </form>

        </div>
    </div>




    {{-- modal --}}
    
@foreach ($products as $product)
    
<div class="modal fade facts-modal-{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">

            <div class="modal-header mb-3" style="border-bottom: 2px solid lightgrey;">
                <h4 class="modal-title mt-0 font-weight-bold" id="myLargeModalLabel">Product Info</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


            <div class="modal-body">

                <div class="row">
                    <div class="col-12 text-center mb-4">
                        <img style="box-shadow:0px 0px 3px 0px grey; width: 60%; border-radius:4px; object-fit:contain"
                            src="{{ asset('assets/supplier/images/products/'.$product->img) }}" alt="">

                    </div>

                    
                    <div class="col-12">
                        <h5 class="text-center mb-4" style="text-decoration: underline;">Flavors</h5>
                    </div>

                    


                    <div class="col-12">
                        
                      
                            
                       
                        {{-- flavors --}}
                        <div class="row align-items-center products-flavors-row mb-5">

 
                            @foreach ($product->flavors as $flavor)
                            {{-- single --}}
                            <div class="col-12 col-md-12 mb-4">
                                <p class="text-center" style="font-size:18px"> {{$flavor->name}} <br><span style="font-size:14px; font-weight:500;">Available Quantity:<span class="ml-1 font-weight-bold text-success">{{$flavor->quantity}}</span></span></p>


                                <div class="row" style="border-bottom: 1px solid lightgrey; border-top: 1px solid lightgrey;">
                                    <div class="col-3 pt-2" style="border-right:1px solid lightgrey">
                                        <p class="text-center">
                                            Cals<br><span class="badge badge-primary w-75 py-1 font-weight-bold">{{$flavor->cals}}g</span>
                                        </p>
                                    </div>
                                    <div class="col-3 pt-2" style="border-right:1px solid lightgrey">
                                        <p class="text-center">
                                            Protein<br><span class="badge badge-primary w-75 py-1 font-weight-bold">{{$flavor->proteins}}g</span>
                                        </p>
                                    </div>
                                    <div class="col-3 pt-2" style="border-right:1px solid lightgrey">
                                        <p class="text-center">
                                            Carbs<br><span class="badge badge-primary w-75 py-1 font-weight-bold">{{$flavor->carbs}}g</span>
                                        </p>
                                    </div>
                                    
                                    <div class="col-3 pt-2">
                                        <p class="text-center">
                                            Fats<br><span class="badge badge-primary w-75 py-1 font-weight-bold">{{$flavor->fats}}g</span>
                                        </p>
                                    </div>
                                </div>
                              

                            </div>

                            {{-- end of single flavor --}}
                            @endforeach
                            

                        </div>


                    </div>

                    

                </div>

            </div>
            {{-- end modal body --}}
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

@endforeach


    {{-- end modal --}}


    
    {{-- scripts --}}
    
    <script src="{{ asset('assets/general-js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/admins/assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/admins/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/admins/assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/admins/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/admins/assets/libs/node-waves/waves.min.js') }}"></script>

    
    
    <!--Morris Chart-->
    <script src="{{ asset('assets/admins/assets/libs/morris.js/morris.min.js') }}"></script>
    <script src="{{ asset('assets/admins/assets/libs/raphael/raphael.min.js') }}"></script>
    
    <!--  <script src="assets/js/pages/dashboard.init.js"></script> -->
    
    <script src="{{ asset('assets/admins/assets/js/app.js') }}"></script>
    
    
    <script src="{{ asset('assets/general-js/general.js') }}"></script>
    <script src="{{ asset('assets/general-js/city-select.js') }}"></script>


    {{-- suppier form --}}
    <script src="{{ asset('assets/general-js/multistepform.js') }}"></script>


    {{-- new flavor --}}
    <script src="{{ asset('assets/general-js/new-flavor.js') }}"></script>




   



    <!-- map script -->
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
            onIdlePositionView.innerHTML = 'The chosen location is ' + location.lat + ',' + location.lng;


        };

        // Listen to map idle event, listening to idle event more accurate than listening to ondrag event
        google.maps.event.addListener(lp.map, 'idle', function (event) {
            // Get current location and show it in HTML
            var location = lp.getMarkerPosition();
            onIdlePositionView.innerHTML = 'The chosen location is ' + location.lat + ',' + location.lng;

        });

    </script>

    <!-- end map script -->

</body>


</html>