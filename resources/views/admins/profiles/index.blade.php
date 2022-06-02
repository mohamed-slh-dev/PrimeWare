@extends('layouts.admin')


@section('content')



{{-- header --}}
<!-- start page title -->
<div class="page-title-box">
    <div class="container-fluid">
        <div class="page-title-content">
            <div class="row align-items-center">

                <div class="col-sm-6">
                    <h4>Profile Settings</h4>
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


            <form action="{{ route('admin.updateprofile') }}" method="post" enctype="multipart/form-data">

                {{-- method fields --}}
                @method('POST')
                @csrf

                {{-- form row --}}
                <div class="row mt-5">

                    <div class="col-lg-12 mt-5">
                        <div class="form-group row">

                            {{-- restaurant name --}}
                            <div class="col-4">
                                <label for="example-text-input" class="col-sm-6 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input name="name" required="" class="form-control" type="text"
                                        id="example-text-input" value="{{ $user->name }}">
                                </div>
                            </div>


                            {{-- email --}}
                            <div class="col-4">
                                <label for="example-text-input" class="col-sm-6 col-form-label ">E-mail</label>
                                <div class="col-sm-10">
                                    <input name="email" required="" class="form-control" type="email"
                                        id="example-text-input" value="{{ $user->email }}">
                                </div>
                            </div>

                            {{-- contact --}}
                            <div class="col-4">
                                <label for="example-text-input" class="col-sm-6 col-form-label ">Phone</label>
                                <div class="col-sm-10">
                                    <input name="phone" required="" class="form-control" type="text"
                                        id="example-text-input" value="{{ $user->phone }}">
                                </div>
                            </div>


                            {{-- contact --}}
                            <div class="col-4 mt-3">
                                <label for="example-text-input" class="col-sm-6 col-form-label ">New Password</label>
                                <div class="col-sm-10">
                                    <input name="password" class="form-control" type="password" placeholder="" minlength="4">
                                </div>
                            </div>


                            {{-- profile pic --}}
                            <div class="col-4 mt-3">
                                <label for="example-text-input" class="col-sm-6 col-form-label ">Avatar</label>
                                <div class="col-sm-10">
                                    <input name="avatar" class="form-control" type="file" id="example-text-input">
                                </div>
                            </div>



                            {{-- department --}}
                            {{-- <div class="col-4">
                                <label for="example-text-input" class="col-sm-6 col-form-label ">Department</label>
                                <div class="col-sm-10">
                                    <select required="" class="custom-select" name="departmentid">
                                        @foreach ($departments as $department)

                                            @if ($department->id == $user->department_id)
                                                <option value="{{$department->id}}" selected="">{{$department->name}}</option>
                                            @else
                                                <option value="{{$department->id}}">{{$department->name}}</option>
                                            @endif
                                            
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}







                            {{-- role --}}
                            {{-- <div class="col-4">
                                <label for="example-text-input" class="col-sm-6 col-form-label ">Role</label>
                                <div class="col-sm-10">
                                    <select class="custom-select" name="roleid">

                                        <option value=""></option>

                                        @foreach ($roles as $role)

                                            @if (!empty($user->role->role_id) && $role->id == $user->role->role_id)
                                                <option value="{{$role->id}}" selected="">{{$role->name}}</option>
                                            @else
                                                <option value="{{$role->id}}">{{$role->name}}</option>
                                            @endif
                                            
                                        @endforeach

                                        
                                    </select>
                                </div>
                            </div> --}}

                        </div>
                    </div>
                    {{-- end row  + col --}}




                    {{-- submit --}}
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-outline-success ml-2 font-15 my-3">Update Info</button>
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