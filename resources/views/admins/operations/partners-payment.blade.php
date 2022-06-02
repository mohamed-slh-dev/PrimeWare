@extends('layouts.admin')


@section('content')



{{-- continue header --}}
<!-- start page title -->
<div class="page-title-box">
    <div class="container-fluid">
        <div class="page-title-content">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4>Partners Payment</h4>
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



                {{-- col 12 for heading things --}}
                <div class="col-12">
                    <div class="row">

                        {{-- restaurants (only 4) --}}
                        @foreach ($partners as $partner)

                        {{-- only if partners customer has charges --}}
                        @if ($partner->orders->where('paymentstatus', 'not paid')->count() > 0)

                        <div class="col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">

                                        {{-- image --}}
                                        <div class="col-5 align-self-center">
                                            <div class="icon-info">
                                                <img src="{{ asset('assets/img/partners/logos/'.$partner->logo) }}"
                                                    width="100%" height="120"
                                                    style="object-fit: contain; object-position: center;">
                                            </div>
                                        </div>

                                        {{-- name and fees he has --}}
                                        <div class="col-7 align-self-center text-left">
                                            <div class="text-left">
                                                <p class="mb-0 text-muted text-left font-size-13">{{ $partner->name }}
                                                </p>
                                                <h5 class="mt-0 mb-1 d-inline-block">
                                                    {{ number_format($partner->orders->where('paymentstatus', 'not paid')->sum('chargefees'))}}
                                                    AED</h5>
                                            </div>

                                            {{-- form (confirm fees) --}}
                                            <form action="{{ route('admin.confirmotherpayment') }}" method="post"
                                                class="text-left mt-1">

                                                {{-- method fields --}}
                                                @method('POST')
                                                @csrf

                                                {{-- collectedcash id --}}
                                                <input type="hidden" name="partner_id" value="{{ $partner->id }}">



                                                <button type="submit"
                                                    class="btn btn-outline-success p-0 px-2 font-size-12">Confirm
                                                    Payment</button>

                                            </form>


                                            <div class="progress mt-2" style="height:3px;">
                                                <div class="progress-bar bg-success" role="progressbar"
                                                    style="width: 70%;" aria-valuenow="55" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>

                                        </div>




                                    </div>
                                    {{-- end row  --}}


                                </div>
                                <!--end card-body-->
                            </div>
                            <!--end card-->
                        </div>
                        <!--end col-->


                        @endif

                        @endforeach
                        {{-- end of company --}}


                    </div>
                    <!--end row-->
                </div>

                {{-- end of heading things --}}







                {{-- restaurants charges table --}}
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Partners Charge Fees</h4>
                            <p class="card-title-desc"></p>

                            {{-- table wrapper --}}
                            <div class="table-responsive">
                                <table class="table mb-0">

                                    <thead class="thead-light">
                                        <tr>
                                            <th>Delivery No.</th>
                                            <th>Partner</th>
                                            <th>Customer</th>
                                            <th>City</th>
                                            <th>Requested Amount (AED)</th>
                                        </tr>
                                    </thead>

                                    {{-- tbody --}}
                                    <tbody>

                                        {{-- foreach --}}
                                        @foreach ($otherorders->where('paymentstatus', 'not paid') as $order)

                                        <tr>
                                            <td># {{ $order->id }}</td>
                                            <td>{{ $order->otherpartner->name }}</td>
                                            <td>{{ $order->customer_name }}</td>
                                            <td>{{ $order->city->name }}</td>
                                            <td class="font-weight-bold">{{ number_format($order->chargefees) }}</td>





                                            @endforeach
                                            {{-- end foreach --}}

                                    </tbody>
                                    {{-- end tbody --}}

                                </table>
                            </div>
                            {{-- end table wrapper --}}


                            {{-- pagination --}}
                            <div class="pagination mt-4">
                                {!! $otherorders->links() !!}
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end col -->
                {{-- end table --}}


                <div class="col-12">
                    <hr class="mt-3 mb-4">
                </div>

               

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