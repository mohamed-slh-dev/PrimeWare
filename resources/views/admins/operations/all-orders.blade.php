@extends('layouts.admin')


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
            <div class="row">
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
                                        <p class="mb-0 text-muted">Total Deliveries</p>
                                        <h4 class="mt-0 mb-1 d-inline-block">{{ number_format($orders->count()) }}</h4>
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
                                            <p class="mb-0 text-muted">Delivered</p>
                                            <h4 class="mt-0 mb-1 d-inline-block">{{ number_format($orders->where('status', 'delivered')->count()) }}</h4>


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
                                        <p class="mb-0 text-muted">Canceled</p>
                                        <h4 class="mt-0 mb-1 d-inline-block">{{ number_format($orders->where('status', 'canceled')->count()) }}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="progress mt-2" style="height:3px;">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 48%;"
                                    aria-valuenow="{{ $orders->where('status', 'canceled')->count() }}" aria-valuemin="0" aria-valuemax="{{ $orders->count() }}"></div>
                            </div>
                        </div>
                        <!--end card-body-->
                    </div>
                    <!--end card-->
                </div>
                <!--end col-->
            </div>
            <!--end row-->



            {{-- filter for delivery orders --}}
            <div class="row">
                <div class="col-lg-12">
                    <div class="card client-card">
                        <div class="card-body text-center">
                            <div class="row">
                                <div class="col-12">

                                    {{-- form --}}
                                    {{-- form (search partner) --}}
                                    <form action="{{ route('admin.searchallorders') }}" method="get">
                                    
                                        {{-- method fields --}}
                                        @method('GET')
                                        @csrf

                                        {{-- row --}}
                                        <div class="row">

                                            <div class="col-2 ">
                                                <div class="form-group row">
                                                    <label for="example-text-input"
                                                        class="col-sm-4 col-form-label">#No.</label>
                                                    <div class="col-sm-8">
                                                       <input type="number" class="form-control" name="id" id="">
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- 1- status --}}
                                            <div class="col-3">
                                                <div class="form-group row">
                                                    <label for="example-text-input"
                                                        class="col-sm-4 col-form-label">Status</label>
                                                    <div class="col-sm-8">
                                                        <select name="status" class="custom-select ">

                                                            <option value="all">All</option>

                                                            {{-- 1 --}}
                                                            <option value="not received">Not Received</option>

                                                            {{-- 2 --}}
                                                            <option value="received from restaurant">Received From Restaurant</option>

                                                            {{-- 3 --}}
                                                            <option value="delivered to warehouse">Delivered To Warehouse</option>
                                                            
                                                            {{-- 4 --}}
                                                            <option value="picked from warehouse">Picked From Warehouse</option>

                                                            {{-- 5 --}}
                                                            <option value="delivered">Delivered</option>

                                                            {{-- 6 --}}
                                                            <option value="canceled">Canceled</option>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- driver --}}
                                            <div class="col-3 ">
                                                <div class="form-group row">
                                                    <label for="example-text-input"
                                                        class="col-sm-4 col-form-label">Driver</label>
                                                    <div class="col-sm-8">
                                                        <select name="driver" class="custom-select ">

                                                            <option value="all" selected="">All</option>

                                                            @foreach ($drivers as $driver)
                                                                <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>


                                            {{-- partner --}}
                                            <div class="col-3">
                                                <div class="form-group row">
                                                    <label for="example-text-input"
                                                        class="col-sm-4 col-form-label">Restaurant</label>
                                                    <div class="col-sm-8">
                                                        <select name="partner" class="custom-select ">

                                                            <option value="all">All</option>

                                                            @foreach ($partners as $partner)
                                                            <option value="{{ $partner->id }}">{{ $partner->name }}</option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>


                                            {{-- search button --}}
                                            <div class="col-12 text-center">
                                                <button type="submit" class="btn btn-outline-success waves-effect waves-light mx-3">Search</button>
                                            </div>

                                        </div>
                                        {{-- row --}}

                                    </form>
                                    {{-- end form --}}

                                </div>
                                {{-- end row + col --}}

                            </div>
                            {{-- end row --}}

                        </div>
                    </div>
                </div>
                {{-- end col --}}
            </div>
            {{-- end row --}}




            {{--all delivery orders --}}
            <div class="row">


                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Customers Deliveries</h4>
                            <p class="card-title-desc">Review all deliveries</p>

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

                                            <th>Status</th>
                                            <th>Delivery Date</th>
                                            <th>Driver</th>
                                            <th>Cash Collected</th>
                                            <th>Delivery Picture</th>

                                        </tr>
                                    </thead>

                                    {{-- tbody --}}
                                    <tbody>

                                        {{-- foreach all orders --}}
                                        @foreach ($pagorders as $order)
                                            
                                        {{-- trow --}}
                                        <tr>
                                            <td># {{ $order->id }}</td>
                                            <td>{{ $order->partner->name }}</td>

                                            <td>{{ $order->customer->name }}</td>
                                            <td>{{ $order->customer->phone }}</td>

                                            <td>{{ $order->customer->city->name }}</td>
                                            <td>{{ $order->customer->district->name }}</td>

                                            <td>{{ $order->customer->address }}</td>

                                            <td><a href="https://www.google.com/maps/search/?api=1&query={{ ltrim($order->customer->locationlink, '@') }}" class="text-warning" target="_blank">Show Map</a></td>

                                            @if ($order->status == "delivered")
                                            
                                            <td><i class="mdi mdi-checkbox-blank-circle text-success"></i> Delivered</td>
                                            
                                            @elseif ($order->status == "canceled")
                                            
                                            <td><i class="mdi mdi-checkbox-blank-circle text-danger"></i> Canceled</td>
                                            
                                            @else
                                            
                                            <td><i class="mdi mdi-checkbox-blank-circle text-warning"></i> {{ ucwords($order->status) }}</td>
                                            
                                            @endif


                                            <td>{{ $order->deliverydate }}</td>
                                            <td>{{ (!empty($order->driver->name) ? $order->driver->name : "-") }}</td>
                                            <td>{{ $order->cashcollected }}</td>
                                            <td class="text-center">
                                                @if (!empty($order->receivedpic))
                                                <a href=" {{asset('assets/img/partners/delivery-pics/'.$order->receivedpic)}} " download="" style="font-size: 18px;"> <i class="mdi mdi-download "></i> </a>
                                                @else
                                                No photo
                                                @endif
                                            </td>

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
                                {!! $pagorders->appends(Request::all())->links() !!}
                            </div>


                        </div>
                    </div>
                </div>
                <!-- end col -->


                {{-- hr --}}
                <div class="col-lg-12">
                    <hr>
                </div>





                {{-- special orders --}}
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Special Deliveries</h4>
                            <p class="card-title-desc">Review all special deliveries</p>
                
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
                                            <th>Status</th>
                                            <th>Delivery Date</th>
                                            <th>Driver</th>
                
                                        </tr>
                                    </thead>
                
                                    {{-- tbody --}}
                                    <tbody>
                
                                        {{-- foreach all orders --}}
                                        @foreach ($pagspecialorders as $order)
                
                                        {{-- trow --}}
                                        <tr>
                                            <td># {{ $order->id }}</td>
                                            <td>{{ $order->partner->name }}</td>
                
                                            <td>{{ $order->customer->name }}</td>
                                            <td>{{ $order->customer->phone }}</td>

                                            <td>{{ $order->customer->city->name }}</td>
                                            <td>{{ $order->customer->district->name }}</td>

                                            <td>{{ $order->customer->address }}</td>
                                            
                                            <td><a href="https://www.google.com/maps/search/?api=1&query={{ ltrim($order->customer->locationlink, '@') }}" class="text-warning" target="_blank">Show Map</a></td>

                                            @if ($order->status == "delivered")
                
                                            <td><i class="mdi mdi-checkbox-blank-circle text-success"></i> Delivered</td>
                
                                            @elseif ($order->status == "canceled")
                
                                            <td><i class="mdi mdi-checkbox-blank-circle text-danger"></i> Canceled</td>
                
                                            @else
                
                                            <td><i class="mdi mdi-checkbox-blank-circle text-warning"></i> {{ ucwords($order->status) }}
                                            </td>
                
                                            @endif
                
                
                                            <td>{{ $order->deliverydate }}</td>
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
                                {!! $pagspecialorders->appends(Request::all())->links() !!}
                            </div>
                
                
                        </div>
                    </div>
                </div>
                <!-- end col -->







                {{-- onetime orders --}}
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">One-Time Deliveries</h4>
                            <p class="card-title-desc">Review all one-time deliveries</p>
                
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
                                            <th>Delivery Date</th>
                                            <th>Pickup Time</th>
                                            <th>Delivery Time</th>
                                            <th>Driver</th>
                
                                        </tr>
                                    </thead>
                
                                    {{-- tbody --}}
                                    <tbody>
                
                                        {{-- foreach all orders --}}
                                        @foreach ($singleorders as $order)
                
                                        {{-- trow --}}
                                        <tr>
                                            <td># {{ $order->id }}</td>
                                            <td>{{ $order->partner->name }}</td>
                
                                            <td>{{ $order->customer_name }}</td>
                                            <td>{{ $order->customer_phone }}</td>

                                            <td>{{ $order->city->name }}</td>
                                            <td>{{ $order->district->name }}</td>


                                            <td>{{ $order->customer_address }}</td>
                                        

                                            <td><a href="https://www.google.com/maps/search/?api=1&query={{ ltrim($order->customer_locationlink, '@') }}" class="text-warning" target="_blank">Show Map</a></td>


                                            {{-- note --}}
                                            <td>{{ $order->meal }}</td>

                                            @if ($order->status == "delivered")
                
                                            <td><i class="mdi mdi-checkbox-blank-circle text-success"></i> Delivered</td>
                
                                            @elseif ($order->status == "canceled")
                
                                            <td><i class="mdi mdi-checkbox-blank-circle text-danger"></i> Canceled</td>
                
                                            @else
                
                                            <td><i class="mdi mdi-checkbox-blank-circle text-warning"></i> {{ ucwords($order->status) }}
                                            </td>
                
                                            @endif
                
                
                                            <td>{{ $order->deliverydate }}</td>
                                            <td>{{ $order->pickuptime }}</td>
                                            <td>{{ $order->deliverytime }}</td>

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
                                {!! $singleorders->appends(Request::all())->links() !!}
                            </div>
                
                
                        </div>
                    </div>
                </div>
                <!-- end col -->











                {{-- hr --}}
                <div class="col-lg-12">
                    <hr>
                </div>


                {{-- collected orders filters --}}
                <div class="col-lg-12">
                    <div class="card client-card">
                        <div class="card-body text-center">
                            <div class="row">
                                <div class="col-12">

                                    {{-- form (search partner) --}}
                                    <form action="{{ route('admin.searchcollectedorders') }}" method="get">
                                    
                                        {{-- method fields --}}
                                        @method('GET')
                                        @csrf

                                        {{-- row --}}
                                        <div class="row">

                                            <div class="col-2 ">
                                                <div class="form-group row">
                                                    <label for="example-text-input"
                                                        class="col-sm-4 col-form-label">#No.</label>
                                                    <div class="col-sm-8">
                                                       <input type="number" class="form-control" name="id" id="">
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- from date --}}
                                            <div class="col-3">
                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-sm-4 col-form-label">Status</label>
                                                    <div class="col-sm-8">
                                                        <select name="status" class="custom-select ">
                                                        
                                                            <option value="all">All</option>
                                                            
                                                            {{-- 1 --}}
                                                            <option value="not received">Not Received</option>
                                                            
                                                            {{-- 2 --}}
                                                            <option value="received from restaurant">Received From Restaurant</option>
                                                            
                                                            {{-- 3 --}}
                                                            <option value="delivered to warehouse">Delivered To Warehouse</option>
                                                            
                                                            {{-- 4 --}}
                                                            <option value="picked from warehouse">Picked From Warehouse</option>
                                                           
                                                        
                                                            
                                                    
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                       


                                            {{-- driver --}}
                                            <div class="col-3 ">
                                                <div class="form-group row">
                                                    <label for="example-text-input"
                                                        class="col-sm-4 col-form-label">Driver</label>
                                                    <div class="col-sm-8">
                                                        <select name="driver" class="custom-select ">
                                                        
                                                            <option value="all" selected="">All</option>
                                                        
                                                            @foreach ($drivers as $driver)
                                                            <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                                            @endforeach
                                                        
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-4">
                                                <div class="form-group row">
                                                    <label for="example-text-input"
                                                        class="col-sm-4 col-form-label">Restaurant</label>
                                                    <div class="col-sm-8">
                                                        <select name="partner" class="custom-select ">

                                                            <option value="all">All</option>

                                                            @foreach ($partners as $partner)
                                                            <option value="{{ $partner->id }}">{{ $partner->name }}</option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>


                                            {{-- search button --}}
                                            <div class="col-12 text-center">
                                                <button type="submit" class="btn btn-outline-success waves-effect waves-light mx-3">Search</button>
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
                {{-- end of collected orders filters --}}





                {{-- collection deliveries --}}
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Collection Deliveries</h4>
                            <p class="card-title-desc">Review all collection deliveries</p>
                
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
                                            <th>Status</th>
                                            <th>Collection Date</th>
                                            <th>Driver</th>
                                    
                                        </tr>
                                    </thead>
                                    
                                    {{-- tbody --}}
                                    <tbody>
                                    
                                        {{-- foreach all orders --}}
                                        @foreach ($collectedorders as $order)
                                    
                                        {{-- trow --}}
                                        <tr>
                                            <td># {{ $order->id }}</td>
                                            <td>{{ $order->partner->name }}</td>
                                    
                                            <td>{{ $order->customer->name }}</td>
                                            <td>{{ $order->customer->phone }}</td>

                                            <td>{{ $order->customer->city->name }}</td>
                                            <td>{{ $order->customer->district->name }}</td>

                                            <td>{{ $order->customer->address }}</td>
                                    

                                            <td><a href="https://www.google.com/maps/search/?api=1&query={{ ltrim($order->customer->locationlink, '@') }}" class="text-warning" target="_blank">Show Map</a></td>
                                            
                                            @if ($order->status == "delivered to warehouse")
                                    
                                            <td><i class="mdi mdi-checkbox-blank-circle text-success"></i> Delivered To Warehouse</td>
                                    
                                            @elseif ($order->status == "canceled")
                                    
                                            <td><i class="mdi mdi-checkbox-blank-circle text-danger"></i> Canceled</td>
                                    
                                            @else
                                    
                                            <td><i class="mdi mdi-checkbox-blank-circle text-warning"></i> {{ ucwords($order->status) }}</td>
                                    
                                            @endif
                                    
                                    
                                            <td>{{ $order->deliverydate }}</td>
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
                            <div class="pagination mt-4">
                                {!! $collectedorders->appends(Request::all())->links() !!}
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end col -->









                {{-- hr --}}
                <div class="col-lg-12">
                    <hr>
                </div>















                {{-- othersingle orders filters --}}
                <div class="col-lg-12">
                    <div class="card client-card">
                        <div class="card-body text-center">
                            <div class="row">
                                <div class="col-12">
                
                                    {{-- form (search orders) --}}
                                    <form action="{{ route('admin.searchothersingleorders') }}" method="get">
                
                                        {{-- method fields --}}
                                        @method('GET')
                                        @csrf
                
                                        {{-- row --}}
                                        <div class="row">

                                              {{-- Order ID --}}
                                            <div class="col-2 ">
                                                <div class="form-group row">
                                                    <label for="example-text-input"
                                                        class="col-sm-4 col-form-label">#No.</label>
                                                    <div class="col-sm-8">
                                                       <input type="number" class="form-control" name="id" id="">
                                                    </div>
                                                </div>
                                            </div>
                
                                            {{-- from date --}}
                                            <div class="col-4 ">
                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-sm-4 col-form-label">Status</label>
                                                    <div class="col-sm-8">
                                                        <select name="status" class="custom-select ">
                
                                                            <option value="all">All</option>
                
                                                            <option value="requested">Requested</option>
                
                                                            <option value="delivered">Delivered</option>
                
                                                            <option value="canceled">Canceled</option>
                
                
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                
                
                
                
                                            {{-- driver --}}
                                            <div class="col-3 ">
                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-sm-4 col-form-label">Driver</label>
                                                    <div class="col-sm-8">
                                                        <select name="driver" class="custom-select ">
                
                                                            <option value="all" selected="">All</option>
                
                                                            @foreach ($drivers as $driver)
                                                            <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                                            @endforeach
                
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                
                
                                            <div class="col-3 ">
                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-sm-4 col-form-label">Partners</label>
                                                    <div class="col-sm-8">
                                                        <select name="partner" class="custom-select ">
                
                                                            <option value="all">All</option>
                
                                                            @foreach ($otherpartners as $partner)
                                                            <option value="{{ $partner->id }}">{{ $partner->name }}</option>
                                                            @endforeach
                
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                
                
                                            {{-- search button --}}
                                            <div class="col-12 text-center">
                                                <button type="submit"
                                                    class="btn btn-outline-success waves-effect waves-light mx-3">Search</button>
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
                {{-- end of othersingleorders filters --}}







                {{-- onetime orders --}}
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Partner Deliveries</h4>
                            <p class="card-title-desc">Review all partners deliveries</p>
                
                            <div class="table-responsive">
                                <table class="table mb-0">
                
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Delivery No.</th>
                                            <th>Partner</th>
                                            <th>Customer</th>
                                            <th>Phone</th>
                                            
                                            <th>City</th>
                                            <th>District</th>

                                            <th>Address</th>
                                            <th>Location</th>
                                            <th>Comments/Notes</th>
                                            <th>Status</th>
                                            <th>Pickup Time</th>
                                            <th>Delivery Time</th>
                                            <th>Driver</th>
                
                                        </tr>
                                    </thead>
                
                                    {{-- tbody --}}
                                    <tbody>
                
                                        {{-- foreach all orders --}}
                                        @foreach ($othersingleorders as $order)
                
                                        {{-- trow --}}
                                        <tr>
                                            <td># {{ $order->id }}</td>
                                            <td>{{ $order->otherpartner->name }}</td>
                
                                            <td>{{ $order->customer_name }}</td>
                                            <td>{{ $order->customer_phone }}</td>

                                            <td>{{ $order->city->name }}</td>
                                            <td>{{ $order->district->name }}</td>

                                            <td>{{ $order->customer_address }}</td>
                                            
                                            <td><a href="https://www.google.com/maps/search/?api=1&query={{ ltrim($order->customer_locationlink, '@') }}" class="text-warning" target="_blank">Show Map</a></td>
                                            

                                            <td>{{ $order->info }}</td>

                                            @if ($order->status == "delivered")
                
                                            <td><i class="mdi mdi-checkbox-blank-circle text-success"></i> Delivered</td>
                
                                            @elseif ($order->status == "canceled")
                
                                            <td><i class="mdi mdi-checkbox-blank-circle text-danger"></i> Canceled</td>
                
                                            @else
                
                                            <td><i class="mdi mdi-checkbox-blank-circle text-warning"></i> {{ ucwords($order->status) }}
                                            </td>
                
                                            @endif
                

                                            <td>{{ $order->pickuptime }}</td>
                                            <td>{{ $order->deliverytime }}</td>
                                            
                                            
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
                                {!! $othersingleorders->appends(Request::all())->links() !!}
                            </div>
                
                
                        </div>
                    </div>
                </div>
                <!-- end col -->

                

            </div>
            <!-- end row -->
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    <footer class="footer">

    </footer>
</div>
<!-- end main content-->

{{-- endcontent --}}








@endsection
