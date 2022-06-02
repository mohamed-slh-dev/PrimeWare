@extends('layouts.admin')


@section('content')



{{-- continue header --}}
<!-- start page title -->
<div class="page-title-box">
    <div class="container-fluid">
        <div class="page-title-content">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4>Drivers</h4>
                </div>

                <div class="col-sm-4">
                    <div class="float-right">
                        <button type="button" class="btn btn-outline-success waves-effect waves-light"
                            data-toggle="modal" data-target=".bs-example-modal-lg">Add Driver</button>
                    </div>
                </div>

                <div class="col-sm-2">
                    <div class="float-right d-none d-md-block">

                        {{-- form (search driver) --}}
                        <form class="app-search" action="{{ route('admin.searchdrivermain') }}" method="post">
                        
                            {{-- method fields --}}
                            @method('POST')
                            @csrf

                            <input name="searchinput" type="text" class="form-control" placeholder="Driver Name">
                            <span class="fa fa-search"></span>
                        </form>
                        {{-- end of form --}}


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


                @foreach ($drivers as $driver)
                    

                {{-- first card (repeat) --}}
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">

                            {{-- row --}}
                            <div class="row text-center">

                                {{-- image --}}
                                <div class="col-12">
                                    <img class="m-3 rounded-circle avatar-md" style="object-fit: cover; object-position: center" src="{{ asset('assets/img/drivers/profiles/'.$driver->pic) }}"
                                        alt="Generic placeholder image">
                                </div>


                                <div class="col-12">
                                    <div class="media-body">

                                        {{-- name - email --}}
                                        <h5 class="font-size-16 mb-1">{{ $driver->name }}</h5>
                                        <p class="text-muted mb-0">{{ $driver->email }}</p>

                                        {{-- driver label --}}
                                        <p class="text-muted font-size-14 font-weight-medium font-secondary mb-0">Driver</p>


                                        {{-- status --}}
                                        <p class="font-weight-small font-secondary">

                                           

                                            @if ($driver->onlinestatus == "offline")
                                                <p> <i class="mdi mdi-checkbox-blank-circle text-danger"></i> Offline</p>
                                            @else
                                                <p> <i class="mdi mdi-checkbox-blank-circle text-success"></i> Online</p>
                                            @endif
                                            
                                        </p>

                                    </div>
                                </div>
                                {{-- end col --}}
                            </div>
                            {{-- end row --}}




                            {{-- row --}}
                            <div class="row text-center mt-4">

                                {{-- delivered --}}
                                <div class="col-4">
                                    <h5 class="mb-0">{{ $driver->deliveredorders->count() }}</h5>
                                    <p class="text-muted font-size-14">Delivered</p>
                                </div>


                                {{-- type + shift --}}
                                <div class="col-4">
                                    <h6 class="text-muted font-size-14">
                                        <span class="badge badge-primary mb-2 ">{{ ucwords($driver->type) }}</span>
                                        <span class="badge badge-light">{{ ucwords($driver->shift) }}</span>
                                    </h6>
                                </div>

                                {{-- canceled orders --}}
                                <div class="col-4">
                                    <h5 class="mb-0">{{ $driver->canceledorders->count() }}</h5>
                                    <p class="text-muted font-size-14">Canceled</p>
                                </div>
                            </div>



                            {{-- social links --}}
                            <ul class="social-links text-center list-inline mb-0 mt-3">


                                <li class="list-inline-item">
                                    <button style="box-shadow:none !important; font-size:13px; padding:0px 8px; padding-bottom:2px;" title="" id="customer-assign-id" type="button" data-placement="top" class="tooltips btn btn-none customer-assign-id" data-target=".delete-partner" data-toggle="modal" value="{{ $driver->id }}"
                                        data-original-title="Delete"><i class="fas fa-trash-alt text-danger"></i></button>
                                </li>




                                <li class="list-inline-item">
                                    <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href=""
                                        data-original-title="{{ $driver->phone }}">
                                        <i class="fab fa-whatsapp"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href=""
                                        data-original-title="{{ $driver->phone }}"><i class="fas fa-phone"></i></a>
                                </li>

                            </ul>

                        </div>
                    </div>
                </div>
                {{-- end of first card (repeat) --}}

                @endforeach
                {{-- endforeach --}}



                <div class="col-12">
                    {{-- paginations --}}
                    <div class="pagination mt-4">
                        
                        @if($drivers instanceof \Illuminate\Pagination\LengthAwarePaginator )
                        
                        {{$drivers->links()}}
                        
                        @endif
                     
                    </div>
                </div>

            </div>
            <!-- end row -->


            

        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    <footer class="footer">
        <div class="container-fluid">
            <div class="row">

            </div>
        </div>
    </footer>
</div>

