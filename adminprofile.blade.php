@extends('common.tamplate')

@section('title') {{ ucfirst($title) }} @endsection

@section('header')
@parent
@endsection

@section('content')

@php
    if (Session::has('user_details')){
        $user = Session::get('user_details');
    }
@endphp
<div class="container">
    <div class="row profile">
		<div class="col-md-3">
			<div class="profile-sidebar">
				<!-- SIDEBAR USERPIC -->
				<div class="profile-userpic" id="profilePic">
                @if ($user[0]->avatar)
                    <img src="{{ asset('public/assets/faces/' . $user[0]->avatar) }}" class="img-responsive" alt="">
                @else
                    <img src="{{ asset('public/images/logo.png') }}" class="img-responsive" alt="">
                @endif
                <a class="editLink" href="javascript:void(0);"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
				</div>
                <form method="post" action="{{ route('uploadprofileimage') }}" enctype="multipart/form-data" id="picUploadForm" >
                     @csrf
                     <input type="file" name="picture" id="fileInput"  style="display:none"/>
                </form>
				<!-- END SIDEBAR USERPIC -->
				<!-- SIDEBAR USER TITLE -->
				<div class="profile-usertitle">
					<div class="profile-usertitle-name">
                        {{ $user[0]->firstname }} {{ $user[0]->lastname }}
					</div>
					<div class="profile-usertitle-job">
						Admin
					</div>
				</div>
				<!-- END SIDEBAR USER TITLE -->
				<!-- SIDEBAR BUTTONS -->

				<!-- END SIDEBAR BUTTONS -->
				<!-- SIDEBAR MENU -->
				<div class="profile-usermenu">
					<ul class="nav">
						<li class="active" id="overview">
							<a href="javascript:void(0)">
							<i class="fa fa-map-o" aria-hidden="true"></i>
							Overview </a>
						</li>
						<li id="admbooking">
							<a href="javascript:void(0)">
							<i class="fa fa-address-book" aria-hidden="true"></i>
							Bookings </a>
						</li>
						@if($user[0]->type == 1)
						<li id="admcabs">
							<a href="javascript:void(0)">
							<i class="fa fa-taxi" aria-hidden="true"></i>
							Cabs </a>
						</li>
						<li id="admcategory">
							<a href="javascript:void(0)">
							<i class="fa fa-cubes" aria-hidden="true"></i>
							Category </a>
                        </li>
                        <li id="admclient">
							<a href="javascript:void(0)">
							<i class="fa fa-users" aria-hidden="true"></i>
							Client </a>
                        </li>
                        <li id="admdriver">
							<a href="javascript:void(0)">
							<i class="fa fa-id-card-o" aria-hidden="true"></i>
							Driver </a>
                        </li>
                        <li id="admconfiguration">
							<a href="javascript:void(0)">
							<i class="fa fa-sliders" aria-hidden="true"></i>
							Configurations </a>
                        </li>
                        @endif
                        <li id="admdailyinvoice">
							<a href="javascript:void(0)">
							<i class="fa fa-envelope-open" aria-hidden="true"></i>
							Regular Invoice </a>
                        </li>
                        <li id="adminvoice">
							<a href="javascript:void(0)">
							<i class="fa fa-envelope-open-o" aria-hidden="true"></i>
							Monthly Invoice </a>
                        </li>
                        <li id="admreport">
							<a href="javascript:void(0)">
							<i class="fa fa-newspaper-o" aria-hidden="true"></i>
							Reports </a>
                        </li>
                        <li id="admsettings">
							<a href="javascript:void(0)">
							<i class="fa fa-cogs" aria-hidden="true"></i>
							Settings </a>
                        </li>
                        <li>
							<a href="/logout">
							<i class="fa fa-sign-out" aria-hidden="true"></i>
							Logout </a>
						</li>
					</ul>
				</div>
				<!-- END MENU -->
			</div>
		</div>
		<div class="col-md-9">
		        @if(Session::has('success'))
                            <div class="alert alert-success">
                                {{Session::get('success')}}
                            </div>
                @endif
                @if(Session::has('error'))
                            <div class="alert alert-success">
                                {{Session::get('error')}}
                            </div>
                @endif
                @if(Session::has('fail'))
                    <div class="alert alert-danger">
                    {{Session::get('fail')}}
                    </div>
                @endif
            <div class="profile-content active" id="overviewinfo">
                <div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card-counter primary">
                                <i class="fa fa-code-fork"></i>
                                <span class="count-numbers">{{$data['totalbooking']}}</span>
                                <span class="count-name">Booking</span>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card-counter danger">
                                <i class="fa fa-ticket"></i>
                                <span class="count-numbers">{{$data['totalcabs']}}</span>
                                <span class="count-name">Cabs</span>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card-counter success">
                                <i class="fa fa-database"></i>
                                <span class="count-numbers">{{$data['totalCategorylist']}}</span>
                                <span class="count-name">Categories</span>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card-counter info">
                                <i class="fa fa-users"></i>
                                <span class="count-numbers">{{$data['totalusers']}}</span>
                                <span class="count-name">Clients</span>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card-counter info">
                                <i class="fa fa-users"></i>
                                <span class="count-numbers">{{$data['totaldrivers']}}</span>
                                <span class="count-name">Drivers</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="profile-content" id="admbookinginfo">
                <div>
                    <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Booking Details  
                                <button type="button" class="btn btn-primary" onclick="refreshbooking()">
                                    New Booking <span class="badge bg-danger" id="pendingbooking">{{$pendingBooking}}</span>
                                </button>
                                    <a href="#" class="btn btn-info" style="margin-left: 45%;" data-toggle="modal" data-target="#myModal">Create Booking</a>
                                </h4>
                            </div>
                            <hr/>
                    </div>
                    <div id="table-container"></div>
                    <div class="text-center">
                        <ul class="pagination text-middle bookingdata">
                            @if($data['totalbooking']  >= 10)
                                @php $count = $data['totalbooking'] /10; @endphp
                                @for($i=1;$i <= ceil($count);$i++)
                                    <li><a href="#" data-page="{{$i}}">{{$i}}</a></li>
                                @endfor
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            <div class="profile-content" id="admcabsinfo">

                <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Cabs Details <a href="#" class="btn btn-info" style="margin-left: 500px;" data-toggle="modal" data-target="#myCabModel">Create Cab</a></h4>
                        </div>
                        <hr/>
                </div>
                <div id="table-containercab"></div>
                <div class="text-center">
                    <ul class="pagination text-middle bookingdata">
                        @if($data['totalcabs']   >= 10)
                            @php $count = $data['totalcabs']  /10; @endphp
                            @for($i=1;$i <= ceil($count);$i++)
                                <li><a href="#" data-page="{{$i}}">{{$i}}</a></li>
                            @endfor
                        @endif
                    </ul>
                </div>

            </div>
            <div class="profile-content" id="admcategoryinfo">
                    <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Category Details <a href="#" class="btn btn-info" style="margin-left: 500px;" data-toggle="modal" data-target="#catModel">Create Category</a></h4>
                            </div>
                            <hr/>
                    </div>
                    <div id="table-containercategory"></div>
                    <div class="text-center">
                        <ul class="pagination text-middle bookingdata">
                            @if($data['totalCategorylist'] >= 10)
                                @php $count = $data['totalCategorylist']/10; @endphp
                                @for($i=1;$i <= ceil($count);$i++)
                                    <li><a href="#" data-page="{{$i}}">{{$i}}</a></li>
                                @endfor
                            @endif
                        </ul>
                    </div>
            </div>
            <div class="profile-content" id="admclientinfo">
                <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Client Info Details</h4>
                        </div>
                        <hr/>
                </div>
                <div id="table-containerclient"></div>
                <div class="text-center">
                    <ul class="pagination text-middle bookingdata">
                        @if($data['totalusers'] >= 10)
                            @php $count =  $data['totalusers']/10; @endphp
                            @for($i=1;$i <= ceil($count);$i++)
                                <li><a href="#" data-page="{{$i}}">{{$i}}</a></li>
                            @endfor
                        @endif
                    </ul>
                </div>
            </div>
            <div class="profile-content" id="admdriverinfo">
                <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Driver Details <a href="#" class="btn btn-info" style="margin-left: 500px;" data-toggle="modal" data-target="#DriverModel">Create Driver</a></h4>
                        </div>
                        <hr/>
                </div>
                <div id="table-containerdriver"></div>
                <div class="text-center">
                    <ul class="pagination text-middle bookingdata">
                        @if($data['totaldrivers']  >= 10)
                            @php $count = $data['totaldrivers'] /10; @endphp
                            @for($i=1;$i <= ceil($count);$i++)
                                <li><a href="#" data-page="{{$i}}">{{$i}}</a></li>
                            @endfor
                        @endif
                    </ul>
                </div>
            </div>
            <div class="profile-content" id="admreportinfo">
                <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Report Details </h4>
                        </div>
                        <hr/>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <select class="form-control" id="customerid">
                            <option value="">Select Customer</option>
                            @foreach($customers as $customer)
                                <option value="{{$customer->id}}">{{$customer->Customer_Name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-control" id="driverid">
                            <option value="">Select Driver</option>
                            @foreach($drivers as $driver)
                                <option value="{{$driver->id}}">{{$driver->Driver_Name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="date" id="seldate" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <select class="form-control" id="paystatus">
                            <option value="">Select Payment Type</option>
                            <option value="1">Paid</option>
                            <option value="0">Not Paid</option>
                        </select>
                    </div>
                    <br/>
                    <br/>
                    <div class="col-md-2">
                        <button class="btn btn-info" id="reportfilter">Filter</button>
                    </div>
                </div>
                <br/>
                <div id="report-table-container" style="overflow-y: scroll;"></div>
                <div class="text-center">
                    <ul class="pagination text-middle reportdata">
                        @if($data['totalusers'] >= 10)
                            @php $count = $data['totalusers']/10; @endphp
                            @for($i=1;$i <= ceil($count);$i++)
                                <li><a href="#" data-page="{{$i}}">{{$i}}</a></li>
                            @endfor
                        @endif
                    </ul>
                </div>
            </div>
            <div class="profile-content" id="admsettingsinfo">
                <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"> Settings </h4>
                        </div>
                        <hr/>
                </div>
                @if(Session::has('success'))
                            <div class="alert alert-success">
                                {{Session::get('success')}}
                            </div>
                @endif
                @if(Session::has('fail'))
                    <div class="alert alert-danger">
                    {{Session::get('fail')}}
                    </div>
                @endif
                <form action="{{ url('changepassword') }}" method="POST">
					@csrf
                    <h6 class="heading-small text-muted mb-4">Change Password</h6>
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group focused">
                                <label class="form-control-label" for="input-first-name">New Password</label>
                                <input type="password" id="input-first-name" name="password" class="form-control" placeholder="New Password" required>
                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                                </div>
                            </div>
                        </div>


                    </div>

                    <hr class="my-4">
                    <!-- Description -->

                    <div class="row">
                        <div class="col text-center">
                            <button type="submit" class="btn btn-success" >Submit</button>
                        </div>
                    </div>
                </form>

            </div>
            <div class="profile-content" id="admconfigurationinfo">
                <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"> Configurations </h4>
                        </div>
                        <hr/>
                </div>
                    <div class="card" id="chargeconfig">
                        <div class="card-body">
                            <h4 class="card-title"> Fares & Charges</h4>
                        </div>
                        <hr/>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Category Name</th>
                                    <th>Base fare</th>
                                    <th>Waiting Charges</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($charges_data as $key=>$value)
                                    <tr>
                                    @if($value->category_id)
                                                <td><lable>{{$value->name}}</lable></td>
                                                <td><input type="text" class="form-control" placeholder="Amount" id="basefare{{$value->charge_id}}" value="{{$value->config_base_fare}}"></td>
                                                <td><input type="text" class="form-control" placeholder="Amount" id="waitingcharge{{$value->charge_id}}" value="{{$value->charges_waiting_charges}}"></td>
                                                <td><button type="button" class="btn btn-suucess" onclick="updateconfig({{$value->charge_id}})">Update Config</button></td>
                                    @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Category Name</th>
                                    <th>Charges</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($charges_data as $key=>$value)
                                    <tr>
                                    @if(empty($value->category_id))
                                                <td><lable>{{$value->config_name}}</lable></td>
                                                <td><input type="text" class="form-control" placeholder="Pencentage %" id="other{{$value->charge_id}}" value="{{$value->config_charges}}"></td>
                                                <td><button type="button" class="btn btn-suucess" onclick="updateconfig({{$value->charge_id}})">Update Config</button></td>
                                    @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

            </div>
            <div class="profile-content" id="adminvoiceinfo">
                <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"> Monthly Invoices </h4>
                        </div>
                        <hr/>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <select class="form-control" id="customertype">
                            <option value="">Select Customer Type</option>
                            <option value="3">Regular Customer</option>
                            <option value="4">Corporate Customer</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="date" id="fromdate" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <input type="date" id="todate" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-info" id="filter">Filter</button>
                    </div>
                </div>
                <br/>
                <div id="invoice-table-container"></div>
            </div>
            <div class="profile-content" id="admdailyinvoiceinfo">
                <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"> Daily Invoices </h4>
                        </div>
                        <hr/>
                </div>
                <div id="daily-invoice-table-container" style="height: 500px; overflow-y: scroll"></div>
                
            </div>
		</div>
	</div>
</div>

<div class="modal" id="myModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Book Trip</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">

        <ul class="nav nav-pills nav-justified">
            <li class="active"><a data-toggle="tab" href="#home">Single Drop Point Booking</a></li>
            <li><a data-toggle="tab" href="#menu1">Multiple Drop Point Booking</a></li>
        </ul>
        <br/>

        <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">First Name:</label>
                            <input type="text" class="form-control" placeholder="Enter Customer Name" id="sfname">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Last Name:</label>
                            <input type="text" class="form-control" placeholder="Enter Customer Name" id="slname">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="text" class="form-control" placeholder="Enter Email" id="semail">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Phone No:</label>
                            <input type="text" class="form-control" placeholder="Enter Phone No" id="sphone">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Pickup Location:</label>
                            <input type="text" class="form-control" placeholder="Enter Pickup Location" id="picklocation">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="pwd">Drop Location:</label>
                            <input type="text" class="form-control" placeholder="Enter Drop Location" id="droplocation">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="pwd">Pickup Date & Time:</label>
                            <input type="datetime-local" class="form-control" placeholder="Enter password" id="pickdatetime">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="pwd">Dropoff Date & Time:</label>
                            <input type="datetime-local" class="form-control" placeholder="Enter password" id="dropdatetime">
                        </div>
                    </div>
                    @include('cabdriver')
                </div>
                <button type="submit" class="btn btn-primary" id="bookingbtn">Submit</button>
            </div>
            <div id="menu1" class="tab-pane fade">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">First Name:</label>
                                <input type="text" class="form-control" placeholder="Enter Customer Name" id="mfname">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Last Name:</label>
                                <input type="text" class="form-control" placeholder="Enter Customer Name" id="mlname">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="text" class="form-control" placeholder="Enter Email" id="memail">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Phone No:</label>
                                <input type="text" class="form-control" placeholder="Enter Phone No" id="mphone">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Pickup Location:</label>
                                <input type="text" class="form-control" placeholder="Enter Pickup Location" id="picklocationmulti">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pwd">Pickup Date & Time:</label>
                                <input type="datetime-local" class="form-control" placeholder="Enter password" id="pickdatetimemultu">
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="col-lg-12">
                        <div class="field_wrapper">
                            <div class="row">
                                <div class="col-md-6"><label for="email">Drop Location:</label><input type="text" class="form-control drop-location" name="drop_points[]" value="" placeholder="Drop Point"/></div>
                                <div class="col-md-3">
                                        <label for="email">Waiting Time:</label>
                                        <input type="text" class="form-control waiting-time" name="waiting_time[]" value="" placeholder="Waiting Time"/>

                                </div>
                                <div class="col-md-3"><a href="javascript:void(0);" class="add_button" title="Add field"><i class="fa fa-plus-circle" aria-hidden="true" style="margin-top: 15%;font-size: 26px;"></i></a></div>
                            </div>
                            <br/>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <hr/>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group focused">
                            <label class="form-control-label" for="input-first-name">Category:</label>
                            <select class="form-control category" name="category" id="categorymulti">
                                <option value="">Select Category</option>
                                @foreach($categorylist as $key=>$value)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group focused">
                            <label class="form-control-label" for="input-first-name">Cab Model:</label>
                            <select class="form-control cabmodel" id="cabmodelmulti" name="cabmodel">
                                        <option value="">Select Option</option>

                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group focused">
                            <label class="form-control-label" for="input-first-name">Plate/Vechile Reg No.: <span class="cabplateno"></span></label>

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group focused">
                            <label class="form-control-label" for="input-first-name">Cab Body Number: <span class="cabbodyno"></span></label>

                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group focused">
                            <label class="form-control-label" for="input-first-name">Driver Name:</label>
                            <select class="form-control" name="driver" id="drivermulti">
                                        <option value="">Select Driver</option>
                                        @foreach($driverlist as $key=>$value)
                                            <option value="{{$value->id}}">{{$value->firstname.' '.$value->lastname.'/ Mobile Number : '.$value->mobile}}</option>
                                        @endforeach

                            </select>

                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" id="bookingmultibtn">Submit</button>

            </div>
        </div>

      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<div class="modal" id="bookingdatamodal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Booking Details</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body" id="bookingbody">

      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<div class="modal" id="reportdatamodal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Report Details</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body" id="singlereportbody">

      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>


<!-- cab model -->

<div class="modal" id="cabdatamodal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Cab Details</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body" id="cabDetail">

      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<!-- client Model -->
<div class="modal" id="clientdatamodal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Client Details</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body" id="clientDetail">

      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<!-- cat model -->

<div class="modal" id="catdatamodal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Cab Details</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body" id="catDetail">

      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<!-- cab model -->
<div class="modal" id="myCabModel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">New Cab Detail</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <!--
        <ul class="nav nav-pills nav-justified">
            <li class="active"><a data-toggle="tab" href="#home">Single Drop Point Booking</a></li>
            <li><a data-toggle="tab" href="#menu1">Multiple Drop Point Booking</a></li>
        </ul>
        <br/> -->

        <div class="tab-content">
            <div id="home" class="tab-pane fade in active">

                <div class="form-group">
                        <label for="email">Category:</label>
                        <select name="category_id" id="category_id" class="form-control">
                            <option value="">Select Category</option>
                            @foreach($categorylist as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="email">Plate #/Vehicle Reg #:</label>
                        <input type="text" class="form-control" name="cab_reg_no" id="cab_reg_no" placeholder="Vehicle Reg" id="picklocation">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Vehicle Model: </label>
                        <input type="text" class="form-control" placeholder="Vehicle Model" name="cab_model" id="cab_model">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Cab's Body #:</label>
                        <input type="text" class="form-control" name="body_no" id="body_no" placeholder="Cab Body No." id="pickdatetime">
                    </div>

                    <div class="form-group">
                    <label for="status" class="control-label">Status</label>
                    <select name="status" id="status" class="custom-select selevt form-control">
                    <option value="1" >Active</option>
                    <option value="0">Inactive</option>
                    </select>
                </div>
                    <button type="submit" class="btn btn-primary" id="cabaddbutton">Submit</button>
            </div>

        </div>

      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<!-- driver Model -->
<div class="modal" id="DriverModel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">New Driver Details</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <!--
        <ul class="nav nav-pills nav-justified">
            <li class="active"><a data-toggle="tab" href="#home">Single Drop Point Booking</a></li>
            <li><a data-toggle="tab" href="#menu1">Multiple Drop Point Booking</a></li>
        </ul>
        <br/> -->

        <div class="tab-content">
            <div id="home" class="tab-pane fade in active">


            <div class="form-group">
				<label for="cab_driver" class="control-label">Driver First Name</label>
                <input name="cab_driver" id="cab_driver_fname" type="text" class="form-control rounded-0"  >
			</div>
			<div class="form-group">
				<label for="cab_driver" class="control-label">Driver Last Name</label>
                <input name="cab_driver" id="cab_driver_lname" type="text" class="form-control rounded-0"  >
			</div>
			<div class="form-group">
				<label for="driver_contact" class="control-label">Driver's Email</label>
                <input name="driver_email" id="driver_email" type="email" class="form-control rounded-0"  >
			</div>
			<div class="form-group">
				<label for="driver_contact" class="control-label">Driver's Contact</label>
                <input name="driver_contact" id="driver_contact" type="text" class="form-control rounded-0"  >
			</div>
			<div class="form-group">
				<label for="driver_address" class="control-label">Driver's Address</label>
                <textarea name="driver_address" id="driver_address" type="text" class="form-control rounded-0" ></textarea>
			</div>
			<div class="form-group">
				<label for="password" class="control-label">Driver's Account Password</label>
				<input name="password" id="password" type="password" class="form-control rounded-0" >
			</div>
			<div class="form-group">
				<label for="password" class="control-label">Driver's Licence Number</label>
				<input name="driver_regcode" id="driver_regcode" type="text" class="form-control rounded-0" >
			</div>

            <button type="submit" class="btn btn-primary" id="driveraddbutton">Submit</button>
            </div>

        </div>

      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<!-- add Category -->
<div class="modal" id="catModel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">New Category</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <!--
        <ul class="nav nav-pills nav-justified">
            <li class="active"><a data-toggle="tab" href="#home">Single Drop Point Booking</a></li>
            <li><a data-toggle="tab" href="#menu1">Multiple Drop Point Booking</a></li>
        </ul>
        <br/> -->

        <div class="tab-content">
            <div id="home" class="tab-pane fade in active">


            <div class="form-group">
			<label for="name" class="control-label">Category Name</label>
			<input name="name" id="name" class="form-control rounded-0 form no-resize" >
		</div>
		<div class="form-group">
			<label for="description" class="control-label">Description</label>
			<textarea name="description" id="description" rows="4" class="form-control rounded-0 form no-resize"></textarea>
		</div>
		<div class="form-group">
			<label for="status" class="control-label">Status</label>
			<select name="status" id="status" class="form-control custom-select rounded-0">
				<option value="1" >Active</option>
				<option value="0" >Inactive</option>
			</select>
		</div>
                    <button type="submit" class="btn btn-primary" id="cateaddbutton">Submit</button>
            </div>

        </div>

      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<div class="modal" id="drivervieweditmodal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Driver Details</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body" id="driverbody">

      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<div class="modal" id="cusreportdatamodal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Invoice Details</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body" id="custsinglereportbody">

      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

@parent
@endsection

@section('footer')
@parent
@endsection
