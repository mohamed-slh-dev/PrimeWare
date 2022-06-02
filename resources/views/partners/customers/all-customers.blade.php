@extends('layouts.partner')


@section('content')



{{-- continue header --}}
<!-- start page title -->
<div class="page-title-box">
    <div class="container-fluid">
        <div class="page-title-content">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4>Customers</h4>
                </div>

                <div class="col-sm-4">
                    <div class="float-right">
                        <button type="button" class="btn btn-outline-success waves-effect waves-light"
                            data-toggle="modal" data-target=".bs-example-modal-lg">Add Customer</button>
                    </div>
                </div>

                <div class="col-sm-2">
                    <div class="float-right d-none d-md-block">

                        {{-- form (search partner) --}}
                        <form class="app-search" action="{{ route('partner.searchcustomermain') }}" method="post">
                        
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


                {{-- card col (repeat) --}}
                @foreach ($customers as $customer)
                    
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">


                            {{-- row --}}
                            <div class="row text-center">

                             

                                {{-- name + email + district --}}
                                <div class="col-12">
                                    <div class="media-body">

                                        {{-- image --}}
                                        <img class="customer-avatar" src="{{ asset('assets/img/customers/avatar.png') }}" alt="">
                                        {{-- end image --}}
                                        

                                        <h5 class="font-size-16 mb-0">{{ $customer->name }}</h5>
                                        <p class="text-warning mb-1 font-size-15 font-weight-bold"># {{ $customer->id }}</p>

                                        <p class="text-muted mb-0">{{ $customer->city->name }} - {{ $customer->district->name }}</p>

                                        <p class="text-muted mb-0">{{ $customer->address }}</p>

                                        <p class="text-muted font-size-14 font-weight-medium font-secondary mb-0"></p>
                                        <p class="font-weight-small font-secondary">
                                            <a href="{{ route('partner.customer.info', [$customer->id]) }}"> <i class="fas fa-edit"></i> </a>
                                        </p>
                                    </div>
                                </div>

                            </div>
                            {{-- end row --}}


                            {{-- row --}}
                            <div class="row text-center mt-4">

                                {{-- delivered orders --}}
                                <div class="col-3">
                                    <h5 class="mb-0">{{ $customer->deliveredorders->count() }}</h5>
                                    <p class="text-muted font-size-14">Delivered</p>
                                </div>


                                {{-- bags + ordertype --}}
                                <div class="col-6">
                                    {{-- order type : Monthly or One time --}}
                                    <h6 class="text-muted font-size-14 mt-4">
                                        <span class="badge badge-light">
                                            Subscription
                                        </span>
                                    </h6>

                                    {{-- order type : Monthly or One time --}}
                                    <h6 class="text-muted font-size-14 mt-0">
                                        <span class="badge badge-light">
                                            {{ $customer->servicetiming }}
                                        </span>
                                    </h6>

                                    {{-- bags --}}
                                    <h6 class=" font-size-14 mt-3">
                                        <span class="badge badge-primary">
                                            Bags On Hand : {{ $customer->totalbags }}
                                        </span>
                                    </h6>
                                </div>

                                
                                {{-- canceled orders count --}}
                                <div class="col-3">
                                    <h5 class="mb-0">{{ $customer->canceledorders->count() }}</h5>
                                    <p class="text-muted font-size-14">Canceled</p>
                                </div>

                            </div>
                            {{-- end row --}}


                            {{-- whatsapp - phone number --}}
                            <ul class="social-links text-center list-inline mb-0 mt-3">


                                <li class="list-inline-item">
                                    <button style="box-shadow:none !important; font-size:13px; padding:0px 8px; padding-bottom:2px;" title="" id="customer-assign-id" type="button" data-placement="top" class="tooltips btn btn-none customer-assign-id" data-target=".delete-partner" data-toggle="modal" value="{{ $customer->id }}"
                                        data-original-title="Delete"><i class="fas fa-trash-alt text-danger"></i></button>
                                </li>


                                <li class="list-inline-item">
                                    <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href=""
                                        data-original-title="{{ $customer->phone }}">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>
                                </li>

                                <li class="list-inline-item">
                                    <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href=""
                                        data-original-title="{{ $customer->phone }}"><i class="fas fa-phone"></i>
                                    </a>
                                </li>
                            </ul>
                            {{-- end whatsapp + phone --}}

                        </div>
                    </div>
                </div>
                <!-- end card col (repeat) -->


                @endforeach
                {{-- end loop --}}


                <div class="col-12">
                    {{-- paginations --}}
                    <div class="pagination mt-4">
                        @if($customers instanceof \Illuminate\Pagination\LengthAwarePaginator )
                        
                        {{$customers->links()}}
                        
                        @endif
                    </div>
                </div>


            </div>
            <!-- end row -->

        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->


    {{-- footer --}}
    <footer class="footer">
        <div class="container-fluid">
            <div class="row">

            </div>
        </div>
    </footer>
    {{-- end footer --}}

