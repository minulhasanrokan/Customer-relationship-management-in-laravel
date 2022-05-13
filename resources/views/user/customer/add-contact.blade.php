@extends('user.template-part.master')
<!--**********************************
    Content body start
***********************************-->
@section('content')
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="basic-form">
                        	<h2>Input Customer Information</h2>
                        	@if(session()->has('success'))
                        	<div style="color:white; background: green;" class="alert alert-primary alert-dismissible fade show">
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
							  {{session()->get('success')}}
							</div>
							@endif
                            <form method="POST" action="{{url('submit-customer')}}" enctype="multipart/form-data" style="color:black;">
                            	@csrf
                            	<div class="row">
	                                <div class="form-group col-md-4">
	                                    <label>Customer Name</label>
	                                    <input name="name" type="text" class="form-control" placeholder="Customer Name" required >
	                                </div>
	                                <div class="form-group col-md-4">
	                                    <label>Customer Phone</label>
	                                    <input type="text" name="phone" class="form-control" placeholder="Customer Phone" required >
	                                </div>
	                                <div class="form-group col-md-4">
	                                    <label>Customer Email address</label>
	                                    <input name="email" type="text" class="form-control" placeholder="Customer Email Address" required >
	                                </div>
	                                <div class="form-group col-md-4">
	                                    <label>Freelancer</label>
	                                    <select name="fl_id" id="fl_id" class="form-control dynamic"  required >
											<option value="0">Select Freelancer</option>
											@foreach($freelancers as $freelancer)
											<option value="{{$freelancer->id}}">{{$freelancer->name}}--{{$freelancer->fl_id}}</option>
											@endforeach
										</select>
	                                </div>
	                                <div class="form-group col-md-4">
	                                    <label>Interested Project Name</label>
	                                    <select name="project_id" id="project_id" class="form-control dynamic"  required >
											<option value="0">Select Project</option>
											@foreach($projects as $project)
											<option value="{{$project->id}}">{{$project->name}}</option>
											@endforeach
										</select>
	                                </div>
	                                <div class="form-group col-md-4">
	                                    <label>Customer Division Name</label>
	                                    <select name="division_id" id="division_id" class="form-control dynamic"  required >
											<option value="0">Select division</option>
											@foreach($divisions as $division)
											<option value="{{$division->id}}">{{$division->name}}</option>
											@endforeach
										</select>
	                                </div>
	                                <div class="form-group col-md-4">
	                                    <label>Customer Zila Name</label>
	                                    <select name="district_id" id="district_id" class="form-control dynamic"  required >	
	                                    	<option>Select Zila</option>
											
										</select>
	                                </div>

	                                <div class="form-group col-md-4">
	                                    <label>Customer Thana/Upzila Name</label>
	                                    <select name="upzilla_id" id="upzilla_id" class="form-control dynamic" required >	
	                                    	<option>Select Upzila</option>
											
										</select>
	                                </div>
	                                 <div class="form-group col-md-4">
	                                    <label>Customer Union Name</label>
	                                    <select name="union_id" id="union_id" class="form-control dynamic" required >
											<option value="0">Select Union</option>
										</select>
	                                </div>
	                                <div class="form-group col-md-4">
	                                    <label>Customer Village Name</label>
	                                    <input type="text" name="village" class="form-control" placeholder="Customer Village Name" required>
	                                </div>
	                                <div class="form-group col-md-4">
	                                    <label>Customer Home Name/No:</label>
	                                    <input type="text" name="home" class="form-control" placeholder="Customer Home Name/No">
	                                </div>
	                                <div class="form-group col-md-4">
	                                    <label>Customer Profession</label>
	                                    <input type="text" name="profession" class="form-control" placeholder="Customer Profession">
	                                </div>
	                                <div class="form-group col-md-4">
	                                    <label>Customer Monthly Income</label>
	                                    <input type="number" name="income" class="form-control" placeholder="Customer Monthly Income">
	                                </div>
	                                <div class="form-group col-md-4">
	                                    <label>Customer Photo</label>
	                                    <input type="file" name="photo" class="file-input"  >
	                                </div>
	                                <div class="form-group col-md-4">
	                                    <label>Customer NID</label>
	                                    <input type="file" name="nid" class="file-input"  >
	                                </div>
	                                <div class="form-group col-md-4">
	                                    <label>Customer Other Document</label>
	                                    <input type="file" name="document" class="file-input"  >
	                                </div>
	                                <div class="form-group col-md-12">

	                                    <button type="submit" style="margin-top:15px; margin-bottom: 15px; padding-right: 25px; padding-left: 25px; float: right;" type="button" class="btn btn-primary">Add New Customer</button>
	                                </div>
	                                
                            	</div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
<link rel="stylesheet" href="./vendor/owl-carousel/css/owl.theme.default.min.css">
<link href="./css/style.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endpush

@push('scripts')
    <!-- Required vendors -->
    <script src="./vendor/global/global.min.js"></script>
    <script src="./js/quixnav-init.js"></script>
    <script src="./js/custom.min.js"></script>
    <script>
        // when district dropdown changes
        $('#division_id').change(function() {

            var division_id = $(this).val();

            if (division_id) {

                $.ajax({
                    type: "GET",
                    url: "{{ url('getDistrict') }}/"+ division_id,
                    success: function(res) {

                        if (res) {

                            $("#district_id").empty();
                            $("#district_id").append('<option>Select Zila</option>');
                            $.each(res, function(key, value) {
                                $("#district_id").append('<option value="' + key + '">' + value +
                                    '</option>');
                            });

                        } else {

                            $("#district_id").empty();
                        }
                    }
                });
            } else {

                $("#district_id").empty();
            }
        });


        // when upzila dropdown changes
        $('#district_id').change(function() {

            var district_id = $(this).val();

            if (district_id) {

                $.ajax({
                    type: "GET",
                    url: "{{ url('getUpzila') }}/"+ district_id,
                    success: function(res) {

                        if (res) {

                            $("#upzilla_id").empty();
                            $("#upzilla_id").append('<option>Select Upzila</option>');
                            $.each(res, function(key, value) {
                                $("#upzilla_id").append('<option value="' + key + '">' + value +
                                    '</option>');
                            });

                        } else {

                            $("#upzilla_id").empty();
                        }
                    }
                });
            } else {

                $("#upzilla_id").empty();
            }
        });

        // when upzila dropdown changes
        $('#upzilla_id').change(function() {

            var upzilla_id = $(this).val();

            if (upzilla_id) {

                $.ajax({
                    type: "GET",
                    url: "{{ url('getUnion') }}/"+ upzilla_id,
                    success: function(res) {

                        if (res) {

                            $("#union_id").empty();
                            $("#union_id").append('<option>Select Union</option>');
                            $.each(res, function(key, value) {
                                $("#union_id").append('<option value="' + key + '">' + value +
                                    '</option>');
                            });

                        } else {

                            $("#union_id").empty();
                        }
                    }
                });
            } else {

                $("#union_id").empty();
            }
        });
</script>
@endpush




