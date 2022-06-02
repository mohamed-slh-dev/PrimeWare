@extends('layouts.admin')

@section('content')


    

{{-- continue header --}}
<!-- start page title -->
<div class="page-title-box">
    <div class="container-fluid">
        <div class="page-title-content">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4>Employees</h4>
                </div>

                <div class="col-sm-6">
                    <div class="float-right">
                        <button type="button" class="btn btn-outline-success waves-effect waves-light"
                            data-toggle="modal" data-target=".add-emp">Add Employee</button>
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

                {{-- col --}}
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">All Employees</h4>
                            <p class="card-title-desc">Review all employees info.</p>

                            <div class="table-responsive">
                                <table class="table mb-0">

                                    <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>E-mail</th>
                                            <th>Department</th>
                                          <th>Reset Password</th>
                                        </tr>
                                    </thead>


                                    <tbody>

                                      
                                        @foreach ($users as $user)
                                            
                                        {{-- table row --}}
                                        <tr>
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->phone}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->department->name}}</td>
                                        <td class="text-left">
                                            <a class="ml-2" data-toggle="modal" data-animation="bounce" data-target=".edit-{{$user->id}}">
                                                <i class="fas fa-edit text-info text-muted font-18" style="cursor: pointer;"></i>
                                            </a>                       
                                      </td>
                                        </tr>
                                        @endforeach
                                        {{-- end foreach --}}
                                        
                                
                                    </tbody>
                                    {{-- end tbody --}}
                                </table>
                            </div>
                            {{-- end table wrapper --}}



                            {{-- pagination --}}
                            <div class="col-12">
                                {{-- paginations --}}
                                <div class="pagination mt-4">
                                  
                                </div>
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

@foreach ($users as $user)
    
<div class="modal fade edit-{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style=" display: block; ">
                
                <button type="button" class="close float-left" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form class="form"  method="POST" action="{{route('admin.update.password')}}">
                    @csrf
                    <input type="hidden" name="user_id" value="{{$user->id}}">
              <div class="row">
                   <div class="col-12"> 
                      <div class="form-group row">
                               
                        
                                 <div class="col-sm-6">
                                  <label for="noe_date" id="pass-label"> New Password</label>
                                   <input type="password" name="new_pass" class="form-control" id="">
                                </div>
                            </div>
                         </div>

                        <div class="col-12 mt-3">
                                <button class="btn btn-outline-success waves-effect waves-light" id="update-btn">Update</button>
                            </div> 
                  

                     </div>
                </form> 
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal --> 
@endforeach  

<div class="modal fade add-emp" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style=" display: block; ">
                
                <button type="button" class="close float-left" data-dismiss="modal" aria-hidden="true">×</button>
                
            </div>
            <div class="modal-body">
                <form novalidate action= "{{ route('admin.add.employee') }} " method="post">
                    @csrf
                    <div class="row">
                    
            
                    <div class="col-12"> 
                        <div class="form-group row">
                                 
                                  <div class="col-sm-4">
                                     <label id="name">Name</label>
                                      <input class="form-control" name="name" type="text" id="example-text-input">
                                  </div>

                                   <div class="col-sm-4">
                                     <label id="phone">Phone</label>
                                      <input class="form-control" name="phone"  type="text" id="example-text-input">
                                  </div>
                                  <div class="col-sm-4">
                                      <label id="dept-name">Department</label>
                                      <select class="custom-select" name="dept_id">
                                      @foreach ($departments as $dept)
                                      <option value="{{$dept->id}} "> {{$dept->name}}</option>  
                                      @endforeach
                                      </select>
                                  </div>
                               

                         </div>
            
                   </div>
                     <div class="col-12"> 
                      <div class="form-group row">
                                 
                                  <div class="col-sm-4">
                                     <label id="email">E-mail</label>
                                      <input class="form-control" name="email" type="email" id="example-text-input">
                                  </div>

                                   <div class="col-sm-4">
                                     <label id="pass">Password</label>
                                      <input class="form-control" name="password"  type="password" id="example-text-input">
                                  </div>
                                  <div class="col-sm-4">
                                      <label id="role">Role</label>
                                  <select class="custom-select" name="role_id">
                                      @foreach ($roles as $role)
                                      <option value=" {{$role->id}} "> {{$role->name}}</option>
                                      @endforeach
                                     </select>
                                  </div>
                               

                         </div>
            
                   </div>

                       <div class="col-12 mt-3"> 
                        <button class="btn btn-outline-success waves-effect waves-light" id="add-btn">Add Employee</button>
                       </div> 
                    

                       </div> 
                </form> 
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal --> 

@endsection