@extends('layouts.admin')


@section('content')



{{-- continue header --}}
<!-- start page title -->
<div class="page-title-box">
    <div class="container-fluid">
        <div class="page-title-content">
            <div class="row align-items-center">
                <div class="col-sm-4">
                    <h4 class="mb-2 mb-sm-0">Restaurant Info</h4>
                </div>

                <div class="col-sm-4 text-center">
                    <img src="{{ asset('assets/img/partners/logos/'.$partner->logo) }}" width="170" height="75" alt="logo-large" class="logo-lg custom-edit-logo">
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
                    <div class="card text-center" style="border: 1px solid black;">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-info mt-2">{{ number_format($partner->orders->count()) }}</h3> Total Deliveries
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-2">
                    <div class="card text-center" style="border: 1px solid black;">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-success mt-2">{{ number_format($partner->deliveredorders->count()) }}</h3> Total Delivered
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-2">
                    <div class="card text-center" style="border: 1px solid black;">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-danger mt-2">{{ number_format($partner->canceledorders->count()) }}</h3> Total Canceled
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-2">
                    <div class="card text-center" style="border: 1px solid black;">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-warning mt-2">{{ number_format($partner->orders->count() - ($partner->deliveredorders->count() + $partner->canceledorders->count())) }}</h3> Total Pending
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-2">
                    <div class="card text-center" style="border: 1px solid black;">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-primary mt-2">{{ number_format($partner->customers->sum('totalbags')) }}</h3> Total Bags

                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-2">
                    <div class="card text-center" style="border: 1px solid black;">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-secondry mt-2">{{ number_format($partner->orders->sum('cashcollected')) }}</h3> Total Income

                        </div>
                    </div>
                </div>
            </div>
            {{-- end row --}}



            {{-- form (edit partner) --}}
            <form action="{{ route('admin.updatepartner') }}" method="post" enctype="multipart/form-data">
            
                {{-- method fields --}}
                @method('POST')
                @csrf


                {{-- partner id --}}
                <input type="hidden" name="id" value="{{ $partner->id }}">


                <div class="row">

                    <div class="col-12">
                        <div class="form-group row">

                            <div class="col-sm-4">
                                <label>Name</label>
                                <input value="{{ $partner->name }}" required="" name="name" class="form-control" type="text">
                            </div>

                            <div class="col-sm-4">
                                <label>Phone</label>
                                <input value="{{ $partner->phone }}" required="" name="phone" class="form-control" type="text">
                            </div>

                            <div class="col-sm-4">
                                <label>Logo</label>
                                <input name="logo" class="form-control" type="file">
                            </div>



                        </div>

                    </div>

                    <div class="col-12">
                        <div class="form-group row">

                            <div class="col-sm-4">
                                <label>E-mail</label>
                                <input value="{{ $partner->email }}" required="" name="email" class="form-control" type="email">
                            </div>
                            <div class="col-sm-4">
                                <label>Portal E-mail</label>
                                <input value="{{ $partner->portalemail }}" required="" name="portalemail" class="form-control" type="email">
                            </div>
                            <div class="col-sm-4">
                                <label>Password</label>
                                <input placeholder="**************" name="password" class="form-control" type="password">
                            </div>


                        </div>

                    </div>


                    <div class="col-12">
                        <div class="form-group row">

                            <div class="col-sm-4">
                                <label>Contract Doc.</label>
                                <input name="contract" class="form-control" type="file">
                            </div>
                            <div class="col-sm-4">
                                <label>Start Date</label>
                                <input value="{{ $partner->startdate }}" required="" name="startdate" class="form-control" type="date" placeholder="YYYY-MM-DD">
                            </div>
                            <div class="col-sm-4">
                                <label>End Date</label>
                                <input value="{{ $partner->enddate }}" required="" name="enddate" class="form-control" type="date" placeholder="YYYY-MM-DD">
                            </div>


                        </div>

                    </div>

                    <div class="col-12">
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label>Type</label>
                                <select required="" name="type" class="custom-select">

                                    @foreach ($types as $type)

                                        @if ($partner->type_id == $type->id)
                                            <option value="{{ $type->id }}" selected="">{{ $type->name }}</option>

                                        @else
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>

                                        @endif

                                    @endforeach

                                </select>
                            </div>

                            <div class="col-sm-4">
                                <label>City</label>
                                <select id="cityselect" required="" name="city" class="custom-select">
                                    
                                    @foreach ($cities as $city)

                                        @if ($partner->city_id == $city->id)
                                            <option value="{{ $city->id }}" selected="">{{ $city->name }}</option>

                                        @else
                                            <option value="{{ $city->id }}">{{ $city->name }}</option>

                                        @endif

                                    @endforeach

                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label>District</label>

                                <select id="districtselect" required="" name="district" class="custom-select">
                                    
                                    @foreach ($districts as $district)

                                        {{-- chosen district --}}
                                        @if ($partner->district_id == $district->id)
                                            <option class="all-districts city-{{ $district->samedistrict->city_id }}" value="{{ $district->id }}" selected="">{{ $district->name }}</option>

                                        {{-- same district within chosen city --}}
                                        @elseif ($partner->city_id == $district->samedistrict->city_id)

                                            <option class="all-districts city-{{ $district->samedistrict->city_id }}" value="{{ $district->id }}">{{ $district->name }}</option>

                                        {{-- other districts --}}
                                        @else
                                            <option class="d-none all-districts city-{{ $district->samedistrict->city_id }}" value="{{ $district->id }}">{{ $district->name }}</option>

                                        @endif

                                    @endforeach

                                </select>
                            </div>

                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group row">

                            <div class="col-4">
                                <label>Address</label>
                                <input value="{{ $partner->address }}" required="" name="address" class="form-control" type="text">
                            </div>

                            <div class="col-sm-8">
                                <label>Location Link</label>
                                <input value="{{ ltrim($partner->locationlink, '@') }}" placeholder="e.g: 12.2773737373, 257773737734" required="" name="locationlink" class="form-control" type="text">
                            </div>
                        </div>
                    </div>


                    <div class="col-12">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>More info.</label>
                                <textarea name="info" id="textarea" class="form-control" maxlength="225" rows="3"
                                    placeholder="This textarea has a limit of 225 chars.">{{ $partner->info }}</textarea>
                            </div>
                        </div>
                    </div>


                    <div class="col-4 ">
                        <button type="submit" class="btn btn-outline-success mr-3 font-15 mt-2 mb-5">Update Info</button>
                    </div>

                </div>
                {{-- end form row --}}
            </form>
            {{-- end form editing --}}




            {{-- partner all orders row --}}
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">All Deliveries</h4>

                            <div class="table-responsive">
                                <table class="table mt-4 mb-0 table-centered table-nowrap">

                                    <thead>
                                        <tr>
                                            <th>Customer</th>
                                            <th>Customer phone</th>
                                            
                                            <th>No. Of deliveries</th>
                                            <th>City</th>
                                            <th>District</th>
                                            <th>Address</th>
                                            <th>View</th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        
                                        <?php $counter = 1; ?>

                                        {{-- customers in partner --}}
                                        @foreach ($partner->customers as $customer)
                                        
                                        {{-- table row --}}
                                        <tr>
                                        
                                            <td>{{ $customer->name }}</td>
                                            <td>{{ $customer->phone }}</td>
                                            <td>{{ $customer->orders->count() }}</td>
                                            <td>{{ $customer->city->name }}</td>
                                            <td>{{ $customer->district->name }}</td>
                                            <td>{{ $customer->address }}</td>
                                            {{-- show info --}}
                                            <td>
                                                <button type="button" class="btn-sm btn btn-outline-success waves-effect waves-light" data-toggle="modal"
                                                    data-target="#modal-{{ $counter }}">
                                                    <i class="dripicons-preview"></i>
                                                </button>
                                            </td>
                                        
                                        
                                        
                                        </tr>
                                        {{-- end of table row  --}}
                                        
                                        {{-- increase counter --}}
                                        <?php $counter++; ?>
                                        
                                        @endforeach
                                        {{-- end of customers in partner --}}

                                    </tbody>
                                    {{-- end tbody --}}

                                </table>
                            </div>
                            {{-- end table wrapper --}}


                        </div>
                    </div>
                </div>

            </div>

        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    {{-- footer --}}
    <footer class="footer">

    </footer>
    {{-- end footer --}}