</div>
{{-- end of main page wrapper --}}



{{-- endcontent --}}






{{-- modal --}}
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            {{-- header --}}
            <div class="modal-header">
                <h4 class="modal-title mt-0 font-weight-bold" id="myLargeModalLabel">Add New Customer</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {{-- endheader --}}


            {{-- modal body --}}
            <div class="modal-body">

                {{-- form (add new customer) --}}
                <form action="{{ route('partner.addcustomer') }}" method="post">
                    
                    {{-- method fields --}}
                    @method('POST')
                    @csrf


                    {{-- partner id (hidden) --}}
                    <input type="hidden" name="partner" value="{{ session()->get('partner_id') }}">


                    {{-- row --}}
                    <div class="row">

                        <div class="col-12">
                            <h5>Customer Info.</h5>
                            <div class="form-group row">

                                <div class="col-sm-4">
                                    <label>Name</label>
                                    <input required="" name="name" class="form-control" type="text">
                                </div>

                                <div class="col-sm-4">
                                    <label>Phone</label>
                                    <input required="" name="phone" class="form-control" type="text">
                                </div>

                                
                                <div class="col-sm-4">
                                    <label>Email</label>
                                    <input required="" name="email" class="form-control" type="email">
                                </div>
                                

                            </div>
                        </div>
                        {{-- end col --}}



                        <div class="col-12">
                            <div class="form-group row">


                                <div class="col-sm-4">
                                    <label>Password</label>
                                    <input required="" name="password" class="form-control" type="password">
                                </div>

                                {{-- city --}}
                                <div class="col-sm-4">
                                    <label>City</label>
                                    <select id="cityselect" required="" name="city" class="custom-select">
                                
                                        <option value="" selected=""></option>
                                
                                        @foreach ($cities as $city)
                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                        @endforeach
                                
                                    </select>
                                </div>



                                {{-- district --}}
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

                                

                                

                            </div>
                            {{-- end form group --}}
                        </div>
                        {{-- end col --}}

                        <div class="col-12">
                            <div class="form-group row">


                                {{-- address --}}
                                <div class="col-4">
                                    <label>Address</label>
                                    <input required="" name="address" class="form-control" type="text">
                                </div>



                                {{-- flatnumber --}}
                                <div class="col-sm-4">
                                    <label>Flat No.</label>
                                    <input  name="flatnumber" class="form-control" type="text">
                                </div>


                                {{-- block number --}}
                                <div class="col-sm-4">
                                    <label>Block No.</label>
                                    <input  name="blocknumber" class="form-control" type="text">
                                </div>

                                

                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group row">


                                {{-- locationlink --}}
                                <div class="col-sm-4">
                                    <label>Location Link</label>
                                    <input placeholder="e.g: 12.2773737373, 257773737734" name="locationlink" class="form-control" type="text">
                                </div>

                                {{-- servicetype : subscription --}}
                                <div class="col-sm-4">
                                    <label>Service Type</label>
                                    <select required="" name="servicetype" class="custom-select">
                                        <option value="subscription" selected="">Subscription</option>
                                        {{-- another unstated called special --}}
                                    </select>
                                </div>

                                {{-- servicetiming : morning shift / night shif --}}
                                <div class="col-4">
                                    <label>Selected Timing</label>
                                    <select required="" name="servicetiming" class="custom-select">
                                        
                                        {{-- morning shift --}}
                                        <option value="3:00 AM - 8:00 AM" selected="">3:00 AM - 8:00 AM</option>
                                        <option value="8:00 AM - 12:00 PM">8:00 AM - 12:00 PM</option>

                                        {{-- nightshift --}}
                                        <option value="3:00 PM - 9:00 PM">3:00 PM - 9:00 PM</option>

                                    </select>
                                </div>



                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group row">

                                {{-- delivery days --}}
                                <div class="col-4">
                                    <label>Delivery Days No.</label>
                                    <input required="" name="deliverydaysnumber" class="form-control" type="number" min="1">
                                </div>

                                {{-- substartdate + subenddate --}}
                                <div class="col-4">
                                    <label>Subscription Start Date </label>
                                    <input required="" id="start_date" name="substartdate" class="form-control" type="date" placeholder="YYYY-MM-DD">
                                </div>

                                <div class="col-4">
                                    <label>Subscription End Date </label>
                                    <input required="" id="end_date" name="subenddate" class="form-control" type="date" placeholder="YYYY-MM-DD">
                                </div>




                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group row">

                                <div class="col-4">
                                    <label>Cash Collection</label>
                                    <input required="" name="cashcollected" class="form-control" type="number" min="0">
                                </div>


                                {{-- link customer --}}
                                <div class="col-4">
                                    <label>Link to a Customer</label>
                                    <select name="linkcustomer" class="custom-select">
                                        
                                        {{-- empty option --}}
                                        <option value="" selected=""></option>

                                        @foreach ($customerslist as $customerlist)
                                            <option value="{{ $customerlist->id }}">{{ $customerlist->name }}</option>
                                        @endforeach

                                    </select>
                                </div>


                               

                            </div>
                        </div>




                        <div class="col-12">
                            <div class="form-group row">

                                <div class="col-12">
                                    <label>Comments/Notes</label>
                                    <textarea name="info" class="form-control" type="text" row="6"></textarea>
                                </div>

                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group row">

                                <div class="col-sm-12">
                                    <label>Deliver Days</label><br>


                                    <input type="checkbox" name="satcheck" id="Satrday">
                                    <label for="Satrday" class=" mx-2">Saturday</label>

                                    <input type="checkbox" name="suncheck" id="Sunday">
                                    <label for="Sunday" class=" mx-2">Sunday</label>

                                    <input type="checkbox" name="moncheck" id="Monday">
                                    <label for="Monday" class=" mx-2">Monday</label>

                                    <input type="checkbox" name="tuecheck" id="Tusday">
                                    <label for="Tusday" class=" mx-2">Tuesday</label>

                                    <input type="checkbox" name="wedcheck" id="Wendsday">
                                    <label for="Wendsday" class=" mx-2">Wednesday</label>

                                    <input type="checkbox" name="thucheck" id="Thursday">
                                    <label for="Thursday" class=" mx-2">Thursday</label>

                                    <input type="checkbox" name="fricheck" id="Friday">
                                    <label for="Friday" class=" mx-2">Friday</label>

                                </div>

                            </div>
                        </div>



                        <div class="col-12">
                            <hr style="border-top: 1px solid #c2c2c233;">
                        </div>

                        <div class="col-12">
                            <h5>Special Customer</h5>
                            <input type="checkbox" name="specialcheck" id="check_id" />
                            <label for="check_id">Special Customer</label><br>

                            <div class="form-group row" id="special-form">

                                <div class="col-sm-4">
                                    <label>Pickup Time</label>
                                    <input name="specialpickuptime" class="form-control" type="time">
                                </div>

                                <div class="col-sm-4">
                                    <label>Deliver Time</label>
                                    <input name="specialdeliverytime" class="form-control" type="time">
                                </div>

                            </div>



                        </div>

                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-outline-success mx-2 font-15">ADD</button>

                        </div>


                    </div>
                    {{-- end row --}}

                </form>
                {{-- endform --}}

            </div>
            {{-- end modal body --}}

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->














