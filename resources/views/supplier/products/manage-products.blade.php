@extends('layouts.supplier')


@section('content')



{{-- continue header --}}
<!-- start page title -->
<div class="page-title-box">
    <div class="container-fluid">
        <div class="page-title-content">

            {{-- row --}}
            <div class="row align-items-center">

                <div class="col-sm-6">
                    <h4>Manage Products</h4>
                </div>

                {{-- <div class="col-sm-6">
                    <div class="float-right d-none d-md-block">

                        <form class="app-search" action="" method="post">

                            @method('POST')
                            @csrf

                            <input name="searchinput" type="text" class="form-control" placeholder="Product Name">
                            <span type="submit" class="fa fa-search"></span>

                        </form>

                    </div>
                </div> --}}
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


                @foreach ($products as $product)
                    
              
                {{-- product 1 --}}
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-3"> {{$product->name}} </h4>
                            <div class="table-responsive">
                                <table class="table mb-0">

                                    <thead class="thead-light">
                                        <tr>
                                            <th>Flavor</th>
                                            <th style="width:140px;">Price (AED)</th>
                                            <th style="width:140px;">Quantity</th>
                                            <th>Macros</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($product->flavors as $flavor)
                                            
                                      
                                        <tr>
                                            
                                            <td> {{$flavor->name}} </td>
                                            <td>{{$flavor->price}}</td>
                                            <td>{{$flavor->quantity}}</td>
                                            <td class="macros-tr">
                                                <span class="badge badge-secondary">Cals: {{$flavor->cals}}</span>
                                                <span class="badge badge-secondary">Protein: {{$flavor->proteins}}</span>
                                                <span class="badge badge-secondary">Carbs: {{$flavor->carbs}}</span>
                                                <span class="badge badge-secondary">Fats: {{$flavor->fats}}</span>
                                            </td>

                                        </tr>


                                        @endforeach

                                    </tbody>
                                    {{-- end tbody --}}
                                </table>
                            </div>
                            {{-- end table + wrapper --}}

                            {{-- paginations --}}
                            <div class="pagination mt-3">


                            </div>


                        </div>
                    </div>
                </div>
                {{-- end product 1 col --}}

                @endforeach


                

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


@endsection