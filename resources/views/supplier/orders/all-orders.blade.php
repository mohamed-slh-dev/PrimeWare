@extends('layouts.supplier')


@section('content')



{{-- continue header --}}
<!-- start page title -->
<div class="page-title-box">
    <div class="container-fluid">
        <div class="page-title-content">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4>Deliveries</h4>
                </div>

                {{-- <div class="col-sm-6">
                    <div class="float-right">
                        <button type="button" class="btn btn-outline-success waves-effect waves-light" data-toggle="modal" data-target=".new-product-modal">Create Delivery</button>
                    </div>
                </div> --}}

            </div>
        </div>
    </div>
</div>
<!-- end page title -->

</header>

{{-- endheader --}}















{{-- content --}}
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            {{-- boxes row --}}
            <div class="row">

                {{-- box --}}
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            
                            <div class="row">
                                <div class="col-4 align-self-center">
                                    <div class="icon-info">
                                        <i class="dripicons-checkmark text-success"></i>
                                    </div>
                                </div>
                                <div class="col-8 align-self-center text-right">
                                    <div class="ml-2">
                                        <p class="mb-0 text-muted">Number of Deliveries</p>
                                        <h4 class="mt-0 mb-1 d-inline-block">
                                            {{ $deliveriesCount }}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="progress mt-2" style="height:3px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 55%;"
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
                                        <i class="dripicons-checkmark text-success"></i>
                                    </div>
                                </div>
                                <div class="col-8 align-self-center text-right">
                                    <div class="ml-2">
                                        <div class="ml-2">
                                            <p class="mb-0 text-muted">Total Delivered</p>
                                            <h4 class="mt-0 mb-1 d-inline-block">
                                                {{ $deliveredCount }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="progress mt-2" style="height:3px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 39%;"
                                    aria-valuenow="39" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <!--end card-body-->
                    </div>
                    <!--end card-->
                </div>
                <!--end col-->


                {{-- <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4 align-self-center">
                                    <div class="icon-info">
                                        <i class="dripicons-checkmark text-success"></i>
                                    </div>
                                </div>
                                <div class="col-8 align-self-center text-right">
                                    <div class="ml-2">
                                        <p class="mb-0 text-muted">Total Delivery Cost</p>
                                        <h4 class="mt-0 mb-1 d-inline-block">
                                            {{ $cashCollection }}
                                        </h4>
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
                <!--end col--> --}}







                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4 align-self-center">
                                    <div class="icon-info">
                                        <i class="dripicons-cross text-danger"></i>
                                    </div>
                                </div>
                                <div class="col-8 align-self-center text-right">
                                    <div class="ml-2">
                                        <p class="mb-0 text-muted">Canceled Deliveries</p>
                                        <h4 class="mt-0 mb-1 d-inline-block">
                                            {{ $canceledCount }}
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            <div class="progress mt-2" style="height:3px;">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 48%;" aria-valuenow="48"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <!--end card-body-->
                    </div>
                    <!--end card-->
                </div>
                <!--end col-->

            </div>
            <!--end boxes row-->




            {{-- content --}}
            <div class="row">
                <div class="col-lg-12">
                    <div class="card client-card">
                        <div class="card-body text-center">
                            <div class="row">
                                <div class="col-12">


                                    {{-- form (add new customer) --}}
                                    <form action="{{ route('supplier.filterDeliveries') }}" method="post">

                                        {{-- method fields (was post)--}}
                                        @method('POST')
                                        @csrf


                                        {{-- row --}}
                                        <div class="row">

                                            {{-- col --}}
                                            <div class="col-3 ">
                                                <div class="form-group row">

                                                    <label for="example-text-input"
                                                        class="col-sm-4 col-form-label">From</label>

                                                    <div class="col-sm-8">
                                                        <input type="date" placeholder="YYYY-MM-DD" name="fromdate"
                                                            class="form-control">
                                                    </div>

                                                </div>
                                            </div>
                                            {{-- end col --}}

                                            {{-- col --}}
                                            <div class="col-3 ">
                                                <div class="form-group row">

                                                    <label for="example-text-input"
                                                        class="col-sm-4 col-form-label">To</label>

                                                    <div class="col-sm-8">
                                                        <input type="date" placeholder="YYYY-MM-DD" name="todate"
                                                            class="form-control">
                                                    </div>

                                                </div>
                                            </div>
                                            {{-- end col --}}


                                            {{-- col --}}
                                            <div class="col-3 ">
                                                <div class="form-group row">

                                                    <label for="example-text-input"
                                                        class="col-sm-4 col-form-label">Status</label>

                                                    <div class="col-sm-8">
                                                        <select required="" name="status" class="custom-select ">
                                                            <option value="all">All</option>

                                                            <option value="not delivered">Not Delivered</option>
                                                            <option value="delivered">Delivered</option>
                                                            <option value="canceled">Canceled</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- end col --}}

                                            {{-- button --}}
                                            <div class="col-3 text-left">
                                                <button type="submit"
                                                    class="btn btn-outline-success waves-effect waves-light mx-3">
                                                    Search </button>
                                            </div>
                                        </div>
                                        {{-- end row --}}

                                    </form>
                                    {{-- end form --}}

                                </div>
                            </div>
                            {{-- end col + row --}}

                        </div>
                    </div>
                </div>
            </div>
            {{-- end of filter --}}




            {{-- all delivery orders --}}
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-title-desc">Review all deliveries</p>

                            <div class="table-responsive">
                                <table class="table mb-0">

                                    <thead class="thead-light">

                                            
                                        <tr>
                                            <th>Delivery No.</th>
                                            <th>Tracking No.</th>

                                            <th>Customer</th>
                                            <th>Phone</th>

                                            <th>City</th>
                                            <th>District</th>
                                            <th>Address</th>

                                            <th>Location</th>

                                            <th>Delivery Date</th>
                                            {{-- <th>Comments/Notes</th> --}}
                                            <th>Status</th>
                                            <th>Received At</th>
                                            {{-- <th>Cancel</th> --}}
                                        </tr>



                                    </thead>

                                    {{-- tbody --}}
                                    <tbody>

                                        {{-- table row --}}

                                        @foreach ($purchases as $purchase)
                                            
                                        <tr>
                                            <td># {{ $purchase->id }}</td>
                                            <td>{{ $purchase->tracking_number }}</td>
                                            <td>{{ $purchase->fname." ".$purchase->lname }}</td>
                                            <td>{{ $purchase->phone }}</td>

                                            <td>{{ $purchase->city->name }}</td>
                                            <td>{{ $purchase->district->name }}</td>

                                            <td>{{ $purchase->address }}</td>

                                            <td><a href="https://www.google.com/maps/search/?api=1&query=" class="text-warning" target="_blank">Show Map</a></td>


                                            {{-- deliverydate + delivery time --}}
                                            <td>{{ date('d M Y', strtotime($purchase->delivery_date)) }}</td>

                                            {{-- <td>Lorem ipsum dolor sit amet consectetur adipisicing elit.</td> --}}


                                            <td><i class="mdi mdi-checkbox-blank-circle text-warning mr-1"></i>{{ ucwords($purchase->status) }}</td>

                                            <td>-</td>




                                        </tr>
                                        {{-- end table row --}}

                                        @endforeach

                                    </tbody>
                                    {{-- end tbody --}}
                                </table>
                            </div>
                            {{-- end table wrapper --}}

                            {{-- paginations --}}
                            <div class="pagination mt-4">
                                
                            </div>
                            {{-- end paginations --}}

                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
            {{-- end row --}}


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