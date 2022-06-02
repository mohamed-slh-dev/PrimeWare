@extends('layouts.partner')


@section('content')



{{-- continue header --}}
<!-- start page title -->
<div class="page-title-box">
    <div class="container-fluid">
        <div class="page-title-content">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4>Bags</h4>
                </div>

                <div class="col-sm-4">
                 
                </div>

                <div class="col-sm-2">
                    <div class="float-right d-none d-md-block">

                        {{-- form (search bags) --}}
                        <form class="app-search" action="{{ route('partner.searchbags') }}" method="post">
                        
                            {{-- method fields --}}
                            @method('POST')
                            @csrf

                            <input name="searchinput" type="text" class="form-control" placeholder="Customer Name">
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
{{-- end header --}}




{{-- content --}}
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            {{-- row --}}
            <div class="row">

                @foreach ($customers as $customer)
                    
                {{-- bag card (repeat) --}}
                <div class="col-4">
                    <div class="card">
                        <div class="card-body">

                            {{-- customer info --}}
                            <div class="media mb-3 mb-lg-0">

                                {{-- customer image --}}
                                <img src="{{ asset('assets/partners/assets/images/small/d-box.png') }}" class="mr-3 thumb-md align-self-center" width="130" height="130" alt="...">

                                <div class="media-body align-self-center">

                                    {{-- number of bags  --}}
                                    <h5 class="mt-0 mb-1">No. Of Bags: {{ $customer->collectedorders->sum('bag') - $customer->orders->sum('bag') }}</h5>

                                    {{-- address --}}
                                    <p class="text-muted mb-0"><i class="fas fa-map-marker-alt mr-2 text-info"></i>{{ $customer->city->name }} - {{ $customer->district->name }}<br>{{ $customer->address }}</p>
                                </div>
                                <!--end media body-->
                            </div>
                            <!--end media-->

                            <div class="col-12">
                                <hr style="border-top: 1px solid #c4c4c4;">
                            </div>

                            {{-- customer name --}}
                            <div class="mt-4 row">
                                <div class="col-12 text-center">
                                    <h6 class="text-muted mb-2 mb-lg-0"><i class="dripicons-user  mr-2 text-warning"></i>{{ $customer->name }}</h6>
                                </div>
                            </div>


                        </div>
                        <!--end card-body-->
                    </div>
                    <!--end card-->
                </div>
                <!--end col card (repeat)-->
                

                @endforeach
                {{-- end foreach --}}



                <div class="col-12">
                    {{-- paginations --}}
                    <div class="pagination mt-4">
                        @if($customers instanceof \Illuminate\Pagination\LengthAwarePaginator )
                        
                        {{$customers->links()}}
                        
                        @endif
                    </div>
                </div>
               

            </div>
            {{-- end row --}}
        </div>
        {{-- end container --}}
    </div>
    <!-- end page content -->

    <footer class="footer">

    </footer>

</div>
<!-- End main content -->

{{-- end content --}}




@endsection