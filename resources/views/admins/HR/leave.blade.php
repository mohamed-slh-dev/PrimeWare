@extends('layouts.admin')

@section('content')


    

{{-- continue header --}}
<!-- start page title -->
<div class="page-title-box">
    <div class="container-fluid">
        <div class="page-title-content">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4>Leaves</h4>
                </div>

                <div class="col-sm-6">
                    <div class="float-right">
                        <button type="button" class="btn btn-outline-success waves-effect waves-light"
                            data-toggle="modal" data-target=".add-leave">Add Leave</button>
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
                            <p class="card-title-desc">Review all employee leaves</p>

                            <div class="table-responsive">
                                <table class="table mb-0">

                                    <thead class="thead-light">
                                        <tr>
                                            <th>Name</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Reason</th>
                                          <th>Status</th>
                                          <th>Delete</th>
                                        </tr>
                                    </thead>


                                    <tbody>

                                      
                                        @foreach ($leave as $leav)
                                            
                                        {{-- table row --}}
                                        <tr>
                                        <td>{{$leav->user->name}}</td>
                                        <td>{{$leav->datefrom}}</td>
                                        <td>{{$leav->dateto}}</td>
                                        <td>{{$leav->subject}}</td>
                                        <td>{{ ucwords($leav->status)}}</td>
                                         <td class="text-left">
                                        <a href="{{url('admin/hr/delete-leave/'.$leav->id)}}" class="ml-3"><i class="fas fa-trash text-danger font-16"></i></a>
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

<div class="modal fade add-leave" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style=" display: block; ">
                
                <button type="button" class="close float-left" data-dismiss="modal" aria-hidden="true">×</button>
                
            </div>
            <div class="modal-body">
                <form novalidate action= "{{ route('admin.add.leave') }} " method="post">
                    @csrf
                    <div class="row">
                       
               
                        <div class="col-12"> 
                            <div class="form-group row">
                                     
                                      <div class="col-sm-6">
                                         <label id="name">Employee Name</label>
                                         <select class="custom-select" name="user_id">
                                           @foreach ($users as $user)
                                           <option value="{{$user->id}}">{{$user->name}}</option>
                                           @endforeach
                                           </select>
                                      </div>


                                      <div class="col-sm-6">
                                        <label id="name">Status</label>
                                        <select class="custom-select" name="status">
                                            <option value="pending">Pendding</option>
                                            <option value="approved">Approved</option>
                                          </select>
                                     </div>

                                     
                                     
                             </div>
                
                       </div>
                         <div class="col-12"> 
                          <div class="form-group row">
                                     
                                      <div class="col-sm-6">
                                         <label id="from">Start Date</label>
                                          <input class="form-control" placeholder="YYYY-MM-DD" type="date" name="from" id="example-text-input">
                                      </div>

                                       <div class="col-sm-6">
                                         <label id="to">End Date</label>
                                          <input class="form-control" type="date" placeholder="YYYY-MM-DD" name="to" id="example-text-input">
                                      </div>
                                 
                                   

                             </div>
                
                       </div>
                        <div class="col-12"> 
                            <label for="noe_date" id="reason">Reason</label>
                         <textarea class="form-control" name="subject" rows="5" id="message"></textarea>
                           </div> 
                       
                           <div class="col-12 mt-3 text-left"> 
                            <button class="btn btn-outline-success waves-effect waves-light" id="add-btn">Add Leave</button>
                           </div> 
                        

                        </div> 
                </form> 
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal --> 

@endsection