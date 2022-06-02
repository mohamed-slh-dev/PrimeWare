@extends('layouts.admin')


@section('content')



{{-- continue header --}}
<!-- start page title -->
<div class="page-title-box">
    <div class="container-fluid">
        <div class="page-title-content">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4>Servcies Settings</h4>
                </div>

                <div class="col-sm-6">
                    <div class="float-right">
                        <button type="button" class="btn btn-outline-success waves-effect waves-light" data-toggle="modal" data-target=".bs-example-modal-lg">Add Restaurant Charge</button>
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


                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Restaurants Service Charge</h4>

                            <div class="table-responsive">
                                <table class="table mb-0">

                                    <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Restaurant</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>


                                    {{-- tbody --}}
                                    <tbody>

                                        {{-- counter --}}
                                        <?php $counter = 1; ?>

                                        @foreach ($groupedcharges as $partner => $charges)
                                        
                                        {{-- trow --}}
                                        <tr>
                                            <td>{{ $counter }}</td>
                                            <td>{{ $charges[0]->partner->name }}</td>
                                            
                                            
                                            {{-- edit button --}}
                                            <td>
                                                <button class="custom-edit-button" data-toggle="modal" data-target=".edit-charge-{{ $counter }}">
                                                    <i class="far fa-edit text-primary"></i>
                                                </button>
                                            
                                            </td>
                                            {{-- end edit button --}}

                                        </tr>
                                        {{-- end trow --}}



                                        {{-- increase counter --}}
                                        <?php $counter++; ?>


                                        @endforeach
                                        {{-- end foreach --}}

                                    </tbody>
                                    {{-- end tbody --}}
                                </table>
                            </div>
                            {{-- end table wrapper --}}


                            {{-- paginations --}}
                            {{-- <div class="pagination mt-4">
                                {!! $charges->links() !!}
                            </div> --}}


                        </div>
                    </div>
                    {{-- end cardbody --}}

                </div>
                {{-- end col --}}
            </div>
            {{-- end row --}}







            <div class="col-12 mb-4">
                <hr style="border-top: 1px solid #c2c2c233;">
            </div>








            {{-- row --}}
            <div class="row">


                <div class="col-12 mb-4 text-right">
                    <button type="button" class="btn btn-outline-success waves-effect waves-light" data-toggle="modal" data-target=".bs-example-modal-lg-2">Add Partners Charge</button>
                </div>

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Other Partners Services Charge</h4>

                            <div class="table-responsive">
                                <table class="table mb-0">

                                    <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>City</th>

                                            <th>Van Charge (Same Day)</th>
                                            <th>Van Charge (Next Day)</th>

                                            <th>Bike Charge (Same Day)</th>
                                            <th>Bike Charge (Next Day)</th>

                                            <th>Edit</th>
                                        </tr>
                                    </thead>


                                    {{-- tbody --}}
                                    <tbody>

                                        <?php $counter = 1; ?>
                                        
                                        @foreach ($othercharges as $charge)
                                            
                                        {{-- trow --}}
                                        <tr>
                                            <td>{{ $charge->id }}</td>
                                            <td>{{ $charge->city->name }}</td>
                                            
                                            <td>{{ $charge->vantodayfees }}</td>
                                            <td>{{ $charge->vannextdayfees }}</td>

                                            <td>{{ $charge->biketodayfees }}</td>
                                            <td>{{ $charge->bikenextdayfees }}</td>


                                            {{-- edit button --}}
                                            <td>
                                                <button class="custom-edit-button" data-toggle="modal" data-target=".edit-othercharge-{{ $counter }}">
                                                    <i class="far fa-edit text-primary"></i>
                                                </button>

                                            </td>
                                            {{-- end edit button --}}

                                        </tr>
                                        {{-- end trow --}}


                                        {{-- increase counter --}}
                                        <?php $counter++; ?>

                                        @endforeach
                                        {{-- end foreach --}}

                                    </tbody>
                                    {{-- end tbody --}}
                                </table>
                            </div>
                            {{-- end table wrapper --}}


                            {{-- paginations --}}
                            <div class="pagination mt-4">
                                {!! $othercharges->links() !!}
                            </div>


                        </div>
                    </div>
                    {{-- end cardbody --}}

                </div>
                {{-- end col --}}
            </div>
            {{-- end row --}}













            <div class="col-12 mb-4">
                <hr style="border-top: 1px solid #c2c2c233;">
            </div>








            {{-- row --}}
            <div class="row">


                <div class="col-12 mb-4 text-right">
                    <button type="button" class="btn btn-outline-success waves-effect waves-light" data-toggle="modal" data-target=".bs-example-modal-lg-3">Add Suppliers Charge</button>
                </div>

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Suppliers Services Charge</h4>

                            <div class="table-responsive">
                                <table class="table mb-0">

                                    <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Supplier</th>

                                            <th>Edit</th>
                                        </tr>
                                    </thead>


                                    {{-- tbody --}}
                                    <tbody>

                                        {{-- counter --}}
                                        <?php $counter = 1; ?>
                                        
                                        @foreach ($groupedsupplierscharges as $supplier => $charges)
                                        
                                        {{-- trow --}}
                                        <tr>
                                            <td>{{ $counter }}</td>
                                            <td>{{ $charges[0]->supplier->name }}</td>
                                        
                                        
                                            {{-- edit button --}}
                                            <td>
                                                <button class="custom-edit-button" data-toggle="modal" data-target=".edit-suppliercharge-{{ $counter }}">
                                                    <i class="far fa-edit text-primary"></i>
                                                </button>
                                        
                                            </td>
                                            {{-- end edit button --}}
                                        
                                        </tr>
                                        {{-- end trow --}}
                                        
                                        
                                        
                                        {{-- increase counter --}}
                                        <?php $counter++; ?>
                                        
                                        
                                        @endforeach
                                        {{-- end foreach --}}

                                    </tbody>
                                    {{-- end tbody --}}
                                </table>
                            </div>
                            {{-- end table wrapper --}}


                            {{-- paginations --}}
                            {{-- <div class="pagination mt-4">
                                {!! $othercharges->links() !!}
                            </div> --}}


                        </div>
                    </div>
                    {{-- end cardbody --}}

                </div>
                {{-- end col --}}
            </div>
            {{-- end row --}}





        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    <footer class="footer">

    </footer>
