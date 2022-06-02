@extends('layouts.admin')


@section('content')



{{-- continue header --}}


<!-- start page title -->
<div class="page-title-box">
    <div class="container-fluid">
        <div class="page-title-content">

            {{-- row --}}
            <div class="row align-items-center">

                <div class="col-sm-6">
                    <h4>Manage Suppliers</h4>
                </div>

                <div class="col-sm-6">
                    <div class="float-right d-none d-md-block">

                        {{-- form (search supplier) --}}
                        <form class="app-search" action="" method="post">

                            {{-- method fields (was post)--}}
                            @method('GET')
                            @csrf

                            <input name="searchinput" type="text" class="form-control" placeholder="Supplier Name">
                            <span type="submit" class="fa fa-search"></span>

                        </form>

                    </div>
                </div>
            </div>
            {{-- end row --}}

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
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            {{-- <p class="card-title-desc">Manage all suppliers Info.</p> --}}

                            <div class="table-responsive">
                                <table class="table mb-0">

                                    <thead class="thead-light">
                                        <tr>
                                            <th>Supplier</th>
                                            <th>E-mail</th>
                                            <th>City</th>
                                            <th>District</th>
                                            <th>Contract Start Date</th>
                                            <th>Contract End Date</th>
                                            <th>Contract</th>
                                            <th>Info</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                      {{-- counter for ids --}}
                                      <?php $counter = 1; ?>
                                        
                                      {{-- foreach --}}
                                      @foreach ($suppliers as $supplier)

                                      <tr>
                                          <td>{{ $supplier->name }}</td>
                                          <td>{{ $supplier->portalemail }}</td>
                                          {{-- <td>{{ $supplier->type->name }}</td> --}}

                                          <td>{{ $supplier->city->name }}</td>

                                          <td class="text-success">
                                              <a class="text-success" href="https://www.google.com/maps/search/?api=1&query={{ ltrim($supplier->locationlink, '@') }}">{{ $supplier->district->name }}</a>
                                          </td>
                                          <td>{{ $supplier->startdate }}</td>
                                          <td>{{ $supplier->enddate }}</td>

                                          {{-- download contract --}}
                                          <td> 
                                              <a target="_blank" href="{{ asset('assets/img/suppliers/contracts/'.$supplier->contract) }}">Download</a>
                                          </td>

                                         
                                          <td>
                                            <a class="btn btn-none text-warning bg-grey py-0 px-2 cs-font-size-12 mr-1" data-toggle="modal" data-target=".supplier-{{$supplier->id}}">
                                            Edit
                                            </a>
                                          </td>

                                          {{-- edit --}}
                                          {{-- <td>
                                              {{-- form (add new supplier) --}}
                                              {{-- <form action="{{ route('admin.editothersupplier') }}" method="post" enctype="multipart/form-data"> --}}
                                              
                                                  {{-- method fields --}}
                                                  {{-- @method('POST')
                                                  @csrf

                                                  <button type="submit" class="custom-edit-button">
                                                      <i class="far fa-edit text-primary"></i>
                                                  </button>
                                                  
                                                  <input type="hidden" name="id" value="{{ $supplier->id }}">
                                              </form> --}}
                                          {{-- </td> --}}

                                      </tr>
                                      {{-- end of first cell (repeat) --}}

                                      {{-- increase counter --}}
                                      <?php $counter++; ?>
                                      
                                      @endforeach
                                      {{-- end foreach (repeat) --}}

                                    </tbody>
                                    {{-- end tbody --}}
                                </table>
                            </div>
                            {{-- end table + wrapper --}}

                            {{-- paginations --}}
                            <div class="pagination mt-3">
                                @if($suppliers instanceof \Illuminate\Pagination\LengthAwarePaginator )
                                
                                {{$suppliers->links()}}
                                
                                @endif
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



@foreach ($suppliers as $supplier)


{{-- add supplier modal --}}
<div class="modal fade supplier-{{$supplier->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Edit Supplier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                {{-- form (add new supplier) --}}
                <form action="{{ route('admin.updatesupplier') }}" method="post" enctype="multipart/form-data">

                    {{-- method fields --}}
                    @method('POST')
                    @csrf

                <input type="hidden" name="supplier_id" value="{{$supplier->id}}" id="">
                    {{-- row --}}
                    <div class="row">


                        <div class="col-12">
                            <div class="form-group row">

                                <div class="col-sm-4">
                                    <label>Name</label>
                                <input required="" value="{{$supplier->name}}" name="name" class="form-control" type="text">
                                </div>

                                <div class="col-sm-4">
                                    <label>Phone</label>
                                    <input required="" name="phone" value="{{$supplier->phone}}" class="form-control" type="text">
                                </div>

                                <div class="col-sm-4">
                                    <label>Logo</label>
                                    <input name="logo" class="form-control" type="file" id="logo-input">
                                </div>



                            </div>

                        </div>

                        <div class="col-12">
                            <div class="form-group row">

                                <div class="col-sm-4">
                                    <label>E-mail</label>
                                    <input required="" value="{{$supplier->email}}" name="email" class="form-control" type="email">
                                </div>
                             

                                     {{-- city --}}
                                     <div class="col-sm-4">
                                        <label>City</label>
                                        <select id="cityselect" required="" name="city" class="custom-select">
    
                                           
                                            @foreach ($cities as $city)
                                            @if ($supplier->city->id == $city->id)
                                        <option selected value="{{$city->id}}">{{$city->name}}</option>
                                                @else
                                                <option value="{{$city->id}}">{{$city->name}}</option>
                                            @endif
                                      
                                            @endforeach 
    
                                        </select>
                                    </div>
    
    
                                    {{-- district --}}
                                    <div class="col-sm-4">
                                        <label>District</label>
                                        <select id="districtselect" required="" name="district"
                                            class="custom-select districtselectforadding">
    
                                          
    
                                            @foreach ($districts as $district)
    
                                            @if ($supplier->district_id == $district->id)
                                    <option value="{{$district->id}}" selected=""> {{$district->name}} </option>
    
                                            @endif
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

                                <div class="col-sm-4">
                                    <label>Contract Doc.</label>
                                    <input name="contract" class="form-control" type="file"
                                        id="contract-input">
                                </div>
                                <div class="col-sm-4">
                                    <label>Start Date</label>
                                <input required="" value="{{$supplier->startdate}}" name="startdate" class="form-control" type="date"
                                        placeholder="YYYY-MM-DD">
                                </div>
                                <div class="col-sm-4">
                                    <label>End Date</label>
                                    <input required="" value="{{$supplier->enddate}}" name="enddate" class="form-control" type="date"
                                        placeholder="YYYY-MM-DD">
                                </div>


                            </div>

                        </div>


                        <div class="col-12">
                            <div class="form-group row">





                                {{-- address --}}
                                <div class="col-sm-4">
                                    <label>Address</label>
                                <input required="" value="{{$supplier->address}}" name="address" class="form-control" type="text">
                                </div>

                                {{-- location link --}}
                                <div class="col-sm-4">
                                    <label>Location Link</label>
                                    <input required="" value="{{$supplier->locationlink}}"
                                        name="locationlink" class="form-control" type="text">
                                </div>


                            </div>
                        </div>


                        {{-- more info (info) --}}
                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label>More info</label>
                                    <textarea name="info" id="textarea" class="form-control" maxlength="225" rows="3"
                                        placeholder="This textarea has a limit of 225 chars.">{{$supplier->info}}</textarea>
                                </div>
                            </div>
                        </div>



                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-outline-success mr-1 font-15">Update</button>
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

    
@endforeach


@endsection