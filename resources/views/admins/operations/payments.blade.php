@extends('layouts.admin')


@section('content')



{{-- continue header --}}
<!-- start page title -->
<div class="page-title-box">
    <div class="container-fluid">
        <div class="page-title-content">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4>Restaurants Payment</h4>
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



                {{-- col 12 for heading things --}}
                <div class="col-12">
                    <div class="row">
                        
                        {{-- restaurants (only 4) --}}
                        @foreach ($partners as $partner)
                        
                        {{-- only if partners customer has charges --}}
                        @if ($partner->customers->sum('totalfees') > 0 || $partner->singleorders->sum('chargefees') > 0)
                            
                        <div class="col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">

                                        {{-- image --}}
                                        <div class="col-5 align-self-center">
                                            <div class="icon-info">
                                                <img src="{{ asset('assets/img/partners/logos/'.$partner->logo) }}" width="100%" height="120" style="object-fit: contain; object-position: center;">
                                            </div>
                                        </div>

                                        {{-- name and fees he has --}}
                                        <div class="col-7 align-self-center text-left">
                                            <div class="text-left">
                                                <p class="mb-0 text-muted text-left font-size-13">{{ $partner->name }}</p>
                                                <h5 class="mt-0 mb-1 d-inline-block">{{ number_format($partner->customers->sum('totalfees') + $singleorders->sum('chargefees'))}} AED</h5>
                                            </div>

                                            {{-- form (confirm fees) --}}
                                            <form action="{{ route('admin.confirmpayment') }}" method="post" class="text-left mt-1">
                                            
                                                {{-- method fields --}}
                                                @method('POST')
                                                @csrf
                                            
                                                {{-- collectedcash id --}}
                                                <input type="hidden" name="partner_id" value="{{ $partner->id }}">
                                            
                                            
                                            
                                                <button type="submit" class="btn btn-outline-success p-0 px-2 font-size-12">Confirm Payment</button>
                                            
                                            </form>


                                            <div class="progress mt-2" style="height:3px;">
                                                <div class="progress-bar bg-success" role="progressbar" style="width: 70%;" aria-valuenow="55" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>

                                        </div>


                                    

                                    </div>
                                    {{-- end row  --}}

                                    
                                </div>
                                <!--end card-body-->
                            </div>
                            <!--end card-->
                        </div>
                        <!--end col-->


                        @endif

                        @endforeach
                        {{-- end of company --}}


                    </div>
                    <!--end row-->
                </div>

                {{-- end of heading things --}}










                {{-- restaurants charges table --}}
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Restaurants Charge Fees</h4>
                            <p class="card-title-desc"></p>

                            {{-- table wrapper --}}
                            <div class="table-responsive">
                                <table class="table mb-0">

                                    <thead class="thead-light">
                                        <tr>
                                            <th>Restaurant</th>
                                            <th>Customer</th>
                                            <th>City</th>
                                            <th>Requested Amount (AED)</th>
                                            <th></th>
                                        </tr>
                                    </thead>

                                    {{-- tbody --}}
                                    <tbody>

                                        <?php $counter = 1; ?>

                                        {{-- foreach --}}
                                        @foreach ($customers as $customer)
                                            
                                        <tr>
                                            <td>{{ $customer->partner->name }}</td>
                                            <td>{{ $customer->name }}</td>
                                            <td>{{ $customer->city->name }}</td>
                                            <td class="font-weight-bold">{{ number_format($customer->totalfees) }}</td>
                                            
                                            



                                            {{-- view orders button (open modal) --}}
                                            <td>
                                                <button type="button" class="btn btn-outline-success p-0 px-2" data-toggle="modal" data-target="#collector-orders-{{ $counter }}">View All</button>
                                            
                                            </td>

                                            
                                        </tr>
                                       {{-- end tr --}}


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
                                {!! $customers->links() !!}
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end col -->
                {{-- end table --}}










                {{-- restaurants charges table --}}
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Restaurants One-Time Deliveries Charge Fees</h4>
                            <p class="card-title-desc"></p>
                
                            {{-- table wrapper --}}
                            <div class="table-responsive">
                                <table class="table mb-0">
                
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Delivery No.</th>
                                            <th>Restaurant</th>
                                            <th>Customer</th>
                                            <th>City</th>
                                            <th>Requested Amount (AED)</th>
                                        </tr>
                                    </thead>
                
                                    {{-- tbody --}}
                                    <tbody>
                
                                        {{-- foreach --}}
                                        @foreach ($singleorders as $order)
                
                                        <tr>
                                            <td># {{ $order->id }}</td>
                                            <td>{{ $order->partner->name }}</td>
                                            <td>{{ $order->customer_name }}</td>
                                            <td>{{ $order->city->name }}</td>
                                            <td class="font-weight-bold">{{ number_format($order->chargefees) }}</td>
                
                                         
                
                                            
                
                                        @endforeach
                                        {{-- end foreach --}}
                
                                    </tbody>
                                    {{-- end tbody --}}
                
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
                {{-- end table --}}







                


                <div class="col-12">
                    <hr class="mt-3 mb-4">
                </div>









                

            </div>
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    <footer class="footer">

    </footer>
</div>
<!-- end main content-->


{{-- end content --}}






{{-- modal --}}


{{-- modal --}}
{{-- customers orders --}}
<?php $counter = 1; ?>


@foreach ($customers as $customer)
    

<div class="modal fade collect-list" id="collector-orders-{{ $counter }}" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Restaurant Charge Fees Details
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">



                <div class="row" id="collectorsreportdiv-{{ $counter }}">


                    {{-- image for printing only --}}
                    <div class="col-12 printimagediv text-center">
                        <span class="logo-lg">
                            <img src="{{ asset('assets/admins/assets/images/Prime-logo1.png') }}"
                                style="object-fit: contain" width="110" height="80"> </span>
                    </div>


                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Deliveries Charge Fees (breakdown)</h4>
                                <p class="card-title-desc">Customer: {{ $customer->name }}</p>


                                <div class="table-responsive">
                                    <table class="table mb-0">

                                        <thead class="thead-light">
                                            <tr>
                                                <th>Delivery No.</th>
                                                <th>Restaurant</th>
                                                <th>City</th>
                                                <th>Delivery Date</th>
                                                <th>Charge Fees (AED)</th>
                                                {{-- <th>Status</th> --}}
                                            </tr>
                                        </thead>


                                        {{-- tbody --}}
                                        <tbody>

                                            @foreach ($customer->orders->sortBy('deliverydate') as $order)

                                            {{-- table row --}}
                                            <tr>
                                                <td># {{ $order->id }}</td>
                                                <td>{{ $order->partner->name }}</td>
                                                <td>{{ $order->customer->city->name }}</td>
                                                <td>{{ $order->deliverydate }}</td>

                                                <td class="font-weight-bold">{{ number_format($order->chargefees) }}</td>
                                                {{-- order status --}}

                                                {{-- @if ($order->status == "delivered to warehouse")

                                                <td><i class="mdi mdi-checkbox-blank-circle text-success"></i> Delivered
                                                    To Warehouse</td>

                                                @elseif ($order->status == "canceled")

                                                <td><i class="mdi mdi-checkbox-blank-circle text-danger"></i> Canceled
                                                </td>

                                                @else

                                                <td><i class="mdi mdi-checkbox-blank-circle text-warning"></i>
                                                    {{ ucwords($order->status) }}</td>

                                                @endif --}}

                                                

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


{{-- end modal --}}



@endsection
