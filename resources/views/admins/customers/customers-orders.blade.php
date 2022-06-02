@extends('layouts.admin')


@section('content')



{{-- continue header --}}
<!-- start page title -->
<div class="page-title-box">
    <div class="container-fluid">
        <div class="page-title-content">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4>Customers Orders</h4>
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
            <div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">


                            {{-- table of orders --}}
                            {{-- <p class="card-title-desc">Orders List</p> --}}
                            <div class="table-responsive">
                                <table class="table mb-0">

                                    <thead class="thead-light">
                                        <tr>
                                            <th>Customer</th>
                                            <th>Phone</th>
                                            <th>City</th>
                                            <th>District</th>
                                            <th>Address</th>
                                            <th>Location</th>
                                            <th>Delivery Date</th>
                                            <th>Order Details</th>
                                        </tr>
                                    </thead>

                                    {{-- tbody --}}
                                    <tbody>

                                      
                                        {{-- customer (repeat) --}}
                                        <tr>

                                            <td>Osama Yaseen</td>
                                            <td>+971 4 563 112</td>
                                            <td>Dubai</td>
                                            <td>Al Abar</td>
                                            <td>Dubai Kilo St. Block 11</td>

                                            <td><a href="https://www.google.com/maps/search/?api=1&query="
                                                    class="text-warning" target="_blank">Show Map</a></td>


                                            <td>2021-10-11</td>
                                            

                                            {{-- show info --}}
                                            <td>
                                                <button type="button"
                                                    class="btn-sm btn btn-outline-success waves-effect waves-light"
                                                    data-toggle="modal" data-target=".order-details-modal">
                                                    <i class="dripicons-preview"></i>
                                                </button>
                                            </td>



                                        </tr>
                                        {{-- end customer (repeat) of table row  --}}

                                

                                    </tbody>
                                    {{-- end tbody --}}
                                </table>
                            </div>
                            {{-- end table wrapper --}}

                        </div>
                    </div>
                </div>
                <!-- end col -->

            </div>
        </div>
    </div>
</div>













{{-- modal for order details and confirm --}}
<div class="modal fade order-details-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Order Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                {{-- form (confirm order) --}}
                <form action="" method="post">

                    {{-- method fields --}}
                    @method('GET')
                    @csrf


                    {{-- form row --}}
                    <div class="row">


                        {{-- customer id --}}
                        <input type="hidden" name="partner" value="">

                        {{-- tables col --}}
                        <div class="col-12">


                            {{-- product 1 table --}}
                            <h5 class="mb-3">Brown Rice Protein</h5>
                            <div class="table-responsive mb-4">
                                <table class="table mb-0">
                            
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Flavor</th>
                                            <th style="width:200px;">Quantity</th>
                                        
                                        </tr>
                                    </thead>
                            
                                    {{-- tbody --}}
                                    <tbody>
                            
                                        {{-- repeat flavor --}}
                                        <tr>
                                            
                                            <td>Chocolate</td>
                                            <td>23</td>
                            
                                        </tr>     
                                        
                                        <tr>
                                        
                                            <td>Vanilla</td>
                                            <td>11</td>
                                        
                                        </tr>

                                        <tr>
                                        
                                            <td>Cookies</td>
                                            <td>10</td>
                                        
                                        </tr>
                            
                            
                                    </tbody>
                                    {{-- end tbody --}}

                                </table>
                            </div>

                            <hr style="border-color: dimgrey; width:50%;">
                            {{-- end product 1 table --}}



                        </div>
                        {{-- tables col --}}




                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-outline-success mr-1 font-15">Confirm Order</button>
                        </div>

                    </div>
                    {{-- end row --}}

                </form>
                {{-- end form --}}


            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



{{-- end modal --}}

@endsection
