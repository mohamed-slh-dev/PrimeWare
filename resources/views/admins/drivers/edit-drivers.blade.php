@extends('layouts.admin')


@section('content')



{{-- continue header --}}
<!-- start page title -->
<div class="page-title-box">
    <div class="container-fluid">
        <div class="page-title-content">
            <div class="row align-items-center">
                <div class="col-sm-4">
                    <h4>Driver Info</h4>
                </div>

                {{-- driver profile pic --}}
                <div class="col-sm-4 text-center">
                    <img src="{{ asset('assets/img/drivers/profiles/'.$driver->pic) }}" width="150" height="120" alt="logo-large"
                        class="logo-lg custom-edit-logo">
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
                <div class="col-md-6 col-xl-3">
                    <div class="card text-center">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-info mt-2">{{ number_format($driver->orders->count()) }}</h3> Total Deliveries
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card text-center">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-success mt-2">{{ number_format($driver->deliveredorders->count()) }}</h3> Total Delivered
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card text-center">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-danger mt-2">{{ number_format($driver->canceledorders->count()) }}</h3> Total Canceled
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card text-center">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-warning mt-2">{{ number_format($driver->orders->count() - ($driver->deliveredorders->count() + $driver->canceledorders->count())) }}</h3> Total Pending

                        </div>
                    </div>
                </div>





            </div>



            {{-- form (edit partner) --}}
            <form action="{{ route('admin.updatedriver') }}" method="post" enctype="multipart/form-data">
            
                {{-- method fields --}}
                @method('POST')
                @csrf


                {{-- id of driver --}}
                <input type="hidden" name="id" value="{{ $driver->id }}">

                <div class="row">


                    <div class="col-12">
                        <div class="form-group row">

                            <div class="col-sm-4">
                                <label>Name</label>
                                <input required="" value="{{ $driver->name }}" name="name" class="form-control" type="text">
                            </div>

                            <div class="col-sm-4">
                                <label>Phone</label>
                                <input required="" value="{{ $driver->phone }}" name="phone" class="form-control" type="text">
                            </div>

                            <div class="col-sm-4">
                                <label>Picture</label>
                                <input name="pic" class="form-control" type="file">
                            </div>



                        </div>

                    </div>


                    <div class="col-12">
                        <div class="form-group row">

                          

                            <div class="col-sm-4">
                                <label>Driver License</label>
                                <input required="" value="{{ $driver->drivinglicense }}" name="license" class="form-control" type="text">
                            </div>

                            <div class="col-sm-4">
                                <label>License Picture</label>
                                <input name="licpic" class="form-control" type="file">
                            </div>

                            <div class="col-sm-4">
                                <label>Type</label>
                                <select required="" name="type" class="custom-select">

                                    @if ($driver->type == "driver")
                                        <option value="driver" selected="">Driver</option>
                                        <option value="collector">Collector</option>

                                    @else
                                        <option value="driver">Driver</option>
                                        <option value="collector" selected="">Collector</option>
                                    @endif

                                    

                                </select>
                            </div>



                        </div>

                    </div>
                    <div class="col-12">
                        <div class="form-group row">

                        

                            
                          
                            <div class="col-sm-4">
                                <label>Shift</label>
                                <select required="" name="shift" class="custom-select">

                                    @if ($driver->shift == "morning shift")
                                        <option value="morning shift" selected="">Morning Shift</option>
                                        <option value="night shift">Night Shift</option>

                                    @else
                                        <option value="morning shift">Morning Shift</option>
                                        <option value="night shift" selected="">Night Shift</option>

                                    @endif
                                    
                            
                                </select>
                            </div>

                            <div class="col-sm-4">
                                <label>City</label>
                                <select id="cityselect" required="" name="city" class="custom-select">
                            
                                    @foreach ($cities as $city)
                            
                                    @if ($driver->city_id == $city->id)
                                    <option value="{{ $city->id }}" selected="">{{ $city->name }}</option>
                            
                                    @else
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                            
                                    @endif
                            
                                    @endforeach
                            
                                </select>
                            </div>

                            <div class="col-sm-4">
                                <label>District</label>
                                <select id="districtselect" required="" name="districts[]" class="custom-select" multiple="">
                                    
                                    @foreach ($districts as $district)

                                        @if (str_contains($ddlist, ",".$district->id.","))
                                            <option class="all-districts city-{{ $district->samedistrict->city_id }}" value="{{ $district->id }}" selected="">{{ $district->name }}</option>

                                        @elseif ($driver->city_id == $district->samedistrict->city_id)
                                            <option class="all-districts city-{{ $district->samedistrict->city_id }}" value="{{ $district->id }}">{{ $district->name }}</option>


                                        @else
                                            <option class="d-none all-districts city-{{ $district->samedistrict->city_id }}" value="{{ $district->id }}">{{ $district->name }}</option>

                                        @endif

                                    @endforeach

                                </select>
                            </div>




                         
                            
                        </div>
                    </div>
                    {{-- outer col --}}
                    

               





                    {{-- col 12--}}
                    <div class="col-12">
                        <div class="form-group row">
                            <div class="col-12">
                                <label>More Info.</label>
                                <textarea name="info" id="textarea" class="form-control" maxlength="225" rows="3"
                                    placeholder="This textarea has a limit of 225 chars.">{{ $driver->info }}</textarea>
                            </div>
                        </div>
                    </div>


                    <div class="col-4 ">
                        <button type="submit" class="btn btn-outline-success mr-3 font-15 mt-2 mb-5">Update Info</button>
                    </div>

                </div>
                {{-- end row --}}
            </form>
            {{-- end of edit form --}}






            {{-- driver orders table --}}
            <div class="row">

                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Latest Driver Deliveries</h4>

                            <div class="table-responsive">
                                <table class="table mt-4 mb-0 table-centered table-nowrap">

                                    <thead>
                                        <tr>
                                            <th>Restaurant</th>

                                            <th>Customer</th>
                                            <th>City</th>
                                            <th>District</th>
                                            <th>Address</th>

                                            <th>Delivery Date</th>
                                            <th>Cash Collection</th>
                                            <th>Status</th>
                                            <th>Bag</th>
                                        </tr>
                                    </thead>

                                    {{-- tbody --}}
                                    <tbody>

                                        {{-- driver orders --}}
                                        @foreach ($orders as $order)
                                            
                                        <tr>
                                            <td>{{ $order->partner->name }}</td>

                                            <td>{{ $order->customer->name }}</td>

                                            <td>{{ $order->customer->city->name }}</td>
                                            <td>{{ $order->customer->district->name }}</td>
                                            <td>{{ $order->customer->address }}</td>

                                            <td>{{ $order->deliverydate }}</td>
                                            <td>{{ $order->cashcollected }}</td>

                                            {{-- status --}}
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
                {{-- end col --}}

                <div class="col-12">
                    {{-- paginations --}}
                    <div class="pagination mt-4">
                        @if($orders instanceof \Illuminate\Pagination\LengthAwarePaginator )
                        
                        {{$orders->links()}}
                        
                        @endif
                    </div>
                </div>

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



@endsection