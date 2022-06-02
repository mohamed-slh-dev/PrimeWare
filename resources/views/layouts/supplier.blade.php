<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>PrimeWare - Delivery MS </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="PrimeWare Delivery Management system" name="description" />
    <meta content="TRUTH" name="author" />
    <!-- App favicon -->
    
    <!--  <link rel="shortcut icon" href="assets/images/favicon.ico"> -->

    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/partners/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet"
        type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/partners/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/partners/assets/css/app.min.css') }}" id="app-style" rel="stylesheet"
        type="text/css" />

    <link href="{{ asset('assets/partners/assets/css/general-style.css') }}" rel="stylesheet" type="text/css" />

    {{-- Other Style --}}
    <link href="{{ asset('assets/general.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/general-style.css') }}" rel="stylesheet" type="text/css" />
    
    
    {{-- only for supplier --}}
    <link href="{{ asset('assets/custom-customer.css') }}" rel="stylesheet" type="text/css" />

    

    
</head>




<body data-layout="horizontal">

    


    {{-- end of check screen is locked --}}

    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner"></div>
        </div>
    </div>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box">
                        <a href="" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="{{ asset('assets/partners/assets/images/Prime-logo1.png') }}" alt=""
                                    width="150" height="100">
                            </span>
                            <span class="logo-lg">
                                <img src="{{ asset('assets/partners/assets/images/Prime-logo1.png') }}" alt=""
                                    width="130" height="70"> </span>
                        </a>

                         <a href="{{ route('supplier.home') }}" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="{{ asset('assets/admins/assets/images/Prime-logo1.png') }}" alt="" width="100" height="70"> </span>
                            <span class="logo-lg">
                                <img src="{{ asset('assets/admins/assets/images/Prime-logo1.png') }}" alt="" width="110" height="70"> </span>
                        </a>
                        
                    </div>


                    <button type="button"
                        class="btn btn-sm mr-2 font-size-24 d-lg-none header-item waves-effect waves-light"
                        data-toggle="collapse" data-target="#topnav-menu-content">
                        <i class="mdi mdi-menu"></i>
                    </button>

                </div>

                <div class="d-flex">

                    <div class="dropdown d-none d-md-block ml-2">
                        <button type="button" class="btn header-item waves-effect" data-toggle="dropdow"
                            aria-haspopup="true" aria-expanded="false">
                            <img class="mr-2" src="{{ asset('assets/partners/assets/images/flags/us_flag.jpg') }}"
                                alt="Header Language" height="16">
                            English <span class="mdi mdi-chevron-down"></span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">

                            <!-- item-->
                            {{-- <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <img src="{{ asset('assets/partners/assets/images/flags/germany_flag.jpg') }}"
                                    alt="user-image" class="mr-1" height="12"> <span class="align-middle"> German
                                </span>
                            </a> --}}

                            <!-- item-->
                            {{-- <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <img src="{{ asset('assets/partners/assets/images/flags/italy_flag.jpg') }}"
                                    alt="user-image" class="mr-1" height="12">
                                <span class="align-middle"> Italian </span>
                            </a> --}}

                            <!-- item-->
                            {{-- <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <img src="{{ asset('assets/partners/assets/images/flags/french_flag.jpg') }}"
                                    alt="user-image" class="mr-1" height="12"> <span class="align-middle"> French
                                </span>
                            </a> --}}

                            <!-- item-->
                            {{-- <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <img src="{{ asset('assets/partners/assets/images/flags/spain_flag.jpg') }}"
                                    alt="user-image" class="mr-1" height="12">
                                <span class="align-middle"> Spanish </span>
                            </a> --}}

                            <!-- item-->
                            {{-- <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <img src="{{ asset('assets/partners/assets/images/flags/russia_flag.jpg') }}"
                                    alt="user-image" class="mr-1" height="12"> <span class="align-middle"> Russian
                                </span>
                            </a> --}}
                        </div>
                    </div>

                    <div class="dropdown d-none d-lg-inline-block">
                        <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                            <i class="mdi mdi-fullscreen"></i>
                        </button>
                    </div>


                    {{-- notifications --}}
                    <div class="dropdown d-inline-block ml-2">
                        <button id="remove_notif" type="button" class="btn header-item noti-icon waves-effect"
                            id="page-header-notifications-dropdown" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="ion ion-md-notifications"></i>

                            {{-- notification count --}}
                          
                                <span id="notification-pill" class="badge badge-danger badge-pill" style="position: initial;"></span>
                          

                        </button>

                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
                            aria-labelledby="page-header-notifications-dropdown">
                            <div class="p-3">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h5 class="m-0 font-size-16"> Notifications (1) </h5>
                                    </div>
                                </div>
                            </div>
                            <div data-simplebar style="max-height: 280px;">
                               



                                {{-- notification --}}
                                <a href="#" class="text-reset notification-item">
                                    <div class="media">
                                        <div class="avatar-xs mr-3">
                                            <span class="avatar-title bg-success rounded-circle font-size-16">
                                                <i class="mdi mdi-check"></i>
                                            </span>
                                        </div>
                                        <div class="media-body">
                                            <h6 class="mt-0 font-size-15 mb-1"></h6>
                                            <div class="font-size-12 text-muted">
                                                <p class="mb-1"></p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                {{-- end nofitication --}}

                                

                            </div>
                       
                        </div>
                    </div>

                    <div class="dropdown d-inline-block ml-2">
                        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="rounded-circle header-profile-user"
                                src="{{ asset('assets/img/suppliers/logos/'.session()->get('supplier_logo')) }}"
                                alt="Avatar">
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <!-- item-->
                            <a class="dropdown-item" href="{{ route('supplier.settings') }}"><i
                                    class="dripicons-user font-size-16 align-middle mr-2"></i> Profile</a>
                           
                           
                            {{-- <a class="dropdown-item" href="{{ route('otherpartner.otherpartnerlock') }}"><i
                                    class="dripicons-lock font-size-16 align-middle mr-2"></i> Lock screen</a> --}}

                            <div class="dropdown-divider"></div>

                            {{-- logout --}}
                            <a class="dropdown-item" href="{{ route('supplier.logout') }}"><i
                                    class="dripicons-exit font-size-16 align-middle mr-2"></i> Logout</a>
                        </div>
                    </div>

                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                            <i class="mdi mdi-spin mdi-cog"></i>
                        </button>
                    </div>

                </div>
            </div>



            {{-- links --}}
            <div class="topnav">
                <div class="container-fluid">
                    <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

                        <div class="collapse navbar-collapse" id="topnav-menu-content">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('supplier.home') }}">
                                        <i class="dripicons-device-desktop mr-2"></i>Dashboard
                                    </a>
                                </li>


                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-advanced-ui"
                                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="dripicons-document  mr-2"></i>Products
                                        <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-advanced-ui">

                                        <a href="{{ route('supplier.products') }}" class="dropdown-item">All Products</a>

                                        <a href="{{ route('supplier.manageproducts') }}" class="dropdown-item">Manage Products</a>
            
                                    </div>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('supplier.deliveries') }}">
                                        <i class="dripicons-device-desktop mr-2"></i>Deliveries
                                    </a>
                                </li>




                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-advanced-ui"
                                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="dripicons-document  mr-2"></i>Reports
                                        <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-advanced-ui">
                                    
                                        <a href="{{ route('supplier.reports') }}" class="dropdown-item">Deliveries Reports</a>


                                    </div>
                                </li>

                            

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-advanced-ui"
                                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="dripicons-gear  mr-2"></i>Settings
                                        <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-advanced-ui">

                                        {{-- general settings --}}
                                        <a href="{{ route('supplier.settings') }}" class="dropdown-item">General Settings</a>
                                 


                                    </div>
                                </li>

                            </ul>
                        </div>
                    </nav>
                </div>
            </div>



            {{-- another thing in header but moved to content file --}}



            {{-- header is closed in content files --}}
            {{-- </header> --}}


            @include('alerts.alerts')

            {{-- page content --}}
            @yield('content')








            {{-- scripts --}}

            <!-- JAVASCRIPT -->
            <script src="{{ asset('assets/general-js/jquery-3.6.0.min.js') }}"></script>
            <script src="{{ asset('assets/partners/assets/libs/jquery/jquery.min.js') }}"></script>
            <script src="{{ asset('assets/partners/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
            <script src="{{ asset('assets/partners/assets/libs/metismenu/metisMenu.min.js') }}"></script>
            <script src="{{ asset('assets/partners/assets/libs/simplebar/simplebar.min.js') }}"></script>
            <script src="{{ asset('assets/partners/assets/libs/node-waves/waves.min.js') }}"></script>


            <!--Morris Chart-->
            <script src="{{ asset('assets/partners/assets/libs/morris.js/morris.min.js') }}"></script>
            <script src="{{ asset('assets/partners/assets/libs/raphael/raphael.min.js') }}"></script>


            <script src="{{ asset('assets/partners/assets/js/app.js') }}"></script>

            
            <script src="{{ asset('assets/general-js/general.js') }}"></script>
            <script src="{{ asset('assets/general-js/new-product.js') }}"></script>

            <script src="{{ asset('assets/general-js/city-select.js') }}"></script>

            <script>
                $('#special-form').hide();
            $("#check_id").click(function() {
            if($(this).is(":checked")) {
                $("#special-form").show(300);
            } else {
                $("#special-form").hide(200);
            }
        });
            </script>






            {{-- check if not authenticated to this restaurants layout --}}
            @if (empty(session('supplier_id')))


        
            <script>
                window.location.href = '/supplier/login'; //dashboard of otherpartners            
            </script>

            @endif




            {{-- print scripts --}}
            
            <script>
                // restaurant reports
                    function printDiv(targetid) {
            
                    var divToPrint=document.getElementById(targetid);
                    var headContent = document.getElementsByTagName('head')[0].innerHTML;
            
                
            
                    w=window.open(null, 'Print_Page', 'scrollbars=yes');
                    w.document.write('<html>'+headContent+'<body><style> .card { border: none !important;} .print-buttons { display:none; } .printimagediv { display:block; } .pagination { display:none; } .table th, .table td { min-width: auto !important; max-width: auto !important; } </style>'+$(divToPrint).html()+'</body></html>');
                        
                    setTimeout( () => {
                    w.print();
                    w.close();
                    }, 2500);
            
            
            
                    
                    }
            
            
                    // function print() {
                        
                    // }
            
            </script>
            
            
            
            {{-- end print scripts --}}

            




            {{-- check if screen is locked --}}
            @if (session('otherpartner_lock') == "locked")     
            
            <script>
                
                window.location.href = '/partner/lock';

            </script>

            @endif





            {{-- notification seen to 0 using ajax --}}
            <script>
                $('#remove_notif').click(function() {
            
                        $('#remove_notif_form').submit();
            
                    });
            
                    
                    $('#remove_notif_form').submit(function(e) {
            
                        e.preventDefault();
            
            
                        // get token
                        let _token = $('input[name=_token]').val();
                        $.ajax({
                            type: 'POST',
                            url:"{{ route('otherpartner.removenotifications') }}",
                            data: {
                                _token:_token
                            },
            
                            // alert message or something
                            success:function(response) {
                                
                                $('#notification-pill').addClass('d-none');
                            }
                        });
            
                        
            
                    });
            
            </script>



            
          
                <script>
                    Morris.Donut({
                    element: 'pie-chart',
                    data: [
                        {label: 'Delivered', value: 21},
                        {label: 'Canceled', value: 2}
                    
                    ]
                    });
                </script>
        

        <!-- for the other customer orders input -->
        <script>
            function otherBackage() {

                var option = document.getElementById("package-select").value;

                if (option == 'other') {

                    document.getElementById("other-backage").classList.remove("d-none");
                    $('#other-backage-input').prop('required', true);
                }
                
                else{
                    $('#other-backage-input').prop('required', false);
                    document.getElementById("other-backage").classList.add("d-none");
                }
                
            } //end function

            function otherLocation() {

                var option = document.getElementById("location-select").value;
                
                if (option == 'otherlocation') {
                    document.getElementById("other-location").classList.remove("d-none");
                    $('#other-location-input').prop('required', true);
                }
                
                else{

                    $('#other-location-input').prop('required', false);
                    document.getElementById("other-location").classList.add("d-none");

                }
             
            } //end function

        </script>


</body>

</html>