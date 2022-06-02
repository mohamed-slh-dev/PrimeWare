@extends('layouts.otherpartner')


@section('content')


{{-- header --}}
<!-- start page title -->
<div class="page-title-box">
    <div class="container-fluid">
        <div class="page-title-content">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4>Deliveries Reports</h4>
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
                <div class="col-lg-12" id="filtter">
                    <div class="card client-card">
                        <div class="card-body text-center">

                            {{-- form (search orders) --}}
                            <form action="{{ route('otherpartner.searchalldeliveryreports') }}" method="post">
                            
                                {{-- method fields --}}
                                @method('POST')
                                @csrf

                                {{-- row --}}
                                <div class="row">

                                    {{-- inner col --}}
                                    <div class="col-12">
                                        
                                        {{-- row --}}
                                        <div class="row">

                                            
                                        

                                            {{-- status --}}
                                            <div class="col-4">
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



                                            {{-- order number --}}
                                            <div class="col-3">
                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-sm-5 col-form-label">Delivery No.</label>
                                            
                                                    <div class="col-sm-7">
                                                        <input name="orderid" type="number" min="0" class="form-control">
                                                    </div>
                                                </div>
                                            </div>


                                            {{-- submit --}}
                                            <div class="col-4 text-left">
                                                <button type="submit" class="btn btn-outline-success waves-effect waves-light mx-4">Search</button>
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

                <div class="col-lg-12 mx-auto" id="partnerreportdiv">


                    {{-- image for printing only --}}
                    <div class="col-12 printimagediv text-center">
                        <span class="logo-lg">
                            <img src="{{ asset('assets/partners/assets/images/Prime-logo1.png') }}" style="object-fit: contain" width="110"
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
                                                    <th>Reference</th>

                                                    <th>Customer</th>
                                                    <th>Phone</th>

                                                    <th>City</th>
                                                    <th>District</th>
                                                    <th>Address</th>

                                                    {{-- <th>Charge</th> --}}
                                                    <th>Pickup DateTime</th>
                                                    <th>Delivery DateTime</th>
                                                    <th>Vehicle</th>
                                                    <th>Status</th>

        
                                                </tr>

                                                

                                            </thead>


                                            <tbody>

                                                @foreach ($orders as $order)

                                                {{-- tr --}}
                                                <tr>

                                                    <td># {{ $order->id }}</td>
                                                    <td># {{ $order->referenceid }}</td>

                                                    <td>{{ $order->customer_name }}</td>
                                                    <td>{{ $order->customer_phone }}</td>

                                                  
                                                    
                                                    <td>{{ $order->city->name }}</td>
                                                    <td>{{ $order->district->name }}</td>
                                                    
                                                    <td><a href="https://www.google.com/maps/search/?api=1&query={{ ltrim($order->customer_locationlink, '@') }}" class="text-warning" target="_blank">{{ $order->customer_address }}</a></td>
                    
                                                    {{-- delivery date + pickup time --}}
                                                    <td>{{ $order->deliverydate }} - {{ $order->pickuptime }}</td>
                                                    
                                                    {{-- deliverydate + delivery time --}}
                                                    <td>{{ $order->deliverydate }} - {{ $order->deliverytime }}</td>

                                                    {{-- vehicle --}}
                                                    <td>{{ ucwords($order->carriage) }}</td>


                                                    {{-- status --}}
                                                    @if ($order->status == "delivered")
                                                        <td><i class="mdi mdi-checkbox-blank-circle text-success"></i> {{ ucwords($order->status) }}</td>

                                                    @elseif ($order->status == "canceled")
                                                        <td><i class="mdi mdi-checkbox-blank-circle text-danger"></i> {{ ucwords($order->status) }}</td>

                                                    @else
                                                        <td><i class="mdi mdi-checkbox-blank-circle text-warning"></i> {{ ucwords($order->status) }}</td>
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
                                        @if($orders instanceof \Illuminate\Pagination\LengthAwarePaginator )
                                        
                                        {{$orders->links()}}
                                        
                                        @endif
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