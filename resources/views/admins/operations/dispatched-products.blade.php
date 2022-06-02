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
                    <h4>Dispatched Products</h4>
                </div>

            </div>
            {{-- end row --}}

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


                {{-- product 1 --}}
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">


                            @foreach ($products_dispatch as $product)
                                
                          
                            {{-- product 1 (repeat this) --}}
                            <div class="row mb-3 align-items-center">

                                <div class="col-6">
                                    <h4 class="mb-2">{{$product->product->name}}</h4>
                                    <h6 class="text-left text-warning mb-0">
                                        {{$product->product->supplier->name}}</h6>
                                </div>

                                <div class="col-6 text-right">
                                <a class="btn btn-outline-danger" href="{{ route('admin.cancelproducts', [$product->id]) }}">Cancel Receiving</a>


                                <button class="btn btn-outline-warning ml-1" data-toggle="modal" data-target=".confirm-product-modal-{{$product->id}}">Confirm Receiving</button>
                                </div>
                            </div>

                            {{-- table --}}
                            <div class="table-responsive">
                                <table class="table mb-0">

                                    <thead class="thead-light">
                                        <tr>
                                            <th>Flavor</th>
                                            <th>Dispatched Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($product->flavors as $flavor)
                                            
                                       
                                        <tr>

                                            <td>{{$flavor->flavor->name}}</td>
                                            <td>{{$flavor->quantity}}</td>
                                            
                                        </tr>

                                        @endforeach
                                  
                                    </tbody>
                                    {{-- end tbody --}}
                                </table>
                            </div>
                            {{-- end table + wrapper --}}
                            {{-- end product 1 (repeat) --}}


                            <hr style="border-color: dimgrey;" class="my-4">

                            @endforeach






                            {{-- paginations --}}
                            <div class="pagination mt-3">


                            </div>


                        </div>
                    </div>
                </div>
                {{-- end product 1 col --}}






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

{{-- end content --}}















@foreach ($products_dispatch as $product)
    
{{-- confirm receving modal --}}
<div class="modal fade confirm-product-modal-{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title mt-0 font-weight-bold" id="myLargeModalLabel">Receiving Product</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


        <form action="{{route('admin.receiveproducts')}}" method="POST">
            @csrf
        <input type="hidden" name="product_dispatch" value="{{$product->id}}" id="">
            <div class="modal-body">

                <div class="row">

                    <div class="col-12">
                        <h5 class="text-center"> {{$product->product->name}} </h5>
                        <h6 class="text-center text-warning mb-3">{{$product->product->supplier->name}}</h6>
                    </div>


                    <div class="col-12">

                        <div class="table-responsive">
                            <table class="table mb-0 dispatch-table">
                        
                                <thead class="thead-light">
                                    <tr>
                                        <th>Flavor</th>
                                        <th>Dispatched</th>
                                        <th>Received</th>
                                    </tr>
                                </thead>
                                <tbody>
                        
                                    @foreach ($product->flavors as $flavor)
                                        
                                   
                                    <tr>
                        
                                        <td>{{$flavor->flavor->name}}</td>
                                        <td>{{$flavor->quantity}}</td>
                                        <td>
                                        <input type="number" max="{{$flavor->quantity}}" name="flavor_dispatch_{{$flavor->id}}" id="" class="form-control">
                                        </td>
                                    </tr>
                        
                                    @endforeach

                                </tbody>
                                {{-- end tbody --}}
                            </table>
                        </div>
                        {{-- end table + wrapper --}}
                    </div>
                    {{-- end col 12 --}}






                    <div class="col-12 mt-3 text-center">
                        <button class="btn btn-outline-warning px-4">Confirm</button>
                    </div>


                    
                </div>
                {{-- end row --}}





            </div>
            {{-- end modal body --}}

        </form>


        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- /.modal -->

@endforeach


{{-- end confirm receiving modal --}}


@endsection