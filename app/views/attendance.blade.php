@extends('dashboard')

@section('styles')
{{ HTML::style('assets/css/datatables/jquery.dataTables.css') }}
{{ HTML::style('assets/css/sa-datetimepicker/bootstrap-datetimepicker.min.css') }}
@stop

@section('web-content')
<div class="container-fluid">
    <!-- ======================================================================================== -->
    <div class="col-lg-3 text-right">
        View by date:
    </div>
    <div class="col-lg-7">
        <div class="form-group">
            <div class="input-group date" id="attendanceDate">
                {{ Form::text('date', null, array('class' => 'form-control', 'readonly')) }}
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
            {{ $errors->first('date', '<div class="text-danger">:message</div>') }}
        </div>
    </div>
    <div class="col-lg-2">
        <div class="form-group">
            {{ Form::submit('Submit', array('class' => 'btn btn-primary btn-block')) }}
        </div>
    </div>
    <!-- ======================================================================================== -->
    <div class="col-sm-6">
        <button data-toggle="modal" data-target="#modal-search" class="btn btn-flat" id="search-btn"><i class="fa fa-search"></i> Search</button>
        <button class="btn btn-flat" id="refresh-btn">Refresh Table / Clear Search</button>
    </div>
    <div class="col-sm-6 text-right">
        <button class="btn btn-flat" onclick="window.location.href='{{ URL::route('attendance.create') }}'"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;&nbsp;Add New</button>
    </div>
    <div class="col-lg-12">

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
</div>
@stop

@section('scripts')
<script type="text/javascript">var base_url = "{{ url() }}";</script>
{{ HTML::script('assets/js/icheck/icheck.min.js') }}
{{ HTML::script('assets/js/sa-datetimepicker/moment.js') }}
{{ HTML::script('assets/js/sa-datetimepicker/transition.js') }}
{{ HTML::script('assets/js/sa-datetimepicker/collapse.js') }}
{{ HTML::script('assets/js/sa-datetimepicker/bootstrap-datetimepicker.min.js') }}
{{ HTML::script('assets/js/datatables/jquery.dataTables.min.js') }}
{{ HTML::script('assets/js/index-pages/attendance.js') }}
@stop