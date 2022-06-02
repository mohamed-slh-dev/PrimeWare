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
                    <h4>Manage Restaurants</h4>
                </div>

                <div class="col-sm-6">
                    <div class="float-right d-none d-md-block">

                        {{-- form (search partner) --}}
                        <form class="app-search" action="{{ route('admin.searchpartner') }}" method="post">
                        
                            {{-- method fields --}}
                            @method('POST')
                            @csrf
                    
                            <input name="searchinput" type="text" class="form-control" placeholder="Restaurant Name">
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
                            <h4 class="card-title">Restaurants Info.</h4>
                            <p class="card-title-desc">Manage all restaurants Info.</p>

                            <div class="table-responsive">
                                <table class="table mb-0">

                                    <thead class="thead-light">
                                        <tr>
                                            <th>Restaurant</th>
                                            <th>E-mail</th>
                                            <th>Type</th>
                                            <th>City</th>
                                            <th>District</th>

                                            <th>Morning Collection</th>
                                            <th>Night Collection</th>

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
                                        @foreach ($partners as $partner)

                                        <tr>
                                            <td>{{ $partner->name }}</td>
                                            <td>{{ $partner->portalemail }}</td>
                                            <td>{{ $partner->type->name }}</td>

                                            <td>{{ $partner->city->name }}</td>
                                            
                                            <td class="text-success">
                                                <a class="text-success" href="https://www.google.com/maps/search/?api=1&query={{ ltrim($partner->locationlink, '@') }}">{{ $partner->district->name }}</a>
                                            </td>

                                            <td>{{ (!empty($partner->collectiontimingfrom) ? $partner->collectiontimingfrom : "-") }}</td>

                                            <td>{{ (!empty($partner->collectiontimingto) ? $partner->collectiontimingto : "-") }}</td>

                                            <td>{{ $partner->startdate }}</td>
                                            <td>{{ $partner->enddate }}</td>

                                            {{-- download contract --}}
                                            <td> 
                                                <a target="_blank" href="{{ asset('assets/img/partners/contracts/'.$partner->contract) }}">Download</a>
                                            </td>

                                           

                                            {{-- edit --}}
                                            <td>
                                                {{-- form (add new partner) --}}
                                                <form action="{{ route('admin.editpartner') }}" method="post" enctype="multipart/form-data">
                                                
                                                    {{-- method fields --}}
                                                    @method('POST')
                                                    @csrf

                                                    <button type="submit" class="custom-edit-button">
                                                        <i class="far fa-edit text-primary"></i>
                                                    </button>
                                                    
                                                    <input type="hidden" name="id" value="{{ $partner->id }}">
                                                </form>
                                            </td>

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
                                
                                @if($partners instanceof \Illuminate\Pagination\LengthAwarePaginator )
                                
                                {{$partners->links()}}
                                
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





@endsection