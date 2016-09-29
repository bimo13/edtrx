@extends('dashboard')

@section('title')
    Teachers
@stop

@section('styles')
    {{ HTML::style('assets/css/select2/select2.css') }}
    {{ HTML::style('assets/css/sa-datetimepicker/bootstrap-datetimepicker.min.css') }}
    {{ HTML::style('assets/css/custom/users-form.css') }}
@stop

@section('main-content')

    <div class="row">
        @if(isset($model))
            {{ Form::model($model, array('id' => 'users-form', 'method' => 'PUT', 'route' => array('users.update', $model->id), 'autocomplete' => 'off')) }}
        @else
            {{ Form::open(array('id' => 'users-form', 'method' => 'POST', 'url' => 'users', 'autocomplete' => 'off')) }}
        @endif

                @if(isset($model))
                    {{ Form::hidden('id', $model->user_id) }}
                    {{ Form::hidden('detail_id', $model->id) }}
                @endif

                <div class="col-sm-6">
                    {{ Form::label('email', 'Email:') }}
                    <div class="form-group users-form">
                        {{ Form::email('email', null, array('class' => 'form-control')) }}
                    </div>
                    {{ $errors->first('email', '<div class="text-danger flash-error">:message</div>') }}
                </div>

                <div class="col-sm-6">
                    {{ Form::label('password', 'Password:') }}
                    <div class="form-group users-form">
                        {{ Form::password('password', array('class' => 'form-control')) }}
                    </div>
                    {{ $errors->first('password', '<div class="text-danger flash-error">:message</div>') }}
                </div>

                <div class="col-sm-6">
                    {{ Form::label('first_name', 'First Name:') }}
                    <div class="form-group users-form">
                        {{ Form::text('first_name', null, array('class' => 'form-control')) }}
                    </div>
                    {{ $errors->first('first_name', '<div class="text-danger flash-error">:message</div>') }}
                </div>

                <div class="col-sm-6">
                    {{ Form::label('last_name', 'Last Name:') }}
                    <div class="form-group users-form">
                        {{ Form::text('last_name', null, array('class' => 'form-control')) }}
                    </div>
                    {{ $errors->first('last_name', '<div class="text-danger flash-error">:message</div>') }}
                </div>

                <div class="col-sm-12">
                    {{ Form::label('teacher_no', 'Teacher No:') }}
                    <div class="form-group users-form">
                        {{ Form::text('teacher_no', null, array('class' => 'form-control')) }}
                    </div>
                    {{ $errors->first('teacher_no', '<div class="text-danger flash-error">:message</div>') }}
                </div>

                <div class="clear"></div>

                <div class="col-sm-12">
                    {{ Form::label('address', 'Address:') }}
                    <div class="form-group users-form">
                        @if(isset($model))
                            {{ Form::textarea('address', null, array('class' => 'form-control')) }}
                        @else
                            {{ Form::textarea('address', null, array('class' => 'form-control')) }}
                        @endif
                    </div>
                    {{ $errors->first('address', '<div class="text-danger flash-error">:message</div>') }}
                </div>

                <div class="col-sm-6">
                    {{ Form::label('phone_1', 'Phone #1:') }}
                    <div class="form-group users-form">
                        {{ Form::text('phone_1', null, array('class' => 'form-control')) }}
                    </div>
                    {{ $errors->first('phone_1', '<div class="text-danger flash-error">:message</div>') }}
                </div>

                <div class="col-sm-6">
                    {{ Form::label('phone_2', 'Phone #2:') }}
                    <div class="form-group users-form">
                        {{ Form::text('phone_2', null, array('class' => 'form-control')) }}
                    </div>
                    {{ $errors->first('phone_2', '<div class="text-danger flash-error">:message</div>') }}
                </div>

                <div class="col-sm-6">
                    {{ Form::label('birth_place', 'Birth Place:') }}
                    <div class="form-group users-form">
                        {{ Form::text('birth_place', null, array('class' => 'form-control')) }}
                    </div>
                    {{ $errors->first('birth_place', '<div class="text-danger flash-error">:message</div>') }}
                </div>

                <div class="col-sm-6">
                    {{ Form::label('birth_date', 'Date:') }}
                    <div class="form-group users-form">
                        <div class='input-group date' id='birth_date'>
                            {{ Form::text('birth_date', null, array('class' => 'form-control', 'readonly')) }}
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                        {{ $errors->first('birth_date', '<div class="text-danger">:message</div>') }}
                    </div>
                </div>

                <div class="col-sm-6">
                    <?php $genders = array('' => '', 'male' => 'Male', 'female' => 'Female'); ?>
                    {{ Form::label('gender', 'Gender:') }}
                    <div class="form-group users-form">
                        {{ Form::select('gender', $genders, null, ['id' => 'gender', 'class' => 'form-control']) }}
                    </div>
                    {{ $errors->first('gender', '<div class="text-danger flash-error">:message</div>') }}
                </div>

                <div class="col-sm-6">
                    {{ Form::label('photo', 'Teacher\'s Photo:') }}
                    <div class="form-group users-form">
                        {{ Form::file('photo', array('class' => 'filestyle', 'data-buttonText' => '&nbsp;&nbsp;Browse', 'data-buttonName' => 'btn-edutrax-cyan')) }}
                    </div>
                    {{ $errors->first('photo', '<div class="text-danger">:message</div>') }}
                </div>

                <div class="col-sm-12">
                    <div class="form-group text-right">
                        {{ Form::submit('Save', array('class' => 'btn roundless btn-edutrax-cyan')) }}
                        <a href="{{ URL::to('/users') }}" class="btn roundless btn-edutrax-grey">Cancel</a>
                    </div>
                </div>

        <!-- conditional-lines indent -->
            {{ Form::close() }}
        <!-- conditional-lines indent -->

    </div>

@stop

@section('scripts')
    {{ HTML::script('assets/js/sa-datetimepicker/moment.js') }}
    {{ HTML::script('assets/js/sa-datetimepicker/transition.js') }}
    {{ HTML::script('assets/js/sa-datetimepicker/collapse.js') }}
    {{ HTML::script('assets/js/sa-datetimepicker/bootstrap-datetimepicker.min.js') }}
    {{ HTML::script('assets/js/forms.filestyle.js') }}
    {{ HTML::script('assets/js/select2.js') }}
    <script type="text/javascript">
        $(function () {
            $('#birth_date').datetimepicker({
                format: 'YYYY/MM/DD',
                ignoreReadonly: true
            });
            $("#gender").select2();
        });
    </script>
@stop