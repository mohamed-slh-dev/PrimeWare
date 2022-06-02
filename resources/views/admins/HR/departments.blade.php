@extends('layouts.admin')

@section('content')


    

{{-- continue header --}}
<!-- start page title -->
<div class="page-title-box">
    <div class="container-fluid">
        <div class="page-title-content">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4>Departments</h4>
                </div>

                <div class="col-sm-6">
                    <div class="float-right">
                        <button type="button" class="btn btn-outline-success waves-effect waves-light"
                            data-toggle="modal" data-target=".add-dept">Add Department</button>
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
                            <h4 class="card-title mb-3">Manage Departments</h4>

                            <div class="table-responsive">
                                <table class="table mb-0">

                                    <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Delete</th>      
                                        </tr>
                                    </thead>


                                    <tbody>

                                      
                                        @foreach ($departments as $dept)
                                            
                                        {{-- table row --}}
                                        <tr>
                                        <td>{{$dept->id}}</td>
                                        <td>{{$dept->name}}</td>
                                        <td class="text-left">
                                            <a href="{{url('admin/delete-department/'.$dept->id)}}" class="ml-3"><i class="fas fa-trash text-danger font-16"></i></a>
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

<div class="modal fade add-dept" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style=" display: block; ">
                
                <button type="button" class="close float-left" data-dismiss="modal" aria-hidden="true">×</button>
                
            </div>
            <div class="modal-body">
                <form novalidate action= "{{ route('add.department') }} " method="post">
                    @csrf
              <div class="row">
                   <div class="col-12"> 
                      <div class="form-group row">
                               
                         
                                 <div class="col-sm-6">
                                  <label>Daprtment Name</label>
                                    <input class="form-control" name="dept_name" type="text" required="">
                                </div>
                            </div>
                         </div>

               <div class="col-12 mt-3">
                    <button type="submit" class="btn btn-outline-success waves-effect waves-light">Add Department</button>
                 </div> 
                  

                     </div>
                </form> 
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal --> 

@endsection