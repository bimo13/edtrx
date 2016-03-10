@extends('dashboard')

@section('web-content')
<div class="container-fluid">
    <div class="col-lg-12">
        <div class="main-form-wrapper" >
            @if(isset($model))
                {{ Form::model($model, array('method' => 'PUT', 'url' => 'classes/update/'.$model->id)) }}
            @else
                {{ Form::open(array('method' => 'POST', 'url' => 'classes', 'autocomplete' => 'off')) }}
            @endif

                    <div class="form-group">
                        {{ Form::label('class_name', 'Class Name:') }}
                        {{ Form::text('class_name', null, array('class' => 'form-control')) }}
                        {{ $errors->first('class_name', '<div class="text-danger">:message</div>') }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('grade_level', 'Grade Level:') }}
                        {{ Form::text('grade_level', null, array('class' => 'form-control')) }}
                        {{ $errors->first('grade_level', '<div class="text-danger">:message</div>') }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('teacher_id', 'Home Room Teacher:') }}
                        {{ Form::select('teacher_id', $teachers, null, array('class' => 'form-control')) }}
                        {{ $errors->first('teacher_id', '<div class="text-danger">:message</div>') }}
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