@extends('layouts.supplier')


@section('content')





{{-- continue header --}}
<!-- start page title -->
<div class="page-title-box">
    <div class="container-fluid">
        <div class="page-title-content">
            <div class="row align-items-center">
                <div class="col-sm-4">
                    <h4 class="mb-2 mb-sm-0">Edit Product</h4>
                </div>

                <div class="col-sm-4 text-center">
                    <img src="{{ asset('assets/supplier/images/products/'.$product->img) }}" width="170" height="170" alt="logo-large" class="logo-lg custom-edit-logo">
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
                <div class="col-md-6 offset-xl-2 col-xl-2">
                    <div class="card text-center">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-info mt-2">{{ $analytics['dispatchedCount'] }}</h3>
                            Quantity<br>Dispatched
                        </div>
                    </div>
                </div>
            
            
            
                <div class="col-md-6 col-xl-2">
                    <div class="card text-center">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-info mt-2">{{ $analytics['receivedCount'] }}</h3>
                            Quantity<br>Received
                        </div>
                    </div>
                </div>
            
            
                <div class="col-md-6 col-xl-2">
                    <div class="card text-center">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-info mt-2">{{ $analytics['availableCount'] }}</h3>
                            Quantity<br>in Stock
                        </div>
                    </div>
                </div>
            
            
                <div class="col-md-6 col-xl-2">
                    <div class="card text-center">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-success mt-2">{{ $analytics['soldCount'] }}</h3>
                            Quantity<br>Sold
                        </div>
                    </div>
                </div>
            
            
            </div>
            <!-- end boxes row -->




            <form action=" {{route('supplier.updateproduct')}} " method="POST" enctype="multipart/form-data">
            
                {{-- method fields --}}
                @csrf
            
            
                {{-- partner id --}}
            <input type="hidden" name="product_id" value="{{$id}}">
            
            
                <div class="row mt-4">
                    
                    <div class="col-4">
                        
                        <label>Name</label>
                    <input required="" name="name" class="form-control" type="text" id="example-text-input" 
                    value="{{$product->name}}">

                    </div>

                    <div class="col-4">
                               
                        <label>Ingredients</label>
                        <input required="" name="ingredients" class="form-control" type="text" id="example-text-input" value="{{$product->ingredients}}">

                    </div>

                    <div class="col-4">
                               
                        <label>Image</label>
                        <input name="img" class="form-control" type="file" id="example-text-input">

                    </div>

                    <div class="col-12">
                        <div class="col-12">
                            <hr style="width:100%; border-color:dimgrey !important;">
                        </div>
                    </div>



                    {{-- flavors outer --}}
                    <div class="col-12">


                        <div class="row">
                            
                            <div class="col-12 mt-4 mb-4">

                                {{-- title + button --}}
                                <div class="row">
                                    <div class="col-6">
                                        <h4 style="text-decoration: underline">Flavors</h4>
                                    </div>

                                    {{-- <div class="col-6 text-right">
                                        <a id="new-flavor-button" class="btn btn-outline-warning px-3 mb-2"><i class="fa fa-plus mr-2"></i>New Flavor</a>
                                    </div> --}}

                                </div>
                                {{-- end row --}}
                                
                            
                            
                                {{-- flavors row (id) --}}
                                <div class="row new-flavors-row">
                            
                            
                                    @foreach ($product->flavors as $flavor)
                                        
                                  
                                    {{-- flavor 1 (repeat) --}}
                                    <div class="col-12 mt-3" id="new-flavor-1">
                            
                                        <div class="row align-items-end">
                                            <div class="col-4">
                                                <label>Flavor</label>
                                                <input type="text" placeholder="" name="flavor_name[]" id="" class="form-control" value="{{$flavor->name}}">
                                            </div>
                            
                            
                                            <div class="col-3">
                                                <label>Price</label>
                                                <input type="text" min="1" name="flavor_price[]" id="" class="form-control" value="{{$flavor->price}}">
                                            </div>
                            
                            
                                            <div class="col-3">
                                                <label>Quantity</label>
                                                <input type="number" min="1" name="flavor_quantity[]" id="" class="form-control" value="{{$flavor->quantity}}">
                                            </div>
                            
                        
                            
                                            <div class="col-3 mt-3">
                                                <label>Cals</label>
                                                <input type="text" placeholder="" name="flavor_cals[]" id="" class="form-control" value="{{$flavor->cals}}">
                                            </div>
                            
                            
                                            <div class="col-3 mt-3">
                                                <label>Protein</label>
                                                <input type="text" placeholder="" name="flavor_proteins[]" id="" class="form-control" value="{{$flavor->proteins}}">
                                            </div>
                            
                                            <div class="col-3 mt-3">
                                                <label>Carbs</label>
                                                <input type="text" placeholder="" name="flavor_carbs[]" id="" class="form-control" value="{{$flavor->carbs}}">
                                            </div>
                            
                                            <div class="col-3 mt-3">
                                                <label>Fats</label>
                                                <input type="text" placeholder="" name="flavor_fats[]" id="" class="form-control" value="{{$flavor->fats}}">
                                            </div>
                            
                                            <div class="col-12">
                                                <hr style="width:50%; border-color:rgb(65, 65, 65) !important;">
                                            </div>
                            
                                        </div>
                                    </div>
                                    {{-- end flavor 1 (repeat) --}}

                                    @endforeach


                                </div>
                                {{-- end flavors row (id) --}}
                            
                            
                            
                            </div>
                            {{-- col 12 --}}


                        </div>
                        {{-- end flavors wrapper --}}




                    </div>
                    {{-- end flavors col 12 --}}



                    {{-- update button --}}
                    <div class="col-12 text-left">
                        <button class="btn btn-outline-warning px-4">Update</button>
                    </div>
                    

                </div>
                {{-- end form row --}}
            </form>
            {{-- end form editing --}}


        </div>
    </div>
</div>
{{-- end content --}}




@endsection
