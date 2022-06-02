@extends('layouts.admin')


@section('content')



{{-- continue header --}}
<!-- start page title -->
<div class="page-title-box">
    <div class="container-fluid">
        <div class="page-title-content">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4>Inventory Products</h4>
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
                            Total Products<br>Dispatched
                        </div>
                    </div>
                </div>



                <div class="col">
                    <div class="card text-center">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-info mt-2">{{ $analytics['receivedCount'] }}</h3>
                            Total Products<br>Received
                        </div>
                    </div>
                </div>


                <div class="col">
                    <div class="card text-center">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-info mt-2">{{ $analytics['availableCount'] }}</h3>
                            Total Products<br>in Stock
                        </div>
                    </div>
                </div>


                <div class="col">
                    <div class="card text-center">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-success mt-2">{{ $analytics['soldCount'] }}</h3>
                            Total Products<br>Sold
                        </div>
                    </div>
                </div>


                <div class="col">
                    <div class="card text-center">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-success mt-2">{{ $analytics['cashCollection'] }}</h3>
                            Total Cash<br>Collection
                        </div>
                    </div>
                </div>


            </div>
            <!-- end boxes row -->



            {{-- content --}}
            <div class="row">

                @foreach ($products->unique('product_id') as $product)
                    
             
                <label class="col-sm-12 col-md-6 col-lg-4 cs-product-card">



                    <div class="card card-group-row__card text-center o-hidden card--raised ">

                        <div class="card-body d-flex flex-column">
                            <div class=" mb-16pt">

                                <div class="d-block">

                                </div>

                                <span
                                    class="w-64 h-64 icon-holder icon-holder--outline-accent rounded-circle d-inline-flex mb-16pt mt-3">

                                    <img width="150" height="150" src="{{ asset('assets/supplier/images/products/'.$product->product->img) }}" style="border-radius: 4px;">
                                </span>


                                {{-- name --}}
                                <h4 class="mb-8pt carousal-card-heading mt-2">{{$product->product->name}}</h4>

                                <h5 class="mb-2 carousal-card-heading text-warning" style="font-size:16px;">{{$product->product->supplier->name}}</h6>
                                
                                {{-- cals --}}
                                {{-- <h6 class="mb-0 text-success" style="font-size:13px !important;">Price: {{$product->product->price}} (AED)</h6> --}}


                                <hr class="mt-2 w-50" style="border-color: whitesmoke">
                           

                                {{-- Ingredients --}}
                                <h6 style="font-size: 14px !important;">Ingredients</h6>
                                <p class="mb-2"
                                    style="font-weight: 600 !important; font-size: 13px !important; overflow:hidden; height: auto;">
                                   {{ $product->product->ingredients}}</p>

                                <div class="d-block text-center mb-4">

                                    <a href="{{ route('admin.singleproduct', [$product->product->id]) }}" class="btn btn-secondary bg-grey py-1 px-2 cs-font-size-12 mr-1">
                                        <i class="fa fa-info-circle mr-2"></i>Show Info
                                    </a>


                    
                                </div>




                                <!-- input quantity 1 -->
                                <div id="flavor-wrapper-1" class="flavor-wrapper">



                                </div>
                                {{-- end wrapper --}}


                            </div>

                        </div>


                    </div>

                </label>
                <!-- end card -->

                @endforeach


                <div class="col-12">
                    {{-- paginations --}}
                    <div class="pagination mt-4">

                    </div>
                </div>


            </div>
            <!-- end row -->

        </div>
    </div>
</div>








