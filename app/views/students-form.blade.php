@extends('dashboard')

@section('title')
    Add New Student
@stop

@section('styles')
    {{ HTML::style('assets/css/sa-datetimepicker/bootstrap-datetimepicker.min.css') }}
    {{ HTML::style('assets/css/custom/students-form.css') }}
@stop

@section('main-content')

    @if(isset($model))
        {{ Form::model($model, array('method' => 'PUT', 'id' => 'student-form', 'files' => true, 'autocomplete' => 'off', 'route' => array('students.update', $model->id))) }}
            {{ Form::hidden('id', $model->id, ['id' => 'id']) }}
    @else
        {{ Form::open(array('method' => 'POST', 'id' => 'student-form', 'url' => 'students', 'files' => true, 'autocomplete' => 'off')) }}
    @endif

            @if(isset($model))
                {{ Form::hidden('id', $model->id, ['id' => 'id']) }}
            @endif

            {{ Form::hidden('teacher_id', Sentry::getUser()->id) }}
            <div class="col-sm-4">
                {{ Form::label('student_no', 'Student No:') }}
                <div class="form-group student-form">
                    {{ Form::text('student_no', null, array('class' => 'form-control')) }}
                </div>
                {{ $errors->first('student_no', '<div class="text-danger flash-error">:message</div>') }}
            </div>

            <div class="col-sm-4">
                {{ Form::label('first_name', 'First Name:') }}
                <div class="form-group student-form">
                    {{ Form::text('first_name', null, array('class' => 'form-control')) }}
                </div>
                {{ $errors->first('first_name', '<div class="text-danger flash-error">:message</div>') }}
            </div>

            <div class="col-sm-4">
                {{ Form::label('last_name', 'Last Name:') }}
                <div class="form-group student-form">
                    {{ Form::text('last_name', null, array('class' => 'form-control')) }}
                </div>
                {{ $errors->first('last_name', '<div class="text-danger flash-error">:message</div>') }}
            </div>

            <div class="col-sm-12">
                {{ Form::label('address', 'Address:') }}
                <div class="form-group student-form">
                    @if(isset($model))
                        {{ Form::textarea('address', null, array('class' => 'form-control')) }}
                    @else
                        {{ Form::textarea('address', null, array('class' => 'form-control')) }}
                    @endif
                </div>
                {{ $errors->first('address', '<div class="text-danger flash-error">:message</div>') }}
            </div>

            <div class="col-sm-6">
                {{ Form::label('phone', 'Phone Number:') }}
                <div class="form-group student-form">
                    <div class="input-group">
                        <span class="input-group-addon">+62</span>
                        {{ Form::text('phone', null, array('class' => 'form-control')) }}
                    </div>
                </div>
                {{ $errors->first('phone', '<div class="text-danger flash-error">:message</div>') }}
            </div>

            <div class="col-sm-6">
                {{ Form::label('ice_number', 'In-Case-of-Emergency Number:') }}
                <div class="form-group student-form">
                    <div class="input-group">
                        <span class="input-group-addon">+62</span>
                        {{ Form::text('ice_number', null, array('class' => 'form-control')) }}
                    </div>
                </div>
                {{ $errors->first('ice_number', '<div class="text-danger flash-error">:message</div>') }}
            </div>

            <div class="col-sm-6">
                {{ Form::label('birth_place', 'Birth Place:') }}
                <div class="form-group student-form">
                    {{ Form::text('birth_place', null, array('class' => 'form-control')) }}
                </div>
                {{ $errors->first('birth_place', '<div class="text-danger flash-error">:message</div>') }}
            </div>

            <div class="col-sm-6">
                {{ Form::label('birth_date', 'Birth Date:') }}
                <div class="form-group student-form">
                    <div class='input-group date' id='birthDate'>
                        {{ Form::text('birth_date', null, array('class' => 'form-control', 'id' => 'birth_date')) }}
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
                {{ $errors->first('birth_date', '<div class="text-danger flash-error">:message</div>') }}
            </div>

            <div class="col-sm-6">
                {{ Form::label('gender', 'Gender:') }}
                <div class="form-group student-form">
                    {{ Form::select('gender', $genders, null, ['class' => 'form-control']) }}
                </div>
                {{ $errors->first('gender', '<div class="text-danger flash-error">:message</div>') }}
            </div>

            <div class="col-sm-6">
                {{ Form::label('parent_id', 'Parent Name/ID:') }}
                <div class="form-group student-form">
                    {{ Form::select('parent_id', $parents, null, ['class' => 'form-control']) }}
                </div>
                {{ $errors->first('parent_id', '<div class="text-danger flash-error">:message</div>') }}
            </div>

            @if(isset($model))
                @if($model->photo != NULL && $model->photo != NULL )
                    <div class="col-sm-2">
                        <div class="form-group student-form">
                            <img src="{{ asset($model->photo); }}" class="wd-full" />
                        </div>
                    </div>
                    <div class="clear"></div>
                @endif
            @endif

            <div class="col-sm-6">
                {{ Form::label('photo', 'Student\'s Photo:') }}
                <div class="form-group student-form">
                    {{ Form::file('photo', array('class' => 'filestyle', 'data-buttonText' => '&nbsp;&nbsp;Browse', 'data-buttonName' => 'btn-edutrax-cyan')) }}
                </div>
                {{ $errors->first('photo', '<div class="text-danger flash-error">:message</div>') }}
            </div>

            <div class="col-sm-6">
                {{ Form::label('class_id', 'Class Name/ID:') }}
                <div class="form-group student-form">
                    {{ Form::select('class_id', $class_id, null, ['class' => 'form-control']) }}
                </div>
                {{ $errors->first('class_id', '<div class="text-danger">:message</div>') }}
            </div>

            <div class="col-lg-12">
                <div class="form-group text-right">
                    {{ Form::submit('Save', array('class' => 'btn roundless btn-edutrax-cyan')) }}
                    <a href="{{ URL::route('students.index') }}" class="btn roundless btn-edutrax-grey">Cancel</a>
                </div>
            </div>

    <!-- conditional-lines indent -->
        {{ Form::close() }}
    <!-- conditional-lines indent -->
@stop

@section('scripts')
    {{ HTML::script('assets/js/forms.filestyle.js') }}
    {{ HTML::script('assets/js/sa-datetimepicker/moment.js') }}
    {{ HTML::script('assets/js/sa-datetimepicker/transition.js') }}
    {{ HTML::script('assets/js/sa-datetimepicker/collapse.js') }}
    {{ HTML::script('assets/js/sa-datetimepicker/bootstrap-datetimepicker.min.js') }}
    <script type="text/javascript">
        $(function () {
            $('#birthDate').datetimepicker({
                format: 'YYYY/MM/DD',
                ignoreReadonly: true
            });
        });
    </script>
@stop