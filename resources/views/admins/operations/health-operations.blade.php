@extends('layouts.admin')


@section('content')



{{-- continue header --}}
<!-- start page title -->
<div class="page-title-box">
    <div class="container-fluid">
        <div class="page-title-content">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4>Operation Health</h4>
                    <h6>Monitor Business Operation - Enusring All Rights.</h6>
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


                {{-- orders with no drivers --}}
                <div class="col-lg-12">
                    <div class="card" style=" background-color: #b83c3cc4; ">
                        <div class="card-body">
                            <h4 class="card-title">Assign Drivers To Deliveries</h4>
                            <p class="card-title-desc">Review all unassigned deliveries. (this may caused by not assinging driver to the selected district)</p>

                            <div class="table-responsive">
                                <table class="table mb-0">

                                    <thead class="thead-light">
                                        <tr>
                                            <th>Restaurant</th>
                                            <th>Customer</th>
                                            <th>Customer Phone</th>
                                            <th>City</th>
                                            <th>District</th>
                                            <th>Address</th>
                                            <th>Delivery Date</th>
                                            <th>Status</th>
                                            <th>Assign To</th>
                                        </tr>
                                    </thead>

                                    {{-- tbody --}}
                                    <tbody>


                                        {{-- forreach for orders --}}
                                        @foreach ($orders as $order)
                                            
                                        {{-- trow --}}
                                        <tr>
                                            
                                            <td>{{ $order->partner->name }}</td>
                                            <td>{{ $order->customer->name }}</td>
                                            <td>{{ $order->customer->phone }}</td>
                                            <td>{{ $order->customer->city->name }}</td>
                                            <td>{{ $order->customer->district->name }}</td>
                                            <td>{{ $order->customer->address }}</td>
                                            

                                            <td>{{ $order->deliverydate }}</td>

                                            {{-- status --}}
                                            <td><i class="mdi mdi-checkbox-blank-circle text-warning"></i> Not Assigned</td>

                                            {{-- driver button --}}
                                            <td>
                                                <button type="button"
                                                    class="btn-sm btn btn-outline-dark waves-effect waves-light driver-assign-id"
                                                    data-toggle="modal" data-target=".drivers-list" value="{{ $order->customer->id }}">Drivers</button>
                                            </td>

                                        </tr>
                                        {{-- end trow --}}

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


    


                {{-- hr --}}
                <div class="col-lg-12">
                    <hr>
                </div>







                {{-- collectedorders with no drivers --}}
                <div class="col-lg-12">
                    <div class="card" style=" background-color: #b83c3cc4; ">
                        <div class="card-body">
                            <h4 class="card-title">Assign Drivers To Collection Deliveries</h4>
                            <p class="card-title-desc">Review all unassigned collection deliveries.</p>
                
                            <div class="table-responsive">
                                <table class="table mb-0">
                
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Restaurant</th>
                                            <th>Customer</th>
                                            <th>Customer Phone</th>
                                            <th>City</th>
                                            <th>District</th>
                                            <th>Address</th>
                                            <th>Delivery Date</th>
                                            <th>Status</th>
                                            <th>Assign To</th>
                                        </tr>
                                    </thead>
                
                                    {{-- tbody --}}
                                    <tbody>
                
                
                                        {{-- forreach for orders --}}
                                        @foreach ($collectedorders as $order)
                
                                        {{-- trow --}}
                                        <tr>
                                            
                                            <td>{{ $order->partner->name }}</td>
                                            <td>{{ $order->customer->name }}</td>
                                            <td>{{ $order->customer->phone }}</td>
                                            <td>{{ $order->customer->city->name }}</td>
                                            <td>{{ $order->customer->district->name }}</td>
                                            <td>{{ $order->customer->address }}</td>
                
                
                                            <td>{{ $order->deliverydate }}</td>
                
                                            {{-- status --}}
                                            <td><i class="mdi mdi-checkbox-blank-circle text-warning"></i> Not Assigned</td>
                
                                            {{-- driver button --}}
                                            <td>
                                                <button type="button"
                                                    class="btn-sm btn btn-outline-dark waves-effect waves-light driver-assign-id-2"
                                                    data-toggle="modal" data-target=".drivers-list-2"
                                                    value="{{ $order->customer->id }}">Drivers</button>
                                            </td>
                
                                        </tr>
                                        {{-- end trow --}}
                
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




                {{-- hr --}}
                <div class="col-lg-12">
                    <hr>
                </div>







                {{-- singleorders with no drivers --}}
                <div class="col-lg-12">
                    <div class="card" style=" background-color: #b83c3cc4; ">
                        <div class="card-body">
                            <h4 class="card-title">Assign Drivers To One-Time Deliveries</h4>
                            <p class="card-title-desc">Review all unassigned single deliveries.</p>
                
                            <div class="table-responsive">
                                <table class="table mb-0">
                
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Restaurant</th>
                                            <th>Customer</th>
                                            <th>Customer Phone</th>
                                            <th>City</th>
                                            <th>District</th>
                                            <th>Address</th>
                                            <th>Delivery Date</th>
                                            <th>Status</th>
                                            <th>Assign To</th>
                                        </tr>
                                    </thead>
                
                                    {{-- tbody --}}
                                    <tbody>
                
                
                                        {{-- forreach for orders --}}
                                        @foreach ($singleorders as $order)
                
                                        {{-- trow --}}
                                        <tr>
                                            <td>{{ $order->partner->name }}</td>
                                            <td>{{ $order->customer_name }}</td>
                                            <td>{{ $order->customer_phone }}</td>
                                            <td>{{ $order->city->name }}</td>
                                            <td>{{ $order->district->name }}</td>
                                            <td>{{ $order->customer_address }}</td>
                
                
                                            <td>{{ $order->deliverydate }}</td>
                
                                            {{-- status --}}
                                            <td><i class="mdi mdi-checkbox-blank-circle text-warning"></i> Not Assigned</td>
                
                                            {{-- driver button --}}
                                            <td>
                                                <button type="button"
                                                    class="btn-sm btn btn-outline-dark waves-effect waves-light driver-assign-id-3"
                                                    data-toggle="modal" data-target=".drivers-list-3"
                                                    value="{{ $order->id }}">Drivers</button>
                                            </td>
                
                                        </tr>
                                        {{-- end trow --}}
                
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















                {{-- hr --}}
                <div class="col-lg-12">
                    <hr>
                </div>
                
                
                
                
                
                
                
                {{-- othersingleorders with no drivers --}}
                <div class="col-lg-12">
                    <div class="card" style=" background-color: #b83c3cc4; ">
                        <div class="card-body">
                            <h4 class="card-title">Assign Drivers To Partner Deliveries</h4>
                            <p class="card-title-desc">Review all unassigned single deliveries.</p>
                
                            <div class="table-responsive">
                                <table class="table mb-0">
                
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Partner</th>
                                            <th>Customer</th>
                                            <th>Customer Phone</th>
                                            <th>City</th>
                                            <th>District</th>
                                            <th>Address</th>
                                            <th>Delivery Date</th>
                                            <th>No. Of Vans</th>
                                            <th>Comments/Notes</th>
                                            <th>Status</th>
                                            <th>Assign To</th>
                                        </tr>
                                    </thead>
                
                                    {{-- tbody --}}
                                    <tbody>
                
                
                                        {{-- forreach for orders --}}
                                        @foreach ($othersingleorders as $order)
                
                                        {{-- trow --}}
                                        <tr>
                                            <td>{{ $order->otherpartner->name }}</td>
                                            <td>{{ $order->customer_name }}</td>
                                            <td>{{ $order->customer_phone }}</td>
                                            <td>{{ $order->city->name }}</td>
                                            <td>{{ $order->district->name }}</td>
                                            <td>{{ $order->customer_address }}</td>
                
                
                                            <td>{{ $order->deliverydate }}</td>
                                            
                                            <td>{{ $order->numberofcarriage }}</td>

                                            <td>{{ $order->info }}</td>
                                            
                                            {{-- status --}}
                                            <td><i class="mdi mdi-checkbox-blank-circle text-warning"></i> Not Assigned</td>
                
                                            {{-- driver button --}}
                                            <td>
                                                <button type="button"
                                                    class="btn-sm btn btn-outline-dark waves-effect waves-light driver-assign-id-4"
                                                    data-toggle="modal" data-target=".drivers-list-4"
                                                    value="{{ $order->id }}">Drivers</button>
                                            </td>
                
                                        </tr>
                                        {{-- end trow --}}
                
                                        @endforeach
                                        {{-- end foreach --}}
                
                
                
                                    </tbody>
                                    {{-- end tbody --}}
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


            </div>
            {{-- end row --}}
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
{{-- orders -> drivers --}}
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


                {{-- form (add order driver (using customer id) --}}
                <form action="{{ route('admin.addorderdriver') }}" method="post">
                
                
                    {{-- method fields --}}
                    @method('POST')
                    @csrf
                
                
                    {{-- order id --}}
                    <input type="hidden" id="modal-assign-driver" name="customer_id" value="">

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














{{-- modal --}}
{{-- collectedorders -> drivers --}}
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


                {{-- form (add order driver (using customer id) --}}
                <form action="{{ route('admin.addcollectedorderdriver') }}" method="post">


                    {{-- method fields --}}
                    @method('POST')
                    @csrf


                    {{-- order id --}}
                    <input type="hidden" id="modal-assign-driver-2" name="customer_id" value="">

                    {{-- row --}}
                    <div class="row">


                        {{-- driver --}}
                        <div class="col-12">
                            <div class="form-group row">

                                <div class="col-sm-4">
                                    <label>Drivers</label>
                                    <select required="" name="driver_id" class="custom-select">

                                        @foreach ($drivers->where('type', 'collector') as $driver)
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














{{-- modal --}}
{{-- singleorders -> drivers --}}
<div class="modal fade drivers-list-3" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
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
                <form action="{{ route('admin.addsingleordersdriver') }}" method="post">


                    {{-- method fields --}}
                    @method('POST')
                    @csrf


                    {{-- order id --}}
                    <input type="hidden" id="modal-assign-driver-3" name="order_id" value="">

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




















{{-- modal --}}
{{-- singleorders -> drivers --}}
<div class="modal fade drivers-list-4" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
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
                <form action="{{ route('admin.addothersingleordersdriver') }}" method="post">


                    {{-- method fields --}}
                    @method('POST')
                    @csrf


                    {{-- order id --}}
                    <input type="hidden" id="modal-assign-driver-4" name="order_id" value="">

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



{{-- endmodal --}}




@endsection