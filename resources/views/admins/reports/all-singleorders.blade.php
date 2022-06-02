@extends('layouts.admin')


@section('content')


{{-- header --}}
<!-- start page title -->
<div class="page-title-box">
    <div class="container-fluid">
        <div class="page-title-content">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4>Partners Reports</h4>
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

                




                {{-- filter column 1 --}}
                <div class="col-lg-12" id="filtter">
                    <div class="card client-card">
                        <div class="card-body text-center">

                            {{-- form (search signleorders) --}}
                            <form action="{{ route('admin.searchpartnersreports') }}" method="get">

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
                                                    <label for="example-text-input" class="col-sm-4 col-form-label">Partner</label>
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


                                            {{-- order number --}}
                                            <div class="col-3">
                                                <div class="form-group row">
                                                    <label for="example-text-input"
                                                        class="col-sm-5 col-form-label">Delivery No.</label>

                                                    <div class="col-sm-7">
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
                <div class="col-lg-12 mx-auto" id="partnerreportdiv">



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

                                                    <th>Partner</th>

                                                    <th>Customer</th>
                                                    <th>City</th>

                                                    <th>Delivery Date</th>
                                                    <th>Charge Fees</th>

                                                    <th>Comments/Notes</th>
                                                    <th>Driver</th>

                                                    <th>Status</th>

                                                </tr>



                                            </thead>


                                            <tbody>

                                                @foreach ($singleorders as $order)

                                                {{-- tr --}}
                                                <tr>

                                                    <td># {{ $order->id }}</td>

                                                    <td>{{ $order->otherpartner->name }}</td>

                                                    <td>{{ $order->customer_name }}</td>

                                                    <td>{{ $order->city->name }}</td>

                                                


                                                    {{-- delivery date --}}
                                                    <td>{{ $order->deliverydate }}</td>

                                                    <td>{{ $order->chargefees }} AED</td>

                                                    <td>{{ $order->info }}</td>

                                                    <td>{{ (!empty($order->driver->name) ? $order->driver->name : "-") }} </td>

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
                                    <button onclick="printDiv('partnerreportdiv')" class="btn btn-outline-success print-buttons">
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