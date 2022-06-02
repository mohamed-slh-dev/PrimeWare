@extends('layouts.otherpartner')


@section('content')



{{-- continue header --}}
<!-- start page title -->
<div class="page-title-box">
    <div class="container-fluid">
        <div class="page-title-content">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4>Home</h4>
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
                <div class="col-md-6 col-xl-2">
                    <div class="card text-center">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-info mt-2">{{ number_format($orders->count()) }}</h3> Total Deliveries
                        </div>
                    </div>
                </div>
         


                <div class="col-md-6 col-xl-2">
                    <div class="card text-center">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-success mt-2">{{ number_format($orders->where('status', 'delivered')->count()) }}</h3> Delivered
                        </div>
                    </div>
                </div>

                
                <div class="col-md-6 col-xl-2">
                    <div class="card text-center">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-danger mt-2">{{ number_format($orders->where('status', 'canceled')->count()) }}</h3> Canceled

                        </div>
                    </div>
                </div>

             
            </div>
            <!-- end row -->


            {{-- row --}}
            <div class="row">

                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Total Deliveries</h4>

                            <div class="row text-center mt-4">
                                <div class="col-2">
                                    <h5 class="mb-2 font-size-18">{{ number_format($orders->where('status', 'delivered')->count()) }}</h5>
                                    <p class="text-muted text-truncate">Delivered</p>
                                </div>
                                <div class="col-8">
                                    <div id="pie-chart" style="height: 300px; margin-top: -60px;"></div>
                                </div>
                                <div class="col-2">
                                    <h5 class="mb-2 font-size-18">{{ number_format($orders->where('status', 'canceled')->count()) }}</h5>
                                    <p class="text-muted text-truncate">Returned | Canceled</p>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>

            </div>
            <!-- end row -->



            {{-- all orders --}}
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Deliveries</h4>
                            <p class="card-title-desc">Review all delivery orders</p>

                            <div class="table-responsive">
                                <table class="table mb-0">

                                    <thead class="thead-light">
                                        <tr>
                                            <th>Delivery No.</th>
                                            <th>Reference ID</th>
                                            <th>Customer</th>
                                            <th>Phone</th>

                                            <th>City</th>
                                            <th>District</th>
                                            <th>Address</th>

                                            <th>Location</th>

                                            <th>Delivery Date</th>

                                            <th>Status</th>
                                            <th>Received At</th>
                                            <th>Cancel</th>
                                        </tr>
                                    </thead>

                                    
                                    <tbody>

                                        {{-- single order (repeat) --}}
                                        @foreach ($orders as $order)
                                            
                                        <tr>
                                            <td># {{ $order->id }}</td>
                                            <td>{{ $order->referenceid }}</td>
                                            <td>{{ $order->customer_name }}</td>
                                            <td>{{ $order->customer_phone }}</td>

                                            <td>{{ $order->city->name }}</td>
                                            <td>{{ $order->district->name }}</td>
                                            <td>{{ $order->customer_address }}</td>

                                            <td><a href="https://www.google.com/maps/search/?api=1&query={{ ltrim($order->customer_locationlink, '@') }}" class="text-warning" target="_blank">Show Map</a></td>
                                            
                                            {{-- deliverydate + delivery time --}}
                                            <td>{{ $order->deliverydate }} - {{ $order->deliverytime }}</td>


                                            @if ($order->status == "delivered")
                                                
                                                <td><i class="mdi mdi-checkbox-blank-circle text-success"></i> Delivered</td>

                                            @elseif ($order->status == "canceled")

                                                <td><i class="mdi mdi-checkbox-blank-circle text-danger"></i> Canceled</td>

                                            @else

                                                <td><i class="mdi mdi-checkbox-blank-circle text-warning"></i> {{ ucwords($order->status) }}</td>

                                            @endif



                                            {{-- updatedate + pickup time --}}
                                            @if ($order->status == "delivered")
                                                <td>{{ $order->updatedate }} - {{ $order->pickuptime }}</td>

                                            @else
                                                <td>-</td>
                                            @endif




                                            {{-- cancel delivery --}}
                                            <td class="text-left">
                                                {{-- form (add new partner) --}}
                                                <form action="{{ route('otherpartner.cancelsingleordermain') }}" method="post">
                                            
                                                    {{-- method fields --}}
                                                    @method('POST')
                                                    @csrf
                                            
                                                    @if ($order->status != "canceled")

                                                        @if ($order->deliverydate >= date('Y-m-d'))
                                                        <button type="submit" class="custom-edit-button">
                                                            <i class="fas fa-trash-alt text-danger"></i>
                                                        </button>
                                                        
                                                        @else
                                                        <button disabled type="submit" class="custom-edit-button">
                                                            <i class="fas fa-trash-alt text-secondary"></i>
                                                        </button>
                                                        @endif
                                            
                                            
                                                    @else

                                                        @if ($order->deliverydate >= date('Y-m-d'))
                                                        <button type="submit" class="custom-edit-button">
                                                            <i class="fas fa-trash-restore-alt text-warning"></i>
                                                        </button>
                                                        @else
                                                        <button disabled type="submit" class="custom-edit-button">
                                                            <i class="fas fa-trash-restore-alt text-secondary"></i>
                                                        </button>
                                                        @endif
                                            
                                                    @endif
                                            
                                            
                                                    <input type="hidden" name="orderid" value="{{ $order->id }}">
                                            
                                                </form>
                                            </td>


                                        </tr>
                                        {{-- end table row --}}

                                        @endforeach
                                        {{-- endforeach --}}
                            

                                    </tbody>
                                    {{-- end of tbody --}}

                                </table>
                            </div>
                            {{-- end of table wrapper --}}

                            {{-- paginations --}}
                            <div class="pagination mt-4">
                                {!! $orders->links() !!}
                            </div>
                            {{-- end paginations --}}

                        </div>
                    </div>
                </div>
                {{-- end column --}}



            </div>
            <!-- end row -->

        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    {{-- footer --}}
    <footer class="footer">

    </footer>
    {{-- endfooter --}}

</div>
<!-- end main content-->

{{-- endcontent --}}




{{-- modal --}}




{{-- endmodals --}}









@endsection


