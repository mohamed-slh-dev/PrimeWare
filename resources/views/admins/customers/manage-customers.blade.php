@extends('layouts.admin')


@section('content')



{{-- continue header --}}
<!-- start page title -->
<div class="page-title-box">
    <div class="container-fluid">
        <div class="page-title-content">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4>Manage Customers</h4>
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
            <div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">All Customers</h4>
                            <p class="card-title-desc">Delivery History </p>

                            <div class="table-responsive">
                                <table class="table mb-0">

                                    <thead class="thead-light">
                                        <tr>
                                            <th>Restaurant</th>
                                            <th>Customer</th>
                                            <th>Phone</th>
                                            <th>No. Of deliveries</th>
                                            <th>City</th>
                                            <th>District</th>
                                            <th>Address</th>
                                            <th>Location</th>
                                            <th>Comments/Notes</th>
                                            <th>View</th>
                                        </tr>
                                    </thead>

                                    {{-- tbody --}}
                                    <tbody>

                                        {{-- counter for table --}}
                                        <?php $counter = 1; ?>
                                        
                                        {{-- partners --}}
                                        @foreach ($partners as $partner)

                                        {{-- customers in partner --}}
                                        @foreach ($partner->customers as $customer)

                                        {{-- table row --}}
                                        <tr>

                                            <td>{{ $partner->name }}</td>

                                            <td>{{ $customer->name }}</td>
                                            <td>{{ $customer->phone }}</td>
                                            <td>{{ $customer->orders->count() }}</td>

                                            <td>{{ $customer->city->name }}</td>
                                            <td>{{ $customer->district->name }}</td>
                                            <td>{{ $customer->address }}</td>
                                            
                                            <td><a href="https://www.google.com/maps/search/?api=1&query={{ ltrim($customer->locationlink, '@') }}" class="text-warning" target="_blank">Show Map</a></td>


                                            <td>{{ $customer->info }}</td>

                                            {{-- show info --}}
                                            <td>
                                                <button type="button" class="btn-sm btn btn-outline-success waves-effect waves-light" data-toggle="modal" data-target="#modal-{{ $counter }}">
                                                    <i class="dripicons-preview"></i>
                                                </button>
                                            </td>

                                            

                                        </tr>
                                        {{-- end of table row  --}}
                                        
                                        {{-- increase counter --}}
                                        <?php $counter++; ?>

                                        @endforeach
                                        {{-- end of customers in partner --}}
                                        
                                        @endforeach
                                        {{-- end foreach --}}


                                    </tbody>
                                    {{-- end tbody --}}
                                </table>
                            </div>
                            {{-- end table wrapper --}}

                        </div>
                    </div>
                </div>
                <!-- end col -->





                {{-- assign special customer driver --}}
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Assign Drivers To Special Customers</h4>
                            <p class="card-title-desc">Review all special customers</p>

                            <div class="table-responsive">
                                <table class="table mb-0">

                                    <thead class="thead-light">
                                        <tr>

                                            <th>Restaurant</th>
                                            <th>Customer</th>
                                            <th>Phone</th>
                                    
                                            <th>City</th>
                                            <th>District</th>
                                            <th>Address</th>

                                            <th>Comments/Notes</th>
                                            <th>Status</th>
                                            
                                            <th>Assign To</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        {{-- table row --}}

                                        {{-- orders --}}
                                        @foreach ($orders as $order)
                                        

                                        <tr>

                                            <td>{{ $order->partner->name }}</td>
                                            <td>{{ $order->customer->name }}</td>
                                            <td>{{ $order->customer->phone }}</td>
                                            
                                            <td>{{ $order->customer->city->name }}</td>
                                            <td>{{ $order->customer->district->name }}</td>
                                            <td>{{ $order->customer->address }}</td>

                                            <td>{{ $order->customer->info }}</td>


                                            <td>
                                                <span class="badge badge-secondary">Request</span>
                                            </td>



                                            <td>
                                                <button type="button"
                                                    class="btn-sm btn btn-outline-dark waves-effect waves-light driver-assign-id"
                                                    data-toggle="modal" data-target=".drivers-list" value="{{ $order->customer->id }}">Drivers</button>
                                            </td>

                                        </tr>
                                        {{-- end table row --}}


                                        @endforeach
                                        {{-- end foreach orders --}}

                                    </tbody>
                                    {{-- end table body --}}
                                </table>
                            </div>
                            {{-- end table wrapper --}}

                        </div>
                    </div>
                </div>
                <!-- end col -->






                {{-- drivers and one time order --}}
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Assign Drivers To One Time Deliveries</h4>
                            <p class="card-title-desc">Review all one time deliveries</p>

                            <div class="table-responsive">
                                <table class="table mb-0">
                            
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Customer</th>
                                            <th>Phone</th>
                                            <th>City</th>
                                            <th>District</th>
                                            <th>Address</th>
                                            <th>Delivery Date</th>

                                            <th>Comments/Notes</th>

                                            <th>Status</th>
                                            <th>Assign to</th>
                                        </tr>
                                    </thead>
                            
                                    {{-- tbody --}}
                                    <tbody>
                            
                                        {{-- singleorders foreach --}}
                                        @foreach ($singleorders as $order)
                            
                                        {{-- table row --}}
                                        <tr>
                                            <td>{{ $order->customer_name }}</td>
                                            <td>{{ $order->customer_phone }}</td>
                                            <td>{{ $order->city->name }}</td>
                                            <td>{{ $order->district->name }}</td>
                                            <td>{{ $order->customer_address }}</td>
                                            <td>{{ $order->deliverydate }}</td>
                                            

                                            <td>{{ $order->meal }}</td>
                            
                            
                                            <td><i class="mdi mdi-checkbox-blank-circle text-warning"></i> Requested</td>
                            
                            
                                            <td>
                                                <button type="button" class="btn-sm btn btn-outline-dark waves-effect waves-light order-assign-id"
                                                    data-toggle="modal" data-target=".drivers-list-2" value="{{ $order->id }}">Drivers</button>
                                            </td>
                            
                                        </tr>
                                        {{-- end table row --}}
                            
                                        @endforeach
                                        {{-- end foreach --}}
                            
                                    </tbody>
                                    {{-- end table body --}}
                                </table>
                            </div>
                            {{-- end table wrapper --}}
                            
                            
                            {{-- pagination --}}
                            <div class="pagination mt-4">
                                {!! $singleorders->links() !!}
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>

        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    <footer class="footer">

    </footer>