</div>
<!-- end main content-->


{{-- end content --}}






{{-- modal --}}
{{-- add restaurant service charge --}}
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            {{-- modal header --}}
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Add Restaurant Service Charge</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


            {{-- modal body --}}
            <div class="modal-body">


                {{-- form (add new driver) --}}
                <form action="{{ route('admin.addcharge') }}" method="post">
                
                    {{-- method fields --}}
                    @method('POST')
                    @csrf


                    {{-- from row --}}
                    <div class="row">


                        {{-- partner --}}
                        <div class="col-12">

                            <div class="form-group row">

                                <div class="col-4">

                                    <label>Restaurant</label>
                                    <select required="" name="partnerid" class="custom-select">
                                    
                                        @foreach ($partners as $partner)
                                        <option value="{{ $partner->id }}">{{ $partner->name }}</option>
                                        @endforeach
                                    
                                    </select>

                                </div>
                                
                            </div>

                        </div>




                        {{-- hr --}}
                        <div class="col-12 mb-3">
                            <hr class="bg-white" style="border-color: grey">
                        </div>



                        {{-- col --}}
                        <div class="col-12">
                            <div class="form-group row">


                                {{-- dubai --}}
                                <div class="col-sm-4">
                                    <label>Dubai Charge</label>
                                    <input min="0" required="" name="dubaifees" class="form-control" type="number">
                                </div>

                                {{-- abu dhabi --}}
                                <div class="col-sm-4">
                                    <label>Abu Dhabi Charge</label>
                                    <input min="0" required="" name="abudhabifees" class="form-control" type="number">
                                </div>


                                {{-- sharjah --}}
                                <div class="col-sm-4">
                                    <label>Sharjah Charge</label>
                                    <input min="0" required="" name="sharjahfees" class="form-control" type="number">
                                </div>

                            </div>




                            <div class="form-group row">
                            
                            
                                {{-- Ajman --}}
                                <div class="col-sm-4">
                                    <label>Ajman Charge</label>
                                    <input min="0" required="" name="ajmanfees" class="form-control" type="number">
                                </div>
                            
                                {{-- Umm Al Quwain --}}
                                <div class="col-sm-4">
                                    <label>Umm Al Quwain Charge</label>
                                    <input min="0" required="" name="ummfees" class="form-control" type="number">
                                </div>
                            
                            
                                {{-- Al Ain --}}
                                <div class="col-sm-4">
                                    <label>Al AIn Charge</label>
                                    <input min="0" required="" name="alainfees" class="form-control" type="number">
                                </div>
                            
                            </div>




                            <div class="form-group row">
                            
                            
                                {{-- RAK --}}
                                <div class="col-sm-4">
                                    <label>RAK Charge</label>
                                    <input min="0" required="" name="rakfees" class="form-control" type="number">
                                </div>
                            
                            
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












