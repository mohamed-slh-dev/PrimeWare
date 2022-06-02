@extends('layouts.partner')


@section('content')


{{-- header --}}
<!-- start page title -->
<div class="page-title-box">
    <div class="container-fluid">
        <div class="page-title-content">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4>Deliveries</h4>
                </div>

                <div class="col-sm-6">
                    <div class="float-right">
                        <button type="button" class="btn btn-outline-success waves-effect waves-light"
                            data-toggle="modal" data-target=".bs-example-modal-lg">Create Delivery</button>
                    </div>
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
                                        <h4 class="mt-0 mb-1 d-inline-block">{{ number_format($partner->orders->count()) }}</h4>
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
                                            <p class="mb-0 text-muted">Total Delivered</p>
                                            <h4 class="mt-0 mb-1 d-inline-block">{{ number_format($partner->deliveredorders->count()) }}</h4>


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
                                        <p class="mb-0 text-muted">Total Canceled</p>
                                        <h4 class="mt-0 mb-1 d-inline-block">{{ $partner->canceledorders->count() }}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="progress mt-2" style="height:3px;">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 48%;"
                                    aria-valuenow="48" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <!--end card-body-->
                    </div>
                    <!--end card-->
                </div>
                <!--end col-->
            </div>
            <!--end row-->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card client-card">
                        <div class="card-body text-center">
                            <div class="row">
                                <div class="col-12">


                                    {{-- form (add new customer) --}}
                                    <form action="{{ route('partner.searchregulardeliveries') }}" method="post">
                                    
                                    {{-- method fields --}}
                                    @method('POST')
                                    @csrf


                                    {{-- row --}}
                                    <div class="row">

                                              {{-- col --}}
                                              <div class="col-2">
                                                <div class="form-group row">
    
                                                    <label for="example-text-input" class="col-sm-4 col-form-label">#No.</label>
    
                                                    <div class="col-sm-8">
                                                       <input type="number" name="id" class="form-control" id="">
                                                    </div>
    
                                                </div>
                                            </div>
                                            {{-- end col --}}

                                        {{-- col --}}
                                        <div class="col-4">
                                            <div class="form-group row">

                                                <label for="example-text-input" class="col-sm-4 col-form-label">Customer</label>

                                                <div class="col-sm-8">
                                                    <select required="" name="customer_id" class="custom-select">
                                                        <option value="all">All</option>
                                                        @foreach ($customers as $customer)
                                                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>

                                            </div>
                                        </div>
                                        {{-- end col --}}


                                        {{-- col --}}
                                        <div class="col-3 ">
                                            <div class="form-group row">

                                                <label for="example-text-input" class="col-sm-4 col-form-label">Status</label>

                                                <div class="col-sm-8">
                                                    <select required="" name="status" class="custom-select ">
                                                        
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
                                        {{-- end col --}}
                                        
                                        {{-- button --}}
                                        <div class="col-3 text-left">
                                            <button type="submit" class="btn btn-outline-success waves-effect waves-light mx-3">
                                                Search </button>
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
            {{-- end of filter --}}




            {{-- all delivery orders --}}
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

                                            <th>Location</th>

                                            <th>Status</th>
                                            <th>Delivery Date</th>
                                            <th>Cancel</th>
                                        </tr>
                                    </thead>

                                    {{-- tbody --}}
                                    <tbody>

                                        {{-- table row --}}

                                        {{-- single order (repeat) --}}
                                        @foreach ($orders as $order)
                                            
                                        <tr>
                                            <td># {{ $order->id }}</td>
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


                                            {{-- deliverydate + updated time (empty at beginning) --}}
                                            <td>{{ $order->deliverydate }} {{ $order->updatedate }}</td>



                                            {{-- cancel delivery --}}
                                            <td class="text-left">
                                                {{-- form (cancel partner order) --}}
                                                <form action="{{ route('partner.cancelorder') }}" method="post">
                                            
                                                    {{-- method fields --}}
                                                    @method('POST')
                                                    @csrf
                                            
                                                    @if ($order->status != "canceled")

                                                        @if ($order->deliverydate >= date('Y-m-d'))
                                                        <button type="submit" class="custom-edit-button">
                                                            <i class="fas fa-trash-alt text-danger"></i>
                                                        </button>
                                                        
                                                        @else
                                                        <button disabled type="submit" class="custom-edit-button">
                                                            <i class="fas fa-trash-alt text-secondary"></i>
                                                        </button>
                                                        @endif
                                            
                                            
                                                    @else
                                                    
                                                        @if ($order->deliverydate >= date('Y-m-d'))
                                                        <button type="submit" class="custom-edit-button">
                                                            <i class="fas fa-trash-restore-alt text-warning"></i>
                                                        </button>
                                                        
                                                        @else
                                                        <button disabled type="submit" class="custom-edit-button">
                                                            <i class="fas fa-trash-restore-alt text-secondary"></i>
                                                        </button>
                                                        @endif
                                            
                                                    @endif
                                            
                                            
                                                    <input type="hidden" name="orderid" value="{{ $order->id }}">
                                            
                                                </form>
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

                            {{-- paginations --}}
                            <div class="pagination mt-3">
                                @if($orders instanceof \Illuminate\Pagination\LengthAwarePaginator )
                                
                                {{$orders->links()}}
                                
                                @endif
                            </div>
                            {{-- end paginations --}}

                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
            {{-- end row --}}












            {{-- one time delivery orders --}}
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">One Time Deliveries</h4>
                            <p class="card-title-desc">Review only one-time deliveries</p>
            
                            <div class="table-responsive">
                                <table class="table mb-0">
            
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Customer</th>
                                            <th>Phone</th>
                                            
                                            <th>City</th>
                                            <th>District</th>
                                            <th>Address</th>

                                            <th>Location</th>

                                            <th>Delivery DateTime</th>
                                            
                                            <th>Status</th>
            
                                            <th>Cancel</th>
                                            {{-- <th>Delivered</th> --}}
                                        </tr>
                                    </thead>
            
                                    {{-- tbody --}}
                                    <tbody>
            
                                        {{-- table row --}}
            
                                        @foreach ($partner->singleorders as $order)
            
                                        <tr>
                                            <td>{{ $order->customer_name }}</td>
                                            <td>{{ $order->customer_phone }}</td>

                                            <td>{{ $order->city->name }}</td>
                                            <td>{{ $order->district->name }}</td>
                                            <td>{{ $order->customer_address }}</td>

                                            <td><a href="https://www.google.com/maps/search/?api=1&query={{ ltrim($order->customer_locationlink, '@') }}" class="text-warning" target="_blank">Show Map</a></td>
                                            

                                            {{-- delivery date --}}
                                            <td>{{ $order->deliverydate }} - {{ $order->deliverytime }}</td>
                                            
            
                                            @if ($order->status == "delivered")
            
                                            <td><i class="mdi mdi-checkbox-blank-circle text-success"></i> Delivered</td>
            
                                            @elseif ($order->status == "canceled")
            
                                            <td><i class="mdi mdi-checkbox-blank-circle text-danger"></i> Canceled</td>
            
                                            @else
            
                                            <td><i class="mdi mdi-checkbox-blank-circle text-warning"></i>
                                                {{ ucwords($order->status) }}</td>
            
                                            @endif
            
                                            
            
                                            {{-- delivered date --}}
                                            {{-- <td>{{ $order->updatedate }}</td> --}}
                                                

                                            {{-- cancel delivery --}}
                                            <td class="text-left">
                                                {{-- form (cancel partner order) --}}
                                                <form action="{{ route('partner.cancelsingleorder') }}" method="post">
                                            
                                                    {{-- method fields --}}
                                                    @method('POST')
                                                    @csrf
                                            
                                                    @if ($order->status != "canceled")
                                                    
                                                        @if ($order->deliverydate >= date('Y-m-d'))
                                                        <button type="submit" class="custom-edit-button">
                                                            <i class="fas fa-trash-alt text-danger"></i>
                                                        </button>
                                                        
                                                        @else
                                                        <button disabled type="submit" class="custom-edit-button">
                                                            <i class="fas fa-trash-alt text-secondary"></i>
                                                        </button>
                                                        @endif
                                            
                                            
                                                    @else

                                                        @if ($order->deliverydate >= date('Y-m-d'))
                                                            <button type="submit" class="custom-edit-button">
                                                                <i class="fas fa-trash-restore-alt text-warning"></i>
                                                            </button>
                                                        @else
                                                           <button disabled type="submit" class="custom-edit-button">
                                                            <i class="fas fa-trash-restore-alt text-secondary"></i>
                                                        </button> 
                                                        @endif
                                                    
                                            
                                                    @endif
                                            
                                            
                                                    <input type="hidden" name="orderid" value="{{ $order->id }}">
                                            
                                                </form>
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



