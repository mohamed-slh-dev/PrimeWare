@extends('layouts.admin')


@section('content')



{{-- continue header --}}
<!-- start page title -->
<div class="page-title-box">
    <div class="container-fluid">
        <div class="page-title-content">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4>Today Deliveries</h4>
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
                <div class="col-md-6 col-xl-3">
                    <div class="card text-center">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-success mt-2">{{ number_format($displayorders->count()) }}</h3> Total Deliveries
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card text-center">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-primary mt-2">{{ number_format($sunorders) }}</h3> Sunday Deliveries
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card text-center">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-primary mt-2">{{ number_format($monorders) }}</h3>Monday Deliveries
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card text-center">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-primary mt-2">{{ number_format($tueorders) }}</h3> Tuesday Deliveries

                        </div>
                    </div>
                </div>



            </div>


            <div class="row">
                <div class="col-md-6 col-xl-3">
                    <div class="card text-center">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-primary mt-2">{{ number_format($wedorders) }}</h3>Wednesday Deliveries
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="card text-center">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-primary mt-2">{{ number_format($thuorders) }}</h3> Thursday Deliveries
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="card text-center">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-primary mt-2">{{ number_format($friorders) }}</h3> Friday Deliveries
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card text-center">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-primary mt-2">{{ number_format($satorders) }}</h3> Saturday Deliveries

                        </div>
                    </div>
                </div>
            </div>




            {{-- filters --}}
            <div class="row">
                <div class="col-lg-12">
                    <div class="card client-card">
                        <div class="card-body text-center">
                            <div class="row">
                                <div class="col-12">


                                    {{-- form (search today orders) --}}
                                    <form action="{{ route('admin.searchtodayorders') }}" method="post">
                                    
                                        {{-- method fields --}}
                                        @method('POST')
                                        @csrf

                                        {{-- form row --}}
                                        <div class="row">

                                              {{-- Delivery ID --}}
                                            <div class="col-2 ">
                                                <div class="form-group row">
                                                    <label for="example-text-input"
                                                        class="col-sm-4 col-form-label">#No.</label>
                                                    <div class="col-sm-8">
                                                       <input type="number" class="form-control" name="id" id="">
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- partner --}}
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


                                            {{-- driver --}}
                                            <div class="col-3">
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


                                            {{-- submit button --}}
                                            <div class="col-2 text-left">
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
            </div>
            {{-- end filters --}}




            {{-- today deliveries --}}
            <div class="row">
                <div class="col-lg-12">
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
                                            <th>Delivery Picture</th>
                                        </tr>
                                    </thead>


                                    {{-- tbody --}}
                                    <tbody>

                                        @foreach ($orders as $order)
                                            
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

                                            {{-- delivered date --}}
                                            <td>{{ (!empty($order->updatedate) ? $order->updatedate : "-") }}</td>

                                            {{-- driver --}}
                                            <td>{{ (!empty($order->driver->name) ? $order->driver->name : "-") }}</td>
                                            
                                            <td class="text-center">
                                                @if (!empty($order->receivedpic))
                                                <a href=" {{asset('assets/img/partners/delivery-pics/'.$order->receivedpic)}} " download="" style="font-size: 18px;"> <i class="mdi mdi-download "></i> </a>
                                                @else
                                                No photo
                                                @endif
                                            </td>

                                        </tr>

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





@endsection