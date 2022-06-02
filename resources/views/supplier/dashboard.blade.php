@extends('layouts.supplier')


@section('content')



{{-- continue header --}}
<!-- start page title -->
<div class="page-title-box">
    <div class="container-fluid">
        <div class="page-title-content">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4>Home</h4>
                </div>
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
                <div class="col">
                    <div class="card text-center">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-info mt-2">{{ $analytics['dispatchedCount'] }}</h3>
                            Total Products<br>Dispatched
                        </div>
                    </div>
                </div>
            
            
            
                <div class="col">
                    <div class="card text-center">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-info mt-2">{{ $analytics['receivedCount'] }}</h3>
                            Total Products<br>Received
                        </div>
                    </div>
                </div>
            
            
                <div class="col">
                    <div class="card text-center">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-info mt-2">{{ $analytics['availableCount'] }}</h3>
                            Total Products<br>in Stock
                        </div>
                    </div>
                </div>
            
            
                <div class="col">
                    <div class="card text-center">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-success mt-2">{{ $analytics['soldCount'] }}</h3>
                            Total Products<br>Sold
                        </div>
                    </div>
                </div>
            
            
                <div class="col">
                    <div class="card text-center">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-success mt-2">{{ $analytics['cashCollection'] }}</h3>
                            Cash<br>Collection
                        </div>
                    </div>
                </div>

            
            
            </div>
            <!-- end boxes row -->





            {{-- boxes row 2 --}}
            <div class="row">

                
                <div class="col">
                    <div class="card text-center">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-info mt-2">{{ $deliveriesCount }}</h3>
                            Number of <br>Deliveries
                        </div>
                    </div>
                </div>
            
            
            
                <div class="col">
                    <div class="card text-center">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-info mt-2">{{ $deliveredCount }}</h3>
                            Total<br>Delivered
                        </div>
                    </div>
                </div>
            
            
                {{-- <div class="col">
                    <div class="card text-center">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-info mt-2">-</h3>
                            Total Delivery<br>Cost
                        </div>
                    </div>
                </div> --}}
            
            
                <div class="col">
                    <div class="card text-center">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-danger mt-2">{{ $canceledCount }}</h3>
                            Canceled<br>Deliveries
                        </div>
                    </div>
                </div>
            
            
                <div class="col">
                    <div class="card text-center">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-danger mt-2">{{ $analytics['damagedCount'] }}</h3>
                            Damaged<br>Products
                        </div>
                    </div>
                </div>
            
            
            
            </div>
            <!-- end boxes row 2 -->


            {{-- row --}}
            <div class="row">

                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Total Deliveries</h4>

                            <div class="row text-center mt-4">
                                <div class="col-2">
                                    <h5 class="mb-2 font-size-18">{{ $deliveredCount }}</h5>
                                    <p class="text-muted text-truncate">Delivered</p>
                                </div>
                                <div class="col-8">
                                    <div id="pie-chart" style="height: 300px; margin-top: -60px;"></div>
                                </div>
                                <div class="col-2">
                                    <h5 class="mb-2 font-size-18">{{ $canceledCount }}</h5>
                                    <p class="text-muted text-truncate">Returned | Canceled</p>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>

            </div>
            <!-- end row -->



            {{-- all orders --}}
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
            
                                            <td><a href="https://www.google.com/maps/search/?api=1&query=" class="text-warning"
                                                    target="_blank">Show Map</a></td>
            
            
                                            {{-- deliverydate + delivery time --}}
                                            <td>{{ date('d M Y', strtotime($purchase->delivery_date)) }}</td>
            
                                            {{-- <td>Lorem ipsum dolor sit amet consectetur adipisicing elit.</td> --}}
            
            
                                            <td><i class="mdi mdi-checkbox-blank-circle text-warning mr-1"></i>{{
                                                ucwords($purchase->status) }}</td>
            
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

    {{-- footer --}}
    <footer class="footer">

    </footer>
    {{-- endfooter --}}

</div>
<!-- end main content-->

{{-- endcontent --}}




{{-- modal --}}




{{-- endmodals --}}



@endsection


