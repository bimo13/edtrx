@extends('dashboard')

@section('web-content')
<div class="container-fluid">
    <div class="col-lg-12">
        <div class="main-form-wrapper" >
            @if(isset($model))
                {{ Form::model($model, array('method' => 'PUT', 'files' => true, 'url' => 'users/update/'.$model->id)) }}
            @else
                {{ Form::open(array('method' => 'POST', 'url' => 'users', 'files' => true, 'autocomplete' => 'off')) }}
            @endif

                    <div class="form-group">
                        {{ Form::label('email', 'Email:') }}
                        {{ Form::email('email', null, array('class' => 'form-control')) }}
                        {{ $errors->first('email', '<div class="text-danger">:message</div>') }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('password', 'Password:') }}
                        {{ Form::password('password', array('class' => 'form-control')) }}
                        {{ $errors->first('password', '<div class="text-danger">:message</div>') }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('first_name', 'First Name:') }}
                        {{ Form::text('first_name', null, array('class' => 'form-control')) }}
                        {{ $errors->first('first_name', '<div class="text-danger">:message</div>') }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('last_name', 'Last Name:') }}
                        {{ Form::text('last_name', null, array('class' => 'form-control')) }}
                        {{ $errors->first('last_name', '<div class="text-danger">:message</div>') }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('teacher_no', 'Teacher No:') }}
                        {{ Form::text('teacher_no', null, array('class' => 'form-control')) }}
                        {{ $errors->first('teacher_no', '<div class="text-danger">:message</div>') }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('address', 'Address:') }}
                        @if(isset($model))
                            {{ Form::textarea('address', null, array('class' => 'form-control')) }}
                        @else
                            {{ Form::textarea('address', null, array('class' => 'form-control')) }}
                        @endif
                        {{ $errors->first('address', '<div class="text-danger">:message</div>') }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('phone_1', 'Phone Number 1:') }}
                        <div class="input-group">
                            <span class="input-group-addon">+62</span>
                            {{ Form::text('phone_1', null, array('class' => 'form-control')) }}
                        </div>
                        {{ $errors->first('phone_1', '<div class="text-danger">:message</div>') }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('phone_2', 'Phone Number 2:') }}
                        <div class="input-group">
                            <span class="input-group-addon">+62</span>
                            {{ Form::text('phone_2', null, array('class' => 'form-control')) }}
                        </div>
                        {{ $errors->first('phone_2', '<div class="text-danger">:message</div>') }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('birth_place', 'Birth Place:') }}
                        {{ Form::text('birth_place', null, array('class' => 'form-control')) }}
                        {{ $errors->first('birth_place', '<div class="text-danger">:message</div>') }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('birth_date', 'Birth Date:') }}
                        {{ Form::text('birth_date', null, array('class' => 'form-control')) }}
                        {{ $errors->first('birth_date', '<div class="text-danger">:message</div>') }}
                    </div>

                    <div class="form-group">
                        <?php $genders = array('' => '', 'male' => 'Male', 'female' => 'Female'); ?>
                        {{ Form::label('gender', 'Gender:') }}
                        {{ Form::select('gender', $genders, null, ['class' => 'form-control']) }}
                        {{ $errors->first('gender', '<div class="text-danger">:message</div>') }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('photo', 'Student\'s Photo:') }}
                        {{ Form::file('photo', null, array('class' => 'form-control')) }}
                        {{ $errors->first('photo', '<div class="text-danger">:message</div>') }}
                    </div>

                    <div class="form-group">
                        {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
                    </div>

            <!-- conditional-lines indent -->
                {{ Form::close() }}
            <!-- conditional-lines indent -->
        </div>
    </div>
</div>
@stop