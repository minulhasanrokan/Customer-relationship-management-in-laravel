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
                        	<h2>Input project Information</h2>
                        	@if(session()->has('success'))
                        	<div style="color:white; background: green;" class="alert alert-primary alert-dismissible fade show">
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
							  {{session()->get('success')}}
							</div>
							@endif
                            <form method="POST" action="{{url('submit-project')}}" enctype="multipart/form-data" style="color:black;">
                            	@csrf
                            	<div class="row">
	                                <div class="form-group col-md-4">
	                                    <label>Project Name</label>
	                                    <input name="name" type="text" class="form-control" placeholder="Project Name" required >
	                                </div>
	                                <div class="form-group col-md-4">
	                                    <label>Project Type</label>
	                                    <select name="type" id="type" class="form-control dynamic" required >
	                                    	<option value="0">Project Type</option>
	                                    	@foreach($project_types as $project_type)
											<option value="{{$project_type->id}}">{{$project_type->project_type}}</option>
											@endforeach
										</select>
	                                </div>
	                                <div class="form-group col-md-4">
	                                    <label>Project Address</label>
	                                    <input name="address" type="text" class="form-control" placeholder="Project Address" required >
	                                </div>

	                                <div class="form-group col-md-4">
	                                    <label>Project Total Flat</label>
	                                    <input type="number" name="flat" class="form-control" required >
	                                </div>

	                                 <div class="form-group col-md-4">
	                                    <label>Project Total Shop</label>
	                                    <input type="number" name="shop" class="form-control"  required >
	                                </div>
	                                <div class="form-group col-md-4">
	                                    <label>Project Total Garage</label>
	                                    <input type="number" name="garage" class="form-control" required>
	                                </div>
	            
	                                <div class="form-group col-md-4">
	                                    <label>Project 3D Image</label>
	                                    <input type="file" name="photo" class="file-input"  >
	                                </div>
	                                <div class="form-group col-md-4">
	                                    <label>Project Brochure</label>
	                                    <input type="file" name="brochure" class="file-input"  >
	                                </div>
	                                <div class="form-group col-md-4">
	                                    <label>Project Video Documment</label>
	                                    <input type="file" name="video" class="file-input"  >
	                                </div>
	                                <div class="form-group col-md-12">
	                                    <label>Project Details</label>
	                                    <textarea name="details" placeholder="Project Details" class="form-control"></textarea>
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
@endpush




