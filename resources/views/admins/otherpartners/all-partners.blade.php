
@extends('layouts.admin')


@section('content')



{{-- continue header --}}



<!-- start page title -->
<div class="page-title-box">
    <div class="container-fluid">
        <div class="page-title-content">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4>Partners</h4>
                </div>


                <div class="col-sm-4">
                    <div class="float-right">
                        <button type="button" class="btn btn-outline-success waves-effect waves-light"
                            data-toggle="modal" data-target=".bs-example-modal-lg">Add Other Partner</button>
                    </div>
                </div>

                <div class="col-sm-2">
                    <div class="float-right d-none d-md-block">

                        {{-- form (search partner) --}}
                        <form class="app-search" action="{{ route('admin.searchotherpartnermain') }}" method="post">
                        
                            {{-- method fields --}}
                            @method('POST')
                            @csrf

                            <input name="searchinput" type="text" class="form-control" placeholder="Partner Name">
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
{{-- end of header --}}





{{-- content --}}

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">


                @foreach ($partners as $partner)
                    
                {{-- first partner (repeat) --}}
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">

                            <div class="media">
                                <div class="col-12 text-center">
                                    <img class="mb-3 card-image-fit" src="{{ asset('assets/img/partners/logos/'.$partner->logo) }}" width="170" height="75"
                                        alt="Generic placeholder image">
                                    <div class="media-body">
                                        <h5 class="font-size-16 mb-1">{{ $partner->name }}</h5>
                                        <p class="text-muted mb-0">{{ $partner->portalemail }}</p>
                                        
                                        {{-- <p class="text-muted font-size-14 font-weight-medium font-secondary mb-0">{{ $partner->type->name }}</p> --}}

                                        <p class=" font-size-16 font-weight-bold text-success">{{ $partner->city->name }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="row text-center">

                                <div class="col-6">
                                    <h5 class="mb-0">{{ $partner->orders->count() }}</h5>
                                    <p class="text-muted font-size-14">Deliveries</p>
                                </div>

                                <div class="col-6">
                                    <h5 class="mb-0">{{ $partner->deliveredorders->count() }}</h5>
                                    <p class="text-muted font-size-14">Delivered</p>
                                </div>
                            </div>

                            <ul class="social-links text-center list-inline mb-0 mt-3">


                                <li class="list-inline-item">
                                    <button style="box-shadow:none !important; font-size:13px; padding:0px 8px; padding-bottom:2px;" title="" id="customer-assign-id" type="button" data-placement="top" class="tooltips btn btn-none customer-assign-id" data-target=".delete-partner" data-toggle="modal" value="{{ $partner->id }}"
                                        data-original-title="Delete"><i class="fas fa-trash-alt text-danger"></i></button>
                                </li>



                                <li class="list-inline-item">
                                    <a title="" target="_blank" data-placement="top" data-toggle="tooltip"
                                        class="tooltips" href="https://www.google.com/maps/search/?api=1&query={{ ltrim($partner->locationlink, '@') }}"
                                        data-original-title="Location"><i class="fas fa-map-marker-alt "></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href=""
                                        data-original-title="Chat"><i class="mdi mdi-chat"></i></a>
                                </li>

                                <li class="list-inline-item">
                                    <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href=""
                                        data-original-title="{{ $partner->phone }}"><i class="fas fa-phone"></i></a>
                                </li>

                            </ul>

                        </div>
                    </div>
                </div>
                {{-- end first partner (repeat) --}}


                @endforeach
                {{-- end foreach partner --}}




                <div class="col-12">
                    {{-- paginations --}}
                    <div class="pagination mt-4">

                        @if($partners instanceof \Illuminate\Pagination\LengthAwarePaginator )
                        
                        {{$partners->links()}}
                        
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
<!-- end main content-->







{{-- modal --}}

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Add Other Partner</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                {{-- form (add new partner) --}}
                <form action="{{ route('admin.addotherpartner') }}" method="post" enctype="multipart/form-data">

                    {{-- method fields --}}
                    @method('POST')
                    @csrf

                    {{-- row --}}
                    <div class="row">


                        <div class="col-12">
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
                                    <label>Logo</label>
                                    <input required="" name="logo" class="form-control" type="file" id="logo-input">
                                </div>



                            </div>

                        </div>

                        <div class="col-12">
                            <div class="form-group row">

                                <div class="col-sm-4">
                                    <label>E-mail</label>
                                    <input required="" name="email" class="form-control" type="email">
                                </div>
                                <div class="col-sm-4">
                                    <label>Portal E-mail</label>
                                    <input required="" name="portalemail" class="form-control" type="email">
                                </div>
                                <div class="col-sm-4">
                                    <label>Password</label>
                                    <input required="" name="password" class="form-control" type="password">
                                </div>


                            </div>

                        </div>


                        <div class="col-12">
                            <div class="form-group row">

                                <div class="col-sm-4">
                                    <label>Contract Doc.</label>
                                    <input required="" name="contract" class="form-control" type="file" id="contract-input">
                                </div>
                                <div class="col-sm-4">
                                    <label>Start Date</label>
                                    <input required="" name="startdate" class="form-control" type="date" placeholder="YYYY-MM-DD">
                                </div>
                                <div class="col-sm-4">
                                    <label>End Date</label>
                                    <input required="" name="enddate" class="form-control" type="date" placeholder="YYYY-MM-DD">
                                </div>


                            </div>

                        </div>

                        <div class="col-12">
                            <div class="form-group row">


                                {{-- priority --}}
                                <div class="col-sm-4">
                                    <label>Priority</label>
                                    <select required="" name="priority" class="custom-select">
                                
                                        <option value="normal" selected="">Normal</option>
                                        <option value="high">High</option>
                                        <option value="MVP">MVP</option>
                                
                                    </select>
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
                        </div>

                        <div class="col-12">
                            <div class="form-group row">


                                


                                {{-- address --}}
                                <div class="col-sm-4">
                                    <label>Address</label>
                                    <input required="" name="address" class="form-control" type="text">
                                </div>

                                {{-- location link --}}
                                <div class="col-sm-4">
                                    <label>Location Link</label>
                                    <input required="" placeholder="e.g: 12.2773737373, 257773737734" name="locationlink" class="form-control" type="text">
                                </div>


                


                            </div>
                        </div>


                        {{-- more info (info) --}}
                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label>More info</label>
                                    <textarea name="info" id="textarea" class="form-control" maxlength="225" rows="3"
                                        placeholder="This textarea has a limit of 225 chars."></textarea>
                                </div>
                            </div>
                        </div>



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
</div>
<!-- /.modal -->











{{-- delete partner modal --}}
<div class="modal fade delete-partner" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title mt-0 font-weight-bold" id="myLargeModalLabel">Delete Partner ? </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                {{-- form (search partner) --}}
                <form action="{{ route('admin.deleteotherpartner') }}" method="post">

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



{{-- end content --}}






@endsection