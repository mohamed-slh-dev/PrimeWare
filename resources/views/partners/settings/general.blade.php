@extends('layouts.partner')


@section('content')


{{-- header --}}
<!-- start page title -->
<div class="page-title-box">
    <div class="container-fluid">
        <div class="page-title-content">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4>General Settings</h4>
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


            <form action="{{ route('partner.updategeneral') }}" method="post" enctype="multipart/form-data">
            
                {{-- method fields --}}
                @method('POST')
                @csrf

                {{-- form row --}}
                <div class="row mt-5">

                    <div class="col-lg-12 mt-5">
                        <div class="form-group row">

                            {{-- restaurant name --}}
                            <div class="col-4">
                                <label for="example-text-input" class="col-sm-6 col-form-label">Restaurant Name</label>
                                <div class="col-sm-10">
                                    <input name="name" required="" class="form-control" type="text"  id="example-text-input" value="{{ $partner->name }}">
                                </div>
                            </div>


                            {{-- email --}}
                            <div class="col-4">
                                <label for="example-text-input" class="col-sm-6 col-form-label ">E-mail</label>
                                <div class="col-sm-10">
                                    <input name="email" required="" class="form-control" type="email" id="example-text-input" value="{{ $partner->email }}">
                                </div>
                            </div>

                            {{-- contact --}}
                            <div class="col-4">
                                <label for="example-text-input" class="col-sm-6 col-form-label ">Phone</label>
                                <div class="col-sm-10">
                                    <input name="phone" required="" class="form-control" type="text" id="example-text-input" value="{{ $partner->phone }}">
                                </div>
                            </div>


                            {{-- address --}}
                            <div class="col-4 mt-3">
                                <label for="example-text-input" class="col-sm-6 col-form-label">Address</label>
                                <div class="col-sm-10">
                                    <input name="address" required="" class="form-control" type="text" id="example-text-input" value="{{ $partner->address }}">
                                </div>
                            </div>



                            {{-- location link --}}
                            <div class="col-4 mt-3">
                                <label for="example-text-input" class="col-sm-6 col-form-label">Location Link</label>
                                <div class="col-sm-10">
                                    <input required="" name="locationlink" class="form-control" type="text" id="example-text-input" value="{{ ltrim($partner->locationlink, '@') }}">
                                </div>
                            </div>




                            {{-- city --}}
                            <div class="col-4 mt-3">
                                <label for="example-text-input" class="col-sm-6 col-form-label">City</label>
                                <div class="col-sm-10">

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
                            </div>




                            {{-- district --}}
                            <div class="col-4 mt-3">
                                <label for="example-text-input" class="col-sm-6 col-form-label">District</label>
                                <div class="col-sm-10">

                                    <select id="districtselect" required="" name="district" class="custom-select">
                                    
                                        @foreach ($districts as $district)
                                    
                                        {{-- chosen district --}}
                                        @if ($partner->district_id == $district->id)
                                        <option class="all-districts city-{{ $district->samedistrict->city_id }}" value="{{ $district->id }}" selected="">
                                            {{ $district->name }}</option>
                                    
                                        {{-- same district within chosen city --}}
                                        @elseif ($partner->city_id == $district->samedistrict->city_id)
                                    
                                        <option class="all-districts city-{{ $district->samedistrict->city_id }}" value="{{ $district->id }}">
                                            {{ $district->name }}</option>
                                    
                                        {{-- other districts --}}
                                        @else
                                        <option class="d-none all-districts city-{{ $district->samedistrict->city_id }}" value="{{ $district->id }}">
                                            {{ $district->name }}</option>
                                    
                                        @endif
                                    
                                        @endforeach
                                    
                                    </select>
                                    
                                </div>
                            </div>


                            {{-- password --}}
                            <div class="col-4 mt-3">
                                <label for="example-text-input" class="col-sm-6 col-form-label">New password</label>
                                <div class="col-sm-10">
                                    <input name="password" class="form-control" type="password" id="example-text-input">
                                </div>
                            </div>

                        </div>
                    </div>


                    {{-- logo input --}}
                    <div class="col-lg-12">
                        <div class="form-group row">

                            <div class="col-6">
                                <label for="example-text-input" class="col-sm-6 col-form-label ">Logo</label><br>

                                <div class="col-sm-10">
                                    <input name="logo" class="form-control" type="file" id="logo">
                                </div>

                            </div>

                        </div>
                    </div>


                    {{-- submit --}}
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-outline-success ml-3 font-15 my-3">Update Info</button>
                    </div>

                </div>
                {{-- end row form --}}
            </form>
            {{-- end form --}}



        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    <footer class="footer">

    </footer>
</div>
<!-- end main content-->



{{-- end content --}}



@endsection