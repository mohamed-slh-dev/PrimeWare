@extends('layouts.partner')


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

            <div class="row">
                <div class="col-md-6 col-xl-2">
                    <div class="card text-center">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-info mt-2">{{ $orders->count() }}</h3> Total Deliveries
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-2">
                    <div class="card text-center">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-info mt-2">{{ $customers->count() }}</h3> Total Customers
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-2">
                    <div class="card text-center">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-info mt-2">{{ $customers->where('servicetype', 'special')->count() }}</h3> Special Customers
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-2">
                    <div class="card text-center">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-success mt-2">{{ $orders->where('status', 'delivered')->count() }}</h3> Delivered
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-2">
                    <div class="card text-center">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-danger mt-2">{{ $orders->where('status', 'canceled')->count() }}</h3> Canceled

                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-2">
                    <div class="card text-center">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-dark mt-2">{{ $orders->where('bag', 1)->sum('bag') }}</h3> Total Bags
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->


            {{-- row --}}
            <div class="row">

                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Total Deliveries</h4>

                            <div class="row text-center mt-4">
                                <div class="col-2">
                                    <h5 class="mb-2 font-size-18">{{ $orders->where('status', 'delivered')->count() }}</h5>
                                    <p class="text-muted text-truncate">Delivered</p>
                                </div>
                                <div class="col-8">
                                    <div id="pie-chart" style="height: 300px; margin-top: -60px;"></div>
                                </div>
                                <div class="col-2">
                                    <h5 class="mb-2 font-size-18">{{ $orders->where('status', 'canceled')->count() }}</h5>
                                    <p class="text-muted text-truncate">Returned | Canceled</p>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>

            </div>
            <!-- end row -->



            {{-- all orders --}}
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
                                            <th>Customer</th>
                                            <th>Phone</th>

                                            <th>City</th>
                                            <th>District</th>
                                            <th>Address</th>


                                            <th>Status</th>
                                            <th>Delivery Date</th>
                                        </tr>
                                    </thead>

                                    
                                    <tbody>

                                        {{-- single order (repeat) --}}
                                        @foreach ($pagorders as $order)
                                            
                                        <tr>
                                            <td># {{ $order->id }}</td>
                                            <td>{{ $order->customer->name }}</td>
                                            <td>{{ $order->customer->phone }}</td>

                                            <td>{{ $order->customer->city->name }}</td>
                                            <td>{{ $order->customer->district->name }}</td>

                                            <td>{{ $order->customer->address }}</td>

                                            @if ($order->status == "delivered")
                                                
                                                <td><i class="mdi mdi-checkbox-blank-circle text-success"></i> Delivered</td>

                                            @elseif ($order->status == "canceled")

                                                <td><i class="mdi mdi-checkbox-blank-circle text-danger"></i> Canceled</td>

                                            @else

                                                <td><i class="mdi mdi-checkbox-blank-circle text-warning"></i> {{ ucwords($order->status) }}</td>

                                            @endif


                                            {{-- deliverydate + updated time (empty at beginning) --}}
                                            <td>{{ $order->deliverydate }} {{ $order->updatedate }}</td>

                                        </tr>

                                        @endforeach
                                        {{-- endforeach --}}
                            

                                    </tbody>
                                    {{-- end of tbody --}}

                                </table>
                            </div>
                            {{-- end of table wrapper --}}

                            {{-- paginations --}}
                            <div class="pagination mt-3">
                                {!! $pagorders->links() !!}
                            </div>
                            {{-- end paginations --}}

                        </div>
                    </div>
                </div>
                {{-- end column --}}






                {{-- customers --}}
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Manage Customers</h4>
                            <p class="card-title-desc">Manage all customers</p>

                            <div class="table-responsive">
                                <table class="table mb-0">

                                    <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Customer</th>
                                            <th>Phone</th>

                                            <th>City</th>
                                            <th>District</th>
                                            <th>Address</th>

                                            <th>Location</th>

                                            <th>Number Of Deliveries</th>
                                            <th>Total Delivered</th>
                                            <th>Add Delivery Days</th>

                                        </tr>
                                    </thead>


                                    <tbody>

                                        <?php $counter = 1; ?>

                                        @foreach ($pagcustomers as $customer)
                                            
                                        {{-- tablerow --}}
                                        <tr>
                                            <td scope="row">{{ $customer->id }}</td>
                                            <td>{{ $customer->name }}</td>
                                            <td>{{ $customer->phone }}</td>

                                            <td>{{ $customer->city->name }}</td>
                                            <td>{{ $customer->district->name }}</td>
                                            <td>{{ $customer->address }}</td>

                                            <td><a href="https://www.google.com/maps/search/?api=1&query={{ ltrim($customer->locationlink, '@') }}" class="text-warning" target="_blank">Show Map</a></td>


                                            <td>{{ $customer->orders->count() }}</td>
                                            <td>{{ $customer->deliveredorders->count() }}</td>
                                            <td>
                                                <button data-toggle="modal" data-target=".edit-customer" class="far fa-edit custom-edit-button text-primary customer-assign-id" value="{{ $customer->id }}"></button>
                                            </td>

                                            {{-- hide button --}}
                                            {{-- <td>
                                                <button type="button"
                                                    class="btn btn-outline-warning btn-sm waves-effect">Hide</button>
                                            </td> --}}

                                        </tr>
                                        {{-- end of table row --}}


                                        <?php $counter++; ?>

                                        @endforeach
                                        {{-- end foreach --}}

                                        
                                    </tbody>
                                    {{-- end tbody --}}

                                </table>
                            </div>
                            {{-- end table wrapper --}}


                            {{-- paginations --}}
                            <div class="pagination mt-3">
                                {!! $pagcustomers->links() !!}
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

    {{-- footer --}}
    <footer class="footer">

    </footer>
    {{-- endfooter --}}

