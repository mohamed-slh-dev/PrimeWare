@extends('layouts.partner')


@section('content')


{{-- header --}}
<!-- start page title -->
<div class="page-title-box">
    <div class="container-fluid">
        <div class="page-title-content">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4>Collected Cash</h4>
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
                            {{-- <h4 class="card-title"></h4> --}}
                            <p class="card-title-desc"></p>

                            <div class="table-responsive">
                                <table class="table mb-0">

                                    <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Driver Name</th>
                                            <th>Driver Phone</th>
                                            <th>Cash Amount</th>
                                            <th>DateTime</th>
                                            <th>Comment</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>

                                    {{-- tbody --}}
                                    <tbody>

                                        @foreach ($collectedcashes as $cash)
                                            
                                        
                                        {{-- tr --}}
                                        <tr>
                                            <th scope="row">{{ $cash->id }}</th>

                                            <td>{{ (!empty($cash->driver->name) ? $cash->driver->name : "-") }}</td>

                                            <td>{{ (!empty($cash->driver->phone) ? $cash->driver->phone : "-") }}</td>

                                            <td>{{ number_format($cash->amount) }} AED</td>
                                            <td>{{ $cash->date }}</td>
                                            <td>{{ (!empty($cash->comment) ? $cash->comment : "-") }}</td>


                                            {{-- status --}}
                                            <td><i class="mdi mdi-checkbox-blank-circle text-warning"></i> {{ ucwords($cash->status) }}</td>


                                            {{-- confirm button --}}
                                            <td>
                                                
                                                {{-- form (add new customer) --}}
                                                <form action="{{ route('partner.confirmcollectedcash') }}" method="post">
                                                
                                                    {{-- method fields --}}
                                                    @method('POST')
                                                    @csrf

                                                    {{-- collectedcash id --}}
                                                    <input type="hidden" name="cash_id" value="{{ $cash->id }}">


                                                    
                                                    <button type="submit" class="btn btn-outline-success p-0 px-2">Confirm</button>
                                                
                                                </form>

                                            </td>

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
                                {!! $collectedcashes->links() !!}
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