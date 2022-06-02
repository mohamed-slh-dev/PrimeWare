@extends('layouts.partner')


@section('content')



{{-- continue header --}}
<!-- start page title -->
<div class="page-title-box">
    <div class="container-fluid">
        <div class="page-title-content">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4>Advertisments</h4>
                </div>

                <div class="col-sm-4">
                    <div class="float-right">
                        <button type="button" class="btn btn-outline-success waves-effect waves-light"
                            data-toggle="modal" data-target=".new-ads">Add Advertisment</button>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="float-right d-none d-md-block">

                        {{-- form (search partner) --}}
                        <form class="app-search" >
                        
                            <input name="searchinput" type="text" class="form-control" placeholder="">
                            <span class="fa fa-search"></span>

                        </form>
                        {{-- end form --}}

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

            {{-- row --}}
            <div class="row">

                @foreach ($ads as $ad)
                    
                {{-- bag card (repeat) --}}
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">

                            {{-- customer info --}}
                            <div class="row mb-3 mb-lg-0">
                                <div class="col-12 text-center">
                                {{-- customer image --}}
                                <img src="{{ asset('assets/img/partners/ads/'.$ad->pic) }}" class=" thumb-md align-self-center" width="130" height="130" alt="...">
                                </div>
                                <div class="col-12 text-center mt-4">
                                <div class="media-body align-self-center row">

                                    <div class="col-sm-4 text-center">
                                    {{-- number of bags  --}}
                                <h5 class="mt-0 mb-1">Title : {{$ad->title}}</h5>
                                    </div>
                                    <div class="col-sm-4 text-center">
                                    {{-- address --}}
                                    <p class="text-muted mb-0">Lable : </i> {{$ad->label}} <br></p>
                                    </div>

                                    <div class="col-sm-4 text-center">
                                        <p class="text-muted mb-2 mb-lg-0">Price : </i>{{ $ad->price }}</p>
                                    </div>
                                </div>
                                <!--end media body-->
                                </div>
                            </div>
                            <!--end media-->

                            <div class="col-12">
                                <hr style="border-top: 1px solid #c4c4c4;">
                            </div>

                            {{-- customer name --}}
                            <div class="mt-3 row">
                               
                               
                                <div class="col-12 text-center">
                                    <form action="{{ route('partner.deleteads') }}" method="post">
                                        @method('POST')
                                        @csrf
                                        <input type="hidden" name="ads_id" value=" {{$ad->id}} " id="">
                                   
                                        <button type="submit" style="background: #0ff0; border:none"> <i class="dripicons-trash  text-danger"></i> </button>
                                       
                                      
                                </form>
                                </div>
                               
                            </div>


                        </div>
                        <!--end card-body-->
                    </div>
                    <!--end card-->
                </div>
                <!--end col card (repeat)-->
                

                @endforeach
                {{-- end foreach --}}



                <div class="col-12">
                    {{-- paginations --}}
                    <div class="pagination mt-4">
                        @if($ads instanceof \Illuminate\Pagination\LengthAwarePaginator )
                        
                        {{$ads->links()}}
                        
                        @endif
                    </div>
                </div>
               

            </div>
            {{-- end row --}}
        </div>
        {{-- end container --}}
    </div>
    <!-- end page content -->

    <div class="modal fade new-ads" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            {{-- modal header --}}
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Add New Advertisment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


            {{-- modal body --}}
            <div class="modal-body">


                {{-- form  --}}
                <form action="{{ route('partner.addads') }}" method="post" enctype="multipart/form-data">

                    {{-- method fields --}}
                    @method('POST')
                    @csrf


                    {{-- from row --}}
                    <div class="row">

                        {{-- col --}}
                        <div class="col-12">
                            <div class="form-group row">

                              
                                <div class="col-sm-4 mt-4">
                                    <label>Title</label>
                                    <input min="0" required="" name="title" class="form-control" type="text">
                                </div>

                        

                                {{-- Van Charges --}}
                                <div class="col-sm-4 mt-4">
                                    <label>Price</label>
                                    <input min="0" required="" name="price" class="form-control" type="text">
                                </div>
                                
                                {{-- next day fees --}}
                                <div class="col-sm-4 mt-4">
                                    <label>Label</label>
                                    <input min="0" required="" name="label" class="form-control" type="text">
                                </div>
                                



                                {{-- Bike Charges --}}
                                <div class="col-sm-4 mt-4">
                                    <label>Picture</label>
                                    <input min="0" required="" name="pic" class="form-control" type="file">
                                </div>
                             



                            </div>
                            {{-- end form group --}}


                        </div>
                        {{-- end col --}}


                        <div class="col-12 text-center mt-2">
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

    <footer class="footer">

    </footer>

</div>
<!-- End main content -->

{{-- end content --}}




@endsection