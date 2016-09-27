@extends('dashboard')

@section('title')
    Attendance
@stop

@section('styles')
    {{ HTML::style('assets/css/datatables/jquery.dataTables.css') }}
    {{ HTML::style('assets/css/sa-datetimepicker/bootstrap-datetimepicker.min.css') }}
    {{ HTML::style('assets/css/custom/attendance.css') }}
@stop

@section('main-content')

    @include('attendance-search')

    <div class="col-sm-12 mg-bottom-10px">
        <button class="btn btn-edutrax-cyan roundless" id="search-btn" data-toggle="modal" data-target="#modal-search"><i class="fa fa-search"></i> Search</button>
        <button class="btn btn-edutrax-cyan roundless" id="refresh-btn">Refresh Table / Clear Search</button>
        <a href="{{ URL::route('attendance.create') }}" class="btn btn-edutrax-cyan roundless pull-right"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;&nbsp;Add New</a>
    </div>

    <div class="col-sm-12">

        <table id="datatables" class="table table-bordered table-condensed table-striped">
            <thead>
                <tr>
                    <th>Student No</th>
                    <th>Name</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
        </table>

    </div>

@stop

@section('scripts')
<script type="text/javascript">var base_url = "{{ url() }}";</script>
{{ HTML::script('assets/js/sa-datetimepicker/moment.js') }}
{{ HTML::script('assets/js/sa-datetimepicker/transition.js') }}
{{ HTML::script('assets/js/sa-datetimepicker/collapse.js') }}
{{ HTML::script('assets/js/sa-datetimepicker/bootstrap-datetimepicker.min.js') }}
{{ HTML::script('assets/js/datatables/jquery.dataTables.min.js') }}
{{ HTML::script('assets/js/custom/attendance.js') }}
@stop