</div>
<!-- end main content-->

{{-- endcontent --}}




{{-- modal --}}


{{-- renew subscription --}}
<div class="modal fade edit-customer" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title mt-0 font-weight-bold" id="myLargeModalLabel">Add Extra Days</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


            {{-- modal body --}}
            <div class="modal-body">

                {{-- form (search partner) --}}
                <form action="{{ route('partner.renewcustomerdash') }}" method="post">
                
                    {{-- method fields --}}
                    @method('POST')
                    @csrf

                    {{-- id of customer --}}
                    <input type="hidden" name="id" id="modal-assign-customer" value="">

                    
                    {{-- row --}}
                    <div class="row">

                        {{-- col --}}
                        <div class="col-12">
                            <div class="form-group row">

                                {{-- extra days input --}}
                                <div class="col-4">
                                    <label>Renew Starting Date</label>
                                    <input required="" name="renewdate" min="{{ date('Y-m-d') }}" class="form-control" type="date" placeholder="YYYY-MM-DD">
                                </div>


                                {{-- extra days input --}}
                                <div class="col-4">
                                    <label>Extra Days</label>
                                    <input required="" name="extradays" min="1" class="form-control" type="number">
                                </div>

                                {{-- extra cash input --}}
                                <div class="col-4">
                                    <label>Cash Collection</label>
                                    <input required="" name="extracash" class="form-control" min="0" type="number">
                                </div>

                                <div class="col-12 mt-3">
                                    <p class="small font-weight-bold">* Note : Renew date should be set after the last scheduled delivery for this customer</p>
                                </div>

                                
                            </div>
                        </div>
                        {{-- end col --}}

                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-outline-success mx-2 font-15">ADD</button>
                        </div>

                    </div>
                    {{-- end row --}}
                </form>
                {{-- end form --}}

            </div>
            {{-- end modal body --}}
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



{{-- endmodals --}}





@endsection