{{-- modal --}}
{{-- add restaurant service charge --}}
<div class="modal fade bs-example-modal-lg-3" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            {{-- modal header --}}
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Add Suppliers Service Charge</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


            {{-- modal body --}}
            <div class="modal-body">


                {{-- form (add new driver) --}}
                <form action="{{ route('admin.addsuppliercharge') }}" method="post">

                    {{-- method fields --}}
                    @method('POST')
                    @csrf


                    {{-- from row --}}
                    <div class="row">


                        {{-- partner --}}
                        <div class="col-12">

                            <div class="form-group row">

                                <div class="col-4">

                                    <label>Suppliers</label>
                                    <select required="" name="partnerid" class="custom-select">

                                        @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                        @endforeach

                                    </select>

                                </div>

                            </div>

                        </div>




                        {{-- hr --}}
                        <div class="col-12 mb-3">
                            <hr class="bg-white" style="border-color: grey">
                        </div>



                        {{-- col --}}
                        <div class="col-12">
                            <div class="form-group row">


                                {{-- dubai --}}
                                <div class="col-sm-4">
                                    <label>Dubai Charge</label>
                                    <input min="0" required="" name="dubaifees" class="form-control" type="number">
                                </div>

                                {{-- abu dhabi --}}
                                <div class="col-sm-4">
                                    <label>Abu Dhabi Charge</label>
                                    <input min="0" required="" name="abudhabifees" class="form-control" type="number">
                                </div>


                                {{-- sharjah --}}
                                <div class="col-sm-4">
                                    <label>Sharjah Charge</label>
                                    <input min="0" required="" name="sharjahfees" class="form-control" type="number">
                                </div>

                            </div>




                            <div class="form-group row">


                                {{-- Ajman --}}
                                <div class="col-sm-4">
                                    <label>Ajman Charge</label>
                                    <input min="0" required="" name="ajmanfees" class="form-control" type="number">
                                </div>

                                {{-- Umm Al Quwain --}}
                                <div class="col-sm-4">
                                    <label>Umm Al Quwain Charge</label>
                                    <input min="0" required="" name="ummfees" class="form-control" type="number">
                                </div>


                                {{-- Al Ain --}}
                                <div class="col-sm-4">
                                    <label>Al AIn Charge</label>
                                    <input min="0" required="" name="alainfees" class="form-control" type="number">
                                </div>

                            </div>




                            <div class="form-group row">


                                {{-- RAK --}}
                                <div class="col-sm-4">
                                    <label>RAK Charge</label>
                                    <input min="0" required="" name="rakfees" class="form-control" type="number">
                                </div>


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









{{-- edit restaurant service charge --}}

<?php $counter = 1; ?>


