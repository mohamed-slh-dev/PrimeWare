@extends('layouts.customer-app')

@section('content')
<div class="container-fluid">



    <!-- title section -->
    <div class="row align-items-center showpage-overlay-img"
        style="background:rgb(51,51,51); padding: 0px !important; background-image: url({{asset('assets/img/partners/logos/'.$rest->logo)}}); background-repeat: no-repeat;background-position: center;   
        background-size: cover; ">


        <div class="col-12 showpage-overlay text-center">

            <div class="row px-0">

                <div class="col-6 text-left">
                <a href="{{route('customer.home')}}" class="menu-back-button">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>
                
                
                <div class="col-6 text-right">
                <a href="{{route('customer.home')}}" class="menu-back-button">
                        <i class="fas fa-question-circle"></i>
                    </a>
                </div>



                <!-- title + num of deliveries  -->
                <div class="col-12 text-center" style="margin-top: 80px">
                    <h5 class="mb-1">{{$rest->restaruant_name}}</h5>
                    <p class="text-main-color font-weight-bold"> {{$totalDeliveries}} Deliveries</p>
                </div>


                <!-- Call + chat buttons -->
                <div class="col-12 text-center">

                    <div class="row user-info-row align-items-center">
                        <div class="col-6 text-right">
                            <p class="text-right">
                                <a style="font-weight: bold" href="tel:{{$rest->phone}} " class="profile-location-button showpage-action-buttons">
                                    <i class="mdi mdi-phone"></i> Call
                                </a>
                            </p>
                        </div>
                    
                        <div class="col-6 text-left">
                            <p class="text-left">
                            <a style="font-weight: bold" href="{{route('customer.partner.chat')}}" class="profile-location-button showpage-action-buttons">
                                    <i class="mdi mdi-chat-processing"></i> Chat
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
                <!-- end call + chat -->

            </div>
        </div>
        <!-- end overlay -->
        
    
    </div>
    <!-- end row -->




    <!-- main section row -->
    <div class="row align-items-center"
        style="background:rgb(42, 42, 42); padding: 70px 20px 20px !important; position: relative">


        <!-- marker -->
        <a href="https://www.google.com/maps/search/?api=1&query={{ ltrim($rest->link, '@') }}" target="_blank" class="showpage-map-button">
            <i class="fas fa-map-marked"></i>
        </a>

        <!-- details -->
        <div class="col-12 showpage-middle-content">

            <p class="text-main-color mb-0" style="font-weight: bold">Details</p>
            <p class="text-offwhite-f mb-0"> {{$totalDeliveries}} Deliveries</p>

        </div>


    </div>
    <!-- end row -->






    <!-- main section bottom -->
    <div class="row align-items-center" style="background:rgb(42, 42, 42); padding: 10px 20px !important;">
    
        <h5 class="text-main-color pb-3 pt-1">Subscription info</h5>
    
        <div class="col-12 user-info-wrapper">
    
            <!-- Sub Dates -->
            <div class="row user-info-row align-items-center">
                <div class="col-6">
                    <h5 class="text-offwhite-f"> {{$rest->start_date}} </h5>
                    <p>Start Date</p>
                </div>
    
                <div class="col-6">
                    <h5 class="text-offwhite-f"> {{$rest->end_date}}</h5>
                    <p>End Date</p>
                </div>
            </div>
    
    
    
            <!-- Sub Buttons -->
            {{-- <div class="row user-info-row align-items-center">
                <div class="col-6">
                    <p>
                        <a data-toggle="modal" data-target=".renew" class="profile-location-button">
                            Renew
                        </a>
                    </p>
                </div>
    
                <div class="col-6">
                    <p>
                        <a  data-toggle="modal" data-target=".freez" class="profile-location-button">
                            Freeze
                        </a>
                    </p>
                </div>
            </div> --}}
    
    
            <!-- button -->
    
    
        </div>
        <!-- end main col -->
    
    
    
    </div>
    <!-- end  -->

</div>
<!-- container-fluid -->

<div class="modal fade freez" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content" style=" background-color:#404040">
             <div class="modal-header">
               <h6>Freezing</h6>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
              </div>
                         <div class="modal-body" >
                            <form action="{{ route('customer.freez') }}" method="post">
                                   <div class="row">
                                  
                                        {{-- method fields --}}
                                        @method('POST')
                                        @csrf
                                        <div class="col-sm-6 col-12 p-3">
                                            <label for="">Starting</label>
                                            <input type="date" required class="form-control" name="start_date">
                                        </div>
                                        <div class="col-sm-6 col-md-12 p-3">
                                            <label for="">End</label>
                                            <input type="date" required class="form-control" name="end_date">
                                        </div>
                                     <div class="col-12 text-center mt-5">
                                            <button class="btn btn-sm btn-warning profile-location-button showpage-action-buttons text-center" style="">Freez</button>
                                     </div>
                            </div> 
                        </form>
                    </div>
              </div><!-- /.modal-content -->
       </div><!-- /.modal-dialog -->
 </div><!-- /.modal -->


 <div class="modal fade renew" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content" style=" background-color:#404040">
             <div class="modal-header">
               <h6>Renew</h6>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                                </button>
                                               </div>
                                               <div class="modal-body">
                                   <form action="{{ route('customer.renew') }}" method="post">
                                     {{-- method fields --}}
                                     @method('POST')
                                     @csrf          
                                   <div class="row">
                                   
                                       
                                        <div class="col-6 p-3">
                                            <label for="">Starting</label>
                                            <input type="date" required class="form-control" name="start_date">
                                        </div>
                                        <div class="col-6  p-3">
                                            <label for="">End</label>
                                            <input type="date" required class="form-control" name="end_date">
                                        </div>  
                                        <div class="col-sm-12 p-3">
                                            <label for="">Number Of Deliveries</label>
                                            <input type="number" required class="form-control" name="deliveries">
                                        </div>

                                            <div class="col-12 text-center">
                                                <button class="btn btn-sm btn-warning profile-location-button showpage-action-buttons text-center" style="">Renew</button>
                                            </div>
                                   
                             </div>
                        </form> 
                    </div>
              </div><!-- /.modal-content -->
       </div><!-- /.modal-dialog -->
 </div><!-- /.modal -->
@endsection