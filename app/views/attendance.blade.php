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
                {{ Form::model($model, array('method' => 'PUT', 'route' => array('attendance.update', $model->id), 'autocomplete' => 'off')) }}
            @else
                {{ Form::open(array('method' => 'POST', 'url' => 'attendance', 'autocomplete' => 'off')) }}
            @endif

                    <div class="col-lg-6">
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

                    <div class="col-lg-6 text-right">
                        <div class="form-group">
                            {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <table class="table table-bordered table-hover">
                            <tr>
                                <th class="col-lg-1">#</th>
                                <th class="col-lg-2">Student ID</th>
                                <th class="col-lg-5">Student</th>
                                <th class="col-lg-2">{{ Form::checkbox('chAtt', 'on', true, array('id' => 'chAtt')) }}&nbsp;&nbsp;&nbsp;Attendance</th>
                                <th class="col-lg-2">{{ Form::checkbox('chApp', 'on', true, array('id' => 'chApp')) }}&nbsp;&nbsp;&nbsp;Apparel</th>
                            </tr>
                            @foreach($students as $index => $student)
                                <tr>
                                    <td>{{ $index+1; }}</td>
                                    <td>
                                        {{ $student->student_no }}
                                        {{ Form::hidden('student_id['.$index.']', $student->id) }}
                                    </td>
                                    <td>{{ ucwords(strtolower($student->first_name.' '.$student->last_name)) }}</td>
                                    <td>
                                        <div class="form-group">
                                            <div class="col-lg-3 paddingless pd-top-5px">
                                                {{ Form::checkbox('att_'.$student->id, '08:00', true, array('class' => 'studentsAttendance')) }}
                                            </div>
                                            <div class="col-lg-9 paddingless">
                                                <div class="input-group date attLate">
                                                    {{ Form::text('att_late_'.$student->id, null, array('class' => 'form-control', 'placeholder' => 'if late', 'readonly')) }}
                                                    <span class="input-group-addon">
                                                        <span class="glyphicon glyphicon-time"></span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        {{ $errors->first('att_late_'.$student->id, '<div class="text-danger txt-size-10px pd-top-25px">:message</div>') }}
                                    </td>
                                    <td>
                                        <div class="form-group ">
                                            <div class="col-lg-3 paddingless pd-top-5px">
                                                {{ Form::checkbox('app_'.$student->id, 'ok', true, array('class' => 'studentsApparel')) }}
                                            </div>
                                            <div class="col-lg-9 paddingless">
                                                {{ Form::text('app_desc_'.$student->id, null, array('class' => 'form-control', 'placeholder' => 'description')) }}
                                            </div>
                                        </div>
                                        {{ $errors->first('app_desc_'.$student->id, '<div class="text-danger txt-size-10px pd-top-25px">:message</div>') }}
                                    </td>
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
<script type="text/javascript">
    var curDate = "{{ date('Y-M-d') }}";
</script>
{{ HTML::script('assets/js/icheck/icheck.min.js') }}
{{ HTML::script('assets/js/sa-datetimepicker/moment.js') }}
{{ HTML::script('assets/js/sa-datetimepicker/transition.js') }}
{{ HTML::script('assets/js/sa-datetimepicker/collapse.js') }}
{{ HTML::script('assets/js/sa-datetimepicker/bootstrap-datetimepicker.min.js') }}
{{ HTML::script('assets/js/index-pages/attendance.js') }}
@stop