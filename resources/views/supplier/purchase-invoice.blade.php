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


    <style>
        .font-size-15 {
            font-size: 15px !important;
        }

        .table .thead-light th {
            border:none;
            border-bottom:1px solid #fb4;
            font-size: 14px !important;
        }

    

        .table td {
            border: none;

        }

        @media (min-width: 1px) and (max-width: 575px) {
            .font-size-sm-20 {
                font-size:20px !important;
            }

            .font-size-sm-16 {
            font-size:16px !important;
            }
        }
    </style>
</head>




<body>

    <div class="pt-0 pt-md-5">
        <div class="container">
            <div class="row align-items-center">


                <div class="col-12 mt-0 mt-md-4 mb-0 mb-md-5" style="background-color: #293749">


                    
                    <div class="row">

                        {{-- logo --}}
                        <div class="offset-1 col-10 mb-3">
                            

                            {{-- heading --}}
                            <div class="row align-items-end">
                                <div class="col-12 d-none d-md-block" style="position: relative">
                                    <h1 class="d-block text-center text-uppercase" style="letter-spacing: 0.5px; margin-top:70px; margin-bottom:45px;">Invoice</h1>

                                    <img class="login-logo" src="{{ asset('assets/partners/assets/images/Prime-logo1.png') }}" alt="logo" width="130" height="130" style="position: absolute; left:0px; top:0px">
                                </div>

                                
                                {{-- mobie view --}}
                                <div class="col-12 d-block d-md-none" style="position: relative">

                                    <p class="text-center mb-0">
                                        <img class="login-logo" src="{{ asset('assets/partners/assets/images/Prime-logo1.png') }}" alt="logo" width="150"
                                            height="50">
                                    </p>

                                    <h3 class="d-block text-center text-uppercase" style="letter-spacing: 0.5px; margin-bottom:45px;">
                                        Invoice</h3>
                                
                                    
                                </div>

                            </div>
                            






                            {{-- basic info --}}
                            <div class="row align-items-end pt-5">


                                {{-- client info + invoice --}}
                                <div class="col-12 col-md-6">
                                    <h4 class="mb-4">{{ $purchase->fname." ".$purchase->lname }}</h4>
                                    <p class="mb-1 font-size-15">Date Issued:<strong class="ml-2">{{ date('d M Y', strtotime($purchase->created_at)) }}</strong></p>
                                    <p class="font-size-15 d-inline-block">Tracking No:</p>
                                    <p class="ml-2 px-2 d-inline-block mb-0" style="border:2px solid #fb4; border-radius:2px; font-weight:bold;">{{ $purchase->tracking_number }}</p>
                                </div>
                                
                                
                                {{-- client address info --}}
                                <div class="col-12 col-md-6 text-left text-md-right">
                                    <p class="mb-1 font-size-15">{{ $purchase->address }}</p>
                                    <p class="mb-1 font-size-15">{{ $purchase->city->name }}, {{ $purchase->district->name }}</p>
                                    <p class="font-size-15">{{ $purchase->phone }}</p>
                                </div>

                            </div>






                            {{-- table of products (only desktop) --}}
                            <div class="row align-items-end pt-5 mt-3 pb-4 d-none d-md-block">

                                <div class="col-12">

                                    {{-- heeadings orw --}}
                                    <div class="row" style="border-bottom: 2px solid dimgrey; margin-bottom:30px">
                                        
                                        <div class="col-3">
                                            <h6 style="color:lightgrey;">Product</h6>
                                        </div>

                                        <div class="col-3">
                                            <h6 style="color:lightgrey;">Flavor</h6>
                                        </div>

                                        <div class="col-3">
                                            <h6 style="color:lightgrey;">Quantity</h6>
                                        </div>

                                        <div class="col-3">
                                            <h6 style="color:lightgrey;">Price</h6>
                                        </div>
                                    </div>



                                    {{-- summation --}}

                                    {{-- products row --}}
                                    <div class="row">

                                        @foreach ($purchase->items as $item)
                                            
                                        {{-- repeat this 4 col for each product --}}
                                        <div class="col-3 mb-2">
                                            <h5 class="font-size-sm-16">{{ $item->product->name }}</h5>
                                        </div>
                                        
                                        <div class="col-3 mb-2">
                                            <h5 class="font-size-sm-16">{{ $item->flavor->name }}</h5>
                                        </div>
                                        
                                        <div class="col-3 mb-2">
                                            <h5 class="font-size-sm-16">{{ $item->quantity }}</h5>
                                        </div>
                                        
                                        <div class="col-3 mb-2">
                                            <h5 class="font-size-sm-16">{{ $item->price }}</h5>
                                        </div>


                                        @endforeach




                                        <div class="col-3 pt-4 mb-2">
                                            <h5 class="font-size-sm-16" style="text-decoration: underline">Delivery Charge</h5>
                                        </div>
                                        
                                        <div class="col-3 pt-4 mb-2">
                                            <h5 class="font-size-sm-16">-</h5>
                                        </div>
                                        
                                        <div class="col-3 pt-4 mb-2">
                                            <h5 class="font-size-sm-16">-</h5>
                                        </div>
                                        
                                        <div class="col-3 pt-4 mb-2">
                                            <h5 class="font-size-sm-16">{{ $purchase->delivery_price }}</h5>
                                        </div>

                                    </div>



                                    {{-- total row --}}
                                    <div class="row" style="border-top: 2px solid dimgrey; margin-top:10px">

                                        <div class="col-3 mt-2">
                                            <h4>Total</h4>
                                        </div>

                                        <div class="col-3 mt-2">
                                            <h4>-</h4>
                                        </div>

                                        <div class="col-3 mt-2">
                                            <h4>-</h4>
                                        </div>

                                        <div class="col-3 mt-2">
                                            <h4 class="text-warning" style="text-decoration: underline">{{ $purchase->price + $purchase->delivery_price }} (AED)</h4>
                                        </div>

                                    </div>



                                    {{-- notes row --}}
                                    <div class="row" style="">

                                        <div class="col-12 mt-5 pt-2">
                                            
                                            <h6 style="font-size:17px;">
                                                <input type="checkbox" name="" id="" disabled checked style="width:20px; height:16px;">
                                                Cash On Delivery
                                            </h6>

                                            <h6 style="margin-top: 20px; font-size:17px;">
                                                Don't forget to keep "{{ $purchase->price + $purchase->delivery_price }}" ready in delivery, <span style="border-bottom:1px solid #fb4;">we only accept cash.</span>
                                            </h6>
                                            
                                        </div>
                                    </div>

                                </div>
                            </div>
                            {{-- end row --}}






                            {{-- mobile view table --}}
                            <div class="d-md-none">
                                <table class="table mt-4 mb-3">
                            
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Product</th>
                                            <th>Flavor</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                       
                                        </tr>
                                    </thead>
                            
                                    {{-- tbody --}}
                                    <tbody>
                            
                                        {{-- table row --}}
                                        
                                        @foreach ($purchase->items as $item)

                                        <tr>
                                            <td>{{ $item->product->name }}</td>
                                            <td>{{ $item->flavor->name }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>{{ $item->price }}</td>
                                        </tr>


                                        @endforeach
                                        
                                        <tr class="pt-4">
                                            <td style="text-decoration: underline">Delivery Charge</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>{{ $purchase->delivery_price }}</td>
                                        </tr>
                                        

                                        <tr style="border-top: 1px solid dimgrey">
                                            <td>Total</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td style="font-weight: bold; color:#fb4; text-decoration:underline">{{ $purchase->price + $purchase->delivery_price }} (AED)</td>
                                        </tr>
                            
                                    </tbody>
                                    {{-- end tbody --}}
                                </table>
                            </div>




                            {{-- notes row --}}
                            <div class="row d-block d-md-none" style="">
                            
                                <div class="col-12 mt-5 pt-2">
                            
                                    <h6 style="font-size:15px;">
                                        <input type="checkbox" name="" id="" disabled checked style="width:15px; height:15px; margin-right:5px;">
                                        Cash On Delivery
                                    </h6>
                            
                                    <h6 style="margin-top: 20px; font-size:15px;">
                                        Don't forget to keep "{{ $purchase->price + $purchase->delivery_price }}" ready in delivery, <span
                                            style="border-bottom:1px solid #fb4;">we only accept cash.</span>
                                    </h6>
                            
                                </div>
                            </div>


                        </div>
                        {{-- end col --}}
                    
                        
                    </div>

                </div>



            </div>
        </div>
    </div>




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



    {{-- new flavor --}}
    <script src="{{ asset('assets/general-js/new-flavor.js') }}"></script>


</body>


</html>