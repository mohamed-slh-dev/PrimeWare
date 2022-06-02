@extends('layouts.admin')


@section('content')



{{-- continue header --}}
<!-- start page title -->
<div class="page-title-box">
    <div class="container-fluid">
        <div class="page-title-content">
            <div class="row align-items-center">
                <div class="col-sm-8">
                    <h4>Assets</h4>
                </div>

                <div class="col-sm-2">
                    <div class="float-right">
                        <button type="button" class="btn btn-outline-success waves-effect waves-light"
                            data-toggle="modal" data-target=".bs-example-modal-lg">Add Asset</button>
                    </div>
                </div>

                <div class="col-sm-2">
                    <div class="float-right d-none d-md-block">

                        {{-- form (search asset) --}}
                        <form class="app-search" action="{{ route('admin.searchassets') }}" method="post">
                        
                            {{-- method fields --}}
                            @method('POST')
                            @csrf

                            <input name="searchinput" type="text" class="form-control" placeholder="Asset Name">
                            <span class="fa fa-search"></span>
                        </form>

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


            @foreach ($assets as $asset)
                

            {{-- asset row (repeat) --}}
            <div class="row">

                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <a class="d-lg-flex justify-content-between">
                                
                                
                                <div class="media mb-3 mb-lg-0" style="width: 320px">

                                    {{-- car pic --}}
                                    <img src="{{ asset('assets/img/assets/'.$asset->pic) }}" class="mr-3 thumb-md align-self-center" width="270" height="200" alt="..." style="object-fit: cover; width:55%;">

                                    {{-- asset name and id --}}
                                    <div class="media-body align-self-center">
                                        <h5 class="mt-0 mb-1">{{ $asset->name }} #{{ $asset->id }}</h5>

                                        {{-- driver  --}}
                                        <p class="text-muted mb-0 mt-1">
                                            <i class="dripicons-user-id  mr-2 text-info"></i>
                                            {{ (!empty($asset->driver->name) ? $asset->driver->name : "-") }}
                                        </p>


                                        {{-- edit or delete --}}
                                        <div class="d-block text-muted mb-0 mt-1">

                                            {{-- edit  --}}
                                            <form method="post" action="{{ route('admin.editassets') }}" class="d-inline-block text-left">

                                                @csrf
                                                @method('POST')

                                                {{-- asset id --}}
                                                <input type="hidden" name="assetid" value="{{ $asset->id }}">


                                                <button type="submit" class="btn btn-none shadow-none text-primary d-inline-block text-left p-0 mr-3">
                                                    <i class="fas fa-edit"></i>
                                                </button>

                                            </form>

                                            
                                            {{-- delete --}}
                                            <form method="post" action="{{ route('admin.deleteassets') }}" class="d-inline-block">
                                            
                                                @csrf
                                                @method('POST')
                                                
                                                {{-- asset id --}}
                                                <input type="hidden" name="assetid" value="{{ $asset->id }}">


                                                <button type="submit" class="btn btn-none shadow-none text-danger d-inline-block p-0">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            
                                            </form> 
                                            
                                        </div>


                                    </div>
                                    <!--end media body-->
                                </div>
                                <!--end media-->

                                {{-- info --}}
                                <p class="text-muted mb-2 mb-lg-0 align-self-center"><i
                                        class="fas fa-info mr-2 text-info font-14"></i>{{ (!empty($asset->info) ? $asset->info : "No Info Added") }}</p>

                                
                                {{-- status --}}
                                <p class="text-muted mb-2 mb-lg-0 align-self-center"><i
                                        class="fas fa-link mr-2 text-dark font-14"></i>{{ ucwords($asset->status) }}</p>

                            </a>

                        </div>
                        <!--end card-body-->
                    </div>
                    <!--end card-->
                </div>
                {{-- end col --}}


            </div>
            {{-- end row --}}


            @endforeach
            {{-- end foreach --}}


            <div class="row">
                <div class="col-12">
                    {{-- paginations --}}
                    <div class="pagination mt-4">

                        @if($assets instanceof \Illuminate\Pagination\LengthAwarePaginator )
                        
                        {{$assets->links()}}
                        
                        @endif
                      
                        
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

</div>
<!-- end main content-->


{{-- end content --}}







{{-- modal --}}
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            {{-- modal header --}}
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Add New Asset</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            {{-- modal body --}}
            <div class="modal-body">

                {{-- form (add new asset) --}}
                <form action="{{ route('admin.addasset') }}" method="post" enctype="multipart/form-data">
                
                    {{-- method fields --}}
                    @method('POST')
                    @csrf

                    {{-- form row --}}
                    <div class="row">


                        {{-- col --}}
                        <div class="col-12">
                            <div class="form-group row">

                                <div class="col-sm-4">
                                    <label>Asset Name</label>
                                    <input required="" name="name" class="form-control" type="text">
                                </div>

                                <div class="col-sm-4">
                                    <label>Model</label>
                                    <input name="model" class="form-control" type="text">
                                </div>

                                <div class="col-sm-4">
                                    <label>Picture</label>
                                    <input required="" name="pic" class="form-control" type="file">
                                </div>

                            </div>
                        </div>
                        {{-- end col --}}
        
                        {{-- col --}}
                        <div class="col-12">
                            <div class="form-group row">

                                <div class="col-sm-4">
                                    <label>Plate Number</label>
                                    <input required="" name="serialnumber" class="form-control" type="text">
                                </div>


                                <div class="col-sm-4">
                                    <label>Status</label>
                                    <select required="" name="status" class="custom-select">
                                        <option selected="" value="assigned">Assigned</option>
                                        <option value="not assigned">Not Assigned</option>
                                    </select>
                                </div>


                                <div class="col-sm-4">
                                    <label>Driver</label>
                                    <select name="driver" class="custom-select">

                                        {{-- empty driver --}}
                                        <option value="" selected=""></option>

                                        @foreach ($drivers as $driver)
                                            <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                        @endforeach

                                    </select>
                                </div>

                            </div>
                        </div>
                        {{-- end col --}}


                        {{-- col --}}
                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label>More Information</label>
                                    <textarea name="info" id="textarea" class="form-control" maxlength="225" rows="3" placeholder="This textarea has a limit of 225 chars."></textarea>
                                </div>
                            </div>
                        </div>



                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-outline-success mr-1 font-15">ADD</button>
                        </div>


                    </div>
                    {{-- end form row --}}

                </form>
                {{-- end form --}}



            </div>
            {{-- end modal --}}
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


{{-- end modal --}}



@endsection