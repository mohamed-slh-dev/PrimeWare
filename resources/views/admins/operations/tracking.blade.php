@extends('layouts.admin')


@section('content')



{{-- continue header --}}
<div class="page-title-box">
    <div class="container-fluid">
        <div class="page-title-content">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4>Tracking</h4>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- end page title -->

</header>

{{-- end header --}}



{{-- content --}}
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4 align-self-center">
                                    <div class="icon-info">
                                        <i class="mdi mdi-account-group text-warning"></i>
                                    </div>
                                </div>

                                {{-- drivers --}}
                                <div class="col-8 align-self-center text-right">
                                    <div class="ml-2">
                                        <p class="mb-1 text-muted"> Drivers</p>
                                        <h4 class="mt-0 mb-1">{{ number_format($drivers->count()) }}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="progress mt-2" style="height:3px;">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 55%;"
                                    aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <!--end card-body-->
                    </div>
                    <!--end card-->
                </div>
                <!--end col-->

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4 align-self-center">
                                    <div class="icon-info">
                                        <i class="dripicons-checklist  text-purple"></i>
                                    </div>
                                </div>
                                <div class="col-8 align-self-center text-right">
                                    <div class="ml-2">
                                        <div class="ml-2">
                                            <p class="mb-0 text-muted">Pending Orders</p>
                                            <h4 class="mt-0 mb-1 d-inline-block">{{ number_format($pendingTotal) }}</h4>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="progress mt-2" style="height:3px;">
                                <div class="progress-bar bg-purple" role="progressbar" style="width: 39%;"
                                    aria-valuenow="39" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <!--end card-body-->
                    </div>
                    <!--end card-->
                </div>
                <!--end col-->

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4 align-self-center">
                                    <div class="icon-info">
                                        <i class="dripicons-checkmark  text-success"></i>
                                    </div>
                                </div>
                                <div class="col-8 align-self-center text-right">
                                    <div class="ml-2">
                                        <p class="mb-0 text-muted">Delivered Orders</p>
                                        <h4 class="mt-0 mb-1 d-inline-block">{{ number_format($deliveredTotal) }}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="progress mt-2" style="height:3px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 48%;"
                                    aria-valuenow="48" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <!--end card-body-->
                    </div>
                    <!--end card-->
                </div>
                <!--end col-->
            </div>
            <!--end row-->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card client-card">
                        <div class="card-body text-center">
                            <div class="row">
                                <div class="col-12">

                                    {{-- form (search driver in map) --}}
                                    <form action="{{ route('admin.filtertracking') }}" method="post">
                                    
                                        {{-- method fields --}}
                                        @method('POST')
                                        @csrf

                                    <div class="row form-row">

                                    

                                        <div class="col-3">
                                            <div class="form-group row">
                                                <label for="example-text-input"
                                                    class="col-sm-4 col-form-label">Driver</label>
                                                <div class="col-sm-8">
                                                    <select name="driverid" class="custom-select ">

                                                        <option value=""></option>

                                                        @foreach ($drivers as $driver)
                                                            <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                     

                                        
                                        <div class="col-3 text-left">
                                            <button type="submit" class="btn btn-outline-success waves-effect waves-light mx-3"> Search</button>
                                        </div>
                                    </div>
                                    {{-- end inner row --}}

                                    </form>
                                    {{-- end form --}}

                                </div>
                            </div>
                            {{-- end col 12 + row --}}

                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Drivers Tracking</h4>
                            <p class="card-title-desc"></p>

                            <div class="mapouter">
                                <div class="gmap_canvas"><iframe width="1200" height="500" id="gmap_canvas"
                                        src="https://maps.google.com/maps?q=duabi&t=&z=13&ie=UTF8&iwloc=&output=embed"
                                        frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a
                                        href="#"></a><br>
                                    <style>
                                        .mapouter {
                                            text-align: center;
                                            height: 500px;
                                        }
                                    </style><a href="#"></a>
                                    <style>
                                        .gmap_canvas {
                                            overflow: hidden;
                                            background: none !important;
                                            height: 500px;
                                        }
                                    </style>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    <footer class="footer">

    </footer>
</div>
<!-- end main content-->



{{-- end content --}}



@endsection