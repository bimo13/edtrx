@extends('dashboard')

@section('web-content')
<div class="container-fluid">
    <div class="col-lg-12">
        <div class="main-form-wrapper" >
            @if(isset($model))
                {{ Form::model($model, array('method' => 'PUT', 'files' => true, 'route' => array('students.update', $model->id))) }}
            @else
                {{ Form::open(array('method' => 'POST', 'url' => 'students', 'files' => true, 'autocomplete' => 'off')) }}
            @endif

                    <div class="form-group">
                        {{ Form::label('student_no', 'Student No:') }}
                        {{ Form::text('student_no', null, array('class' => 'form-control')) }}
                        {{ $errors->first('student_no', '<div class="text-danger">:message</div>') }}
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
                        {{ Form::label('address', 'Address:') }}
                        @if(isset($model))
                            {{ Form::textarea('address', null, array('class' => 'form-control')) }}
                        @else
                            {{ Form::textarea('address', null, array('class' => 'form-control')) }}
                        @endif
                        {{ $errors->first('address', '<div class="text-danger">:message</div>') }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('phone', 'Phone Number:') }}
                        <div class="input-group">
                            <span class="input-group-addon">+62</span>
                            {{ Form::text('phone', null, array('class' => 'form-control')) }}
                        </div>
                        {{ $errors->first('phone', '<div class="text-danger">:message</div>') }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('ice_number', 'In-Case-of-Emergency Number:') }}
                        <div class="input-group">
                            <span class="input-group-addon">+62</span>
                            {{ Form::text('ice_number', null, array('class' => 'form-control')) }}
                        </div>
                        {{ $errors->first('ice_number', '<div class="text-danger">:message</div>') }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('birth_place', 'Birth Place:') }}
                        {{ Form::text('birth_place', null, array('class' => 'form-control')) }}
                        {{ $errors->first('birth_place', '<div class="text-danger">:message</div>') }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('birth_date', 'Birth Date:') }}
                        {{ Form::text('birth_date', null, array('class' => 'form-control', 'id' => 'birth_date')) }}
                        {{ $errors->first('birth_date', '<div class="text-danger">:message</div>') }}
                    </div>

                    <div class="form-group">
                        <?php $genders = array('' => '', 'male' => 'Male', 'female' => 'Female'); ?>
                        {{ Form::label('gender', 'Gender:') }}
                        {{ Form::select('gender', $genders, null, ['class' => 'form-control']) }}
                        {{ $errors->first('gender', '<div class="text-danger">:message</div>') }}
                    </div>

                    <div class="form-group">
                        <?php $parent_id = $blankArray; ?>
                        {{ Form::label('parent_id', 'Parent Name/ID:') }}
                        {{ Form::select('parent_id', $parent_id, null, ['class' => 'form-control']) }}
                        {{ $errors->first('parent_id', '<div class="text-danger">:message</div>') }}
                    </div>

                    <div class="form-group">
                        <?php $class_id = $blankArray; ?>
                        {{ Form::label('class_id', 'Class Name/ID:') }}
                        {{ Form::select('class_id', $class_id, null, ['class' => 'form-control']) }}
                        {{ $errors->first('class_id', '<div class="text-danger">:message</div>') }}
                    </div>

                    @if(isset($model))
                        @if($model->photo != NULL && $model->photo != NULL )
                            <div class="form-group">
                                <img src="{{ asset($model->photo); }}" width="90" />
                            </div>
                        @endif
                        {{ Form::hidden('id', $model->id, ['id' => 'id']) }}
                    @endif

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