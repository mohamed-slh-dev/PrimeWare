@extends('layouts.admin')


@section('content')



{{-- continue header --}}


<!-- start page title -->
<div class="page-title-box">
    <div class="container-fluid">
        <div class="page-title-content">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4>Dashboard</h4>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end page title -->

</header>




{{-- endheader --}}


<div class="main-content">
    <div class="page-content">

        <div class="container-fluid">

            <div class="row">
                <div class="col-md-6 col-xl-2">
                    <div class="card text-center">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-info mt-2">{{ number_format($orders->count()) }}</h3> Total Deliveries
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-2">
                    <div class="card text-center">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-info mt-2">{{ number_format($orders->where('status', 'delivered')->count()) }}</h3> Total Delivered
                        </div>
                    </div>
                </div>
          

                <div class="col-md-6 col-xl-2">
                    <div class="card text-center">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-danger mt-2">{{ number_format($orders->where('status', 'canceled')->count()) }}</h3> Total Canceled

                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-2">
                    <div class="card text-center">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-info mt-2">{{ number_format($orders->where('status', 'delivered to warehouse')->count()) }}</h3>Total In Warehouse
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-2">
                    <div class="card text-center">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-success mt-2">{{ number_format($orders->sum('cashcollected')) }}</h3> Cash Collected
                        </div>
                    </div>
                </div>


                <div class="col-md-6 col-xl-2">
                    <div class="card text-center">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-primary mt-2">{{ number_format($collectedordersbags) }}</h3> Picked Bags
                        </div>
                    </div>
                </div>

            </div>
            {{-- end row --}}

            <div class="row">


                <div class="col-md-6 col-xl-2">
                    <div class="card text-center">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-primary mt-2">{{ number_format($orders->sum('bag')) }}</h3> Collected Bags
                        </div>
                    </div>
                </div>


   
                <div class="col-md-6 col-xl-2">
                    <div class="card text-center">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-info mt-2">{{ number_format($returnedbags->sum('bags')) }}</h3> Returned Bags
                        </div>
                    </div>
                </div>



                <div class="col-md-6 col-xl-2">
                    <div class="card text-center">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-info mt-2">{{ number_format($partners->count()) }}</h3>Total Restaurants
                        </div>
                    </div>
                </div>
                
                
                <div class="col-md-6 col-xl-2">
                    <div class="card text-center">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-purple mt-2">{{ number_format($customers->count()) }}</h3> Total Customers
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-2">
                    <div class="card text-center">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-primary mt-2">{{ number_format($drivers->count()) }}</h3>Total Drivers
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-2">
                    <div class="card text-center">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-purple mt-2">0</h3> Total Employees
                        </div>
                    </div>
                </div>
            
            </div>
            {{-- end row --}}

   



            <div class="row">
                
                    <div class="col-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Total Deliveries</h4>

                                <div class="row text-center mt-4">
                                    <div class="col-6">
                                        <h5 class="mb-2 font-size-18">{{ number_format($orders->where('status', 'delivered')->count()) }}</h5>
                                        <p class="text-muted text-truncate">Delivered</p>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="mb-2 font-size-18">{{ number_format($orders->where('status', 'canceled')->count()) }}</h5>
                                        <p class="text-muted text-truncate">Returned | Canceled</p>
                                    </div>
                                </div>


                                <div id="pie-chart" style="height: 250px;"></div>


                            </div>
                        </div>
                    </div>

                    <div class="col-8">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="card-title">Drivers Tracking</h4>
                                <p class="card-title-desc">Drivers on the way to customers</p>


                                <div class="mapouter">
                                    <div class="gmap_canvas"><iframe width="800" height="500" id="gmap_canvas"
                                            src="https://maps.google.com/maps?q=duabi&t=&z=13&ie=UTF8&iwloc=&output=embed"
                                            frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a
                                            href="#"></a><br>
                                        <style>
                                            .mapouter {
                                                text-align: center;
                                                height: 289px;
                                            }
                                        </style><a href="#"></a>
                                        <style>
                                            .gmap_canvas {
                                                overflow: hidden;
                                                background: none !important;
                                                height: 289px;
                                            }
                                        </style>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- end col 8 --}}
              
            



                    {{-- collection deliveries --}}
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Collection Deliveries</h4>
                                <p class="card-title-desc">Review all deliveries to collect</p>

                                <div class="table-responsive">
                                    <table class="table mb-0">

                                        <thead class="thead-light">
                                            <tr>
                                                <th>Collector Name</th>
                                                <th>Phone</th>
                                                <th>Assigned Deliveries</th>
                                                <th>Collected Deliveries</th>
                                                <th>Collected Bags</th>
                                                <th>View</th>
                                            </tr>
                                        </thead>

                                        {{-- tbody --}}
                                        <tbody>

                                            <?php $counter = 1; ?>

                                            @foreach ($collectordrivers as $driver)
                                                
                                            {{-- table row --}}
                                            <tr>
                                                
                                                <td>{{ $driver->name }}</td>

                                                <td>{{ $driver->phone }}</td>
                                                
                                                <td>{{ $driver->collectedorders->count() }}</td>

                                                <td>{{ $driver->collectedorders->where('status', 'delivered to warehouse')->count() }}</td>

                                                {{-- collected bags (not done) --}}
                                                <td>0</td>


                                                
                                                {{-- view orders button (open modal) --}}
                                                <td>
                                                    <button type="button"
                                                        class="btn-sm btn btn-outline-success waves-effect waves-light"
                                                        data-toggle="modal" data-target="#collector-orders-{{ $counter }}"> <i class="dripicons-preview"></i></button>

                                                </td>

                                            </tr>
                                            {{-- end of table row --}}

                                            {{-- increase counter --}}
                                            <?php $counter++; ?>

                                            @endforeach
                                            {{-- end foreach --}}


                                        </tbody>
                                        {{-- end tbody --}}

                                    </table>
                                </div>
                                {{-- end table wrapper --}}


                                {{-- pagination --}}
                                <div class="pagination mt-4">
                                    {!! $collectordrivers->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
              




                {{-- modal --}}
                {{-- collector driver orders --}}
                <?php $counter = 1; ?>

                @foreach ($collectordrivers as $driver)
                    
                <div class="modal fade collect-list" id="collector-orders-{{ $counter }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title mt-0" id="myLargeModalLabel">Restaurant Collected List Details
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">

                                    <div class="col-md-6 col-xl-3">
                                        <div class="card text-center">
                                            <div class="mb-2 card-body text-muted">
                                                <h3 class="text-info mt-2">{{ number_format($driver->collectedorders->count()) }}</h3>Total Assinged
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xl-3">
                                        <div class="card text-center">
                                            <div class="mb-2 card-body text-muted">
                                                <h3 class="text-success mt-2">{{ number_format($driver->collectedorders->where('status', 'delivered to warehouse')->count()) }}</h3> Total Collected

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xl-3">
                                        <div class="card text-center">
                                            <div class="mb-2 card-body text-muted">
                                                <h3 class="text-info mt-2">0</h3>Total Bags
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-xl-3">
                                        <div class="card text-center">
                                            <div class="mb-2 card-body text-muted">
                                                <h3 class="text-danger mt-2">{{ number_format($driver->collectedorders->where('status', '!=', 'delivered to warehouse')->count()) }}</h3> Not Collected
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row" id="collectorsreportdiv-{{ $counter }}">


                                    {{-- image for printing only --}}
                                    <div class="col-12 printimagediv text-center">
                                        <span class="logo-lg">
                                            <img src="{{ asset('assets/admins/assets/images/Prime-logo1.png') }}" style="object-fit: contain" width="110" height="80"> </span>
                                    </div>


                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title">Collection Deliveries</h4>
                                                <p class="card-title-desc">Collector: {{ $driver->name }}</p>
                                           

                                                <div class="table-responsive">
                                                    <table class="table mb-0">

                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th>Delivery No.</th>
                                                                <th>Restaurant</th>
                                                                <th>Customer</th>
                                                                <th>Phone</th>
                                                                <th>Delivery Date</th>
                                                                <th>Status</th>
                                                                <th>Bag</th>
                                                            </tr>
                                                        </thead>


                                                        {{-- tbody --}}
                                                        <tbody>

                                                            @foreach ($driver->collectedorders->sortByDesc('deliverydate') as $order)
                                                                
                                                            {{-- table row --}}
                                                            <tr>
                                                                <td># {{ $order->id }}</td>
                                                                <td>{{ $order->partner->name }}</td>

                                                                <td>{{ $order->customer->name }}</td>


                                                                <td>{{ $order->customer->phone }}</td>

                                                                <td>{{ $order->deliverydate }}</td>

                                                                {{-- order status --}}
                                                        
                                                                @if ($order->status == "delivered to warehouse")
                                                                
                                                                <td><i class="mdi mdi-checkbox-blank-circle text-success"></i> Delivered To Warehouse</td>
                                                                
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


                                    {{-- print button --}}
                                    <div class="col-lg-12 col-xl-12">
                                        <div class="text-center">
                                            <button onclick="printDiv('collectorsreportdiv-{{ $counter }}')" class="btn btn-outline-success print-buttons">
                                                <i class="fa fa-print"></i>
                                            </button>
                                        </div>
                                    </div>
                                    {{-- end print button --}}


                                </div>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                {{-- end collector driver orders modal --}}


                {{-- increase counter --}}
                <?php $counter++; ?>


                @endforeach
                {{-- end foreach --}}
                




                {{-- delivery for today --}}
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Deliveries For Today</h4>
                                <p class="card-title-desc">Review all deliveries for today with current status</p>

                                <div class="table-responsive">
                                    <table class="table mb-0">

                                        <thead class="thead-light">
                                            <tr>
                                                <th>Delivery No.</th>
                                                <th>Restaurant</th>
                                                <th>Customer</th>
                                                <th>Phone</th>

                                                <th>City</th>
                                                <th>District</th>
                                                <th>Address</th>
                                                <th>Location</th>

                                                <th>Comments/Notes</th>

                                                <th>Status</th>
                                                <th>Delivered At</th>
                                                <th>Driver</th>
                                            </tr>
                                        </thead>

                                        {{-- tbody --}}
                                        <tbody>

                                            {{-- foreach --}}
                                            @foreach($todayorders as $order)

                                            {{-- table row --}}
                                            <tr>
                                                <td># {{ $order->id }}</td>
                                                <td>{{ $order->partner->name }}</td>
                                                <td>{{ $order->customer->name }}</td>
                                                <td>{{ $order->customer->phone }}</td>

                                                <td>{{ $order->customer->city->name }}</td>
                                                <td>{{ $order->customer->district->name }}</td>
                                                <td>{{ $order->customer->address }}</td>


                                                <td><a href="https://www.google.com/maps/search/?api=1&query={{ ltrim($order->customer->locationlink, '@') }}" class="text-warning" target="_blank">Show Map</a></td>


                                                <td>{{ $order->customer->info }}</td>

                                                @if ($order->status == "delivered")
                                                
                                                <td><i class="mdi mdi-checkbox-blank-circle text-success"></i> Delivered</td>
                                                
                                                @elseif ($order->status == "canceled")
                                                
                                                <td><i class="mdi mdi-checkbox-blank-circle text-danger"></i> Canceled</td>
                                                
                                                @else
                                                
                                                <td><i class="mdi mdi-checkbox-blank-circle text-warning"></i> {{ ucwords($order->status) }}</td>
                                                
                                                @endif

                                                <td>{{ (!empty($order->updatedate) ? $order->updatedate : "-") }}</td>

                                                <td>{{ (!empty($order->driver->name) ? $order->driver->name : "-") }}</td>

                                            </tr>
                                            {{-- end table row --}}
                                            
                                            @endforeach
                                            {{-- end foreach --}}

                                        </tbody>
                                        {{-- end tbody --}}
                                    </table>
                                </div>
                                {{-- end table wrapper --}}


                                {{-- pagination --}}
                                <div class="pagination mt-3">
                                    {!! $todayorders->links() !!}
                                </div>

                            </div>
                        </div>
                    </div>
                    {{-- end col --}}







                    {{-- deliveries for today (purchases) --}}
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Deliveries For Today - Supplier</h4>
                                <p class="card-title-desc">Review all deliveries for today with current status</p>
                    
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                
                                        <thead class="thead-light">
                                
                                
                                            <tr>
                                                <th>Delivery No.</th>
                                                {{-- <th>Supplier</th> --}}
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

                                                <th>Driver</th>
                                                {{-- <th>Cancel</th> --}}

                                                <td>Invoice</td>
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
                                
                                                <td><a href="https://www.google.com/maps/search/?api=1&query=" class="text-warning" target="_blank">Show
                                                        Map</a></td>
                                
                                
                                                {{-- deliverydate + delivery time --}}
                                                <td>{{ date('d M Y', strtotime($purchase->delivery_date)) }}</td>
                                
                                                {{-- <td>Lorem ipsum dolor sit amet consectetur adipisicing elit.</td> --}}
                                
                                
                                                <td><i class="mdi mdi-checkbox-blank-circle text-warning mr-1"></i>{{
                                                    ucwords($purchase->status) }}</td>
                                
                                                <td>-</td>
                                                    
                                                <td>
                                                    @if ($purchase->driver)
                                                        {{ $purchase->driver->name }}
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                
                                
                                
                                                <td>
                                                    <button type="button"
                                                    class="btn-sm btn btn-outline-dark waves-effect waves-light"
                                                data-toggle="modal" data-target=".purchase-{{$purchase->id}}">View Invoice</button> 
                                                </td>
                                            </tr>
                                            {{-- end table row --}}
                                
                                            @endforeach
                                
                                        </tbody>
                                        {{-- end tbody --}}
                                    </table>
                                </div>
                                {{-- end table wrapper --}}
                    
                    
                                {{-- pagination --}}
                                <div class="pagination mt-3">
                                    {!! $todayorders->links() !!}
                                </div>
                    
                            </div>
                        </div>
                    </div>
                    {{-- end col --}}






                    {{-- assign driver to one time delivery --}}
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Assign Drivers To One Time Deliveries</h4>
                                <p class="card-title-desc">Review all unassigned one time deliveries</p>

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
                                                <th>Location</th>
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
                                                <td>{{ $order->partner->name }}</td>
                                                <td>{{ $order->customer_name }}</td>
                                                <td>{{ $order->customer_phone }}</td>
                                                <td>{{ $order->city->name }}</td>
                                                <td>{{ $order->district->name }}</td>
                                                <td>{{ $order->customer_address }}</td>

                                                <td><a href="https://www.google.com/maps/search/?api=1&query={{ ltrim($order->customer_locationlink, '@') }}" class="text-warning" target="_blank">Show Map</a></td>
                                        


                                                <td>{{ $order->deliverydate }}</td>
                                                
                                                <td>{{ $order->meal }}</td>
                                                
                                                <td><i class="mdi mdi-checkbox-blank-circle text-warning"></i> Requested</td>
                                                

                                                <td>
                                                    <button type="button"
                                                        class="btn-sm btn btn-outline-dark waves-effect waves-light order-assign-id"
                                                        data-toggle="modal" data-target=".drivers-list" value="{{ $order->id }}">Drivers</button>
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










                    {{-- assign driver to Otherpartner deliveries --}}
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Assign Drivers To Partners Deliveries</h4>
                                <p class="card-title-desc">Review all unassigned partners deliveries</p>

                                <div class="table-responsive">
                                    <table class="table mb-0">

                                        <thead class="thead-light">
                                            <tr>
                                                <th>Partner</th>
                                                <th>Customer</th>
                                                <th>Phone</th>
                                                <th>City</th>
                                                <th>District</th>
                                                <th>Address</th>
                                                <th>Location</th>
                                                <th>Priority</th>
                                                <th>Delivery Date</th>
                                                <th>Pickup Time</th>
                                                <th>Delivery Time</th>
                                                <th>Comments/Notes</th>
                                                <th>Status</th>
                                                
                                                <th>Assign to</th>
                                            </tr>
                                        </thead>

                                        {{-- tbody --}}
                                        <tbody>

                                            {{-- singleorders foreach --}}
                                            @foreach ($othersingleorders as $order)
                                                
                                            {{-- table row --}}
                                            <tr>
                                                <td>{{ $order->otherpartner->name }}</td>
                                                <td>{{ $order->customer_name }}</td>
                                                <td>{{ $order->customer_phone }}</td>
                                                <td>{{ $order->city->name }}</td>
                                                <td>{{ $order->district->name }}</td>

                                                <td>{{ $order->customer_address }}</td>

                                                <td><a href="https://www.google.com/maps/search/?api=1&query={{ ltrim($order->customer_locationlink, '@') }}" class="text-warning" target="_blank">Show Map</a></td>

                                                {{-- priority --}}
                                                @if ($order->otherpartner->priority == "MVP")
                                                <td class="text-danger">MVP</td>

                                                @elseif ($order->otherpartner->priority == "high")
                                                <td class="text-warning">High</td>

                                                @else
                                                <td class="text-primary">Normal</td>
                                                @endif

                                                <td>{{ $order->deliverydate }}</td>
                                                <td>{{ $order->pickuptime }}</td>
                                                <td>{{ $order->deliverytime }}</td>
                                                <td>{{ $order->info }}</td>
                                               
                                                
                                                <td><i class="mdi mdi-checkbox-blank-circle text-warning"></i> Requested</td>
                                                

                                                <td>
                                                    <button type="button"
                                                        class="btn-sm btn btn-outline-dark waves-effect waves-light order-assign-id-2"
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
                                    {!! $othersingleorders->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->








                    {{-- activity col --}}
                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-body" style="height: 450px; overflow-y:scroll">
                                <h4 class="card-title mb-3">Recent Activity Feeds</h4>

                                <ol class="activity-feed mb-0">

                                    @foreach ($activities as $activity)
                                        
                                    <li class="feed-item">
                                        <span class="date">{{ $activity->datetime }}</span>
                                        <span class="activity-text">{{ $activity->longinfo }}</span>
                                    </li>

                                    @endforeach

                                    
                                </ol>
                            </div>
                        </div>
                    </div>
                    {{-- end activity col --}}




                    {{-- drivers online status --}}
                    <div class="col-xl-8">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Drivers Availablity</h4>

                                <div class="table-responsive">
                                    <table class="table mt-4 mb-0 table-centered table-nowrap">

                                        <thead>
                                            <tr>
                                                <th>Driver Name</th>
                                                <th>Phone</th>
                                                <th>Assigned Area</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>

                                        {{-- tbody --}}
                                        <tbody>

                                            

                                            @foreach ($pagdrivers as $driver)


                                            {{-- table row --}}
                                            <tr>

                                                {{-- name --}}
                                                <td>
                                                    <img src="{{ asset('assets/img/drivers/profiles/'.$driver->pic) }}" alt="user-image" class="avatar-sm rounded-circle mr-2" /> {{ $driver->name }}
                                                </td>

                                                {{-- phone --}}
                                                <td>{{ $driver->phone }}</td>

                                                {{-- districts names --}}
                                                <td style="overflow:hidden">

                                                    {{-- counter --}}
                                                    <?php $counter = 1; ?>

                                                    @foreach ($driver->districts as $districtid)

                                                    @if ($counter == 1)
                                                        <p class="d-inline-block mb-0"> {{ $districtid->district->name }}</p>

                                                    @else
                                                        <p class="table-multiple-districts mb-0"> {{ $districtid->district->name }}</p>
                                                    @endif
                                                        

                                                    {{-- increase counter --}}
                                                    <?php $counter++; ?>

                                                    @endforeach
                                                </td>

                                                {{-- online - offline --}}
                                                @if ($driver->onlinestatus == "online")
                                                    <td><i class="mdi mdi-checkbox-blank-circle text-success"></i> Online
                                                    </td>

                                                @else
                                                    <td><i class="mdi mdi-checkbox-blank-circle text-danger"></i> Offline
                                                    </td>
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

                                {{-- pagination --}}
                                <div class="pagination mt-4">
                                    {!! $pagdrivers->links() !!}
                                </div>


                            </div>
                        </div>
                    </div>
                    {{-- end driver status col --}}


             

            </div>
            <!-- end row -->
        </div>
        <!-- End container fluiid -->

        <footer class="footer">

        </footer>

    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->







{{-- assign driver to single oreder --}}
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

                {{-- form (search partner) --}}
                <form action="{{ route('admin.addonetimeorderdriver') }}" method="post">


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






{{-- modal --}}
{{-- collectedorders -> drivers --}}

<div class="modal fade drivers-list-2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Assign Driver</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                {{-- form (add order driver (using customer id) --}}
                <form action="{{ route('admin.addothersingleordersdrivermain') }}" method="post">


                    {{-- method fields --}}
                    @method('POST')
                    @csrf


                    {{-- order id --}}
                    <input type="hidden" id="modal-assign-order-2" name="order_id" value="">

                    {{-- row --}}
                    <div class="row">


                        {{-- driver --}}
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
                        {{-- end driver --}}

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



{{-- endmaincontent --}}

@foreach ($purchases as $purchase)
      

<div class="modal fade purchase-{{$purchase->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Order Purchase Invoice</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            <div class="pt-0 pt-md-5" id="purcahse-{{$purchase->id}}">
                    <div class="container">
                        <div class="row align-items-center">
            
            
                            <div class="col-12 mt-0 mt-md-4 mb-0 mb-md-5" style="background-color: #293749">
            
            
                                
                                <div class="row">
            
                                    {{-- logo --}}
                                    <div class="offset-1 col-10 mb-3">
                                        
            
                                        {{-- heading --}}
                                        <div class="row align-items-end">
                                            <div class="col-12 d-none d-md-block" style="position: relative">
                                                <h1 class="d-block text-center text-uppercase" style="letter-spacing: 0.5px; margin-top:70px; margin-bottom:45px;">Invoice</h1>
            
                                                <img class="login-logo" src="{{ asset('assets/partners/assets/images/Prime-logo1.png') }}" alt="logo" width="130" height="130" style="position: absolute; left:0px; top:0px">
                                            </div>
            
                                            
                                            {{-- mobie view --}}
                                            <div class="col-12 d-block d-md-none" style="position: relative">
            
                                                <p class="text-center mb-0">
                                                    <img class="login-logo" src="{{ asset('assets/partners/assets/images/Prime-logo1.png') }}" alt="logo" width="150"
                                                        height="50">
                                                </p>
            
                                                <h3 class="d-block text-center text-uppercase" style="letter-spacing: 0.5px; margin-bottom:45px;">
                                                    Invoice</h3>
                                            
                                                
                                            </div>
            
                                        </div>
                                        
            
            
            
            
            
            
                                        {{-- basic info --}}
                                        <div class="row align-items-end pt-5">
            
            
                                            {{-- client info + invoice --}}
                                            <div class="col-12 col-md-6">
                                                <h4 class="mb-4">{{ $purchase->fname." ".$purchase->lname }}</h4>
                                                <p class="mb-1 font-size-15">Date Issued:<strong class="ml-2">{{ date('d M Y', strtotime($purchase->created_at)) }}</strong></p>
                                                <p class="font-size-15 d-inline-block">Tracking No:</p>
                                                <p class="ml-2 px-2 d-inline-block mb-0" style="border:2px solid #fb4; border-radius:2px; font-weight:bold;">{{ $purchase->tracking_number }}</p>
                                            </div>
                                            
                                            
                                            {{-- client address info --}}
                                            <div class="col-12 col-md-6 text-left text-md-right">
                                                <p class="mb-1 font-size-15">{{ $purchase->address }}</p>
                                                <p class="mb-1 font-size-15">{{ $purchase->city->name }}, {{ $purchase->district->name }}</p>
                                                <p class="font-size-15">{{ $purchase->phone }}</p>
                                            </div>
            
                                        </div>
            
            
            
            
            
            
                                        {{-- table of products (only desktop) --}}
                                        <div class="row align-items-end pt-5 mt-3 pb-4 d-none d-md-block" style="background-color: #fff0">
            
                                            <div class="col-12">
            
                                                {{-- heeadings orw --}}
                                                <div class="row" style="border-bottom: 2px solid dimgrey; margin-bottom:30px">
                                                    
                                                    <div class="col-3">
                                                        <h6 style="color:lightgrey;">Product</h6>
                                                    </div>
            
                                                    <div class="col-3">
                                                        <h6 style="color:lightgrey;">Flavor</h6>
                                                    </div>
            
                                                    <div class="col-3">
                                                        <h6 style="color:lightgrey;">Quantity</h6>
                                                    </div>
            
                                                    <div class="col-3">
                                                        <h6 style="color:lightgrey;">Price</h6>
                                                    </div>
                                                </div>
            
            
            
                                                {{-- summation --}}
            
                                                {{-- products row --}}
                                                <div class="row">
            
                                                    @foreach ($purchase->items as $item)
                                                        
                                                    {{-- repeat this 4 col for each product --}}
                                                    <div class="col-3 mb-2">
                                                        <h5 class="font-size-sm-16">{{ $item->product->name }}</h5>
                                                    </div>
                                                    
                                                    <div class="col-3 mb-2">
                                                        <h5 class="font-size-sm-16">{{ $item->flavor->name }}</h5>
                                                    </div>
                                                    
                                                    <div class="col-3 mb-2">
                                                        <h5 class="font-size-sm-16">{{ $item->quantity }}</h5>
                                                    </div>
                                                    
                                                    <div class="col-3 mb-2">
                                                        <h5 class="font-size-sm-16">{{ $item->price }}</h5>
                                                    </div>
            
            
                                                    @endforeach
            
            
            
            
                                                    <div class="col-3 pt-4 mb-2">
                                                        <h5 class="font-size-sm-16" style="text-decoration: underline">Delivery Charge</h5>
                                                    </div>
                                                    
                                                    <div class="col-3 pt-4 mb-2">
                                                        <h5 class="font-size-sm-16">-</h5>
                                                    </div>
                                                    
                                                    <div class="col-3 pt-4 mb-2">
                                                        <h5 class="font-size-sm-16">-</h5>
                                                    </div>
                                                    
                                                    <div class="col-3 pt-4 mb-2">
                                                        <h5 class="font-size-sm-16">{{ $purchase->delivery_price }}</h5>
                                                    </div>
            
                                                </div>
            
            
            
                                                {{-- total row --}}
                                                <div class="row" style="border-top: 2px solid dimgrey; margin-top:10px">
            
                                                    <div class="col-3 mt-2">
                                                        <h4>Total</h4>
                                                    </div>
            
                                                    <div class="col-3 mt-2">
                                                        <h4>-</h4>
                                                    </div>
            
                                                    <div class="col-3 mt-2">
                                                        <h4>-</h4>
                                                    </div>
            
                                                    <div class="col-3 mt-2">
                                                        <h4 class="text-warning" style="text-decoration: underline">{{ $purchase->price + $purchase->delivery_price }} (AED)</h4>
                                                    </div>
            
                                                </div>
            
            
            
                                                {{-- notes row --}}
                                                <div class="row" style="">
            
                                                    <div class="col-12 mt-5 pt-2">
                                                        
                                                        <h6 style="font-size:17px;">
                                                            <input type="checkbox" name="" id="" disabled checked style="width:20px; height:16px;">
                                                            Cash On Delivery
                                                        </h6>
            
                                                        <h6 style="margin-top: 20px; font-size:17px;">
                                                            Don't forget to keep "{{ $purchase->price + $purchase->delivery_price }}" ready in delivery, <span style="border-bottom:1px solid #fb4;">we only accept cash.</span>
                                                        </h6>
                                                        
                                                    </div>
                                                </div>
            
                                            </div>
                                        </div>
                                        {{-- end row --}}
            
            
            
            
            
            
                                        {{-- mobile view table --}}
                                        <div class="d-md-none">
                                            <table class="table mt-4 mb-3" style="background-color: #fff0">
                                        
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>Product</th>
                                                        <th>Flavor</th>
                                                        <th>Quantity</th>
                                                        <th>Price</th>
                                                   
                                                    </tr>
                                                </thead>
                                        
                                                {{-- tbody --}}
                                                <tbody>
                                        
                                                    {{-- table row --}}
                                                    
                                                    @foreach ($purchase->items as $item)
            
                                                    <tr>
                                                        <td>{{ $item->product->name }}</td>
                                                        <td>{{ $item->flavor->name }}</td>
                                                        <td>{{ $item->quantity }}</td>
                                                        <td>{{ $item->price }}</td>
                                                    </tr>
            
            
                                                    @endforeach
                                                    
                                                    <tr class="pt-4">
                                                        <td style="text-decoration: underline">Delivery Charge</td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                        <td>{{ $purchase->delivery_price }}</td>
                                                    </tr>
                                                    
            
                                                    <tr style="border-top: 1px solid dimgrey">
                                                        <td>Total</td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                        <td style="font-weight: bold; color:#fb4; text-decoration:underline">{{ $purchase->price + $purchase->delivery_price }} (AED)</td>
                                                    </tr>
                                        
                                                </tbody>
                                                {{-- end tbody --}}
                                            </table>
                                        </div>
            
            
            
            
                                        {{-- notes row --}}
                                        <div class="row d-block d-md-none" style="">
                                        
                                            <div class="col-12 mt-5 pt-2">
                                        
                                                <h6 style="font-size:15px;">
                                                    <input type="checkbox" name="" id="" disabled checked style="width:15px; height:15px; margin-right:5px;">
                                                    Cash On Delivery
                                                </h6>
                                        
                                                <h6 style="margin-top: 20px; font-size:15px;">
                                                    Don't forget to keep "{{ $purchase->price + $purchase->delivery_price }}" ready in delivery, <span
                                                        style="border-bottom:1px solid #fb4;">we only accept cash.</span>
                                                </h6>
                                        
                                            </div>
                                        </div>
            
            
                                    </div>
                                    {{-- end col --}}
                                
                                    
                                </div>
            
                            </div>
            
            
            
                        </div>
                    </div>

                    <div class="col-lg-12 col-xl-12">
                        <div class="text-center">
                            <button onclick="printDiv('purcahse-{{ $purchase->id }}')" class="btn btn-outline-success print-buttons">
                                <i class="fa fa-print"></i>
                            </button>
                        </div>
                    </div>

                </div>
            

             

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



@endforeach




@endsection