@foreach ($groupedcharges as $partner => $charges)
    
    
<div class="modal fade edit-charge-{{ $counter }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            {{-- modal header --}}
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Edit Service Charge ({{ $charges[0]->partner->name }})</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


            {{-- modal body --}}
            <div class="modal-body">


                {{-- form  --}}
                <form action="{{ route('admin.editcharge') }}" method="post">

                    {{-- method fields --}}
                    @method('POST')
                    @csrf


                    {{-- partner id --}}
                    <input type="hidden" name="partnerid" value="{{ $charges[0]->partner->id }}">

                    
                    {{-- from row --}}
                    <div class="row">

                        
                        
                        
                        {{-- col --}}
                        <div class="col-12">
                            <div class="form-group row">
                        
                        
                                {{-- dubai --}}
                                <div class="col-sm-4">
                                    <label>Dubai Charge</label>
                                    <input min="0" value="{{ $charges[0]->fees }}" required="" name="dubaifees" class="form-control" type="number">
                                </div>
                        
                                {{-- abu dhabi --}}
                                <div class="col-sm-4">
                                    <label>Abu Dhabi Charge</label>
                                    <input min="0" value="{{ $charges[1]->fees }}" required="" name="abudhabifees" class="form-control" type="number">
                                </div>
                        
                        
                                {{-- sharjah --}}
                                <div class="col-sm-4">
                                    <label>Sharjah Charge</label>
                                    <input min="0" value="{{ $charges[2]->fees }}" required="" name="sharjahfees" class="form-control" type="number">
                                </div>
                        
                            </div>
                        
                        
                        
                        
                            <div class="form-group row">
                        
                        
                                {{-- Ajman --}}
                                <div class="col-sm-4">
                                    <label>Ajman Charge</label>
                                    <input min="0" value="{{ $charges[3]->fees }}" required="" name="ajmanfees" class="form-control" type="number">
                                </div>
                        
                                {{-- Umm Al Quwain --}}
                                <div class="col-sm-4">
                                    <label>Umm Al Quwain Charge</label>
                                    <input min="0" value="{{ $charges[4]->fees }}" required="" name="ummfees" class="form-control" type="number">
                                </div>
                        
                        
                                {{-- Al Ain --}}
                                <div class="col-sm-4">
                                    <label>Al AIn Charge</label>
                                    <input min="0" value="{{ $charges[5]->fees }}" required="" name="alainfees" class="form-control" type="number">
                                </div>
                        
                            </div>
                        
                        
                        
                        
                            <div class="form-group row">
                        
                        
                                {{-- RAK --}}
                                <div class="col-sm-4">
                                    <label>RAK Charge</label>
                                    <input min="0" value="{{ $charges[6]->fees }}" required="" name="rakfees" class="form-control" type="number">
                                </div>
                        
                        
                            </div>
                        
                        </div>
                        {{-- end col --}}


                        <div class="col-12 text-center mt-2">
                            <button type="submit" class="btn btn-outline-success mr-1 font-15">UPDATE</button>
                        </div>


                    </div>
                    {{-- end row --}}

                </form>
                {{-- end form --}}

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


{{-- increase counter --}}
<?php $counter++; ?>



@endforeach
{{-- end foreach --}}















{{-- edit supplier service charge --}}

<?php $counter = 1; ?>


@foreach ($groupedsupplierscharges as $supplier => $charges)


<div class="modal fade edit-suppliercharge-{{ $counter }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            {{-- modal header --}}
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Edit Service Charge ({{ $charges[0]->supplier->name
                    }})</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


            {{-- modal body --}}
            <div class="modal-body">


                {{-- form --}}
                <form action="{{ route('admin.editsuppliercharge') }}" method="post">

                    {{-- method fields --}}
                    @method('POST')
                    @csrf


                    {{-- partner id --}}
                    <input type="hidden" name="partnerid" value="{{ $charges[0]->supplier->id }}">


                    {{-- from row --}}
                    <div class="row">




                        {{-- col --}}
                        <div class="col-12">
                            <div class="form-group row">


                                {{-- dubai --}}
                                <div class="col-sm-4">
                                    <label>Dubai Charge</label>
                                    <input min="0" value="{{ $charges[0]->fees }}" required="" name="dubaifees"
                                        class="form-control" type="number">
                                </div>

                                {{-- abu dhabi --}}
                                <div class="col-sm-4">
                                    <label>Abu Dhabi Charge</label>
                                    <input min="0" value="{{ $charges[1]->fees }}" required="" name="abudhabifees"
                                        class="form-control" type="number">
                                </div>


                                {{-- sharjah --}}
                                <div class="col-sm-4">
                                    <label>Sharjah Charge</label>
                                    <input min="0" value="{{ $charges[2]->fees }}" required="" name="sharjahfees"
                                        class="form-control" type="number">
                                </div>

                            </div>




                            <div class="form-group row">


                                {{-- Ajman --}}
                                <div class="col-sm-4">
                                    <label>Ajman Charge</label>
                                    <input min="0" value="{{ $charges[3]->fees }}" required="" name="ajmanfees"
                                        class="form-control" type="number">
                                </div>

                                {{-- Umm Al Quwain --}}
                                <div class="col-sm-4">
                                    <label>Umm Al Quwain Charge</label>
                                    <input min="0" value="{{ $charges[4]->fees }}" required="" name="ummfees"
                                        class="form-control" type="number">
                                </div>


                                {{-- Al Ain --}}
                                <div class="col-sm-4">
                                    <label>Al AIn Charge</label>
                                    <input min="0" value="{{ $charges[5]->fees }}" required="" name="alainfees"
                                        class="form-control" type="number">
                                </div>

                            </div>




                            <div class="form-group row">


                                {{-- RAK --}}
                                <div class="col-sm-4">
                                    <label>RAK Charge</label>
                                    <input min="0" value="{{ $charges[6]->fees }}" required="" name="rakfees"
                                        class="form-control" type="number">
                                </div>


                            </div>

                        </div>
                        {{-- end col --}}


                        <div class="col-12 text-center mt-2">
                            <button type="submit" class="btn btn-outline-success mr-1 font-15">UPDATE</button>
                        </div>


                    </div>
                    {{-- end row --}}

                </form>
                {{-- end form --}}

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


