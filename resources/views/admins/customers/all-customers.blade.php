@extends('layouts.admin')


@section('content')



{{-- continue header --}}
<!-- start page title -->
<div class="page-title-box">
    <div class="container-fluid">
        <div class="page-title-content">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4>Customers</h4>
                </div>

                <div class="col-sm-6">
                    <div class="float-right d-none d-md-block">

                        {{-- form (search partner) --}}
                        <form class="app-search" action="{{ route('admin.searchcustomermain') }}" method="post">
                        
                            {{-- method fields --}}
                            @method('POST')
                            @csrf
                            <input name="searchinput" type="text" class="form-control" placeholder="Restaurant Name">
                            <span class="fa fa-search"></span>
                        </form>
                        {{-- end form --}}

                    </div>
                </div>
                {{-- end column --}}

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
            {{-- 4 last partners --}}
            <div class="row">

                

                {{-- display first 4 partners only --}}
                <?php $counter = 4; ?>

                @for ($i = 0; $i < $partners->count(); $i++)


                {{-- break the loop --}}
                @if ($i == $counter)
                    @break
                @endif



                {{-- 1st partner col--}}
                <div class="col-lg-3">
                    <div class="card" style="border: 1px solid #fcbc12;">
                        <div class="card-body">


                            {{-- row --}}
                            <div class="row">

                                {{-- profile --}}
                                <div class="col-7 align-self-center">
                                    <div class="icon-info">
                                        <img class="customers-partners-img" src="{{ asset('assets/img/partners/logos/'.$partners[$i]['logo']) }}" width="80" height="40">
                                    </div>
                                </div>


                                {{-- name + customers  --}}
                                <div class="col-5 align-self-center text-right">
                                    <div class="ml-2">

                                        <p class="mb-0 text-muted">{{ $partners[$i]['name'] }}</p>

                                        <h4 class="mt-0 mb-1 d-inline-block">{{ $partners[$i]->customers->count() }}
                                            <span class="font-size-13">Customers</span>
                                        </h4>

                                    </div>
                                </div>

                            </div>
                            {{-- end row --}}


                            {{-- progress bar --}}
                            <div class="progress mt-2" style="height:3px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 55%;" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            {{-- end progress bar --}}

                        </div>
                        <!--end card-body-->
                    </div>
                    <!--end card-->
                </div>
                {{-- end 1st partner col --}}


                @endfor
                {{-- endfor loop --}}

                


                {{-- main col --}}
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            {{-- title --}}
                            <p class="card-title-desc mb-1">All Restaurants Customers </p>


                            {{-- paginations --}}
                            <div class="row text-left">
                                <div class="col-12 text-left mb-3">
                                    <div class="pagination mt-1 mb-4">

                                        @if($partners instanceof \Illuminate\Pagination\LengthAwarePaginator )
                                        
                                        {{$partners->links()}}
                                        
                                        @endif
                                      

                                    </div>
                                </div>
                            </div>
                            {{-- end pagination --}}



                            {{-- 1st partner table (repeat) --}}
                            
                            @foreach ($partners as $partner)
                                
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    
                                    @if ($partner->id == 1) 
                                        <p class="ml-3 mt-2 mb-2">{{ $partner->name }}</p>
                                    @else
                                        <p class="ml-3 mt-5 mb-2">{{ $partner->name }}</p>
                                    @endif


                                    <thead class="thead-light">
                                        <tr>
                                            <th style="color:#fcbc12;">#</th>
                                            <th style=" width: 150px; ">Customer</th>
                                            <th>Phone</th>
                                            <th>City</th>
                                            <th>District</th>
                                            <th>Address</th>
                                            <th>Location</th>
                                            <th>Deliveries</th>
                                            <th>Delivered</th>
                                            <th>Delivery Timing</th>

                                            <th>Subscription Start Date</th>
                                            <th>Subscription End Date</th>
                                            <th>Delivery Days</th>


                                        </tr>
                                    </thead>

                                    {{-- tbody --}}
                                    <tbody>

                                        {{-- customers of partner --}}
                                        <?php $counter = 1; ?>

                                        @foreach ($partner->customers as $customer)
                                            
                                        {{-- first customer of partner --}}
                                        <tr>
                                            <td scope="row" style="color:#fcbc12;">{{ $customer->id }}</td>
                                            <td>{{ $customer->name }}</td>
                                            <td>{{ $customer->phone }}</td>
                                            <td>{{ $customer->city->name }}</td>
                                            <td>{{ $customer->district->name }}</td>
                                            <td>{{ $customer->address }}</td>

                                            <td><a href="https://www.google.com/maps/search/?api=1&query={{ ltrim($customer->locationlink, '@') }}" class="text-warning" target="_blank">Show Map</a></td>

                                            {{-- all deliveries --}}
                                            <td class="text-primary">
                                                {{ $customer->orders->count() }}
                                            </td>

                                            {{-- delivered --}}
                                            <td class="text-success">{{ $customer->deliveredorders->count() }}</td>

                                            {{-- service timing (selected timing) --}}
                                            <td>{{ $customer->servicetiming }}</td>

                                            {{-- startdate - enddate  --}}
                                            <td>{{ $customer->substartdate }}</td>
                                            <td>{{ $customer->subenddate }}</td>
                                            
                                            <td>

                                                {{-- php code --}}
                                                <?php
                                                
                                                // days string
                                                $days = "";


                                                // check days
                                                if (str_contains($customer->deliverydays, '1'))
                                                    $days .= "Sunday, ";
                                                
                                                if (str_contains($customer->deliverydays, '2'))
                                                    $days .= "Monday, ";

                                                if (str_contains($customer->deliverydays, '3'))
                                                    $days .= "Tuesday, ";

                                                if (str_contains($customer->deliverydays, '4'))
                                                    $days .= "Wednesday, ";
                                                
                                                if (str_contains($customer->deliverydays, '5'))
                                                    $days .= "Thursday, ";

                                                if (str_contains($customer->deliverydays, '6'))
                                                    $days .= "Friday, ";

                                                if (str_contains($customer->deliverydays, '7'))
                                                    $days .= "Saturday, ";


                                                // if days not empty then trim it
                                                if ($days != "")
                                                    $days = rtrim($days, ', ');
                                                

                                                ?>

                                                {{-- end php code --}}


                                                {{-- print days --}}
                                                {{ $days }}
                                            </td>

                                        </tr>
                                        {{-- end of first customer --}}


                                        {{-- increase counter --}}
                                        <?php $counter++ ?>

                                        @endforeach
                                        {{-- end foreach of customers of partner --}}

                                        
                                    </tbody>
                                    {{-- end tbody --}}

                                </table>
                            </div>
                            {{-- end table wrapper (repeat) --}}


                            


                            @endforeach
                            {{-- endforeach --}}

                        </div>
                    </div>
                </div>
                <!-- end col -->

            </div>
            {{-- end row --}}
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    {{-- footer --}}
    <footer class="footer">

    </footer>

</div>
<!-- end main content-->


{{-- endcontent --}}




@endsection