</div>
<!-- end main content-->

</div>
<!-- END layout-wrapper -->


{{-- endcontent --}}








{{-- modal --}}

{{-- partners with customers orders (partner) --}}
{{-- counter for table --}}
<?php $counter = 1; ?>

{{-- partners --}}
@foreach ($partners as $partner)

{{-- customers in partner --}}
@foreach ($partner->customers as $customer)


<div class="modal fade collect-list" id="modal-{{ $counter }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Resturant Collected List</h5>
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">

                   
                    <div class="col-md-6 col-xl-2">
                        <div class="card text-center">
                            <div class="mb-2 card-body text-muted">
                                <h3 class="text-info mt-2">{{ number_format($customer->orders->count()) }}</h3>Total Deliveries
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-2">
                        <div class="card text-center">
                            <div class="mb-2 card-body text-muted">
                                <h3 class="text-danger mt-2">{{ number_format($customer->canceledorders->count()) }}</h3> Canceled

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-2">
                        <div class="card text-center">
                            <div class="mb-2 card-body text-muted">
                                <h3 class="text-primary mt-2">{{ number_format($customer->deliveredorders->count()) }}</h3> Deliverd
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-2">
                        <div class="card text-center">
                            <div class="mb-2 card-body text-muted">
                                <h3 class="text-primary mt-2">{{ number_format($customer->orders->sum('bag')) }}</h3> Bags Collected
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-2">
                        <div class="card text-center">
                            <div class="mb-2 card-body text-muted">
                                <h3 class="text-primary mt-2">0</h3> Bags On Hand
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-2">
                        <div class="card text-center">
                            <div class="mb-2 card-body text-muted">
                                <h3 class="text-success mt-2">{{ number_format($customer->orders->sum('cashcollected')) }}</h3> Cash Collected
                            </div>
                        </div>
                    </div>

                </div>


                {{-- deliveries | orders --}}
                <div class="row" id="customersreportdiv-{{ $counter }}">


                    {{-- image for printing only --}}
                    <div class="col-12 printimagediv text-center">
                        <span class="logo-lg">
                            <img src="{{ asset('assets/admins/assets/images/Prime-logo1.png') }}" style="object-fit: contain" width="110"
                                height="80"> </span>
                    </div>

                    
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Deliveries History</h4>
                                <p class="card-title-desc">Customer: {{ $customer->name }}</p>

                                <div class="table-responsive">
                                    <table class="table mb-0">

                                        <thead class="thead-light">
                                            <tr>
                                                <th>Delivery No.</th>
                                                <th>Restaurant</th>
                                                <th>Driver</th>
                                                <th>Delivery Date</th>
                                                <th>Delivered At</th>
                                                <th>Cash Collected</th>
                                                <th>Status</th>
                                                <th>Bag</th>
                                            </tr>
                                        </thead>

                                        {{-- tbody --}}
                                        <tbody>

                                            {{-- customers in partner --}}
                                            @foreach ($customer->orders->sortByDesc('deliverydate') as $order)

                                            {{-- table row --}}
                                            <tr>    
                                                <td># {{ $order->id }}</td>
                                                <td>{{ $partner->name }}</td>
                                                <td>{{ (!empty($order->driver->name) ? $order->driver->name : "-") }}</td>
                                                <td>{{ $order->deliverydate}}</td>

                                                <td>{{ (!empty($order->updatedate) ? $order->updatedate : "-") }}</td>

                                                <td>{{ number_format($order->cashcollected) }}</td>

                                                {{-- status of order --}}
                
                                                @if ($order->status == "delivered")
                                                
                                                    <td><i class="mdi mdi-checkbox-blank-circle text-success"></i> Delivered</td>
                                                
                                                @elseif ($order->status == "canceled")
                                                
                                                    <td><i class="mdi mdi-checkbox-blank-circle text-danger"></i> Canceled</td>
                                                
                                                @else
                                                
                                                    <td><i class="mdi mdi-checkbox-blank-circle text-warning"></i> {{ ucwords($order->status) }}</td>
                                                
                                                @endif


                                                {{-- bag --}}
                                                @if ($order->bag == 1)
                                                    <td>With Bag</td>

                                                @else
                                                    <td>Without Bag</td>

                                                @endif

                                            </tr>
                                            {{-- end table row --}}

                                            @endforeach
                                            {{-- end foreach --}}

                                        </tbody>
                                        {{-- end tbody --}}

                                    </table>
                                </div>
                                {{-- end table wrapper --}}

                            </div>
                        </div>
                    </div>
                    <!-- end col -->


                    <div class="col-lg-12 col-xl-12">
                        <div class="text-center">
                            <button onclick="printDiv('customersreportdiv-{{ $counter }}')" class="btn btn-outline-success print-buttons">
                                <i class="fa fa-print"></i>
                            </button>


                        </div>
                    </div>
                </div>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- /.modal -->


