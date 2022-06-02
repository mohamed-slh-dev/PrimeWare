@extends('layouts.partner')


@section('content')



{{-- continue header --}}
<!-- start page title -->
<div class="page-title-box">
    <div class="container-fluid">
        <div class="page-title-content">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4>Freeze Requests</h4>
                </div>

                <div class="col-sm-6">
                    <div class="float-right d-none d-md-block">



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



                {{-- column 12 --}}
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-title-desc">View all freeze requests</p>

                            <div class="table-responsive">
                                <table class="table mb-0">

                                    <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Customer</th>
                                            <th>City</th>
                                            <th>District</th>
                                            <th>Phone</th>
                                            <th>Starting Date</th>
                                            <th>Ending Date</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>


                                        {{-- counter for ids --}}
                                        <?php $counter = 1; ?>

                                        {{-- foreach --}}
                                        @foreach ($requests as $request)

                                        <tr>
                                            <td scope="row">{{ $request->id }}</td>
                                            <td>{{ $request->customer->name }}</td>
                                            <td>{{ $request->customer->city->name }}</td>
                                            <td>{{ $request->customer->district->name }}</td>
                                            <td>{{ $request->customer->phone }}</td>

                                            <td>{{ $request->startingdate }}</td>
                                            <td>{{ $request->endingdate }}</td>


                                            {{-- edit --}}
                                            <td>
                                                <button data-toggle="modal" data-target=".edit-customer"
                                                    class="far fa-edit text-primary custom-edit-button customer-assign-id-2"
                                                    value="{{ $request->customer->id }}"></button>

                                                <input type="hidden" id="customer-assign-request"
                                                    value="{{ $request->id }}">
                                            </td>

                                        </tr>

                                        {{-- increase counter --}}
                                        <?php $counter++; ?>

                                        @endforeach
                                        {{-- end foreach (repeat) --}}


                                    </tbody>
                                    {{-- end body --}}
                                </table>
                            </div>
                            {{-- end of table and wrapper --}}

                            <div class="col-12">
                                {{-- paginations --}}
                                <div class="pagination mt-4">
                                    {!! $requests->links() !!}
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






{{-- modals --}}


{{-- edit customer modal --}}
<div class="modal fade edit-customer" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title mt-0 font-weight-bold" id="myLargeModalLabel">Freeze Deliveries</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                {{-- form (search partner) --}}
                <form action="{{ route('partner.confirmfreezerequest') }}" method="post">

                    {{-- method fields --}}
                    @method('POST')
                    @csrf

                    {{-- id of customer --}}
                    <input type="hidden" name="id" id="modal-assign-customer" value="">

                    <input type="hidden" name="requestid" id="modal-assign-request" value="">


                    {{-- row --}}
                    <div class="row">

                        {{-- col --}}
                        <div class="col-12">
                            <div class="form-group row">


                                {{-- extra days input --}}
                                <div class="col-6">
                                    <label>Starting Date</label>
                                    <input required="" name="freezefrom" class="form-control"
                                        type="date" placeholder="YYYY-MM-DD">
                                </div>


                                <div class="col-6">
                                    <label>Ending Date</label>
                                    <input required="" name="freezeto" class="form-control"
                                        type="date" placeholder="YYYY-MM-DD">
                                </div>


                            </div>
                        </div>
                        {{-- end col --}}

                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-outline-success mx-2 font-15">FREEZE</button>
                        </div>

                    </div>
                    {{-- end row --}}
                </form>
                {{-- end form --}}

            </div>
            {{-- end modal body --}}
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- /.modal -->





@endsection