</div>
<!-- end main content-->


{{-- endcontent --}}














{{-- modal --}}

{{-- partners with customers orders (partner) --}}
{{-- counter for table --}}
<?php $counter = 1; ?>


{{-- customers in partner --}}
@foreach ($partner->customers as $customer)


<div class="modal fade collect-list" id="modal-{{ $counter }}" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Resturant Collected List Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">

                    <div class="col-md-6 col-xl-2">
                        <div class="card text-center">
                            <div class="mb-2 card-body text-muted">
                                <h3 class="text-info mt-2">{{ number_format($customer->orders->count()) }}</h3>Total
                                Deliveries
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-2">
                        <div class="card text-center">
                            <div class="mb-2 card-body text-muted">
                                <h3 class="text-danger mt-2">{{ number_format($customer->canceledorders->count()) }}
                                </h3> Canceled

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-2">
                        <div class="card text-center">
                            <div class="mb-2 card-body text-muted">
                                <h3 class="text-primary mt-2">{{ number_format($customer->deliveredorders->count()) }}
                                </h3> Delivered
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-2">
                        <div class="card text-center">
                            <div class="mb-2 card-body text-muted">
                                <h3 class="text-primary mt-2">{{ number_format($customer->orders->sum('bag')) }}</h3>
                                Bags Collected
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-2">
                        <div class="card text-center">
                            <div class="mb-2 card-body text-muted">
                                <h3 class="text-primary mt-2">1</h3> Bags On Hand
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-2">
                        <div class="card text-center">
                            <div class="mb-2 card-body text-muted">
                                <h3 class="text-success mt-2">
                                    {{ number_format($customer->orders->sum('cashcollected')) }}</h3> Cash Collected
                            </div>
                        </div>
                    </div>

                </div>


                {{-- deliveries | orders --}}
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Deliveries History</h4>
                                <p class="card-title-desc">Review all deliveries details </p>

                                <div class="table-responsive">
                                    <table class="table mb-0">

                                        <thead class="thead-light">
                                            <tr>
                                                <th>Driver</th>
                                                <th>Delivery Date</th>
                                                <th>Cash Collected</th>
                                                <th>Status</th>
                                                <th>Bag</th>
                                            </tr>
                                        </thead>

                                        {{-- tbody --}}
                                        <tbody>

                                            {{-- customers in partner --}}
                                            @foreach ($customer->orders as $order)

                                            {{-- table row --}}
                                            <tr>

                                                <td>{{ (!empty($order->driver->name) ? $order->driver->name : "-") }}
                                                </td>
                                                <td>{{ $order->deliverydate}}</td>
                                                <td>{{ number_format($order->cashcollected) }}</td>

                                                {{-- status of order --}}

                                                @if ($order->status == "delivered")

                                                <td><i class="mdi mdi-checkbox-blank-circle text-success"></i> Delivered
                                                </td>

                                                @elseif ($order->status == "canceled")

                                                <td><i class="mdi mdi-checkbox-blank-circle text-danger"></i> Canceled
                                                </td>

                                                @else

                                                <td><i class="mdi mdi-checkbox-blank-circle text-warning"></i>
                                                    {{ ucwords($order->status) }}</td>

                                                @endif


                                                {{-- bag --}}
                                                @if ($order->bag == 1)
                                                <td>With Bag</td>

                                                @else
                                                <td>Without Bag</td>

                                                @endif

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
</div>
<!-- /.modal -->


{{-- increase counter --}}
<?php $counter++; ?>

@endforeach
{{-- end of customers in partner --}}







@endsection