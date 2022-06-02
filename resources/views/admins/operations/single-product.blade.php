@extends('layouts.admin')


@section('content')



{{-- continue header --}}
<!-- start page title -->
<div class="page-title-box">
    <div class="container-fluid">
        <div class="page-title-content">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4>{{$product->name}}</h4>
                </div>

                <div class="col-12">
                    <div class="col-12 text-center">
                        <img width="200" height="200" src="{{ asset('assets/supplier/images/products/'.$product->img) }}" style="border:1px solid gold; border-radius: 4px;">
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



            {{-- boxes row --}}
            <div class="row">
                <div class="col">
                    <div class="card text-center">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-info mt-2">{{ $analytics['dispatchedCount'] }}</h3>
                            Total Quantity<br>Dispatched
                        </div>
                    </div>
                </div>



                <div class="col">
                    <div class="card text-center">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-info mt-2">{{ $analytics['receivedCount'] }}</h3>
                            Total Quantity<br>Received
                        </div>
                    </div>
                </div>


                <div class="col">
                    <div class="card text-center">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-info mt-2">{{ $analytics['availableCount'] }}</h3>
                            Total Quantity<br>in Stock
                        </div>
                    </div>
                </div>


                <div class="col">
                    <div class="card text-center">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-success mt-2">{{ $analytics['soldCount'] }}</h3>
                            Total Quantity<br>Sold
                        </div>
                    </div>
                </div>


                <div class="col">
                    <div class="card text-center">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-success mt-2">{{ $analytics['cashCollection'] }}</h3>
                            Cash<br>Collection
                        </div>
                    </div>
                </div>


            </div>
            <!-- end boxes row -->










            {{-- content --}}
            <div class="row">

                {{-- product details col --}}
                <div class="col-12">


                    <div class="card">
                        <div class="card-body">
                    
                    
                            <div class="row mb-3 align-items-center">
                    
                                <div class="col-12">
                                    <h5 class="mb-0">Product Stock Details</h5>
                                </div>
                                
                            </div>
                    
                            {{-- table --}}
                            <div class="table-responsive">
                                <table class="table mb-0">
                    
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Flavor</th>
                                            <th>Received</th>
                                            <th>Available</th>
                                            <th>Sold</th>
                                            <th>Not Received</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                    
                                        @foreach ($product->flavors as $flavor)
                                            
                                      
                                        <tr>
                    
                                            <td>{{$flavor->name}}</td>
                                            <td>{{$flavor->received}}</td>
                                            
                                            <td class="text-success">{{$flavor->available}}</td>
                                            <td>{{$flavor->sold}}</td>
                                            <td class="text-danger">{{$flavor->damaged}}</td>
                                        </tr>
                    
                                        @endforeach
                                      
                                    </tbody>
                                    {{-- end tbody --}}
                                </table>
                            </div>
                            {{-- end table + wrapper --}}
                    
                    
            
                        </div>
                    </div>
                    {{-- end card --}}

                </div>
                {{-- end col --}}






                {{-- orders details col --}}
                <div class="col-12">
                
                
                    <div class="card">
                        <div class="card-body">
                
                
                            <div class="row mb-3 align-items-center">
                
                                <div class="col-12">
                                    <h5 class="mb-0">Product Orders</h5>
                                </div>
                
                            </div>
                
                            {{-- table --}}
                            <div class="table-responsive">
                                <table class="table mb-0">
                
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Delivery No.</th>
                                            <th>Customer</th>
                                            <th>Phone</th>
                                            <th>City</th>
                                            <th>District</th>
                                            <th>Address</th>
                                            <th>Delivery Date</th>
                                            <th>Status</th>
                                            <th>Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        {{-- <tr>   
                                            <td># 1</td>
                                            <td>Ahmed Ala Aldeen</td>
                                            <td>+971 4 222 1219</td>
                                            <td>Dubai</td>
                                            <td>Al Abar</td>
                                            <td>St. Orwa Block 22</td>
                                            <td>2021-08-17</td>
                                            <td><i class="mdi mdi-checkbox-blank-circle text-success"></i> Delivered</td>

                                            <td>15</td>
                                        </tr> --}}
                                        
                                    </tbody>
                                    {{-- end tbody --}}
                                </table>
                            </div>
                            {{-- end table + wrapper --}}
                
                
                
                        </div>
                    </div>
                    {{-- end card --}}
                
                </div>
                {{-- end col --}}


            </div>
            {{-- end row --}}


        </div>
    </div>
</div>



@endsection