{{-- increase counter --}}
<?php $counter++; ?>



@endforeach
{{-- end foreach --}}











{{-- add partners service charge --}}
<div class="modal fade bs-example-modal-lg-2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            {{-- modal header --}}
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Add Partners Service Charge</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


            {{-- modal body --}}
            <div class="modal-body">


                {{-- form  --}}
                <form action="{{ route('admin.addothercharge') }}" method="post">

                    {{-- method fields --}}
                    @method('POST')
                    @csrf


                    {{-- from row --}}
                    <div class="row">

                        {{-- col --}}
                        <div class="col-12">
                            <div class="form-group row">

                                <div class="col-sm-6">
                                    <label>City</label>
                                    <select required="" name="city" class="custom-select">

                                        @foreach ($cities as $city)
                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                        @endforeach

                                    </select>
                                </div>

                                <div class="col-sm-6">

                                </div>



                        

                                {{-- Van Charges --}}
                                <div class="col-sm-6 mt-4">
                                    <label>Van Charge (Same Day)</label>
                                    <input min="0" required="" name="vantodayfees" class="form-control" type="number">
                                </div>
                                
                                {{-- next day fees --}}
                                <div class="col-sm-6 mt-4">
                                    <label>Van Charge (Next Day)</label>
                                    <input min="0" required="" name="vannextdayfees" class="form-control" type="number">
                                </div>
                                



                                {{-- Bike Charges --}}
                                <div class="col-sm-6 mt-4">
                                    <label>Bike Charge (Same Day)</label>
                                    <input min="0" required="" name="biketodayfees" class="form-control" type="number">
                                </div>
                                
                                {{-- next day fees --}}
                                <div class="col-sm-6 mt-4">
                                    <label>Bike Charge (Next Day)</label>
                                    <input min="0" required="" name="bikenextdayfees" class="form-control" type="number">
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









{{-- edit partners service charge --}}
<?php $counter = 1; ?>

@foreach ($othercharges as $charge)
    
<div class="modal fade edit-othercharge-{{ $counter }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            {{-- modal header --}}
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Edit Service Charge</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


            {{-- modal body --}}
            <div class="modal-body">


                {{-- form  --}}
                <form action="{{ route('admin.editothercharge') }}" method="post">

                    {{-- method fields --}}
                    @method('POST')
                    @csrf


                    {{-- charge id --}}
                    <input type="hidden" name="charge_id" value="{{ $charge->id }}">

                    {{-- from row --}}
                    <div class="row">

                        {{-- col --}}
                        <div class="col-12">
                            <div class="form-group row">

                                {{-- Van Charges --}}
                                <div class="col-sm-6 mt-4">
                                    <label>Van Charge (Same Day)</label>
                                    <input min="0" required="" name="vantodayfees" class="form-control" type="number" value="{{ $charge->vantodayfees }}">
                                </div>
                                
                                {{-- next day fees --}}
                                <div class="col-sm-6 mt-4">
                                    <label>Van Charge (Next Day)</label>
                                    <input min="0" required="" name="vannextdayfees" class="form-control" type="number" value="{{ $charge->vannextdayfees }}">
                                </div>
                                
                                
                                
                                
                                {{-- Bike Charges --}}
                                <div class="col-sm-6 mt-4">
                                    <label>Bike Charge (Same Day)</label>
                                    <input min="0" required="" name="biketodayfees" class="form-control" type="number" value="{{ $charge->biketodayfees }}">
                                </div>
                                
                                {{-- next day fees --}}
                                <div class="col-sm-6 mt-4">
                                    <label>Bike Charge (Next Day)</label>
                                    <input min="0" required="" name="bikenextdayfees" class="form-control" type="number" value="{{ $charge->bikenextdayfees }}">
                                </div>

                            </div>
                            {{-- end form group --}}


                        </div>
                        {{-- end col --}}


                        <div class="col-12 text-center mt-2">
                            <button type="submit" class="btn btn-outline-success mr-1 font-15">UPDATE</button>
                        </div>


                    </div>
                    {{-- end row --}}

                </form>
                {{-- end form --}}

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<?php $counter++; ?>

@endforeach
{{-- end foreach --}}


{{-- end modal --}}



@endsection