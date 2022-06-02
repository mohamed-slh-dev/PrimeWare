@extends('layouts.partner')

@section('content')

  <!-- start page title -->
  <div class="page-title-box">
    <div class="container-fluid">
        <div class="page-title-content">
            <div class="row align-items-center">
                <div class="col-sm-4">
                    <h4>Customer Info</h4>
                </div>

              
            </div>
        </div>
    </div>
</div>
<!-- end page title -->

</header>
{{-- end header --}}

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

        <div class="row">
            
                <div class="col-md-6 col-xl-2">
                    <div class="card text-center" >
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-info mt-2">{{ number_format($customer_info->orders->count()) }}</h3>Total Deliveries
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-2">
                    <div class="card text-center" >
                        <div class="mb-2 card-body text-muted">
                      <h3 class="text-primary mt-2">{{ number_format($customer_info->deliveredorders->count()) }}</h3> Delivered

                        </div>
                    </div>
                </div>
                 <div class="col-md-6 col-xl-2">
                    <div class="card text-center" >
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-danger mt-2">{{ number_format($customer_info->canceledorders->count()) }}</h3> Canceled
                        </div>
                    </div>
                </div>
               
                 <div class="col-md-6 col-xl-2">
                    <div class="card text-center" >
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-primary mt-2">0</h3> Bags Collected
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-2">
                    <div class="card text-center" >
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-primary mt-2">0</h3> Bags On Hand
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-2">
                    <div class="card text-center" >
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-success mt-2">{{ number_format($customer_info->orders->sum('cashcollected')) }}</h3> Cash Collected
                        </div>
                    </div>
                </div>
               
            </div>

            <div class="row ">
            <form action="{{route('partner.update.customer.info')}}" method="post">
                <input type="hidden" name="customer_id" value="{{$customer_info->id}}" id="">
                    @csrf
               <div class="col-lg-12">
                 <div class="form-group row">
                   <div class="col-4">
                       <label for="example-text-input" class="col-sm-6 col-form-label">Customer Name</label>
                                    <div class="col-sm-12">
                                    <input required="" class="form-control" type="text" name="name" value="{{$customer_info->name}}" id="example-text-input">
                                    </div>
                        
                      </div>
                     
                      <div class="col-4">
                       <label for="example-text-input" class="col-sm-6 col-form-label ">Phone</label>
                                    <div class="col-sm-12">
                                        <input required="" class="form-control" name="phone" type="text" value="{{$customer_info->phone}}" id="example-text-input">
                                    </div>
                        
                      </div>




                      <div class="col-4">
                        <label for="example-text-input" class="col-sm-6 col-form-label ">Email</label>
                        <div class="col-sm-12">
                            <input required="" class="form-control" type="email" name="email" value="{{$customer_info->email}}"
                                id="example-text-input">
                        </div>
                    
                    </div>




                    <div class="col-4 mt-3">
                        <label for="example-text-input" class="col-sm-6 col-form-label">Reset Password</label>
                        <div class="col-sm-12">
                            <input name="password" class="form-control" type="password">
                        </div>
                    
                    </div>






                       

                        <div class="col-4 mt-3">
                            <label for="example-text-input" class="col-sm-6 col-form-label">City</label> 

                            <div class="col-sm-12">


                                <select id="cityselect" required="" name="city" class="custom-select">
                                
                                    @foreach ($cities as $city)
                                
                                    @if ($customer_info->city_id == $city->id)
                                    <option value="{{ $city->id }}" selected="">{{ $city->name }}</option>
                                
                                    @else
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                
                                    @endif
                                
                                    @endforeach
                                
                                </select>


                                
                            </div>
                        </div>



                    {{-- district --}}
                      <div class="col-4 mt-3">

                        <label for="example-text-input" class="col-sm-6 col-form-label">District</label> 
                         <div class="col-sm-12">

                                <select id="districtselect" required="" name="district" class="custom-select">
                                
                                    @foreach ($districts as $district)
                                
                                    {{-- chosen district --}}
                                    @if ($customer_info->district_id == $district->id)
                                    <option class="all-districts city-{{ $district->samedistrict->city_id }}" value="{{ $district->id }}" selected="">{{ $district->name }}</option>
                                
                                    {{-- same district within chosen city --}}
                                    @elseif ($customer_info->city_id == $district->samedistrict->city_id)
            
                                    <option class="all-districts city-{{ $district->samedistrict->city_id }}" value="{{ $district->id }}">{{ $district->name }}</option>
                                
                                    {{-- other districts --}}
                                    @else
                                    <option class="d-none all-districts city-{{ $district->samedistrict->city_id }}" value="{{ $district->id }}">
                                        {{ $district->name }}</option>
                                
                                    @endif
                                
                                    @endforeach
                                
                                </select>

                              
                            </div>
                        </div>




                        <div class="col-4 mt-3">
                            <label for="example-text-input" class="col-sm-6 col-form-label ">Address</label>
                            <div class="col-sm-12">
                                <input required="" class="form-control" type="text" name="address" value="{{$customer_info->address}}"
                                    id="example-text-input">
                            </div>
                        
                        </div>



                       <div class="col-4 mt-3">
                       <label for="example-text-input" class="col-sm-6 col-form-label">Location Link</label>
                                    <div class="col-sm-12">
                                    <input required="" class="form-control" placeholder="e.g: 12.2773737373, 257773737734" name="location_link" type="text" value="{{ ltrim($customer_info->locationlink, '@')}}" id="example-text-input">  
                                     </div>
                        
                      </div>




                      <div class="col-4 mt-3">
                        <label for="example-text-input" class="col-sm-6 col-form-label">Selected Timing</label>
                        <div class="col-sm-12">
                            <select required="" disabled name="servicetiming" class="custom-select">
                                
                                @if ($customer_info->servicetiming == "3:00 AM - 8:00 AM")
                                    
                                    {{-- morning shift --}}
                                    <option value="3:00 AM - 8:00 AM" selected="">3:00 AM - 8:00 AM</option>
                                    <option value="8:00 AM - 12:00 PM">8:00 AM - 12:00 PM</option>
                                    
                                    {{-- nightshift --}}
                                    <option value="3:00 PM - 9:00 PM">3:00 PM - 9:00 PM</option>


                                @elseif ($customer_info->servicetiming == "8:00 AM - 12:00 PM")
                                    
                                    {{-- morning shift --}}
                                    <option value="3:00 AM - 8:00 AM">3:00 AM - 8:00 AM</option>
                                    <option value="8:00 AM - 12:00 PM" selected="">8:00 AM - 12:00 PM</option>
                                    
                                    {{-- nightshift --}}
                                    <option value="3:00 PM - 9:00 PM">3:00 PM - 9:00 PM</option>

                                @else
                                    {{-- morning shift --}}
                                    <option value="3:00 AM - 8:00 AM">3:00 AM - 8:00 AM</option>
                                    <option value="8:00 AM - 12:00 PM">8:00 AM - 12:00 PM</option>
                                    
                                    {{-- nightshift --}}
                                    <option value="3:00 PM - 9:00 PM" selected="">3:00 PM - 9:00 PM</option>
                                    
                                @endif
                                
                            
                            </select>
                        </div>
                    
                    </div>



                   




                    <div class="col-4 mt-3">
                        <label for="example-text-input" class="col-sm-6 col-form-label ">Subscription Start Date</label>
                        <div class="col-sm-12">
                            <input required="" disabled name="substartdate" class="form-control" type="date" placeholder="YYYY-MM-DD" value="{{ $customer_info->substartdate }}">
                        </div>
                    
                    </div>



                    <div class="col-4 mt-3">
                        <label for="example-text-input" class="col-sm-6 col-form-label ">Subscription End Date</label>
                        <div class="col-sm-12">
                            <input required="" name="subenddate" class="form-control" type="date" placeholder="YYYY-MM-DD" disabled value="{{ $customer_info->subenddate }}">
                        </div>
                    
                    </div>


                      <div class="col-4 mt-3">
                       <label for="example-text-input" class="col-sm-6 col-form-label">Flat No.</label>
                                    <div class="col-sm-12">
                                        <input class="form-control" name="flat_no" value="{{$customer_info->flatnumber}}" type="text"  id="example-text-input">  
                                     </div>
                        
                      </div>

                       <div class="col-4 mt-3">
                        <label for="example-text-input" class="col-sm-6 col-form-label">Block No.</label>
                                    <div class="col-sm-12">
                                        <input class="form-control" name="block_no" type="text" value="{{$customer_info->blocknumber}}"  id="example-text-input">  
                                     </div>
                        
                      </div>


                      

                        <div class="col-12 mt-3">
                       <label for="example-text-input" class="col-sm-6 col-form-label">Comments/Notes</label>
                        <div class="col-sm-12">

                            <textarea class="form-control" name="more_info" id="example-text-input" cols="30" rows="6">{{$customer_info->info}}</textarea>
                        
                        </div>
                        
                      </div>

                       <div class="col-12 text-left">
                        <button class="btn btn-outline-success ml-3 font-15 mt-5">Update Info</button> 
                </div>

                        

                    <div class="col-12 mt-3"> <hr style="border-top: 1px solid #c2c2c233;"></div>


               </div>      
           </div>
        </form>     
      </div>



            <div class="row">
                <div class="col-12 mt-2 mb-5">
                
                
                    <form action="{{route('partner.update.customerdeliverydays')}}" method="post">
                
                        @csrf
                        @method('POST')
                
                        <input type="hidden" name="customer_id" value="{{ $customer_info->id }}">
                
                
                        <h5>
                            Edit Delivery Days Number
                        </h5>
                
                
                        <p class="font-size-16">
                            <span class="text-danger">*</span> All deliveries will be deleted and new deliveries will be created
                            starting from: <span style="text-decoration: underline"
                                class="text-danger">{{ $customer_info->substartdate }}</span>
                        </p>
                
                        <div class="row align-items-center mt-3">
                            <div class="col-4">
                                <input class="form-control" name="deliverydays" type="number"
                                    value="{{$customer_info->deliverydaysnumber}}" required="">
                            </div>
                
                            <div class="col-4 text-left">
                                <button type="submit" class="btn btn-outline-success font-15">Update</button>
                            </div>
                        </div>
                
                    </form>
                
                </div>
            </div>

            <div class="row">

            <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Deliveries</h4>
                            <p class="card-title-desc">Review all delivery orders</p>    
                            
                            <div class="table-responsive">
                                <table class="table mb-0">

                                    <thead class="thead-light">
                                        <tr>
                              
                                            <th>Order No.</th>
                                            
                                            <th>Restaurant</th>
                                            <th>Delivery Date</th>
                                            <th>Bag</th>
                                            <th>Cash Collected</th>
                                            <th>Status</th>

                                        </tr>
                                    </thead>

                                    {{-- tbody --}}
                                    <tbody>

                                        @foreach ($orders as $order)

                                        <tr>
                                                
                                            <td># {{ $order->id }}</td>
                                            <td>{{ $order->partner->name }}</td>

                                            <td>{{ $order->deliverydate }}</td>

                                            {{-- bag --}}
                                            @if ($order->bag == 1)
                                                <td>With Bag</td>
                                            @else
                                                <td>Without Bag</td>
                                            @endif


                                            {{-- cash --}}
                                            <td>{{ number_format($order->cashcollected) }} AED</td>


                                            {{-- status --}}
                                            @if ($order->status == "delivered")
                                                
                                                <td><i class="mdi mdi-checkbox-blank-circle text-success"></i> Delivered</td>

                                            @elseif ($order->status == "canceled")

                                                <td><i class="mdi mdi-checkbox-blank-circle text-danger"></i> Canceled</td>

                                            @else

                                                <td><i class="mdi mdi-checkbox-blank-circle text-warning"></i> {{ ucwords($order->status) }}</td>

                                            @endif
                                            

                                        </tr>

                                        @endforeach
                                        {{-- end foreach --}}
                                        
                                    </tbody>
                                    {{-- end tbody --}}
                                </table>
                            </div>
                            {{-- end table wrapper --}}

                            {{-- paginations --}}
                            <div class="pagination mt-3">
                                {!! $orders->links() !!}
                            </div>
                            {{-- end paginations --}}


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
    
@endsection