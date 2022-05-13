@extends('user.template-part.master')
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
                        <h1><span>All Leave</span></h1>
                    </div>
                </div>
            </div>
            <!-- /# column -->
            <div class="col-lg-4 p-l-0 title-margin-left">
                <div class="page-header">
                    <div class="page-title">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">All Leave</li>
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
                                
                                <table id="bootstrap-data-table-export" class="table table-striped table-dark text-white table-hover">
                                    <thead>
                                        <tr>
                                            <th>Leave Type</th>
                                            <th>Start date</th>
                                            <th>End date</th>
                                            <th>Toatal date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($all_leaves as $all_leave)
                                        <tr>
                                            <td>
                                                @foreach($holydayTypes as $holydayType)
                                                    @if($holydayType->id==$all_leave->leave_type)
                                                        {{$holydayType->name}}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>{{$all_leave->Start_date}}</td>
                                            <td>{{$all_leave->end_date}}</td>
                                            <td>{{$all_leave->total_date}}</td>
                                            <td>
                                                @if($all_leave->status==0)
                                                Pendding
                                                @elseif($all_leave->status==1)
                                                Un Approved
                                                @elseif($all_leave->status==2)
                                                Approved
                                                @endif
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
    <script type="text/javascript">
        // when upzila dropdown changes
        $('#holydaytype_id').change(function() {

            var holydaytype_id = $(this).val();

            if (holydaytype_id) {

                $.ajax({
                    type: "GET",
                    url: "{{ url('getremainingholyday') }}/"+ holydaytype_id,
                    success: function(res) {

                        $("#RemainingHolyday").html('<label>Total Remaining Leave</label><input name="RemainingHolyday" disabled value="' + res + '"  type="text" class="form-control">');
                    }
                });
            } else {

                $("#RemainingHolyday").empty();
            }
        });
    </script>
    <!-- scripit init-->
@endpush
