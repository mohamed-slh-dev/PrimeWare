@extends('layouts.admin')


@section('content')


{{-- header --}}
<!-- start page title -->
<div class="page-title-box">
    <div class="container-fluid">
        <div class="page-title-content">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4>Restaurants Reports</h4>
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

                {{-- print div --}}
                <div id="printTheDivisionValue"></div>



                {{-- filter column 1 --}}
                <div class="col-lg-12" id="filtter">
                    <div class="card client-card">
                        <div class="card-body text-center">

                            {{-- form (search orders) --}}
                            <form action="{{ route('admin.searchrestaurantsreports') }}" method="get">

                                {{-- method fields --}}
                                @method('GET')
                                @csrf

                                {{-- row --}}
                                <div class="row">

                                    {{-- inner col --}}
                                    <div class="col-12">

                                        {{-- row --}}
                                        <div class="row">


                                            {{-- partners (restaurtants) --}}
                                            <div class="col-4">
                                                <div class="form-group row">
                                                    <label for="example-text-input"
                                                        class="col-sm-4 col-form-label">Restaurant</label>
                                                    <div class="col-sm-8">
                                                        <select name="partnerid" class="custom-select ">

                                                            <option value="all" selected="">All</option>

                                                            @foreach ($partners as $partner)
                                                            <option value="{{ $partner->id }}">{{ $partner->name }}
                                                            </option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- end status  --}}



                                            {{-- status --}}
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
                                            {{-- end status  --}}





                                            {{-- submit --}}
                                            <div class="col-2 text-left">
                                                <button type="submit"
                                                    class="btn btn-outline-success waves-effect waves-light mx-3">Search</button>
                                            </div>

                                        </div>
                                        {{-- end row --}}
                                    </div>
                                    {{-- end inner col --}}


                                </div>
                                {{-- end row --}}
                            </form>
                            {{-- end form --}}
                        </div>
                    </div>
                </div>
                {{-- end of filter col --}}


                {{-- regular orders report --}}
                <div class="col-lg-12 mx-auto" id="restreportdiv">


                    {{-- image for printing only --}}
                    <div class="col-12 printimagediv text-center">
                        <span class="logo-lg">
                            <img src="{{ asset('assets/admins/assets/images/Prime-logo1.png') }}" style="object-fit: contain" width="110"
                                height="80"> </span>
                    </div>



                    <div class="card">
                        <div class="card-body invoice-head">
                            <div class="row">

                                <div class="col-lg-12 text-center">

                                    <h4>Deliveries Report</h4>

                                </div>
                            </div>
                        </div>
                        <!--end card-body-->
                        <div class="card-body">

                            <div class="row">

                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table mb-0">

                                            <thead class="thead-light">


                                                <tr>
                                                    <th>Delivery No.</th>
                                                    <th>Restaurant</th>

                                                    <th>Customer</th>

                                                    <th>City</th>
                                                    
                                                    <th>Driver</th>
                                                    <th>Delivery Date</th>
                                                    <th>Charge Fees</th>
                                                    <th>Status</th>


                                                </tr>



                                            </thead>


                                            <tbody>

                                                @foreach ($orders as $order)

                                                {{-- tr --}}
                                                <tr>

                                                    <td># {{ $order->id }}</td>
                                                    <td>{{ $order->partner->name }}</td>

                                                    <td>{{ $order->customer->name }}</td>

                                                    <td>{{ $order->customer->city->name }}</td>


                                                    {{-- <td><a href="https://www.google.com/maps/search/?api=1&query={{ ltrim($order->customer->locationlink, '@') }}" class="text-warning" target="_blank">{{ $order->customer->address }}</a></td> --}}



                                                    <td>{{ (!empty($order->driver->name) ? $order->driver->name : "-") }}
                                                    </td>

                                                    {{-- delivery date --}}
                                                    <td>{{ $order->deliverydate }}</td>

                                                    {{-- charge fees --}}
                                                    <td>{{ number_format($order->chargefees) }} AED</td>

                                                    {{-- status --}}
                                                    @if ($order->status == "delivered")
                                                    <td><i class="mdi mdi-checkbox-blank-circle text-success"></i>
                                                        {{ ucwords($order->status) }}</td>

                                                    @elseif ($order->status == "canceled")
                                                    <td><i class="mdi mdi-checkbox-blank-circle text-danger"></i>
                                                        {{ ucwords($order->status) }}</td>

                                                    @else
                                                    <td><i class="mdi mdi-checkbox-blank-circle text-warning"></i>
                                                        {{ ucwords($order->status) }}</td>
                                                    @endif


                                                    @endforeach
                                                    {{-- end foreach --}}

                                                </tr>
                                                {{-- end tr --}}

                                            </tbody>
                                        </table>
                                    </div>
                                    {{-- end table wrapper --}}


                                    {{-- paginations --}}
                                    <div class="pagination mt-4">
                                        {!! $orders->appends(Request::all())->links() !!}
                                    </div>


                                </div>
                            </div>



                            <div class="col-lg-12 col-xl-12 mt-3">
                                <div class="text-center">
                                    <button onclick="printDiv('restreportdiv')" class="btn btn-outline-success print-buttons">
                                        <i class="fa fa-print"></i>
                                    </button>

                                </div>
                            </div>

                        </div>
                    </div>
                    <!--end card-->
                </div>
                <!--end col-->
                {{-- end regular orders --}}














                {{-- filter column 1 --}}
                <div class="col-lg-12" id="filtter">
                    <div class="card client-card">
                        <div class="card-body text-center">

                            {{-- form (search signleorders) --}}
                            <form action="{{ route('admin.searchsinglerestaurantsreports') }}" method="get">

                                {{-- method fields --}}
                                @method('GET')
                                @csrf

                                {{-- row --}}
                                <div class="row">

                                    {{-- inner col --}}
                                    <div class="col-12">

                                        {{-- row --}}
                                        <div class="row">



                                            {{-- order number --}}
                                            <div class="col-4">
                                                <div class="form-group row">
                                                    <label for="example-text-input"
                                                        class="col-sm-4 col-form-label">Delivery No.</label>

                                                    <div class="col-sm-8">
                                                        <input name="orderid" type="number" min="0"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- end order number --}}




                                            {{-- status --}}
                                            <div class="col-3">
                                                <div class="form-group row">
                                                    <label for="example-text-input"
                                                        class="col-sm-4 col-form-label">Status</label>
                                                    <div class="col-sm-8">
                                                        <select name="status" class="custom-select ">
                                                            <option value="all" selected="">All</option>

                                                            <option value="requested">Requested</option>

                                                            <option value="delivered">Delivered</option>
                                                            <option value="canceled">Canceled</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- end status  --}}


                                            {{-- submit --}}
                                            <div class="col-5 text-left">
                                                <button type="submit"
                                                    class="btn btn-outline-success waves-effect waves-light mx-3">Search</button>
                                            </div>

                                        </div>
                                        {{-- end row --}}
                                    </div>
                                    {{-- end inner col --}}


                                </div>
                                {{-- end row --}}
                            </form>
                            {{-- end form --}}

                        </div>
                    </div>
                </div>
                {{-- end of filter col --}}









                {{-- regular orders report --}}
                <div class="col-lg-12 mx-auto" id="restsinglereportdiv">



                    {{-- image for printing only --}}
                    <div class="col-12 printimagediv text-center">
                        <span class="logo-lg">
                            <img src="{{ asset('assets/admins/assets/images/Prime-logo1.png') }}" style="object-fit: contain" width="110"
                                height="80"> </span>
                    </div>



                    <div class="card">
                        <div class="card-body invoice-head">
                            <div class="row">

                                <div class="col-lg-12 text-center">

                                    <h4>One-Time Deliveries Report</h4>

                                </div>
                            </div>
                        </div>
                        <!--end card-body-->
                        <div class="card-body">

                            <div class="row">

                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table mb-0">

                                            <thead class="thead-light">


                                                <tr>
                                                    <th>Delivery No.</th>

                                                    <th>Customer</th>
                                                    <th>City</th>

                                                    <th>Driver</th>
                                                    <th>Delivery Date</th>
                                                    
                                                    <th>Charge Fees</th>
                                                    <th>Comments/Notes</th>

                                                    <th>Status</th>


                                                </tr>



                                            </thead>


                                            <tbody>

                                                @foreach ($singleorders as $order)

                                                {{-- tr --}}
                                                <tr>

                                                    <td># {{ $order->id }}</td>

                                                    <td>{{ $order->customer_name }}</td>

                                                    <td>{{ $order->city->name }}</td>
                                                    

                                                    

                                                    <td>{{ (!empty($order->driver->name) ? $order->driver->name : "-") }}
                                                    </td>

                                                    {{-- delivery date --}}
                                                    <td>{{ $order->deliverydate }}</td>
                                                    <td>{{ number_format($order->chargefees) }} AED</td>

                                                    <td>{{ $order->meal }}</td>
                                                    

                                                    {{-- status --}}
                                                    @if ($order->status == "delivered")
                                                    <td><i class="mdi mdi-checkbox-blank-circle text-success"></i>
                                                        {{ ucwords($order->status) }}</td>

                                                    @elseif ($order->status == "canceled")
                                                    <td><i class="mdi mdi-checkbox-blank-circle text-danger"></i>
                                                        {{ ucwords($order->status) }}</td>

                                                    @else
                                                    <td><i class="mdi mdi-checkbox-blank-circle text-warning"></i>
                                                        {{ ucwords($order->status) }}</td>
                                                    @endif


                                                    @endforeach
                                                    {{-- end foreach --}}

                                                </tr>
                                                {{-- end tr --}}

                                            </tbody>
                                        </table>
                                    </div>
                                    {{-- end table wrapper --}}


                                    {{-- paginations --}}
                                    <div class="pagination mt-4">
                                        {!! $singleorders->appends(Request::all())->links() !!}
                                    </div>


                                </div>
                            </div>



                            <div class="col-lg-12 col-xl-12 mt-3">
                                <div class="text-center">
                                    <button onclick="printDiv('restsinglereportdiv')" class="btn btn-outline-success print-buttons">
                                        <i class="fa fa-print"></i>
                                    </button>


                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end card-->
                </div>
                <!--end col-->
                {{-- end regular orders --}}





            </div>
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