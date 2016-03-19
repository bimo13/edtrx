@extends('dashboard')

@section('styles')
{{ HTML::style('assets/css/icheck/skins/square/orange.css') }}
{{ HTML::style('assets/css/sa-datetimepicker/bootstrap-datetimepicker.min.css') }}
@stop

@section('web-content')

<div class="container-fluid">
    <div class="col-sm-12">
        <div class="main-form-wrapper" >
            @if(isset($model))
                {{ Form::model($model, array('method' => 'PUT', 'route' => array('agenda.update', $model->id), 'autocomplete' => 'off')) }}
            @else
                {{ Form::open(array('method' => 'POST', 'url' => 'agenda', 'autocomplete' => 'off')) }}
            @endif

                    <div class="col-lg-6">
                        <div class="form-group">
                            <div class='input-group date' id='attendanceDate'>
                                {{ Form::text('date', null, array('class' => 'form-control', 'readonly')) }}
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                            {{ $errors->first('date', '<div class="text-danger">:message</div>') }}
                        </div>
                    </div>

                    <div class="col-lg-6 text-right">
                        <div class="form-group">
                            {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <table class="table table-bordered table-hover">
                            <tr>
                                <th>#</th>
                                <th>Student ID</th>
                                <th>Student</th>
                                <th>{{ Form::checkbox('chAtt', 'on', true, array('class' => 'chAtt')) }}&nbsp;&nbsp;&nbsp;Attendance</th>
                                <th>{{ Form::checkbox('chApp', 'on', true, array('class' => 'chApp')) }}&nbsp;&nbsp;&nbsp;Apparel</th>
                            </tr>
                            @foreach($students as $index => $student)
                                <tr>
                                    <td>{{ $index+1; }}</td>
                                    <td>{{ $student->student_no }}</td>
                                    <td>{{ ucwords(strtolower($student->first_name.' '.$student->last_name)) }}</td>
                                    <td>{{ Form::checkbox('att_'.$student->id, '08:00', true, array('class' => 'studentsAttendance')) }}</td>
                                    <td>{{ Form::checkbox('app_'.$student->id, 'ok', true, array('class' => 'studentsApparel')) }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>

            <!-- conditional-lines indent -->
                {{ Form::close() }}
            <!-- conditional-lines indent -->
        </div>
    </div>
</div>

@stop

@section('scripts')
{{ HTML::script('assets/js/icheck/icheck.min.js') }}
{{ HTML::script('assets/js/sa-datetimepicker/moment.js') }}
{{ HTML::script('assets/js/sa-datetimepicker/transition.js') }}
{{ HTML::script('assets/js/sa-datetimepicker/collapse.js') }}
{{ HTML::script('assets/js/sa-datetimepicker/bootstrap-datetimepicker.min.js') }}
<script type="text/javascript">
    $(function () {
        $('#attendanceDate').datetimepicker({
            format: 'YYYY/MM/DD',
            ignoreReadonly: true,
            defaultDate: '{{ date("Y-M-d") }}'
        });

        $(document).ready(function(){
            $('.chAtt, .chApp, .studentsAttendance, .studentsApparel').iCheck({
                checkboxClass: 'icheckbox_square-orange',
                radioClass: 'iradio_square-orange',
                increaseArea: '20%' // optional
            });
        });
    });
</script>
@stop