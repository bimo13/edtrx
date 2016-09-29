@extends('dashboard')

@section('title')
    Classes
@stop

@section('styles')
    {{ HTML::style('assets/css/select2/select2.css') }}
    {{ HTML::style('assets/css/custom/classes-form.css') }}
@stop

@section('main-content')

    <div class="row">
        @if(isset($model))
            {{ Form::model($model, array('id' => 'classes-form', 'method' => 'PUT', 'route' => array('classes.update', $model->id), 'autocomplete' => 'off')) }}
        @else
            {{ Form::open(array('id' => 'classes-form', 'method' => 'POST', 'url' => 'classes', 'autocomplete' => 'off')) }}
        @endif

                @if(isset($model))
                    {{ Form::hidden('id', $model->id) }}
                @endif

                <div class="col-sm-6">
                    {{ Form::label('class_name', 'Class Name:') }}
                    <div class="form-group classes-form">
                        {{ Form::text('class_name', null, array('class' => 'form-control')) }}
                    </div>
                    {{ $errors->first('class_name', '<div class="text-danger flash-error">:message</div>') }}
                </div>

                <div class="col-sm-6">
                    {{ Form::label('grade_level', 'Grade Level:') }}
                    <div class="form-group classes-form">
                        {{ Form::text('grade_level', null, array('class' => 'form-control')) }}
                    </div>
                    {{ $errors->first('grade_level', '<div class="text-danger flash-error">:message</div>') }}
                </div>

                <div class="col-sm-12">
                    {{ Form::label('teacher_id', 'Home Room Teacher:') }}
                    <div class="form-group classes-form">
                        {{ Form::select('teacher_id', $teachers, null, array('id' => 'teacher_id', 'class' => 'form-control')) }}
                    </div>
                    {{ $errors->first('teacher_id', '<div class="text-danger flash-error">:message</div>') }}
                </div>

                <div class="col-sm-12">
                    <div class="form-group text-right">
                        {{ Form::submit('Save', array('class' => 'btn roundless btn-edutrax-cyan')) }}
                        <a href="{{ URL::to('/classes') }}" class="btn roundless btn-edutrax-grey">Cancel</a>
                    </div>
                </div>

        <!-- conditional-lines indent -->
            {{ Form::close() }}
        <!-- conditional-lines indent -->
    </div>

@stop

@section('scripts')
    {{ HTML::script('assets/js/select2.js') }}
    <script type="text/javascript">
        $("#teacher_id").select2();
    </script>
@stop