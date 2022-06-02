<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>PrimeWare</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />


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

    <style>
        .btn-outline-success {
            color: #fcbc12;
            border-color: #fcbc12;
        }

        .btn-outline-success:hover {
            color: #f8f9fa;
            background-color: #fcbc12;
            border-color: #fcbc12;
        }

        .btn-outline-success:not(:disabled):not(.disabled):active,
        .btn-outline-success:not(:disabled):not(.disabled).active,
        .show>.btn-outline-success.dropdown-toggle {
            color: #f8f9fa;
            background-color: #fcbc12;
            border-color: #fcbc12;
        }

        .btn-outline-success:focus {
            box-shadow: 0 0 0 .15rem rgba(221, 111, 46, 0.5);
        }
    </style>

</head>

<body class="account-bg">

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
                                    <a href="javascript:void(0);"><img class="login-logo"
                                            src="{{ asset('assets/partners/assets/images/OnTime-logo.png') }}"
                                            height="90" width="300" alt="logo"></a>
                                </div>
                            </div>


                            {{-- headings --}}
                            <div class="p-3">
                                <h4 class="font-size-18 text-muted mt-2 text-center">Locked.</h4>
                                <p class="text-muted text-center mb-4">Hello {{ session()->get('partner_name') }},
                                    enter your password to unlock the screen</p>


                                {{-- login form --}}
                                <form action="{{ route('partner.partnerunlock') }}" method="post">

                                    {{-- method fields --}}
                                    @method('POST')
                                    @csrf



                                    {{-- password --}}
                                    <div class="form-group">
                                        <label for="userpassword">Password</label>
                                        <input required="" name="password" type="password" class="form-control"
                                            id="userpassword" placeholder="">
                                    </div>

                                    {{-- remember me + submit button--}}
                                    <div class="form-group row mt-4">

                                        <div class="col-sm-6">
                                            <div class="custom-control custom-checkbox">

                                            </div>
                                        </div>

                                        <div class="col-sm-6 text-right">
                                            <button class="btn btn-primary w-md waves-effect waves-light"
                                                type="submit">Unlock</button>
                                        </div>

                                    </div>
                                    {{-- end row --}}


                                    {{-- forgot password --}}
                                    <div class="form-group mb-0 row align-items-center">

                                    </div>


                                    {{-- Switch to User --}}
                                    <div class="form-group mb-0 row">

                                    </div>

                                </form>
                                {{-- end form --}}


                            </div>
                        </div>
                    </div>


                    {{-- make account --}}
                    <div class=" text-center mt-4">

                        {{-- <p>Don't have an account ? <a href="javascript:void(0);" class="font-weight-bold text-primary"> Signup Now </a> </p> --}}

                        <a href="https://truth-solutions.com">
                            <p>© 2021 developed with <i class="mdi mdi-heart text-danger"></i> by TRUTH</p>

                        </a>
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