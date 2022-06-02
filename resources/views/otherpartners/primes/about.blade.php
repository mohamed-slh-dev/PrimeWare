@extends('layouts.otherpartner')


@section('content')


{{-- header --}}
<!-- start page title -->
<div class="page-title-box">
    <div class="container-fluid">
        <div class="page-title-content">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4>General Settings</h4>
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

                <div class="col-md-6 col-xl-3">
                    <div class="card text-center">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-info mt-2">{{ number_format($partner->deliveredorders->count()) }}</h3>Total
                            Delivered
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card text-center">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-success mt-2">{{ number_format($orders->sum('chargefees')) }}
                            </h3> Unpaid Service Fees

                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card text-center">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-info mt-2">0</h3>-
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="card text-center">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-danger mt-2">0</h3> -
                        </div>
                    </div>
                </div>

            </div>
            {{-- row of counters --}}




            {{-- row of inputs --}}
            <div class="row align-items-end">

                <div class="col-12 mb-3">
                    <h5>Select Deliveries Collection Timing (Morning - Evening)</h5>
                </div>

                <div class="col-2">
                    <label for="example-text-input">Collection Timing Morning</label>
                    <div>
                        <input type="time" name="morningtiming" class="form-control">
                    </div>

                </div>


                <div class="col-2">
                    <label for="example-text-input">Collection Timing Evening</label>
                    <div>
                        <input type="time" name="eveningtiming" class="form-control">
                    </div>

                </div>



                <div class="col-3 text-left">


                    <button type="submit" class="btn btn-outline-success mx-2 font-15">UPDATE</button>


                </div>


            </div>
            {{-- end row --}}


            {{-- early footer --}}
            <div class="row mt-5">
                <div class="col-lg-12 mt-4">
                    <div class="form-group row">

                        <div class="col-12 text-center">

                            <img src="{{ asset('assets/partners/assets/images/Prime-logo1.png') }}" width="180"
                                height="90" alt="logo-large" class="logo-lg text-center">


                        </div>

                    </div>
                </div>

                <div class="col-lg-12 ">
                    <div class="form-group row">
                        <div class="col-4">
                            <label for="example-text-input" class="col-sm-6 col-form-label">Name:</label>
                            <div class="col-sm-10">
                                <h4>PrimeWare Delivery</h4>
                            </div>

                        </div>
                        <div class="col-4">
                            <label for="example-text-input" class="col-sm-6 col-form-label">E-mail:</label>
                            <div class="col-sm-10">
                                <h4>hello@primewaredelivery.ae</h4>
                            </div>

                        </div>
                        <div class="col-4">
                            <label for="example-text-input" class="col-sm-6 col-form-label">Phone:</label>
                            <div class="col-sm-10">
                                <h4>+971 50 626 2006</h4>
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