</div>
<!-- END layout-wrapper -->


{{-- endcontent --}}








{{-- modal --}}

{{-- new driver modal --}}
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Add New Driver</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                {{-- form (add new driver) --}}
                <form action="{{ route('admin.adddriver') }}" method="post" enctype="multipart/form-data">
                
                    {{-- method fields --}}
                    @method('POST')
                    @csrf


                    {{-- row --}}
                    <div class="row">


                        <div class="col-12">
                            <div class="form-group row">

                                <div class="col-sm-4">
                                    <label>Name</label>
                                    <input required="" name="name" class="form-control" type="text" >
                                </div>

                                <div class="col-sm-4">
                                    <label>Phone</label>
                                    <input required="" name="phone" class="form-control" type="text">
                                </div>

                                <div class="col-sm-4">
                                    <label>Picture</label>
                                    <input required="" name="pic" class="form-control" type="file">
                                </div>



                            </div>

                        </div>

                        <div class="col-12">
                            <div class="form-group row">

                                <div class="col-sm-4">
                                    <label>Email</label>
                                    <input required="" name="email" class="form-control" type="text" >
                                </div>

                                <div class="col-sm-4">
                                    <label>Password</label>
                                    <input required="" name="password" class="form-control" type="password">
                                </div>

                                <div class="col-sm-4">
                                    <label>Driver License</label>
                                    <input required="" name="license" class="form-control" type="text" >
                                </div>
                              


                            </div>

                        </div>


                        <div class="col-12">
                            <div class="form-group row">

                                
                                <div class="col-sm-4">
                                    <label>License Picture</label>
                                    <input required="" name="licpic" class="form-control" type="file">
                                </div>
                                
                                <div class="col-sm-4">
                                    <label>Shift</label>
                                    <select name="shift" required="" class="custom-select">
                                        <option value="morning shift" selected="">Morning Shift</option>
                                        <option value="night shift">Night Shift</option>
                                    </select>
                                </div>



                                <div class="col-sm-4">
                                    <label>Type</label>
                                    <select name="type" required="" class="custom-select">
                                        <option value="driver" selected="">Driver</option>
                                        <option value="collector">Collector</option>
                                    </select>
                                </div>

                               

                            </div>

                        </div>



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
                               
                                    <select id="districtselect" required="" name="districts[]" class="custom-select districtselectforadding" multiple>
                                        

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
                                <div class="col-12">
                                    <label>More info.</label>
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






{{-- edit driver modal --}}
<div class="modal fade edit-driver" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Edit driver</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">


                    <div class="col-12">
                        <div class="form-group row">

                            <div class="col-sm-4">
                                <label>Name</label>
                                <input class="form-control" type="text" >
                            </div>

                            <div class="col-sm-4">
                                <label>Phone</label>
                                <input class="form-control" type="text" >
                            </div>

                            <div class="col-sm-4">
                                <label>Picture</label>
                                <input class="form-control" type="file" >
                            </div>



                        </div>

                    </div>


                    <div class="col-12">
                        <div class="form-group row">

                            <div class="col-sm-4">
                                <label>Plate number</label>
                                <input class="form-control" type="text" >
                            </div>

                            <div class="col-sm-4">
                                <label>Driver licence</label>
                                <input class="form-control" type="text" >
                            </div>

                            <div class="col-sm-4">
                                <label>Car picture</label>
                                <input class="form-control" type="file" >
                            </div>



                        </div>

                    </div>
                    <div class="col-12">
                        <div class="form-group row">

                            <div class="col-sm-4">
                                <label>Emarite ID</label>
                                <input class="form-control" type="text" >
                            </div>

                            <div class="col-sm-4">
                                <label>Area</label>
                                <input class="form-control" type="text" >
                            </div>

                            <div class="col-sm-4">
                                <label>Shift</label>
                                <select class="custom-select">
                                    <option selected="">Morning shift</option>
                                    <option value="1">Evening shift</option>
                                    <option value="1">Weekend shift</option>
                                </select>
                            </div>
                        </div>



                    </div>


                    <div class="col-12">
                        <div class="form-group row">
                            <div class="col-12">
                                <label>More info.</label>
                                <textarea id="textarea" class="form-control" maxlength="225" rows="3"
                                    placeholder="This textarea has a limit of 225 chars."></textarea>
                            </div>
                        </div>
                    </div>



                    <div class="col-12 text-center">
                        <button class="btn btn-outline-success mr-1 font-15">UPDATE</button>
                    </div>


                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->














{{-- delete partner modal --}}
<div class="modal fade delete-partner" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title mt-0 font-weight-bold" id="myLargeModalLabel">Delete Driver ? </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                {{-- form (search partner) --}}
                <form action="{{ route('admin.deletedriver') }}" method="post">

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





@endsection