{{-- modal --}}
{{-- delete partner modal --}}
<div class="modal fade facts-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">

            <div class="modal-header mb-3" style="border-bottom: 2px solid lightgrey;">
                <h4 class="modal-title mt-0 font-weight-bold" id="myLargeModalLabel">Product Info</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


            <div class="modal-body">

                <div class="row">
                    <div class="col-12 text-center mb-4">
                        <img style="box-shadow:0px 0px 3px 0px grey; width: 60%; border-radius:4px; object-fit:contain"
                            src="{{ asset('assets/img/suppliers/Rice2.jpg') }}" alt="">

                    </div>


                    <div class="col-12">
                        <h5 class="text-center mb-4" style="text-decoration: underline;">Flavors</h5>
                    </div>




                    <div class="col-12">

                        {{-- flavors --}}
                        <div class="row align-items-center products-flavors-row mb-5">

                            {{-- single --}}
                            <div class="col-12 col-md-12 mb-4">
                                <p class="text-center" style="font-size:18px">Chocolate<br><span
                                        style="font-size:14px; font-weight:500;">Available Quantity:<span
                                            class="ml-1 font-weight-bold text-success">33</span></span></p>


                                <div class="row"
                                    style="border-bottom: 1px solid lightgrey; border-top: 1px solid lightgrey;">
                                    <div class="col-3 pt-2" style="border-right:1px solid lightgrey">
                                        <p class="text-center">
                                            Cals<br><span
                                                class="badge badge-primary w-75 py-1 font-weight-bold">400</span>
                                        </p>
                                    </div>
                                    <div class="col-3 pt-2" style="border-right:1px solid lightgrey">
                                        <p class="text-center">
                                            Protein<br><span
                                                class="badge badge-primary w-75 py-1 font-weight-bold">180g</span>
                                        </p>
                                    </div>
                                    <div class="col-3 pt-2" style="border-right:1px solid lightgrey">
                                        <p class="text-center">
                                            Carbs<br><span
                                                class="badge badge-primary w-75 py-1 font-weight-bold">80g</span>
                                        </p>
                                    </div>

                                    <div class="col-3 pt-2">
                                        <p class="text-center">
                                            Fats<br><span
                                                class="badge badge-primary w-75 py-1 font-weight-bold">4g</span>
                                        </p>
                                    </div>
                                </div>


                            </div>



                            {{-- single --}}
                            <div class="col-12 col-md-12 mb-4">
                                <p class="text-center" style="font-size:18px;">Vanillla<br><span
                                        style="font-size:14px; font-weight:500;">Available Quantity:<span
                                            class="ml-1 font-weight-bold text-success">21</span></span></p>


                                {{-- macros row --}}
                                <div class="row"
                                    style="border-bottom: 1px solid lightgrey; border-top: 1px solid lightgrey;">

                                    <div class="col-3 pt-2" style="border-right:1px solid lightgrey">
                                        <p class="text-center">
                                            Cals<br><span
                                                class="badge badge-primary w-75 py-1 font-weight-bold">400</span>
                                        </p>
                                    </div>
                                    <div class="col-3 pt-2" style="border-right:1px solid lightgrey">
                                        <p class="text-center">
                                            Protein<br><span
                                                class="badge badge-primary w-75 py-1 font-weight-bold">180g</span>
                                        </p>
                                    </div>
                                    <div class="col-3 pt-2" style="border-right:1px solid lightgrey">
                                        <p class="text-center">
                                            Carbs<br><span
                                                class="badge badge-primary w-75 py-1 font-weight-bold">80g</span>
                                        </p>
                                    </div>

                                    <div class="col-3 pt-2">
                                        <p class="text-center">
                                            Fats<br><span
                                                class="badge badge-primary w-75 py-1 font-weight-bold">4g</span>
                                        </p>
                                    </div>
                                </div>
                                {{-- end macros row --}}

                            </div>



                            {{-- single --}}
                            <div class="col-12 col-md-12 mb-4">
                                <p class="text-center" style="font-size:18px;">Cookies<br><span
                                        style="font-size:14px; font-weight:500;">Available Quantity:<span
                                            class="ml-1 font-weight-bold text-success">8</span></span></p>


                                {{-- macros row --}}
                                <div class="row"
                                    style="border-bottom: 1px solid lightgrey; border-top: 1px solid lightgrey;">
                                    <div class="col-3 pt-2" style="border-right:1px solid lightgrey">
                                        <p class="text-center">
                                            Cals<br><span
                                                class="badge badge-primary w-75 py-1 font-weight-bold">400</span>
                                        </p>
                                    </div>
                                    <div class="col-3 pt-2" style="border-right:1px solid lightgrey">
                                        <p class="text-center">
                                            Protein<br><span
                                                class="badge badge-primary w-75 py-1 font-weight-bold">180g</span>
                                        </p>
                                    </div>
                                    <div class="col-3 pt-2" style="border-right:1px solid lightgrey">
                                        <p class="text-center">
                                            Carbs<br><span
                                                class="badge badge-primary w-75 py-1 font-weight-bold">80g</span>
                                        </p>
                                    </div>

                                    <div class="col-3 pt-2">
                                        <p class="text-center">
                                            Fats<br><span
                                                class="badge badge-primary w-75 py-1 font-weight-bold">4g</span>
                                        </p>
                                    </div>
                                </div>
                                {{-- end macros row --}}


                            </div>

                            {{-- single --}}
                            <div class="col-12 col-md-12 mb-4">
                                <p class="text-center" style="font-size:18px;">Caramel<br><span
                                        style="font-size:14px; font-weight:500;">Available Quantity:<span
                                            class="ml-1 font-weight-bold text-success">11</span></span></p>


                                {{-- macros row --}}
                                <div class="row"
                                    style="border-bottom: 1px solid lightgrey; border-top:1px solid lightgrey">
                                    <div class="col-3 pt-2" style="border-right:1px solid lightgrey;">
                                        <p class="text-center">
                                            Cals<br><span
                                                class="badge badge-primary w-75 py-1 font-weight-bold">400</span>
                                        </p>
                                    </div>
                                    <div class="col-3 pt-2" style="border-right:1px solid lightgrey">
                                        <p class="text-center">
                                            Protein<br><span
                                                class="badge badge-primary w-75 py-1 font-weight-bold">180g</span>
                                        </p>
                                    </div>
                                    <div class="col-3 pt-2" style="border-right:1px solid lightgrey">
                                        <p class="text-center">
                                            Carbs<br><span
                                                class="badge badge-primary w-75 py-1 font-weight-bold">80g</span>
                                        </p>
                                    </div>

                                    <div class="col-3 pt-2">
                                        <p class="text-center">
                                            Fats<br><span
                                                class="badge badge-primary w-75 py-1 font-weight-bold">4g</span>
                                        </p>
                                    </div>
                                </div>
                                {{-- end macros row --}}


                            </div>




                        </div>


                    </div>



                </div>

            </div>
            {{-- end modal body --}}
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>