{{-- endcontent --}}





{{-- modal --}}
{{-- add new one time order --}}
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Create New Delivery</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                {{-- form (add new customer) --}}
                <form action="{{ route('partner.addsingleorder') }}" method="post">
                
                    {{-- method fields --}}
                    @method('POST')
                    @csrf


                    {{-- form row --}}
                    <div class="row">


                        {{-- partner id --}}
                        <input type="hidden" name="partner" value="{{ session()->get('partner_id') }}">

                        {{-- col --}}
                        <div class="col-12">
                            <h5>Customer Info.</h5>
                            <div class="form-group row">

                                <div class="col-sm-4">
                                    <label>Name</label>
                                    <input required="" name="name" class="form-control" type="text" id="example-text-input">
                                </div>

                                <div class="col-sm-4">
                                    <label>Phone</label>
                                    <input required="" name="phone" class="form-control" type="text" id="example-text-input">
                                </div>


                                <div class="col-sm-4">
                                    <label>City</label>
                                    <select id="cityselect" required="" name="city" class="custom-select">

                                        <option value="" selected=""></option>
                                        
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                                        @endforeach

                                    </select>
                                </div>

                            </div>
                        </div>
                        {{-- end col --}}



                        {{-- col --}}
                        <div class="col-12">
                            <div class="form-group row">

                                <div class="col-sm-4">
                                    <label>District</label>
                                    <select id="districtselect" required="" name="district" class="custom-select districtselectforadding">
                                        
                                        <option value="" selected=""></option>
                                        
                                        @foreach ($districts as $district)

                                            <option class="all-districts d-none city-{{ $district->samedistrict->city_id }}" value="{{ $district->id }}">
                                                {{ $district->name }}
                                            </option>

                                        @endforeach

                                    </select>
                                </div>

                                <div class="col-4">
                                    <label>Address</label>
                                    <input required="" name="address" class="form-control" type="text" id="example-text-input">
                                </div>

                                <div class="col-sm-4">
                                    <label>Location Link</label>
                                    <input required="" placeholder="e.g: 12.2773737373, 257773737734" name="locationlink" class="form-control" type="text">
                                </div>

                            </div>
                        </div>
                        {{-- end col --}}


                        {{-- col --}}
                        <div class="col-12">
                            <div class="form-group row">

                                <div class="col-sm-4">
                                    <label>Service Type</label>
                                    <select required="" name="servicetype" class="custom-select">
                                        <option selected="" value="one time">One Time</option>

                                    </select>
                                </div>


                                <div class="col-4">
                                    <label>Delivery Date</span> </label>
                                    <input required="" name="deliverydate" class="form-control" type="date" placeholder="YYYY-MM-DD" min="{{ date('Y-m-d') }}" id="example-text-input">
                                </div>
                                


                                <div class="col-4">
                                    <label>Pickup Time</span> </label>
                                    <input required="" name="pickuptime" class="form-control" type="time" id="example-text-input">
                                </div>

                                

                            </div>
                        </div>
                        {{-- end col --}}

                        <div class="col-12">
                            <div class="form-group row">

                                <div class="col-4">
                                    <label>Delivery Time</span> </label>
                                    <input required="" name="deliverytime" class="form-control" type="time" id="example-text-input">
                                </div>
                                
                                <div class="col-4">
                                    <label>Cash Collected</span> </label>
                                    <input required="" name="cashcollected" class="form-control" type="number" min="0" id="example-text-input">
                                </div>
                            </div>
                        </div>


                        {{-- col --}}
                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-12">
                                    <label>Comments/Notes</label>
                                    <textarea required="" name="meal" id="textarea" class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        {{-- end col --}}


                        <div class="col-12 text-center">
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