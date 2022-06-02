@extends('layouts.admin')

@section('content')

{{-- continue header --}}
<!-- start page title -->
<div class="page-title-box">
    <div class="container-fluid">
        <div class="page-title-content">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4>Roles & Permissons</h4>
                </div>

                <div class="col-sm-6">
                    <div class="float-right">
                        <button type="button" class="btn btn-outline-success waves-effect waves-light"
                            data-toggle="modal" data-target=".add-role">Add Role</button>
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



                



                {{-- add roles --}}
                <div class="col-lg-12 px-0">
                    
                    <div class="col-lg-12">
                        <div class="card client-card">                               
                            <div class="card-body text-center" >

                                <form action="{{ route('admin.add.user.role') }} " method="post">
                                    @csrf

                                <div class="row form-row">

                                    <div class="col-4 pl-0">
                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-sm-4 col-form-label text-center px-0" id="emp-name">Employee</label>
                                            <div class="col-sm-8">
                                                <select class="custom-select" name="user_id">
                                                    @foreach ($users as $user)
                                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                            
                                                
                                    </div>

                                    <div class="col-4 ">
                                        <div class="form-group row">
                                        <label for="example-text-input" class="col-sm-4 col-form-label text-center px-0" id="emp-role">Role</label>
                                        <div class="col-sm-8">
                                            <select required="" class="custom-select" name="role_id">
                                            @foreach ($roles as $role)
                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                        
                                </div>
                                {{-- end row --}}

                                <div class="col-3  text-left">
                                    <button class="btn btn-outline-success waves-effect waves-light mx-3" id="add-permission">Assign</button>
                                </div>


                                </form>

                            </div>

                        </div>
                    </div>      
                
                </div>
            </div>
                {{-- end add new role --}}




                



                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-body">

                  
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0 table-centered">
                                    <thead>
                                    <tr>
                                
                                        <th id="th1-1">Employee Name</th>
                                        <th id="th1-2">Role</th>
                                    
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users_roles as $userrole)
                                    <tr>
                                        <td>{{$userrole->user->name}}</td>
                                        <td>{{$userrole->role->name}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                </table><!--end /table-->
                            </div><!--end /tableresponsive-->
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div>
                {{-- end col --}}

                



                {{-- delete roles --}}
                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-body">
                
                
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0 table-centered">
                                    <thead>
                                        <tr>
                
                                            <th id="th-1">Role</th>
                
                                            <th id="th-2" class="text-left">Delete</th>
                
                
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($roles as $role)
                                        <tr>
                                            <td> {{$role->name}} </td>
                
                                            <td class="text-left">
                                                <a href="{{url('admin/hr/delete-role/'.$role->id)}}" class="ml-3"><i
                                                        class="fas fa-trash text-danger font-16"></i></a>
                                            </td>
                
                
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!--end /table-->
                            </div>
                            <!--end /tableresponsive-->
                        </div>
                        <!--end card-body-->
                    </div>
                    <!--end card-->
                </div> <!-- end col -->



            </div>
        </div>
    </div>
</div>




{{-- modal --}}
<div class="modal fade add-role" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                
                <button type="button" class="close float-left" data-dismiss="modal" aria-hidden="true">×</button>
                
            </div>
            <div class="modal-body">
                <form action= "{{ route('admin.add.role') }} " method="post">
                    @csrf
              <div class="row">
                
                <div class="col-12 mt-2"> 

                    
                    <div class="row mb-4">
                        <div class="col-sm-4">
                            <label id="add-perm-title">Role Name</label>
                            <input class="form-control" name="role_name" type="text" id="example-text-input" required="">
                        </div>
                    </div>
                    
                    
                


              <div class="table-responsive">
                <table class="table table-bordered mb-0 table-centered">
                    <thead>
                    <tr>

                        <th id="add-perm-module">Module</th>
                        <th id="add-perm-view">Access</th>

                  </tr>
                    </thead>
                    <tbody>
                    <tr>
                       
                        <td id="add-perm-home">Dashboard</td>
                        <td> 
                        <div class="custom-control custom-switch switch-success">
                        <input type="checkbox" class="custom-control-input" value="1" name="1" id="1">
                        <label class="custom-control-label text-muted" for="1"></label>
                    </div> 
                        </td>
                       
                      
                    </tr>

                    <tr>
                        <td id="add-perm-client">Partners</td>
                        <td> 
                        <div class="custom-control custom-switch switch-success">
                        <input type="checkbox" class="custom-control-input" value="1" name="2" id="2">
                        <label class="custom-control-label text-muted" for="2"></label>
                    </div> 
                        </td>
                  
  
                      
                      
                    </tr>

                    <tr>
                        <td id="add-perm-search">Drivers</td>
                        <td> 
                        <div class="custom-control custom-switch switch-success">
                        <input type="checkbox" class="custom-control-input" value="1" name="3" id="3">
                        <label class="custom-control-label text-muted" for="3"></label>
                    </div> 
                        </td>
  
                      
                    </tr>

                    <tr>
                         
                        <td id="add-perm-cm">Customers</td>
                        <td> 
                        <div class="custom-control custom-switch switch-success">
                        <input type="checkbox" class="custom-control-input" value="1" name="4" id="4">
                        <label class="custom-control-label text-muted" for="4"></label>
                    </div> 
                        </td>
  
                      
                    </tr>
                    <tr>
                         
                        <td id="add-perm-tasks">Operations</td>
                        <td> 
                        <div class="custom-control custom-switch switch-success">
                        <input type="checkbox" class="custom-control-input" value="1" name="5" id="5">
                        <label class="custom-control-label text-muted" for="5"></label>
                    </div> 
                        </td>
  
                      
                    </tr>
                    <tr>
                         
                        <td id="add-perm-reports">Assets</td>
                        <td> 
                        <div class="custom-control custom-switch switch-success">
                        <input type="checkbox" class="custom-control-input" value="1" name="6" id="6">
                        <label class="custom-control-label text-muted" for="6"></label>
                    </div> 
                        </td>
  
                      
                    </tr>
                   
                    <tr>
                         
                        <td id="add-perm-chats">HR</td>
                        <td> 
                        <div class="custom-control custom-switch switch-success">
                        <input type="checkbox" class="custom-control-input" value="1" name="7" id="7">
                        <label class="custom-control-label text-muted" for="7"></label>
                    </div> 
                        </td>
  
                      
                    </tr>
                    <tr>
                         
                        <td id="add-perm-hr">Reports</td>
                        <td> 
                        <div class="custom-control custom-switch switch-success">
                        <input type="checkbox" class="custom-control-input" value="1" name="8" id="8">
                        <label class="custom-control-label text-muted" for="8"></label>
                    </div> 
                        </td>
  
                      
                    </tr>

                    <tr>
                         
                        <td id="add-perm-settings"> Settings</td>
                        <td> 
                        <div class="custom-control custom-switch switch-success">
                        <input type="checkbox" class="custom-control-input" value="1" name="9" id="9">
                        <label class="custom-control-label text-muted" for="9"></label>
                    </div> 
                        </td>
  
                      
                    </tr>
                    
                    </tbody>
                </table><!--end /table-->
            </div><!--end /tableresponsive-->

            </div>

                 <div class="col-12 mt-2"> 
                       
                        <button class="btn btn-outline-success waves-effect waves-light mt-3" id="add-perm-btn1">Add Permission</button>

                     </div> 

                     
                  

                     </div> 
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal --> 
@endsection