@extends('layouts.admin')


@section('content')


{{-- header --}}
<!-- start page title -->
<div class="page-title-box">
    <div class="container-fluid">
        <div class="page-title-content">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4>Payments Reports</h4>
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
                            <form action="{{ route('admin.searchpaymentsreports') }}" method="get">

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
                                            <div class="col-3">
                                                <div class="form-group row">
                                                    <label for="example-text-input"
                                                        class="col-sm-5 col-form-label">Restaurant</label>
                                                    <div class="col-sm-7">
                                                        <select required="" name="partnerid" class="custom-select ">
                                                            
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
                                                            <option value="requested">Requested</option>

                                                            {{-- 1 --}}
                                                            <option value="not received">Not Received</option>

                                                            {{-- 2 --}}
                                                            <option value="received from restaurant">Received From
                                                                Restaurant</option>

                                                            {{-- 3 --}}
                                                            <option value="delivered to warehouse">Delivered To
                                                                Warehouse</option>

                                                            {{-- 4 --}}
                                                            <option value="picked from warehouse">Picked From Warehouse
                                                            </option>

                                                            {{-- 5 --}}
                                                            <option value="delivered">Delivered</option>

                                                            {{-- 6 --}}
                                                            <option value="canceled">Canceled</option>


                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- end status  --}}



                                            {{-- startdate --}}
                                            <div class="col-2">
                                                <div class="form-group row">
                                                    <label for="example-text-input"
                                                        class="col-sm-4 col-form-label">From</label>
                                                    <div class="col-sm-8">
                                                        <input class="form-control" type="date" name="startdate">
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- end status  --}}


                                            {{-- enddate --}}
                                            <div class="col-2">
                                                <div class="form-group row">
                                                    <label for="example-text-input"
                                                        class="col-sm-4 col-form-label">To</label>
                                                    <div class="col-sm-8">
                                                        <input class="form-control" type="date" name="enddate">
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
                            <img src="{{ asset('assets/admins/assets/images/Prime-logo1.png') }}"
                                style="object-fit: contain" width="110" height="80"> </span>
                    </div>



                    <div class="card">
                        <div class="card-body invoice-head">
                            <div class="row">

                                <div class="col-lg-12 text-center">

                                    <h4>Deliveries Payment Report</h4>

                                    @if (!empty($chosenpartner))
                                        <h5 class="text-warning font-size-20">{{ $chosenpartner->name }}</h5>
                                    @endif

                                </div>


                                <div class="col-12 text-center my-1">
                                    @if (!empty($chosenpartner))
                                
                                    <h6 class="d-inline-block px-4 py-1" style="border-left: 1px solid whitesmoke; border-right: 1px solid whitesmoke; border-radius: 2px; ">Total Charge Fees<br>
                                        <span class="font-size-18 text-success">{{ number_format($chosenpartner->payedfees) }} AED</span>
                                    </h6>
                                    
                                    @endif
                                </div>

                                {{-- <div class="col-6 offset-6 text-right my-1">
                                    @if (!empty($chosenpartner))
                                    {{ date('d M Y') }}
                                    @endif
                                </div> --}}


                            </div>
                        </div>
                        
                        <!--end card-body-->
                        <div class="card-body pt-2">

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
                                                    <th>Status</th>


                                                </tr>



                                            </thead>


                                            <tbody>

                                                @foreach ($orders as $order)
                                                
                                                {{-- tr --}}
                                                <tr>

                                                    <td># {{ $order->id }}</td>


                                                    <td>{{ $order->customer->name }}</td>

                                                    <td>{{ $order->customer->city->name }}</td>



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


                                                   
                                                </tr>
                                                {{-- end tr --}}

                                                @endforeach
                                                {{-- end foreach --}}

                                                @if (!empty($chosenpartner))

                                                <tr>
                                                    <td style="border: 0px solid lightgrey"></td>
                                                    <td style="border: 0px solid lightgrey"></td>
                                                    <td style="border: 0px solid lightgrey"></td>
                                                    <td style="border: 0px solid lightgrey"></td>
                                                    <td style="border: 0px solid lightgrey"></td>

                                                    {{-- total --}}
                                                    <td class="font-weight-bold font-size-16 text-success">{{ number_format($orders->sum('chargefees')) }} AED</td>

                                                    <td style="border: 0px solid lightgrey"></td>
                                                </tr>

                                                @endif

                                            </tbody>
                                        </table>
                                    </div>
                                    {{-- end table wrapper --}}



                                </div>
                            </div>


                            
                            @if (!empty($chosenpartner))

                            <div class="col-lg-12 col-xl-12 mt-3">
                                <div class="text-center">
                                    <button onclick="printDiv('restreportdiv')"
                                        class="btn btn-outline-success print-buttons">
                                        <i class="fa fa-print"></i>
                                    </button>

                                </div>
                            </div>
                            @endif

                        </div>
                    </div>
                    <!--end card-->
                </div>
                <!--end col-->
                {{-- end regular orders --}}















                <div class="col-lg-12 mx-auto" id="restsinglereportdiv">
                
                
                    {{-- image for printing only --}}
                    <div class="col-12 printimagediv text-center">
                        <span class="logo-lg">
                            <img src="{{ asset('assets/admins/assets/images/Prime-logo1.png') }}" style="object-fit: contain"
                                width="110" height="80"> </span>
                    </div>
                
                
                
                    <div class="card">
                        <div class="card-body invoice-head">
                            <div class="row">
                
                                <div class="col-lg-12 text-center">
                
                                    <h4>One-time Deliveries Payment Report</h4>
                
                
                                </div>
                
                
                                <div class="col-12 text-center my-1">
                                    @if (!empty($chosenpartner))
                
                            
                
                                    @endif
                                </div>
                
                                
    
                        </div>
                    </div>
                
                    <!--end card-body-->
                    <div class="card-body pt-2">
                
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
                
                                                {{-- charge fees --}}
                                                <td>{{ number_format($order->payedfees) }} AED</td>
                
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
                
                
                
                                            </tr>
                                            {{-- end tr --}}
                
                                            @endforeach
                                            {{-- end foreach --}}
                
                                            @if (!empty($chosenpartner))
                
                                            <tr>
                                                <td style="border: 0px solid lightgrey"></td>
                                                <td style="border: 0px solid lightgrey"></td>
                                                <td style="border: 0px solid lightgrey"></td>
                                                <td style="border: 0px solid lightgrey"></td>
                                                <td style="border: 0px solid lightgrey"></td>
                
                                                {{-- total --}}
                                                <td class="font-weight-bold font-size-16 text-success">
                                                    {{ number_format($singleorders->sum('payedfees')) }} AED</td>
                
                                                <td style="border: 0px solid lightgrey"></td>
                                            </tr>
                
                                            @endif
                
                                        </tbody>
                                    </table>
                                </div>
                                {{-- end table wrapper --}}
                
                
                
                            </div>
                        </div>
                
                
                
                        @if (!empty($chosenpartner))
                
                        <div class="col-lg-12 col-xl-12 mt-3">
                            <div class="text-center">
                                <button onclick="printDiv('restsinglereportdiv')" class="btn btn-outline-success print-buttons">
                                    <i class="fa fa-print"></i>
                                </button>
                
                            </div>
                        </div>
                        @endif
                
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