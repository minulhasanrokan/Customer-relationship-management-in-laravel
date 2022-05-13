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
                            <h2>Input Notice Information</h2>
                            @if(session()->has('success'))
                            <div style="color:white; background: green;" class="alert alert-primary alert-dismissible fade show">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                              {{session()->get('success')}}
                            </div>
                            @endif
                            <form method="POST" action="{{url('submit-notice')}}" enctype="multipart/form-data" style="color:black;">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>Select Department</label>
                                        <select name="department_id" id="department_id" class="form-control dynamic"  required >
                                            <option value="">Select Department</option>
                                            <option value="0">All Department</option>
                                            @foreach($departments as $department)
                                            <option value="{{$department->id}}">{{$department->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Select Department</label>
                                        <select name="employee_id" id="employee_id" class="form-control dynamic"  required >
                                            <option value="">Select Employee</option>
                                            <option value="0">All Employee</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Notice Date</label>
                                        <input name="date" type="date" class="form-control" placeholder="Customer Name" required >
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Notice Title</label>
                                        <input name="title" type="text" class="form-control" placeholder="Customer Name" required >
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Notice DEtails</label>
                                        <textarea name="details" placeholder="Notice Details" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group col-md-12">
	                                    <label>Notice File</label>
	                                    <input type="file" name="file" class="file-input"  >
	                                </div>
                                    <div class="form-group col-md-12">
                                        <button type="submit" style="margin-top:15px; margin-bottom: 15px; padding-right: 25px; padding-left: 25px; float: right;" type="button" class="btn btn-primary">Add New Notice</button>
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
<link href="./css/lib/font-awesome.min.css" rel="stylesheet">
<link href="./css/lib/themify-icons.css" rel="stylesheet">

 <link href="./css/lib/bootstrap.min.css" rel="stylesheet">
<link href="./css/lib/helper.css" rel="stylesheet">
<link href="./css/style.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<style type="text/css">
    
  table.dataTable thead th {
        color: white !important;
    }
    .dataTables_length{
        padding: 10px !important
    }
    .dataTables_filter{
        padding: 10px !important
    }
    .dt-buttons{
        padding: 10px !important
    }
</style>
@endpush

@push('scripts')
    <script src="./vendor/global/global.min.js"></script>
    <script src="./js/quixnav-init.js"></script>
    <script src="./js/custom.min.js"></script>

    <script src="./js/lib/bootstrap.min.js"></script><script src="./js/scripts.js"></script>
    <!-- scripit init-->
    <script>
        // when user dropdown changes
        $('#department_id').change(function() {

            var department_id = $(this).val();

            if (department_id) {

                $.ajax({
                    type: "GET",
                    url: "{{ url('getUserid') }}/"+ department_id,
                    success: function(res) {

                        if (res) {

                            $("#employee_id").empty();
                            $("#employee_id").append('<option value="0">All Employee</option>');
                            $.each(res, function(key, value) {
                                $("#employee_id").append('<option value="' + key + '">' + value +
                                    '</option>');
                            });

                        } else {

                            $("#employee_id").empty();
                        }
                    }
                });
            } else {

                $("#employee_id").empty();
            }
        });
    </script>

@endpush