{{-- delete partner modal --}}
<div class="modal fade delete-partner" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title mt-0 font-weight-bold" id="myLargeModalLabel">Delete Customer ? </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                {{-- form (search partner) --}}
                <form action="{{ route('partner.deletecustomer') }}" method="post">

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
                                <div class="col-6 text-right">
                                    <button type="submit" class="btn btn-outline-success mx-2 font-15">CONFIRM</button>
                                </div>

                                <div class="col-6 text-left">
                                    <button data-dismiss="modal"
                                        class="btn btn-outline-success mx-2 font-15">CANCEL</button>
                                </div>


                            </div>
                        </div>
                        {{-- end col --}}


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






{{-- endmodal --}}


<script type="text/javascript">
	var datefield=document.createElement("input")
	datefield.setAttribute("type", "date")
	if (datefield.type!="date"){ //if browser doesn't support input type="date", load files for jQuery UI Date Picker
		document.write('<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />\n')
		document.write('<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"><\/script>\n')
		document.write('<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"><\/script>\n') 
	}
</script>

<script>
if (datefield.type!="date"){ //if browser doesn't support input type="date", initialize date picker widget:
	jQuery(function($){ //on document.ready
		$('#start_date').datepicker();
        $('#end_date').datepicker();
	})
}
</script>
@endsection