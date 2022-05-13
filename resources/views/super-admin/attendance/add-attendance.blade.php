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
                            <form method="POST" action="{{url('add-attendance')}}" style="color:black;">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>Employees By Department</label>
                                        <select name="department" id="department" class="form-control dynamic"  required >
                                            <option value="">Select Department</option>
                                            @foreach($departments as $department)
                                            <option
                                            @if($department_id==$department->id)
                                            {{"Selected"}}
                                            @endif
                                            value="{{$department->id}}">{{$department->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Date</label>
                                        <input type="date" name="date" class="form-control" placeholder="Customer Phone" required value="{{$date}}">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <button style="width:100%; margin-top: 28px;" type="submit" type="button" class="btn btn-primary">Get Employee List</button>
                                    </div>
                                    
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="bootstrap-data-table-panel">
                    <div class="table-responsive">
                        @if(session()->has('success'))
                            <div style="color:white; background: green;" class="alert alert-primary alert-dismissible fade show">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                              {{session()->get('success')}}
                            </div>
                            @endif
                        <form action="{{url('submit-attendance')}}" method="POST">
                        @csrf
                        <table id="bootstrap-data-table-export" class="table table-striped table-dark text-white table-hover">
                            <thead>
                                <tr>
                                    <th>Serial</th>
                                    <th>Date</th>
                                    <th>Name</th>
                                    <th>Department</th>
                                    <th>Designation</th>
                                    <th>In Time</th>
                                    <th>Out Time</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach($users as $user)
                              
                                <tr>
                                    <td>{{$serial++}}</td>
                                    <td>{{$date}}<input type="hidden" name="date[]" value="{{$date}}"></td>
                                    <td>{{$user->name}}-{{$user->emp_id}}</td>
                                    <input type="hidden" name="user_id[]" value="{{$user->id}}">
                                    <td>
                                        @foreach($departments as $department)
                                        @if($department->id==$user->department)
                                        {{$department->name}}
                                        @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($designations as $designation)
                                        @if($designation->id==$user->designation)
                                        {{$designation->name}}
                                        @endif
                                        @endforeach
                                    </td>
                                    <td><input type="time" name="in_time[]" value="00:00"></td>
                                    <td>
                                        <input type="time" name="out_time[]" value="00:00">
                                    </td>
                                    <td>
                                        <select style="background: white;" name="status[]" id="attendence_status" class="form-control dynamic custom-select" >
                                            <option value="">Select Status</option>
                                            <option value="Present">Present</option>
                                            <option value="Late">Late</option>
                                            <option value="Absent">Absent</option>
                                            <option value="On Leave">On Leave</option>
                                    </td>
                                </tr>
                              
                                
                                @endforeach
                            </tbody>
                        </table>
                        <div class="form-group col-md-12">
                            <button type="submit" style="margin-top:15px; margin-bottom: 15px; padding-right: 25px; padding-left: 25px; float: right;" type="button" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
            <!-- /# card -->
        </div>
        <!-- /# column -->
    </div>
    <!-- /# row -->
    </div>
</div>
@endsection

@push('css')
<link href="./css/lib/font-awesome.min.css" rel="stylesheet">
<link href="./css/lib/themify-icons.css" rel="stylesheet">

 <link href="./css/lib/bootstrap.min.css" rel="stylesheet">
<link href="./css/lib/helper.css" rel="stylesheet">
<link href="./css/style.css" rel="stylesheet">

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

@endpush

