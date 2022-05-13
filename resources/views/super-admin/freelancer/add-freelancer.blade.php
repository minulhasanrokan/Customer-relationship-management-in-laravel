@extends('super-admin.template-part.master')
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
                        	<h2>Input New Freelancer Information</h2>
                        	@if(session()->has('success'))
                        	<div style="color:white; background: green;" class="alert alert-primary alert-dismissible fade show">
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
							  {{session()->get('success')}}
							</div>
							@endif
                            <form method="POST" action="{{url('submit-freelancer')}}" enctype="multipart/form-data" style="color:black;">
                            	@csrf
                            	<div class="row">
	                                <div class="form-group col-md-4">
	                                    <label>Freelancer Name</label>
	                                    <input name="name" type="text" class="form-control" placeholder="Customer Name" required >
	                                </div>
	                                <div class="form-group col-md-4">
	                                    <label>Freelancer Phone</label>
	                                    <input type="text" name="phone" class="form-control" placeholder="Customer Phone" required >
	                                </div>
	                                <div class="form-group col-md-4">
	                                    <label>Freelancer Email address</label>
	                                    <input name="email" type="text" class="form-control" placeholder="Customer Email Address" required >
	                                </div>
	                                <div class="form-group col-md-4">
	                                    <label>Freelancer Id</label>
	                                    <input type="text" name="fl_id" class="form-control" placeholder="Freelancer Id" required >
	                                </div>
                                    <div class="form-group col-md-4">
                                        <label>Select Admin</label>
                                        <select name="admin_id" id="admin_id" class="form-control dynamic"  required >
                                            <option value="0">Select Admin</option>
                                            @foreach($admins as $admin)
                                            <option value="{{$admin->id}}">{{$admin->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Select User</label>
                                        <select name="user_id" id="user_id" class="form-control dynamic"  required >
                                            <option value="0">Select User</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Freelancer Division Name</label>
                                        <select name="division_id" id="division_id" class="form-control dynamic"  required >
                                            <option value="0">Select division</option>
                                            @foreach($divisions as $division)
                                            <option value="{{$division->id}}">{{$division->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Freelancer Zila Name</label>
                                        <select name="district_id" id="district_id" class="form-control dynamic"  required >    
                                            <option>Select Zila</option>
                                            
                                        </select>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>Freelancer Thana/Upzila Name</label>
                                        <select name="upzilla_id" id="upzilla_id" class="form-control dynamic" required >   
                                            <option>Select Upzila</option>
                                            
                                        </select>
                                    </div>
                                     <div class="form-group col-md-4">
                                        <label>Freelancer Union Name</label>
                                        <select name="union_id" id="union_id" class="form-control dynamic" required >
                                            <option value="0">Select Union</option>
                                        </select>
                                    </div>
	                                <div class="form-group col-md-4">
	                                    <label>Freelancer Village Name</label>
	                                    <input type="text" name="village" class="form-control" placeholder="Customer Village Name" required>
	                                </div>
	                                <div class="form-group col-md-4">
	                                    <label>Freelancer Home Name/No:</label>
	                                    <input type="text" name="home" class="form-control" placeholder="Customer Home Name/No">
	                                </div>
	                                <div class="form-group col-md-4">
	                                    <label>Freelancer Profession</label>
	                                    <input type="text" name="profession" class="form-control" placeholder="Customer Profession">
	                                </div>
	                                <div class="form-group col-md-4">
	                                    <label>Freelancer Monthly Income</label>
	                                    <input type="number" name="income" class="form-control" placeholder="Customer Monthly Income">
	                                </div>
	                                <div class="form-group col-md-4">
	                                    <label>Freelancer Photo</label>
	                                    <input type="file" name="photo" class="file-input"  >
	                                </div>
	                                <div class="form-group col-md-4">
	                                    <label>Freelancer NID</label>
	                                    <input type="file" name="nid" class="file-input"  >
	                                </div>
	                                <div class="form-group col-md-12">

	                                    <button type="submit" style="margin-top:15px; margin-bottom: 15px; padding-right: 25px; padding-left: 25px; float: right;" type="button" class="btn btn-primary">Add New Freelancer</button>
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

        // when admin dropdown changes get user
        $('#admin_id').change(function() {

            var admin_id = $(this).val();

            if (admin_id) {

                $.ajax({
                    type: "GET",
                    url: "{{ url('getUser') }}/"+ admin_id,
                    success: function(res) {

                        if (res) {

                            $("#user_id").empty();
                            $("#user_id").append('<option>Select User</option>');
                            $.each(res, function(key, value) {
                                $("#user_id").append('<option value="' + key + '">' + value +
                                    '</option>');
                            });

                        } else {

                            $("#user_id").empty();
                        }
                    }
                });
            } else {

                $("#user_id").empty();
            }
        });
</script>
@endpush




