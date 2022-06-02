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
    <link href="{{ asset('assets/customstyle.css')}}" rel="stylesheet" type="text/css" />


</head>

<body data-layout="horizontal">

   

    <!-- Begin page -->
    <div id="layout-wrapper">


        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content" style="margin-top: 0px; padding:0px">
                <form action="{{ route('customer.login') }}" method="post">
                     {{-- method fields --}}
                     @method('POST')
                     @csrf
                 <div class="container-fluid">


                

                    <!-- login section -->
                    <div class="row align-items-center" style="background: rgb(42, 42, 42)">



                        <div class="col-12">
                            <img src="{{ asset('assets/img/Prime-logo1.gif') }}" class="login-logo" alt="Logo">
                        </div>



                        <!-- phone -->
                        <div class="col-12 profile-cols">
                                                
                            <p>
                                <input class="custom-control profile-custom-inputs" type="text" name="email" id="name" required="" placeholder="E-mail">
                            </p>
                        </div>
                        
                        
                        
                        
                        <!-- email -->
                        <div class="col-12 profile-cols">
                        
                            <p>
                                <input class="custom-control profile-custom-inputs mt-3" type="password" name="password" id="password" placeholder="Password">
                            </p>
                        </div>

                        
                        <!-- forget link -->
                        <div class="col-12 profile-cols">
                            <a href="#" class="text-white mt-3">
                                Forgot Password?
                            </a>
                        </div>


                        <!-- save button -->
                        <div class="col-sm-12 profile-cols">
                        
                            <button type="submit" style="width:100%; background-color: #fbbe00;" class="btn btn-warning mt-5">
                                Login
                            </button>
                        
                        </div>

                    </div>
                    <!-- end row -->





                 </div>
                <!-- container-fluid -->
              </form>
            </div>
            <!-- End Page-content -->

        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->



    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>




    <!--Morris Chart-->
    <script src="assets/libs/morris.js/morris.min.js"></script>
    <script src="assets/libs/raphael/raphael.min.js"></script>

    <!--  <script src="assets/js/pages/dashboard.init.js"></script> -->

    <script src="assets/js/app.js"></script>



</body>

</html>