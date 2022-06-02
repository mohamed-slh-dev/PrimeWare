@extends('layouts.partner-chat')

@section('content')





{{-- continue header --}}
<!-- start page title -->
<div class="page-title-box">
    <div class="container-fluid">
        <div class="page-title-content">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4>Drivers Chat Room</h4>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end page title -->

</header>
{{-- end header --}}





{{-- content --}}
<div>
    <div class="container-fluid mt-4">

        <div class="row">
            <div class="col-12">
                <div class="chat-box-left">
                    <ul class="nav nav-pills mb-3 nav-justified" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="general_chat_tab" data-toggle="pill" href="#general_chat" style="background-color: lightgrey; color: #50649c; border-color:transparent">Online</a>
                        </li>
                    
                    </ul>


                    {{-- search by driver name --}}
                    {{-- <div class="chat-search">
                        <div class="form-group"> 
                            <div class="input-group">                                                
                                <input type="text" id="chat-search" name="chat-search" class="form-control" placeholder="Driver Name" style="height:42px">
                                <span class="input-group-append">
                                    <button style="background-color: lightgrey;" type="button" class="btn btn-default shadow-none"><i class="fas fa-search" style="color: #50649c"></i></button>
                                </span>
                            </div>                                                    
                        </div>
                    </div> --}}
                    <!--end chat-search-->



                    {{-- drivers with newest messages --}}
                    <div class="tab-content chat-list slimscroll" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="general_chat">

                            <?php $counter = 1; ?>
                            
                            @foreach ($drivers as $driver)
                         
                            {{-- new message --}}
                             
                            <a href="javascript:void(0);" id="button-{{ $counter }}" class="media chats-button" style="border-bottom: 1px solid lightgrey">
                            

                                {{-- image --}}
                                <div class="media-left">

                                    <?php $tmpurl = $driver['pic']; ?>

                                    <img src="{{ asset('assets/img/drivers/profiles/'.$tmpurl) }}" alt="user" class="rounded-circle thumb-md">

                                    {{-- online status --}}
                                    @if ($driver['status'] == "online")
                                        <span class="round-10 bg-success"></span>
                                    @else
                                        <span class="round-10 bg-danger"></span>
                                    @endif

                                </div>
                                <!-- media-left -->

                                {{-- message + name --}}
                                <div class="media-body">
                                    <div class="d-inline-block">
                                        <h6>{{ $driver['name'] }}</h6>
                                        <p>{{ (!empty($messages->where('driver_id', $driver['id'])->last()) ? '["'. $messages->where('driver_id', $driver['id'])->last()->message .'"]' : "Chat Now!" ) }}</p>
                                    </div>
                                    <div>
                                        <span style="font-size:8px;">{{ (!empty($messages->where('driver_id', $driver['id'])->last()) ? $messages->where('driver_id', $driver['id'])->last()->date : "" ) }}</span>

                                        @if ($messages->where('driver_id', $driver['id'])->sum('seen') > 0)
                                        <span></span>
                                        @endif

                                    </div>
                                </div><!-- end media-body -->
                            </a>
                            {{-- end new message --}}


                            <?php $counter++; ?>

                            @endforeach
                                                             
                        </div><!--end general chat-->

                        
                    </div><!--end tab-content-->
                </div><!--end chat-box-left -->




                {{-- 2- chatting right box --}}
                <div class="chat-box-right">


                    {{-- chat header --}}
                    <div class="chat-header" style="background-color: #e9ecef;">
                        <a href="javascript:void(0);" class="media">
                            <div class="media-left">
                                <img src="{{ asset('assets/img/partners/logos/'.$partner->logo) }}" alt="Partner" class="rounded-circle thumb-md">
                            </div><!-- media-left -->
                            <div class="media-body">
                                <div>
                                    <h6 class="mb-1 mt-0">{{ $partner->name }}</h6>
                                    <p class="mb-0">Status: Online</p>
                                </div>
                            </div><!-- end media-body -->
                        </a><!--end media-->   

                    </div>
                    <!-- end chat-header -->





                    {{-- first one to appear always --}}
                    @if ($openchat == 0)
                        <div id="chat-0" class="chats-wrapper">
                    
                    @else
                        <div id="chat-0" class="chats-wrapper d-none">
                        
                    @endif

                        {{-- chat body --}}
                        <div class="chat-body" style="background-color: #e9ecef; box-shadow: 0px 0px 1px 1px #e9ecef">
                            <div class="chat-detail slimscroll">


                                {{-- block of messages from sender --}}
                                <div class="media text-center">

                                    

                                </div>
                                <!--end of block of messages from sender--> 


                            </div>  
                        </div>
                        <!-- end chat-body -->



                        {{-- footer to send new message --}}
                        <div class="chat-footer">
                            <div class="row">
                                
                                {{-- image of sender + input --}}
                                <div class="col-12 col-md-10">
                                    <span class="chat-admin"><img src="{{ asset('assets/img/partners/logos/'.$partner->logo) }}" alt="Partner" class="rounded-circle thumb-sm"></span>

                                    {{-- input of message --}}
                                    <input style="color:white" type="text" class="form-control" placeholder="Type Something ..">
                                </div>
                                <!-- end of sender input and image -->


                                <div class="col-2 text-center">
                                <button class="btn-sm btn-default disabled" disabled style="background-color: lightgrey; height:39px; width: 100%; box-shadow:0px 0px 0px 0px lightgrey; border:1px solid lightgrey; color: #2f5275">Send</button>
                                </div>
                                
                            </div>
                        </div>
                        <!-- end chat-footer -->

                    </div>
                    {{-- end chat wrapper --}}
                    {{-- the first one --}}





                    {{-- chat wrapper to appear n' disappear --}}
                    <?php $counter = 1; ?> 

                    @foreach ($drivers as $driver)
                    
                    @if ($openchat == $driver['id'])
                        <div id="chat-{{ $counter }}" class="chats-wrapper">
                        
                    @else
                        <div id="chat-{{ $counter }}" class="chats-wrapper d-none">

                    @endif

                        {{-- chat body --}}
                        <div class="chat-body" style="background-color: #364358; box-shadow: 0px 0px 1px 1px #364358">
                            <div class="chat-detail slimscroll">


                                @foreach ($messages->where('driver_id', $driver['id']) as $message)



                                {{-- partner message --}}
                                @if ($message->type == "sender")
                                
                                {{-- block of messages from sender --}}
                                <div class="media">
                                
                                
                                    {{-- messages body --}}
                                    <div class="media-body">
                                
                                        {{-- 1 --}}
                                        <div class="chat-msg" style="margin-left: -28px;">
                                            <p style="padding: 11px 20px;">{{ $message->message }}<br><span class="font-10" style="color:black">{{ $message->date }}</span></p>
                                        </div>
                                      
                                    </div>
                                    <!--end messages-body-->
                                
                                
                                </div>
                                <!--end of block of messages from sender-->





                                {{-- driver message --}}
                                @else
                                    
                                {{-- block of receiver messages --}}
                                <div class="media">
                                
                                    {{-- messages block --}}
                                    <div class="media-body reverse">

                                        <div class="chat-msg" style="margin-right: -15px;">
                                            <p style="padding: 11px 20px;">{{ $message->message }}<br><span class="font-10" style="color:black">{{ $message->date }}</span></p>
                                        </div>
                                       
                                        
                                    </div>
                                    <!--end messages-body-->
                            
                                
                                </div>
                                <!--end receiver message block-->

                                @endif
                                



                                @endforeach
                                {{-- end foreach for messages --}}

                            </div>  
                        </div>
                        <!-- end chat-body -->






                        {{-- footer to send new message --}}
                        <div class="chat-footer">

                            <form action="{{ route('partner.sendmessagedriver') }}" method="post">
                                @csrf
                                @method('POST')

                            {{-- id of driver --}}
                            <input type="hidden" name="driverid" value="{{ $driver['id'] }}">


                            <div class="row form-row">
                                
                                {{-- image of sender + input --}}
                                <div class="col-12 col-md-10">
                                    <span class="chat-admin"><img src="{{ asset('assets/img/partners/logos/'.$partner->logo) }}" alt="Partner" class="rounded-circle thumb-sm"></span>

                                    {{-- input of message --}}
                                    <input style="color:white" name="message" required="" type="text" class="form-control" placeholder="Type Something ..">
                                </div>
                                <!-- end of sender input and image -->


                                <div class="col-2 text-center">

                                    <button type="submit" class="btn-sm btn-default" style="background-color: lightgrey; height:39px; width: 100%; box-shadow:0px 0px 0px 0px lightgrey; border:1px solid lightgrey; color: #2f5275">Send</button>
                                    </div>
                            </div>
                            {{-- end row --}}

                            </form>
                            {{-- end form --}}

                        </div>
                        <!-- end chat-footer -->

                    </div>
                    {{-- end chat wrapper --}}

                    
                    <?php $counter++; ?>

                    @endforeach
                    {{-- driver --}}



                </div><!--end chat-box-right --> 
            </div> <!-- end col -->                           
        </div><!-- end row --> 
    </div>
</div>
{{-- end container + div --}}
    
@endsection