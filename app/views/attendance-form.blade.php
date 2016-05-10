@extends('dashboard')

@section('title')
    New Attendance Data
@stop

@section('styles')
    {{ HTML::style('assets/css/icheck/skins/square/edutrax.css') }}
    {{ HTML::style('assets/css/sa-datetimepicker/bootstrap-datetimepicker.min.css') }}
    {{ HTML::style('assets/css/custom/attendance-form.css') }}
@stop

@section('main-content')

    @if(isset($model))
        {{ Form::model($model, array('method' => 'PUT', 'id' => 'attendance-form', 'route' => array('attendance.update', $model->id), 'autocomplete' => 'off')) }}
    @else
        {{ Form::open(array('method' => 'POST', 'id' => 'attendance-form', 'url' => 'attendance', 'autocomplete' => 'off')) }}
    @endif

            <div class="col-sm-4">
                <div class="form-group attendance-form">
                    <div class='input-group date' id='attendanceDate'>
                        {{ Form::text('date', null, array('class' => 'form-control', 'readonly')) }}
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                    {{ $errors->first('date', '<div class="text-danger">:message</div>') }}
                </div>
            </div>

            <div class="col-sm-4 col-sm-offset-4">
                <div class="form-group text-right">
                    {{ Form::submit('Save', array('class' => 'btn roundless btn-edutrax-cyan')) }}
                </div>
            </div>

            <div class="col-sm-12">
                <table id="table-attendance" class="table table-condensed table-striped">
                    <tr>
                        <th class="col-sm-6">Student Information</th>
                        <th class="col-sm-3">
                            <div class="col-sm-3 paddingless">{{ Form::checkbox('chAtt', 'on', true, array('id' => 'chAtt')) }}</div>
                            <div class="col-sm-9 paddingless">Attendance</div>
                        </th>
                        <th class="col-sm-3">
                            <div class="col-sm-3 paddingless">{{ Form::checkbox('chApp', 'on', true, array('id' => 'chApp')) }}</div>
                            <div class="col-sm-9 paddingless">Apparel</div>
                        </th>
                    </tr>

                    @foreach($students as $index => $student)

                        <tr>
                            <td class="student-information">
                                <img src="{{ asset($student->photo) }}" />
                                <span class="student-name">{{ ucwords(strtolower($student->first_name.' '.$student->last_name)) }}</span><br />
                                <span class="student-no">{{ $student->student_no }}</span>
                            </td>
                            <td>
                                <div class="form-group">
                                    <div class="col-sm-3 paddingless pd-top-5px">
                                        {{ Form::checkbox('att_'.$student->id, '08:00', true, array('class' => 'studentsAttendance')) }}
                                    </div>
                                    <div class="col-sm-9 paddingless">
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
                                    <div class="col-sm-3 paddingless pd-top-5px">
                                        {{ Form::checkbox('app_'.$student->id, 'ok', true, array('class' => 'studentsApparel')) }}
                                    </div>
                                    <div class="col-sm-9 paddingless">
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
    {{ HTML::script('assets/js/custom/attendance-form.js') }}
@stop