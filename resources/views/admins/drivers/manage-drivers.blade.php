@extends('layouts.admin')


@section('content')



{{-- continue header --}}
<!-- start page title -->
<div class="page-title-box">
    <div class="container-fluid">
        <div class="page-title-content">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4>Manage Drivers</h4>
                </div>

                <div class="col-sm-6">
                    <div class="float-right d-none d-md-block">

                        {{-- form (search driver) --}}
                        <form class="app-search" action="{{ route('admin.searchdriver') }}" method="post">
                        
                            {{-- method fields --}}
                            @method('POST')
                            @csrf

                            <input name="searchinput" type="text" class="form-control" placeholder="Driver Name">
                            <span class="fa fa-search"></span>

                        </form>
                        {{-- end form --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end page title -->

</header>

{{-- endheader --}}







{{-- content --}}
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">

                {{-- col --}}
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-title-desc">Review all drivers info.</p>

                            <div class="table-responsive">
                                <table class="table mb-0">

                                    <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Service Area</th>
                                            <th>Phone Number</th>
                                            <th>Type</th>
                                            <th>Shift</th>
                                            <th>Status</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>


                                    <tbody>

                                        {{-- counter for table --}}
                                        <?php $counter = 1; ?>

                                        @foreach ($drivers as $driver)
                                            
                                        {{-- table row --}}
                                        <tr>
                                            <td scope="row">{{ $driver->id }}</td>
                                            <td>{{ $driver->name }}</td>

                                            {{-- districts --}}
                                            <td>

                                                {{-- inner counter --}}
                                                <?php $innercounter = 1; ?>

                                                @foreach ($driver->districts as $district)

                                                    @if ($innercounter == 1)
                                                    {{ $district->district->name }}

                                                    @else
                                                     - {{ $district->district->name }}

                                                    @endif

                                                    {{-- increase innercounter --}}
                                                    <?php $innercounter++; ?>

                                                @endforeach
                                                
                                            </td>

                                            <td>{{ $driver->phone }}</td>


                                            <td>
                                                <span class="badge badge-secondary">{{ ucwords($driver->type) }}</span>
                                            </td>
                                            <td> {{ ucwords($driver->shift) }}</td>

                                            @if ($driver->onlinestatus == "offline")
                                                <td><span class="badge badge-danger">{{ "Offline" }}</span></td>

                                            @elseif ($driver->onlinestatus == "online")
                                                <td><span class="badge badge-success">{{ "Online" }}</span></td>

                                            @else
                                                <td> <span class="badge badge-secondary">{{ ucwords($driver->onlinestatus) }}</span></td>

                                            @endif
                                            
                                            
                                            {{-- edit --}}
                                            <td>
                                                {{-- form (add new partner) --}}
                                                <form action="{{ route('admin.editdriver') }}" method="post" enctype="multipart/form-data">
                                            
                                                    {{-- method fields --}}
                                                    @method('POST')
                                                    @csrf
                                            
                                                    <button type="submit" class="custom-edit-button">
                                                        <i class="far fa-edit text-primary"></i>
                                                    </button>
                                            
                                                    <input type="hidden" name="id" value="{{ $driver->id }}">
                                                </form>
                                            </td>

                                        </tr>

                                        {{-- end table row --}}


                                        {{-- increase counter --}}
                                        <?php $counter++; ?>

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
                                    
                                    @if($drivers instanceof \Illuminate\Pagination\LengthAwarePaginator )
                                    
                                    {{$drivers->links()}}
                                    
                                    @endif
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




@endsection