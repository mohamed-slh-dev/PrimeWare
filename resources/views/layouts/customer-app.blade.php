<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
         <title>PrimeWare - Delivery MS </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="PrimeWare Delivery Management system" name="description" />
        <meta content="TRUTH" name="author" />
        <!-- App favicon -->
      <!--   <link rel="shortcut icon" href="assets/images/favicon.ico"> -->

 <!-- plugin css -->
        <!-- Bootstrap Css -->
    <link href="{{ asset('assets/admins/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/admins/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/admins/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

    {{-- Other Style --}}
    <link href="{{ asset('assets/general.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/general-style.css') }}" rel="stylesheet" type="text/css" />


    <!-- custom style -->
    <link href="{{ asset('assets/my-style.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/customstyle.css')}}" rel="stylesheet" type="text/css" />

    @yield('head')
    </head>

    <body data-layout="horizontal">

        <!-- Loader -->
        {{-- <div id="preloader"><div id="status"><div class="spinner"></div></div></div> --}}

        <!-- Begin page -->
        <div id="layout-wrapper">

            
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">
                <div class="page-content" style="margin-top: 0px; padding:0px">
                    @include('alerts.alerts')
                   @yield('content')
                </div>
                <!-- End Page-content -->

                <footer class="footer" style="background:rgb(51,51,51); position:fixed; z-index:100;">
                    
                        <div class="row align-items-center home-footer">
                            <div class="col-3">
                            <a href="{{route('customer.home')}}">
                                    <i class="fas fa-home"></i>
                                </a>
                            </div>

                            <div class="col-3">
                                <a href="{{route('customer.myRestaurant')}}">
                                    <i class="fas fa-comment-dots"></i>
                                </a>
                            </div>

                            <div class="col-3">
                            <a href="{{route('customer.ads')}}">
                                    <i class="fas fa-ad"></i>
                                </a>
                            </div>

                            <div class="col-3">
                                <a href="{{route('customer.profile')}}">
                                    <i class="fas fa-user"></i>
                                </a>
                            </div>

                        </div>
                </footer>
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        @if (empty(session('customer_id')))
            
        <script>
            window.location.href = '/customer/index'; //dashboard of restaurant            
        </script>

        @endif

        
      
        <!-- JAVASCRIPT -->
        <script src="{{ asset('assets/general-js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/admins/assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/admins/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/admins/assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/admins/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/admins/assets/libs/node-waves/waves.min.js') }}"></script>
    

    @yield('scripts')

       <!--  <script src="assets/js/pages/dashboard.init.js"></script> -->

        {{-- <script src="{{asset('assets/js/app.js')}}"></script> --}}

      



    </body>

</html>