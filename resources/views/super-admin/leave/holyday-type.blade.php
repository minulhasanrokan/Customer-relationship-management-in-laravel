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
                            <h2>Input Holiday Type Information</h2>
                            @if(session()->has('success'))
                            <div style="color:white; background: green;" class="alert alert-primary alert-dismissible fade show">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                              {{session()->get('success')}}
                            </div>
                            @endif
                            <form method="POST" action="{{url('submit-holiday-type')}}" enctype="multipart/form-data" style="color:black;">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label>Name of Holiday Type</label>
                                        <input name="name" type="text" class="form-control" placeholder="Name of Holiday Type" required >
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Total day</label>
                                        <input name="total_day" type="number" class="form-control" placeholder="10" required >
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label>Status of Holiday Type</label>
                                        <select name="Status" class="form-control">
                                            <option>Select Status</option>
                                            <option value="1">Active</option>
                                            <option value="0">In Active</option>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group col-md-12">
                                        <button type="submit" style="margin-top:15px; margin-bottom: 15px; padding-right: 25px; padding-left: 25px; float: right;" type="button" class="btn btn-primary">Add New Holiday Type</button>
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
@endpush
