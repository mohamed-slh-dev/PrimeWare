@extends('layouts.collector-app')

@section('content')

<div class="row mt-5 mx-0">
    <div class="col-12">
        <div class="card" style="background:rgb(42,42,42);">
            <form action="{{route('collector.return.cash')}}" method="post">

                @method('POST')
                @csrf

                <div class="card-body p-4">
                    <div>
                  <label class="mt-3" style=" color: #fbbe00; ">Restaurant</label>
                    <select class="custom-control custom-select home-searchselect" name="restaurant_id">
                        @foreach ($restaurants as $rest)
                    <option value="{{$rest->id}}">{{$rest->name}}</option>
                        @endforeach
                       
                           
                    </select>
                    </div>
                    
                    <div class="mt-3">
                    <label style=" color: #fbbe00; ">Collected Cash Returned</label>
                     <input type="number" required="" placeholder="" name="cash_amount" class="custom-control home-searchinput" min="0">
                    </div>

                   
                     <div class="mt-3 text-center">
                   <button class="btn btn-warning" type="submit" style=" width: 200px; background-color:rgb(254, 184, 0) !important; color:black "> Save </button>
                    </div>
              </div><!--end card-body-->
            </form>
            </div><!--end card-->
     </div><!--end col-->


    </div>
@endsection