{{-- end modal --}}














{{-- modal --}}
{{-- add new one time order --}}
<div class="modal fade new-product-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Create New Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                {{-- form (add new customer) --}}
                <form action="" method="post">

                    {{-- method fields --}}
                    @method('POST')
                    @csrf


                    {{-- form row --}}
                    <div class="row">


                        {{-- partner id --}}
                        <input type="hidden" name="partner" value="">

                        {{-- col --}}
                        <div class="col-12">

                            <div class="form-group row">

                                <div class="col-4">
                                    <label>Name</label>
                                    <input required="" name="name" class="form-control" type="text"
                                        id="example-text-input">
                                </div>

                                <div class="col-8">
                                    <label>Ingredients</label>
                                    <input required="" name="name" class="form-control" type="text"
                                        id="example-text-input">
                                </div>



                                {{-- <div class="col-8 mt-3">
                                    <label>Ingredients</label>
                                    <textarea name="" class="form-control" id="" rows="2"></textarea>
                                </div> --}}

                                <div class="col-12">
                                    <hr style="border-color: dimgrey;">
                                </div>

                                <div class="col-12 mt-4 mb-4">
                                    <a id="new-flavor-button" class="btn btn-outline-warning px-3 mb-2"><i
                                            class="fa fa-plus mr-2"></i>New Flavor</a>


                                    {{-- flavors --}}
                                    <div class="row new-flavors-row">


                                        {{-- flavor 1 --}}
                                        <div class="col-12 mt-3" id="new-flavor-1">

                                            <div class="row align-items-end">
                                                <div class="col-4">
                                                    <label>Flavor</label>
                                                    <input type="text" placeholder="" name="new-flavor-name" id=""
                                                        class="form-control">
                                                </div>


                                                <div class="col-3">
                                                    <label>Price</label>
                                                    <input type="text" min="1" name="new-flavor-price" id=""
                                                        class="form-control">
                                                </div>


                                                <div class="col-3">
                                                    <label>Quantity</label>
                                                    <input type="number" min="1" name="new-flavor-quantity" id=""
                                                        class="form-control">
                                                </div>

                                                {{-- <div class="col-2 text-left">
                                                    <button id="deletenew-flavor-'+flavors+'"
                                                        class="btn btn-danger deletenew-flavor"><i class="fa fa-trash"></i>
                                                    </button>
                                                </div> --}}

                                                <div class="col-3 mt-3">
                                                    <label>Cals</label>
                                                    <input type="text" placeholder="" name="new-flavor-cals" id=""
                                                        class="form-control">
                                                </div>


                                                <div class="col-3 mt-3">
                                                    <label>Protein</label>
                                                    <input type="text" placeholder="" name="new-flavor-protein" id=""
                                                        class="form-control">
                                                </div>

                                                <div class="col-3 mt-3">
                                                    <label>Carbs</label>
                                                    <input type="text" placeholder="" name="new-flavor-carbs" id=""
                                                        class="form-control">
                                                </div>

                                                <div class="col-3 mt-3">
                                                    <label>Fats</label>
                                                    <input type="text" placeholder="" name="new-flavor-fats" id=""
                                                        class="form-control">
                                                </div>

                                                <div class="col-12">
                                                    <hr style="width:50%; border-color:rgb(65, 65, 65) !important;">
                                                </div>

                                            </div>
                                        </div>
                                        {{-- end flavor 1 --}}

                                    </div>
                                    {{-- end flavors --}}



                                </div>
                                {{-- col 12 --}}






                            </div>
                        </div>
                        {{-- end col --}}




                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-outline-success mr-1 font-15">ADD</button>
                        </div>

                    </div>
                    {{-- end row --}}

                </form>
                {{-- end form --}}


            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

