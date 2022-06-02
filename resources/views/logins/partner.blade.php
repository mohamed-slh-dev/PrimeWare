
{{-- delete all session when you in this page --}}
<?php

// admins
session()->forget('user_name');
session()->forget('user_id');
session()->forget('user_avatar');
session()->forget('user_lock');

// restaurants
session()->forget('partner_name');
session()->forget('partner_id');
session()->forget('partner_logo');
session()->forget('partner_lock');

// partners
session()->forget('otherpartner_name');
session()->forget('otherpartner_id');
session()->forget('otherpartner_logo');
session()->forget('otherpartner_lock');

?>






<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>PrimeWare</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
   
    
    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/admins/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/admins/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/admins/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

    {{-- Other Style --}}
    <link href="{{ asset('assets/general.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/general-style.css') }}" rel="stylesheet" type="text/css" />

    <style>
        .btn-outline-success {
  color: #fcbc12;
  border-color: #fcbc12; }
  .btn-outline-success:hover {
    color: #f8f9fa;
    background-color: #fcbc12;
    border-color: #fcbc12; }

     .btn-outline-success:not(:disabled):not(.disabled):active, .btn-outline-success:not(:disabled):not(.disabled).active,
  .show > .btn-outline-success.dropdown-toggle {
    color: #f8f9fa;
    background-color: #fcbc12;
    border-color: #fcbc12; 
  }
   .btn-outline-success:focus{
    box-shadow: 0 0 0 .15rem rgba(221, 111, 46, 0.5);
  }

  .account-bg {
    background: url('{{asset('assets/img/dashboard-login-background1.gif')}}');
    background-repeat: no-repeat;
    background-size: cover;
}
    </style>
</head>

<body class="account-bg" >

    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner"></div>
        </div>
    </div>

    <div class="account-pages pt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card mb-0">
                        <div class="card-body pb-0">


                            {{-- logo --}}
                            <div class="text-center">
                                <div class="">
                                    <a href="javascript:void(0);"><img class="login-logo" src="{{ asset('assets/partners/assets/images/Prime-logo1.png') }}" height="90"
                                            width="150" alt="logo"></a>
                                </div>
                            </div>


                            {{-- headings --}}
                            <div class="p-3">
                                <h4 class="font-size-18 text-muted mt-2 text-center">Welcome To Restaurants Portal !</h4>
                                <p class="text-muted text-center mb-4">Sign in to continue to RESTAURANTS dashboard.</p>


                                {{-- login form --}}
                                <form action="{{ route('partner.checkuser') }}" method="post">
                                
                                    {{-- method fields --}}
                                    @method('POST')
                                    @csrf

                                    {{-- username --}}
                                    <div class="form-group">
                                        <label for="username">Portal Email</label>
                                        <input required="" name="email" type="email" class="form-control" id="username"
                                            placeholder="">
                                    </div>

                                    {{-- email --}}
                                    <div class="form-group">
                                        <label for="userpassword">Password</label>
                                        <input required="" name="password" type="password" class="form-control" id="userpassword" placeholder="">
                                    </div>

                                    {{-- remember me + submit button--}}
                                    <div class="form-group row mt-4">

                                        <div class="col-sm-6">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input"
                                                    id="customControlInline">
                                                <label class="custom-control-label" for="customControlInline">Remember
                                                    me</label>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 text-right">
                                            <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Login</button>
                                        </div>

                                    </div>
                                    {{-- end row --}}

                                    
                                    {{-- forgot password --}}
                                    <div class="form-group mb-0 row align-items-center">
                                        <div class="col-sm-6 mt-3">
                                            <a href="javascript:void(0);" class="text-muted"><i class="mdi mdi-lock"></i> Forgot your password ?</a>
                                        </div>

                                        {{-- <div class="col-sm-6 text-right mt-2">
                                            <a href="{{ route('admin.login') }}" class="btn login-switch-button w-md waves-effect waves-light">Switch To User</a>
                                        </div> --}}

                                    </div>

                                    {{-- Switch to User --}}
                                    <div class="form-group mb-0 row">
                                        
                                    </div>

                                </form>
                                {{-- end form --}}
                                <div class="form-group row mt-4">
                                    <div class="col-sm-4 text-center my-2">
                                    <a href="{{route('admin.login')}}">
                                        <button class="btn btn-outline-success waves-effect waves-light font-size-12" >Admin Portal</button>
                                    </a>
                                </div>
                                <div class="col-sm-4 text-center my-2">
                                    <a href="javascript:void(0);">
                                        <button type="button" class=" active btn btn-outline-success waves-effect waves-light font-size-12">Rest. Portal</button>
                                    </a>
                                </div>
                                <div class="col-sm-4 text-center my-2">
                                    <a href="{{route('otherpartner.login')}}">
                                        <button class="btn btn-outline-success waves-effect waves-light font-size-12" type="submit">Partners Portal</button>
                                    </a>
                                </div>

                                   
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    {{-- make account --}}
                    <div class=" text-center">

                        <h4 class="text-center" style="color: black">   Powered By <span style=""> <a href="http://truth.ae" target="_blank">
                            <img src="{{asset('assets/img/truth-logo-1.png')}}" alt="">
                        </a>
                           </span> 
                        </h4>  
                    </div>
                    {{-- end make account --}}
                </div>
            </div>
        </div>
    </div>


    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets/admins/assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/admins/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/admins/assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/admins/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/admins/assets/libs/node-waves/waves.min.js') }}"></script>

    <script src="{{ asset('assets/admins/assets/js/app.js') }}"></script>

</body>

</html>