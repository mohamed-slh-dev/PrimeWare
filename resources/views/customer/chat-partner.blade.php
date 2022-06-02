@extends('layouts.customer-app')

@section('content')

<div class="container-fluid">



    <!-- title section -->
    <div class="align-items-start"
    style="background:rgb(42, 42, 42); padding: 25px 20px !important; overflow-y: scroll; height: 83vh">

    <div class="row">
    @foreach ($msgs as $msg)
    @if ($msg->type == 'customer')
          <!-- sender -->
        <div class="col-12">
            <p class="chat-message chat-sender">
               {{$msg->message}}
             </p>
        </div>

        @else
        <!-- receiver -->
        <div class="col-12">
            <p class="chat-message chat-receiver">
               {{$msg->message}}
             </p>
        </div>
        
        @endif
@endforeach
    </div>
</div>
<!-- end row -->




   





    <form action="{{ route('customer.partner.send') }}" method="post">

        @method('POST')
        @csrf
    <!-- send message bar -->
    <div class="row align-items-center"
        style="background:rgb(42, 42, 42); padding: 15px 20px 5px !important;">


        <div class="col-10 col-sm-11 text-left px-0">

            <div class="d-block bg-white send-message-wrapper">

                <!-- input -->
                <input type="text" class="send-message-input custom-control d-inline-block-f" placeholder="Write a Message ..." name="message" >

                <!-- button -->
                {{-- <button class="btn d-inline-block send-message-button" type="submit" >
                    <i class="fas fa-arrow-circle-right"></i>
                </button> --}}
            </div>
        </div>

        <div class="col-2 col-sm-1 text-center px-0">
            <button class="btn d-inline-block send-message-button" type="submit" >
                <i class="fas fa-arrow-circle-right"></i>
            </button>
        </div>

    </div>
</form>

</div>
<!-- container-fluid -->
@endsection