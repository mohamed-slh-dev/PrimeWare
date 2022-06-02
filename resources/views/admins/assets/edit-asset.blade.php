@extends('layouts.admin')


@section('content')



{{-- continue header --}}
<!-- start page title -->
<div class="page-title-box">
    <div class="container-fluid">
        <div class="page-title-content">
            <div class="row align-items-center">


                <div class="col-sm-8">
                    <h4>Edit Asset</h4>
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
        <div class="container-fluid mt-5">


            {{-- form (add new asset) --}}
            <form action="{{ route('admin.updateassets') }}" method="post" enctype="multipart/form-data">
            
                {{-- method fields --}}
                @method('POST')
                @csrf


                {{-- asset id --}}
                <input type="hidden" name="assetid" value="{{ $asset->id }}">



                {{-- form row --}}
                <div class="row form-row pt-4">
            
            
                    {{-- col --}}
                    <div class="col-12">
                        <div class="form-group row">
            
                            <div class="col-sm-4">
                                <label>Asset Name</label>
                                <input required="" value="{{ $asset->name }}" name="name" class="form-control" type="text">
                            </div>
            
                            <div class="col-sm-4">
                                <label>Model</label>
                                <input name="model" value="{{ $asset->model }}" class="form-control" type="text">
                            </div>
            
                            <div class="col-sm-4">
                                <label>Picture</label>
                                <input name="pic" class="form-control" type="file">
                            </div>
            
                        </div>
                    </div>
                    {{-- end col --}}
            
                    {{-- col --}}
                    <div class="col-12">
                        <div class="form-group row">
            
                            <div class="col-sm-4">
                                <label>Plate Number</label>
                                <input required="" value="{{ $asset->serialnumber }}" name="serialnumber" class="form-control" type="text">
                            </div>
            
            
                            <div class="col-sm-4">
                                <label>Status</label>
                                <select required="" name="status" class="custom-select">

                                    @if ($asset->status == "assigned")
                                        <option selected="" value="assigned">Assigned</option>
                                        <option value="not assigned">Not Assigned</option>
                                    @else
                                        <option value="assigned">Assigned</option>
                                        <option selected="" value="not assigned">Not Assigned</option>
                                    @endif

                                    
                                </select>
                            </div>
            
            
                            <div class="col-sm-4">
                                <label>Driver</label>
                                <select name="driver" class="custom-select">
            
            
                                    @foreach ($drivers as $driver)

                                        @if ($asset->driver_id == $driver->id)
                                        <option selected="" value="{{ $driver->id }}">{{ $driver->name }}</option>

                                        @else
                                        <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                        @endif


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
                                <textarea name="info" id="textarea" class="form-control" maxlength="225" rows="3"
                                    placeholder="This textarea has a limit of 225 chars.">{{ $asset->info }}</textarea>
                            </div>
                        </div>
                    </div>
            
            
            
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-outline-success mr-1 font-15">UPDATE</button>
                    </div>
            
            
                </div>
                {{-- end form row --}}
            
            </form>
            {{-- end form --}}



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






@endsection