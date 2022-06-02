@extends('layouts.admin')


@section('content')



{{-- continue header --}}
<div class="page-title-box">
    <div class="container-fluid">
        <div class="page-title-content">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4>Drivers Settings</h4>
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
                            <div class="row">

                                <div class="col-12 mb-3">
                                    <h4>Shifts Switching Every (Days)</h4>
                                </div>

                                <div class="col-2 mb-3">

                                    <div>
                                        <input type="number" name="from" class="form-control">
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

</div>

{{-- endcontent --}}





@endsection