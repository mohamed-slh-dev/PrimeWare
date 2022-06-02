<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>PrimeWare - Delivery MS </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="PrimeWare Delivery Management system" name="description" />
    <meta content="TRUTH" name="author" />
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}" /> --}}
    <!-- App favicon -->
    <!--   <link rel="shortcut icon" href="assets/images/favicon.ico"> -->



    <!-- plugin css -->
    <link href="{{ asset('assets/admins/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet"
        type="text/css" />
    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/admins/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/admins/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/admins/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">

    <link href="{{ asset('assets/admins/assets/css/general-style.css') }}" rel="stylesheet" type="text/css" />

    {{-- general (lastly added) --}}
    <link href="{{ asset('assets/general.css') }}" rel="stylesheet" type="text/css" />

</head>








{{-- body --}}
<body data-layout="horizontal">

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
                        <a href="{{ route('admin.dashboard') }}" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="{{ asset('assets/admins/assets/images/Prime-logo1.png') }}" alt="" width="150" height="100">
                            </span>
                            <span class="logo-lg">
                                <img src="{{ asset('assets/admins/assets/images/Prime-logo1.png') }}" alt="" width="130" height="70"> </span>
                        </a>

                        <a href="{{ route('admin.dashboard') }}" class="logo logo-light">
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
                            <img class="mr-2" src="{{ asset('assets/admins/assets/images/flags/us_flag.jpg') }}" alt="Header Language" height="16">
                            English <span class="mdi mdi-chevron-down"></span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">

                            <!-- item-->
                            {{-- <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <img src="{{ asset('assets/admins/assets/images/flags/russia_flag.jpg') }}" alt="user-image" class="mr-1"
                                    height="12"> <span class="align-middle"> Russian </span>
                            </a> --}}
                        </div>
                    </div>

                    <br>
                    <div class="dropdown d-none d-lg-inline-block">
                        <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                            <i class="mdi mdi-fullscreen"></i>
                        </button>
                    </div>



                    {{-- get notification number --}}
                    <?php $notifications = \App\Models\UserNotification::whereNotNull('partner_id')->orWhereNotNull('otherpartner_id')->orderBy('created_at', 'DESC')->get(); ?>


                    <div class="d-none">
                        <form id="remove_notif_form">
                            @csrf
                        </form>
                    </div>

                    <div class="dropdown d-inline-block ml-2">
                        <button id="remove_notif" type="button" class="btn header-item noti-icon waves-effect"
                            id="page-header-notifications-dropdown" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="ion ion-md-notifications"></i>

                            {{-- notification count --}}
                            @if ($notifications->sum('seen') > 0)
                                <span id="notification-pill" class="badge badge-danger badge-pill" style="position: initial;">{{ $notifications->sum('seen') }}</span>
                            @endif

                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
                            aria-labelledby="page-header-notifications-dropdown">
                            <div class="p-3">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h5 class="m-0 font-size-16"> Notifications ({{ $notifications->count() }}) </h5>
                                    </div>
                                </div>
                            </div>
                            <div data-simplebar style="max-height: 280px;">


                                {{-- not used only hidden --}}
                                <a href="" class="text-reset notification-item d-none">
                                    <div class="media">
                                        <div class="avatar-xs mr-3">
                                            <span class="avatar-title bg-warning rounded-circle font-size-16">
                                                <i class="mdi mdi-timer-sand "></i>
                                            </span>
                                        </div>
                                        <div class="media-body">
                                            <h6 class="mt-0 font-size-15 mb-1">One Time Delivery Requested</h6>
                                            <div class="font-size-12 text-muted">
                                                <p class="mb-1">Eat Clean Create One Time Delivery</p>
                                            </div>
                                        </div>
                                </a>
                                {{-- hidden --}}

                            </div>


                            {{-- notification loop --}}
                            @foreach ($notifications as $notif)
                                
                            <a href="{{ !empty($notif->linkroute) ? route($notif->linkroute) : "#" }}" class="text-reset notification-item">
                                <div class="media">
                                    <div class="avatar-xs mr-3">
                                        <span class="avatar-title bg-success rounded-circle font-size-16">
                                            <i class="mdi mdi-check"></i>
                                        </span>
                                    </div>
                                    <div class="media-body">
                                        <h6 class="mt-0 font-size-15 mb-1">{{ $notif->shortinfo }}</h6>
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-1">{{ $notif->longinfo }}</p>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            @endforeach

                        </div>
                        {{-- <div class="p-2 border-top">
                            <a class="btn btn-sm btn-link font-size-14 btn-block text-center" href="javascript:void(0)">
                                View All
                            </a>
                        </div> --}}
                    </div>
                </div>

                <div class="dropdown d-inline-block ml-2">
                    <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="rounded-circle header-profile-user" src="{{ asset('assets/img/admins/profiles/'.session()->get('user_avatar')) }}"
                            alt="Avatar">
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <!-- item-->
                        <a class="dropdown-item" href="{{ route('admin.profile') }}"><i class="dripicons-user font-size-16 align-middle mr-2"></i>
                            Profile</a>

                        <a class="dropdown-item d-block" href="{{ route('admin.generalsettings') }}"><i
                                class="dripicons-gear font-size-16 align-middle mr-2"></i> Settings</a>

                        <a class="dropdown-item" href="{{ route('admin.adminlock') }}"><i class="dripicons-lock font-size-16 align-middle mr-2"></i> Lock screen</a>

                        <div class="dropdown-divider"></div>

                        {{-- logout --}}
                        <a class="dropdown-item" href="{{ route('admin.logout') }}"><i class="dripicons-exit font-size-16 align-middle mr-2"></i> Logout</a>
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
                        <li class=" d-none nav-item" id="dashboard">
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                                <i class="dripicons-device-desktop mr-2"></i>Dashboard
                            </a>
                        </li>
    
    
    
                        <li class="d-none nav-item dropdown" id="partners">
                            <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-advanced-ui" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="dripicons-user-group  mr-2"></i>Partners
                                <div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnav-advanced-ui">
    
                                <a href="{{ route('admin.partners') }}" class="dropdown-item">All Restaurants</a>
    
                                <a href="{{ route('admin.managepartners') }}" class="dropdown-item">Manage Restaurants</a>
    
                                {{-- <a href="#" class="dropdown-item">Restaurants Finance</a> --}}
    
                                <a href="{{ route('admin.requestpartners') }}" class="dropdown-item">Restaurants
                                    Requests</a>
    
                                {{-- other partners --}}
                                <a href="{{ route('admin.otherpartners') }}" class="dropdown-item">All Other Partners</a>
                                <a href="{{ route('admin.manageotherpartners') }}" class="dropdown-item">Manage Other
                                    Partners</a>
    
                                {{-- <a href="#" class="dropdown-item">Other Partners Finance</a> --}}
    
                                <a href="{{ route('admin.requestotherpartners') }}" class="dropdown-item">Other Partners
                                    Requests</a>


                                
                                <a href="{{ route('admin.suppliers') }}" class="dropdown-item">All Suppliers</a>

                                <a href="{{ route('admin.managesuppliers') }}" class="dropdown-item">Manage Suppliers</a>


                                
    
                            </div>
                        </li>
    
                        <li class="d-none nav-item dropdown" id="drivers">
                            <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-advanced-ui" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="dripicons-crosshair  mr-2"></i>Drivers
                                <div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnav-advanced-ui">
                                <a href="{{ route('admin.drivers') }}" class="dropdown-item">All Drivers</a>
                                <a href="{{ route('admin.managedrivers') }}" class="dropdown-item">Manage Drivers</a>
    
                                <a href="{{ route('admin.requestdrivers') }}" class="dropdown-item"> Drivers Requests </a>
    
                                <a href="{{ route('admin.settingdrivers') }}" class="dropdown-item">Drivers Settings</a>
                            </div>
                        </li>
    
                        <li class="d-none nav-item dropdown" id="customers">
                            <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-advanced-ui" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="dripicons-user-group  mr-2"></i>Customers
                                <div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnav-advanced-ui">
                                <a href="{{ route('admin.customers') }}" class="dropdown-item">All Customers</a>
                                <a href="{{ route('admin.managecustomers') }}" class="dropdown-item">Manage Customers</a>

                                <a href="{{ route('admin.customersorders') }}" class="dropdown-item">Customers Orders</a>
    
                            </div>
                        </li>
    
    
                        <li class="d-none nav-item dropdown" id="operations">
                            <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-advanced-ui" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="dripicons-gear  mr-2"></i>Operations
                                <div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnav-advanced-ui">
                                <a href="{{ route('admin.allorders') }}" class="dropdown-item">All Deliveries</a>
    
                                <a href="{{ route('admin.todayorders') }}" class="dropdown-item">Today Deliveries</a>
    
                                <a href="{{ route('admin.tracking') }}" class="dropdown-item">Tracking</a>
    
                                <a href="{{ route('admin.payments') }}" class="dropdown-item">Restaurants Payment</a>
                                
                                <a href="{{ route('admin.otherpayments') }}" class="dropdown-item">Partners Payment</a>

                                <a href="{{ route('admin.dispatchedproducts') }}" class="dropdown-item">Dispatched Products</a>

                                <a href="{{ route('admin.inventoryproducts') }}" class="dropdown-item">Inventory Products</a>

                                <a href="{{ route('admin.healthoperations') }}" class="dropdown-item">Operation Health</a>
    
                            </div>
                        </li>
    
                        <li class="d-none nav-item" id="assets">
                            <a class="nav-link" href="{{ route('admin.assets') }}">
                                <i class="dripicons-stack mr-2"></i>Assets
                            </a>
                        </li>
    
    
                        <li class="d-none nav-item dropdown" id="HR">
                            <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-advanced-ui" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="dripicons-document  mr-2"></i>HR
                                <div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnav-advanced-ui">
                                {{-- <a href="#" class="dropdown-item">Dashboard</a> --}}
                                <a href="{{route('admin.departments')}}" class="dropdown-item">Departments</a>
    
                                <a href="{{route('admin.employees')}}" class="dropdown-item">Empolyees</a>
                                <a href="{{route('admin.leave')}}" class="dropdown-item">Leaves</a>
                                {{-- <a href="#" class="dropdown-item">Reports</a> --}}
                                <a href="{{route('admin.roles')}}" class="dropdown-item">Roles & Permission</a>
                            </div>
                        </li>
    
    
                        {{-- nav link dropdown --}}
                        <li class=" d-none nav-item dropdown" id="reports">
                            <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-advanced-ui" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="dripicons-document  mr-2"></i>Reports
                                <div class="arrow-down"></div>
                            </a>
    
                            <div class="dropdown-menu" aria-labelledby="topnav-advanced-ui">
                                <a href="{{ route('admin.restaurantsreports') }}" class="dropdown-item">Restaurants
                                    Reports</a>
    
                                <a href="{{ route('admin.partnersreports') }}" class="dropdown-item">Partners Reports</a>

                                <a href="{{ route('admin.paymentsreports') }}" class="dropdown-item">Payments Reports</a>
                            </div>
                        </li>
    
                        {{-- nav link dropdown --}}
                        <li class=" d-none nav-item dropdown" id="settings">
                            <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-advanced-ui" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="dripicons-gear  mr-2"></i>Settings
                                <div class="arrow-down"></div>
                            </a>
    
                            <div class="dropdown-menu" aria-labelledby="topnav-advanced-ui">
    
                                <a href="{{ route('admin.generalsettings') }}" class="dropdown-item">General Settings</a>
    
                                <a href="{{ route('admin.servicesettings') }}" class="dropdown-item">Services Settings</a>
    
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


    
    {{-- page content --}}
    @yield('content')


    @include('alerts.alerts')

    {{-- right darkmode --}}
    



    




    {{-- scripts --}}
    
    <!-- JAVASCRIPT --> 


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



    <script>
        var modules =  @json($modules);
           for (let index = 0; index <  modules.length; index++) {
               if (document.getElementById(modules[index]) != null) {
                   document.getElementById(modules[index]).classList.remove("d-none");     

               }
           }
    </script>