{{-- endmodal --}}













{{-- modal --}}
{{-- add new one time order --}}
<div class="modal fade dispatch-product-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Dispatch Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                {{-- form (add new customer) --}}
                <form action="" method="post">

                    {{-- method fields --}}
                    @method('GET')
                    @csrf


                    {{-- form row --}}
                    <div class="row">


                        {{-- partner id --}}
                        <input type="hidden" name="partner" value="">

                        {{-- col --}}
                        <div class="col-12">

                            <div class="form-group row">

                                <div class="col-4">
                                    <label>Product</label>
                                    <select name="" id="" class="form-control custom-select">
                                        <option value="">Brown Rice Protein</option>
                                    </select>
                                </div>


                                <div class="col-12">
                                    <hr style="border-color: dimgrey;">
                                </div>

                                <div class="col-12 mt-4 mb-4">
                                    {{-- <a id="dispatch-flavor-button" class="btn btn-outline-warning px-3 mb-2"><i class="fa fa-plus mr-2"></i>Add Flavors</a> --}}


                                    {{-- flavors --}}
                                    <div class="row dispatch-flavors-row">

                                        <div class="col-12" id="dispatch-flavor-1">
                                            <div class="row align-items-end">

                                                <div class="col-4">
                                                    <label>Flavor</label>
                                                    <input type="text" name="" id="" class="form-control" readonly
                                                        value="Chocolate">
                                                </div>


                                                <div class="col-3">
                                                    <label>Quantity</label>
                                                    <input type="number" min="0" name="dispatch-flavor-quantity" id=""
                                                        class="form-control">
                                                </div>




                                                <div class="col-12">
                                                    <hr style="width:50%; border-color:rgb(65, 65, 65) !important;">
                                                </div>
                                            </div>
                                        </div>
                                        {{-- end flavor --}}






                                        {{-- flavor --}}
                                        <div class="col-12" id="dispatch-flavor-1">
                                            <div class="row align-items-end">

                                                <div class="col-4">
                                                    <label>Flavor</label>
                                                    <input type="text" name="" id="" class="form-control" readonly
                                                        value="Vanilla">
                                                </div>


                                                <div class="col-3">
                                                    <label>Quantity</label>
                                                    <input type="number" min="0" name="dispatch-flavor-quantity" id=""
                                                        class="form-control">
                                                </div>




                                                <div class="col-12">
                                                    <hr style="width:50%; border-color:rgb(65, 65, 65) !important;">
                                                </div>
                                            </div>
                                        </div>




                                        {{-- flavor --}}
                                        <div class="col-12" id="dispatch-flavor-1">
                                            <div class="row align-items-end">

                                                <div class="col-4">
                                                    <label>Flavor</label>
                                                    <input type="text" name="" id="" class="form-control" readonly
                                                        value="Caramel">
                                                </div>


                                                <div class="col-3">
                                                    <label>Quantity</label>
                                                    <input type="number" min="0" name="dispatch-flavor-quantity" id=""
                                                        class="form-control">
                                                </div>




                                                <div class="col-12">
                                                    <hr style="width:50%; border-color:rgb(65, 65, 65) !important;">
                                                </div>
                                            </div>
                                        </div>





                                        {{-- flavor --}}
                                        <div class="col-12" id="dispatch-flavor-1">
                                            <div class="row align-items-end">

                                                <div class="col-4">
                                                    <label>Flavor</label>
                                                    <input type="text" name="" id="" class="form-control" readonly
                                                        value="Cookies">
                                                </div>


                                                <div class="col-3">
                                                    <label>Quantity</label>
                                                    <input type="number" min="0" name="dispatch-flavor-quantity" id=""
                                                        class="form-control">
                                                </div>




                                                <div class="col-12">
                                                    <hr style="width:50%; border-color:rgb(65, 65, 65) !important;">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    {{-- end flavors --}}



                                </div>
                                {{-- col 12 --}}


                            </div>
                        </div>
                        {{-- end col --}}




                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-outline-success mr-1 font-15">Confirm</button>
                        </div>

                    </div>
                    {{-- end row --}}

                </form>
                {{-- end form --}}


            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

{{-- endmodal --}}

@endsection