@extends('layouts.admin')


@section('content')



{{-- continue header --}}
<!-- start page title -->
<div class="page-title-box">
    <div class="container-fluid">
        <div class="page-title-content">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4>Restaurants Requests</h4>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end page title -->

</header>
{{-- end of header --}}








{{-- content --}}

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-title-desc">Review all restaurants requests</p>

                            <div class="table-responsive">
                                <table class="table mb-0">

                                    <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Restaurant Name</th>
                                            <th>Phone Number</th>
                                            <th>E-mail</th>
                                            <th>DateTime</th>
                                            <th>Status</th>
                                           
                                        </tr>
                                    </thead>

                                    {{-- tbody --}}
                                    <tbody>
                                        @foreach ($resturants as $rest)
                                        <tr>
                                            <td>{{$rest->id}}</td>
                                            <td>{{$rest->name}}</td>
                                            <td>{{$rest->phone}}</td>
                                            <td>{{$rest->email}}</td>
                                            <td>{{$rest->request_date}}</td>
                                            <td class="text-warning">Requested</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    {{-- end tbody --}}

                                </table>
                            </div>
                            {{-- end table wrapper --}}
                        </div>
                        {{-- end row --}}
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









@endsection