{{-- check if not authenticated to this admin layout --}}
    @if (empty(session('user_id')))
    

        {{-- redirect to restaurant dashboard --}}
        @if (!empty(session('partner_id')))
            
        <script>
            window.location.href = '/restaurant'; //dashboard of restaurant            
        </script>



        {{-- redirect to partner dashboard --}}
        @elseif (!empty(session('otherpartner_id')))
        
        <script>
            window.location.href = '/partner'; //dashboard of restaurant            
        </script>



        {{-- redirect to admin login --}}
        @else

        <script>
            window.location.href = '/login/users';              
        </script>

        @endif
        



    @endif 
    {{-- end of check if not authenticated to admin layout --}}




    {{-- check if screen is locked --}}
    @if (session('user_lock') == "locked")
    
    <script>
        
        window.location.href = '/admin/lock';
            
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
                url:"{{ route('admin.removenotifications') }}",
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



    {{-- variable contain the image url --}}
    <?php 
    
    
    ?>


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



    <script>
    var data = [
     
      { y: '2021', a: 115, b: 75},
      { y: '2022', a: 120, b: 85},
      { y: '2023', a: 145, b: 85}
 
    ],
    config = {
      data: data,
      xkey: 'y',
      ykeys: ['a', 'b'],
      labels: ['Total Delivered', 'Total Income'],
      fillOpacity: 0.6,
      hideHover: 'auto',
      behaveLikeLine: true,
      resize: true,
      pointFillColors:['#ffffff'],
      pointStrokeColors: ['black'],
      lineColors:['gray','red']
  };
    config.element = 'bar-chart';
    Morris.Bar(config);
    config.element = 'stacked';
    config.stacked = true;
    Morris.Bar(config);
    </script>



{{-- script of precentage --}}
@if (!empty($doc) && !empty($coc))

    <script>
        Morris.Donut({
        element: 'pie-chart',
        data: [
            {label: "Delivered", value: {{ $doc - 1 }}},
            {label: "Canceled", value: {{ $coc - 1 }}}
        
        ]
    });
    </script>
@endif
{{-- end script --}}




    <script>
        Morris.Line({
    // ID of the element in which to draw the chart.
    element: 'myfirstchart',
    // Chart data records -- each entry in this array corresponds to a point on
    // the chart.
    data: [
    
        { year: '2020', Delivered: 15420 },
        { year: '2021', Delivered: 33245 },
        { year: '2022', Delivered: 45265 }
    ],
    // The name of the data record attribute that contains x-values.
    xkey: 'year',
    // A list of names of data record attributes that contain y-values.
    ykeys: ['Delivered'],
    // Labels for the ykeys -- will be displayed when you hover over the
    // chart.
    labels: ['Delivered']
    });

        </script>

    </body>

</html>