{{-- increase counter --}}
<?php $counter++; ?>

@endforeach
{{-- end of customers in partner --}}

@endforeach
{{-- end foreach --}}









{{-- assign driver for special orders --}}
<div class="modal fade drivers-list" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Assign Driver</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                {{-- form row --}}
                {{-- form (search partner) --}}
                <form action="{{ route('admin.addspecialorderdriver') }}" method="post">
                
                    {{-- method fields --}}
                    @method('POST')
                    @csrf

                    {{-- id of customer from button --}}
                    <input type="hidden" id="modal-assign-driver" name="id" value="">


                    <div class="row">

                        {{-- col --}}
                        <div class="col-12">
                            <div class="form-group row">

                                <div class="col-sm-4">
                                    <label>Drivers</label>
                                    <select required="" name="driver" class="custom-select">
                                        
                                        @foreach ($drivers->where('type', 'driver') as $driver)
                                            <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                        @endforeach

                                    </select>
                                </div>

                            </div>
                        </div>
                        {{-- end col --}}

                        <div class="col-sm-12 text-center mt-4">
                            <button type="submit" class="btn btn-outline-success mr-1 font-15">ADD</button>
                        </div>

                    </div>
                    {{-- end row --}}

                </form>
                {{-- end form --}}


            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



{{-- endmodal --}}












{{-- assign driver for special orders --}}
<div class="modal fade drivers-list-2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Assign Driver</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                {{-- form (search partner) --}}
                <form action="{{ route('admin.addonetimeorderdriver_customers') }}" method="post">
                
                
                    {{-- method fields --}}
                    @method('POST')
                    @csrf
                
                
                    {{-- order id --}}
                    <input type="hidden" id="modal-assign-order" name="order_id" value="">
                
                
                    {{-- form row --}}
                    <div class="row">
                
                
                        {{-- drivers --}}
                        <div class="col-12">
                            <div class="form-group row">
                
                                <div class="col-sm-4">
                                    <label>Drivers</label>
                                    <select required="" name="driver_id" class="custom-select">
                
                                        @foreach ($drivers->where('type', 'driver') as $driver)
                                            <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                        @endforeach
                
                
                                    </select>
                                </div>
                
                            </div>
                        </div>
                
                        {{-- button --}}
                        <div class="col-sm-12 text-center mt-4">
                            <button type="submit" class="btn btn-outline-success mr-1 font-15">ADD</button>
                        </div>
                
                
                    </div>
                    {{-- end row --}}
                
                
                </form>
                {{-- end form --}}


            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



{{-- endmodal --}}




@endsection