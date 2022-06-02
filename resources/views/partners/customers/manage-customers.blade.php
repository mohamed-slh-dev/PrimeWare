@extends('layouts.partner')


@section('content')



{{-- continue header --}}
<!-- start page title -->
<div class="page-title-box">
    <div class="container-fluid">
        <div class="page-title-content">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4>Manage Customers</h4>
                </div>

                <div class="col-sm-6">
                    <div class="float-right d-none d-md-block">

                        {{-- form (search partner) --}}
                        <form class="app-search" action="{{ route('partner.searchcustomer') }}" method="post">
                        
                            {{-- method fields --}}
                            @method('POST')
                            @csrf

                            <input name="searchinput" type="text" class="form-control" placeholder="Customer Name">
                            <span class="fa fa-search"></span>
                        
                        </form>
                        {{-- end form --}}

                    </div>
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
                

                {{-- column 12 --}}
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
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
                                            <th>Freeze Subscription</th>
                                            <th>Add Delivery Days</th>
                                        </tr>
                                    </thead>
                                    <tbody>


                                        {{-- counter for ids --}}
                                        <?php $counter = 1; ?>

                                        {{-- foreach --}}
                                        @foreach ($customers as $customer)
                                            
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

                                            {{-- freeze --}}
                                            <td>
                                                <button data-toggle="modal" data-target=".freeze-modal" class="fa fa-cube text-primary custom-edit-button customer-assign-id-freeze" value="{{ $customer->id }}"></button>
                                            </td>

                                            {{-- edit --}}
                                            <td>
                                                <button data-toggle="modal" data-target=".edit-customer" class="far fa-edit text-primary custom-edit-button customer-assign-id" value="{{ $customer->id }}"></button>
                                            </td>

                                            {{-- delete --}}
                                            {{-- <td>

                                                <form action="{{ route('partner.deletecustomer') }}" method="post">
                                                    
                                                    @csrf
                                                    @method('POST')

                                                    
                                                    <input type="hidden" name="customerid" value="{{ $customer->id }}">


                                                    <button type="submit" class="btn btn-none p-0 shadow-none">
                                                    <i class="dripicons-trash text-danger"></i>
                                                    </button> 

                                                </form>
                                            </td> --}}

                                        </tr>

                                        {{-- increase counter --}}
                                        <?php $counter++; ?>

                                        @endforeach
                                        {{-- end foreach (repeat) --}}

                            
                                    </tbody>
                                    {{-- end body --}}
                                </table>
                            </div>
                            {{-- end of table and wrapper --}}

                            <div class="col-12">
                                {{-- paginations --}}
                                <div class="pagination mt-4">
                                    @if($customers instanceof \Illuminate\Pagination\LengthAwarePaginator )
                                    
                                    {{$customers->links()}}
                                    
                                    @endif
                                </div>
                            </div>


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







{{-- modals --}}


{{-- edit customer modal --}}
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
            <div class="modal-body">


                {{-- form (search partner) --}}
                <form action="{{ route('partner.renewcustomermain') }}" method="post">
                
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
</div>
<!-- /.modal -->





{{-- freeze modal --}}
<div class="modal fade freeze-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            {{-- header --}}
            <div class="modal-header">
                <h4 class="modal-title mt-0 font-weight-bold" id="myLargeModalLabel">Freeze Subscription</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            {{-- modal body --}}
            <div class="modal-body">

                {{-- form (search partner) --}}
                <form action="{{ route('partner.freezeorders') }}" method="post">
                
                    {{-- method fields --}}
                    @method('POST')
                    @csrf
                
                    {{-- partner id --}}
                    <input type="hidden" name="customer_id" id="modal-assign-customer-freeze" value="">


                    <div class="row">


                        {{-- freeze from to --}}
                        <div class="col-12">

                            
                            {{-- freeze from - to --}}
                            <div class="form-group row">

                                
                                <div class="col-6">
                                    <label>Freezing Start Date </label>
                                    <input required="" name="freezefrom" min="{{ date('Y-m-d') }}" class="form-control" type="date" placeholder="YYYY-MM-DD" id="example-text-input">
                                </div>

                                <div class="col-6">
                                    <label>Freezing End Date </label>
                                    <input required="" name="freezeto" min="{{ date('Y-m-d') }}" class="form-control" type="date" placeholder="YYYY-MM-DD" id="example-text-input">
                                </div>

                            </div>
                            {{-- end freeze from to --}}
                    

                        </div>
                        {{-- end freeze from to --}}


               

                    


                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-outline-success mr-1 font-15">FREEZE</button>
                        </div>


                    </div>
                    {{-- end row --}}

                </form>
                {{-- end form --}}

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



{{-- endmodals --}}



@endsection