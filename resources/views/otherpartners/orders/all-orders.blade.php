@extends('layouts.otherpartner')


@section('content')




<style>
        .input-hidden {
            position: absolute;
            left: -9999px;
        }
    
        input[type=radio]:checked+label>img {
            border: 1px solid #fff;
            padding: 5px 8px;
            box-shadow: 0 0 1px 1px #fbbe00;
        }
    
        /* Stuff after this is only to make things more pretty */
        input[type=radio]+label>img {
            border: 1px dashed #444;
            width: 100px;
            height: 100px;
            transition: 500ms all;
        }
    
        /* input[type=radio]:checked+label>img {
            transform:
                rotateZ(-10deg) rotateX(10deg);
        } */
    
        /*
     | //lea.verou.me/css3patterns
     | Because white bgs are boring.
    */
        html {
            background-color: #fff;
            background-size: 100% 1.2em;
            background-image:
                linear-gradient(90deg,
                    transparent 79px,
                    #abced4 79px,
                    #abced4 81px,
                    transparent 81px),
                linear-gradient(#eee .1em,
                    transparent .1em);
        }
    </style>




{{-- continue header --}}
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

{{-- end header --}}




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
                                        <h4 class="mt-0 mb-1 d-inline-block">
                                            {{ number_format($orders->count()) }}</h4>
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
                                            <h4 class="mt-0 mb-1 d-inline-block">
                                                {{ number_format($orders->where('status', 'delivered')->count()) }}</h4>


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
                                        <h4 class="mt-0 mb-1 d-inline-block">{{ number_format($orders->where('status', 'canceled')->count()) }}
                                        </h4>
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
                                    <form action="{{ route('otherpartner.searchregulardeliveries') }}" method="post">

                                        {{-- method fields --}}
                                        @method('POST')
                                        @csrf


                                        {{-- row --}}
                                        <div class="row">

                                            {{-- col --}}
                                            <div class="col-3 ">
                                                <div class="form-group row">

                                                    <label for="example-text-input" class="col-sm-4 col-form-label">From</label>

                                                    <div class="col-sm-8">
                                                        <input type="date" placeholder="YYYY-MM-DD" name="fromdate" class="form-control">
                                                    </div>

                                                </div>
                                            </div>
                                            {{-- end col --}}

                                            {{-- col --}}
                                            <div class="col-3 ">
                                                <div class="form-group row">
                                            
                                                    <label for="example-text-input" class="col-sm-4 col-form-label">To</label>
                                            
                                                    <div class="col-sm-8">
                                                        <input type="date" placeholder="YYYY-MM-DD" name="todate" class="form-control">
                                                    </div>
                                            
                                                </div>
                                            </div>
                                            {{-- end col --}}


                                            {{-- col --}}
                                            <div class="col-3 ">
                                                <div class="form-group row">

                                                    <label for="example-text-input"
                                                        class="col-sm-4 col-form-label">Status</label>

                                                    <div class="col-sm-8">
                                                        <select required="" name="status" class="custom-select ">
                                                            <option value="all">All</option>

                                                            <option value="requested">Requested</option>
                                                            <option value="delivered">Delivered</option>
                                                            <option value="canceled">Canceled</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- end col --}}

                                            {{-- button --}}
                                            <div class="col-3 text-left">
                                                <button type="submit"
                                                    class="btn btn-outline-success waves-effect waves-light mx-3">
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
                            <p class="card-title-desc">Review all deliveries</p>

                            <div class="table-responsive">
                                <table class="table mb-0">

                                    <thead class="thead-light">
                                        <tr>
                                            <th>Delivery No.</th>
                                            <th>Reference ID</th>
                                            <th>Customer</th>
                                            <th>Phone</th>

                                            <th>City</th>
                                            <th>District</th>
                                            <th>Address</th>

                                            <th>Location</th>

                                            <th>Delivery Date</th>
                                            <th>Comments/Notes</th>
                                            <th>Status</th>
                                            <th>Received At</th>
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
                                            <td>{{ $order->referenceid }}</td>
                                            <td>{{ $order->customer_name }}</td>
                                            <td>{{ $order->customer_phone }}</td>

                                            <td>{{ $order->city->name }}</td>
                                            <td>{{ $order->district->name }}</td>

                                            <td>{{ $order->customer_address }}</td>

                                            <td><a href="https://www.google.com/maps/search/?api=1&query={{ ltrim($order->customer_locationlink, '@') }}" class="text-warning" target="_blank">Show Map</a></td>

                                            
                                            {{-- deliverydate + delivery time --}}
                                            <td>{{ $order->deliverydate }} - {{ $order->deliverytime }}</td>

                                            <td>{{ $order->info }}</td>

                                            @if ($order->status == "delivered")
                                                
                                                <td><i class="mdi mdi-checkbox-blank-circle text-success"></i> Delivered</td>

                                            @elseif ($order->status == "canceled")

                                                <td><i class="mdi mdi-checkbox-blank-circle text-danger"></i> Canceled</td>

                                            @else

                                                <td><i class="mdi mdi-checkbox-blank-circle text-warning"></i> {{ ucwords($order->status) }}</td>

                                            @endif



                                            {{-- updatedate + pickup time --}}
                                            @if ($order->status == "delivered")
                                                <td>{{ $order->updatedate }} - {{ $order->pickuptime }}</td>

                                            @else
                                                <td>-</td>
                                            @endif




                                            {{-- cancel delivery --}}
                                            <td class="text-left">
                                                {{-- form (add new partner) --}}
                                                <form action="{{ route('otherpartner.cancelsingleorder') }}" method="post">
                                            
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
                                        {{-- endforeach --}}

                                    </tbody>
                                    {{-- end tbody --}}
                                </table>
                            </div>
                            {{-- end table wrapper --}}

                            {{-- paginations --}}
                            <div class="pagination mt-4">
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
                <form action="{{ route('otherpartner.addsingleorder') }}" method="post">

                    {{-- method fields --}}
                    @method('POST')
                    @csrf


                    {{-- form row --}}
                    <div class="row">


                        {{-- partner id --}}
                        <input type="hidden" name="otherpartner" value="{{ session()->get('otherpartner_id') }}">

                        {{-- col --}}
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
                                    <label>Reference ID</label>
                                    <input name="refid" class="form-control" type="text">
                                </div>



                            </div>
                        </div>
                        {{-- end col --}}



                        {{-- col --}}
                        <div class="col-12">
                            <div class="form-group row">


                                <div class="col-sm-4">
                                    <label>City</label>
                                    <select id="cityselect" required="" name="city" class="custom-select">

                                        <option value="" selected=""></option>
                                        
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                                        @endforeach

                                    </select>
                                </div>



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
                                    <input required="" name="address" class="form-control" type="text" >
                                </div>


                            </div>
                        </div>
                        {{-- end col --}}


                        {{-- col --}}
                        <div class="col-12">
                            <div class="form-group row">

                                
                                <div class="col-sm-4">
                                    <label>Pickup Location Link</label>
                                    <select name="pickuplocationlink" class="custom-select" id="location-select" onchange="otherLocation()">
                                        <option selected="" value="currentlocation">My Current Location</option>
                                        <option value="otherlocation">Other Location</option>
                                    </select>
                                
                                </div>
                                
                                <div class="col-sm-4 d-none" id="other-location">
                                    <label>Other Pickup Location Link</label>
                                    <input id="other-location-input" name="otherpickuplocationlink" placeholder="e.g: 12.2773737373, 257773737734" class="form-control" type="text">
                                </div>



                                <div class="col-sm-4">
                                    <label>Customer Location Link</label>
                                    <input required="" placeholder="e.g: 12.2773737373, 257773737734" name="customerlocationlink" class="form-control" type="text">
                                </div>



                            </div>
                        </div>
                        {{-- end col --}}


                        {{-- col --}}
                        <div class="col-12">
                            <div class="form-group row">
                                
                                <div class="col-sm-4">
                                    <label>Package Content Type</label>
                                    <select name="packagetype" class="custom-select" id="package-select" onchange="otherBackage()">
                                        <option value="food">Food</option>
                                        <option value="perfume">Perfume</option>
                                        <option value="electronics">Electronics</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                                
                                <div class="col-sm-8 d-none" id="other-backage">
                                    <label>Other Package Content </label>
                                    <input id="other-backage-input" name="otherpackagetype" class="form-control" type="text">
                                </div>

                            </div>
                        </div>
                        {{-- end col --}}



                        {{-- col 12 --}}
                        <div class="col-12">
                            <div class="form-group row">
                                

                                <div class="col-4">
                                    <label>Delivery Date</label>
                                    <input required="" id="order_date" name="deliverydate" class="form-control" type="date" placeholder="YYYY-MM-DD" min="{{ date('Y-m-d') }}">
                                </div>
                        
                                <div class="col-4">
                                    <label>Pickup Time</label>
                                    <input required="" name="pickuptime" class="form-control" type="time">
                                </div>
                        
                        
                        
                                <div class="col-4">
                                    <label>Delivery Time</label>
                                    <input required="" name="deliverytime" class="form-control" type="time">
                                </div>
                        
                        
                            </div>
                        </div>
                        {{-- end col --}}




                        <div class="col-12">
                            <div class="form-group row">
                        
                                <div class="col-sm-4">
                                    <label>Deliver With</label><br>

                                    {{-- bike --}}
                                    {{-- <input type="radio" checked name="vehicle" id="bikeoption" class="" value="bike"/>
                                    <label for="bikeoption" class="ml-1 mr-3">
                                        <img src="{{ asset('assets/img/assets/bike.png') }}" alt="bike" />
                                        Bike
                                    </label> --}}
                                    
                                    {{-- van --}}
                                    <input type="radio" checked name="vehicle" id="vanoption" class="invisible" value="van"/>
                                    <label for="vanoption" class="ml-1">
                                        <img src="{{ asset('assets/img/assets/van.png') }}" alt="van" />
                                        
                                    </label>
                        
                                </div>
                        

                                <div id="numberofvans" class="col-sm-4 d-none">
                                    <label>Number of Vans</label>
                                    <input value="1" id="numberofvansinput" name="numberofvans" class="form-control" type="number" min="1" max="10">
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
            

                        {{-- submit button --}}
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


{{-- end modal --}}

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
		$('#order_date').datepicker();
	})
}
</script>


@endsection