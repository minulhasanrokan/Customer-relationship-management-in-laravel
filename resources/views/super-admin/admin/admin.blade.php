@extends('super-admin.template-part.master')
<!--**********************************
    Content body start
***********************************-->
@section('content')
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 p-r-0 title-margin-right">
                <div class="page-header">
                    <div class="page-title">
                        <h1><span>All Admin List</span></h1>
                    </div>
                </div>
            </div>
            <!-- /# column -->
            <div class="col-lg-4 p-l-0 title-margin-left">
                <div class="page-header">
                    <div class="page-title">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Genarel Contact</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /# column -->
        </div>
        <!-- /# row -->
        <section id="main-content">
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
                                @elseif(session()->has('error'))
                                <div style="color:white; background: red;" class="alert alert-primary alert-dismissible fade show">
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                  {{session()->get('error')}}
                                </div>
                                @endif
                                <table id="bootstrap-data-table-export" class="table table-striped table-dark text-white table-hover">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>EMP-ID</th>
                                            <th>Designation</th>
                                            <th>Mobile Number</th>
                                            <th>E-mail</th>
                                            <th>Zoone</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($admins as $admin)
                                        <tr>
                                            <td>{{$admin->name}}</td>
                                            <td>{{$admin->emp_id}}</td>
                                            <td>{{$admin->designation}}</td>
                                            <td>{{$admin->phone}}</td>
                                            <td>{{$admin->email}}</td>
                                            <td>{{$admin->zone}}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{url('view-admin-details',$admin->id)}}"><button type="button" class="btn btn-secondary">Details</button></a> 
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /# card -->
                </div>
                <!-- /# column -->
            </div>
            <!-- /# row -->
        </section>
    </div>
</div>
@endsection

@push('css')
<link href="./css/lib/font-awesome.min.css" rel="stylesheet">
<link href="./css/lib/themify-icons.css" rel="stylesheet">
<link href="./css/lib/data-table/buttons.bootstrap.min.css" rel="stylesheet" />
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
    <!-- Required vendors -->
    <script src="./vendor/global/global.min.js"></script>
    <script src="./js/quixnav-init.js"></script>
    <script src="./js/custom.min.js"></script>

    <script src="./js/lib/bootstrap.min.js"></script><script src="./js/scripts.js"></script>
    <!-- scripit init-->
    <script src="./js/lib/data-table/datatables.min.js"></script>
    <script src="./js/lib/data-table/dataTables.buttons.min.js"></script>
    <script src="./js/lib/data-table/buttons.flash.min.js"></script>
    <script src="./js/lib/data-table/jszip.min.js"></script>
    <script src="./js/lib/data-table/pdfmake.min.js"></script>
    <script src="./js/lib/data-table/vfs_fonts.js"></script>
    <script src="./js/lib/data-table/buttons.html5.min.js"></script>
    <script src="./js/lib/data-table/buttons.print.min.js"></script>
    <script src="./js/lib/data-table/datatables-init.js"></script>
@endpush