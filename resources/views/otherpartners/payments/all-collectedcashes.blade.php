@extends('layouts.otherpartner')


@section('content')


{{-- header --}}
<!-- start page title -->
<div class="page-title-box">
    <div class="container-fluid">
        <div class="page-title-content">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4>Payments</h4>
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
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Unpaid Charge Fees</h4>
                            <p class="card-title-desc"></p>

                            <div class="table-responsive">
                                <table class="table mb-0">

                                    <thead class="thead-light">
                                        <tr>
                                            <th>Delivery No.</th>
                                            <th>Reference ID</th>
                                            <th>Customer Name</th>
                                            <th>Charge Fees</th>
                                          
                                            <th>Delivery Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>

                                    {{-- tbody --}}
                                    <tbody>

                                        @foreach ($orders as $order)


                                        {{-- tr --}}
                                        <tr>
                                            <td># {{ $order->id }}</td>
                                            <td>{{ $order->referenceid }}</td>
                                            <td>{{ $order->customer_name }}</td>

                                            <td>{{ $order->chargefees }} AED</td>

                            

                                            {{-- deliverydate + delivery time --}}
                                            <td>{{ $order->deliverydate }} - {{ $order->deliverytime }}</td>

                                            {{-- status --}}
                                            <td><i class="mdi mdi-checkbox-blank-circle text-warning"></i> {{ ucwords($order->paymentstatus) }}</td>


                                        </tr>
                                        {{-- end tr --}}

                                        @endforeach


                                    </tbody>
                                    {{-- end tbdoy --}}


                                </table>
                            </div>
                            {{-- end table wrapper --}}


                            {{-- paginations --}}
                            <div class="pagination mt-4">
                                {!! $orders->links() !!}
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


{{-- end content --}}



@endsection