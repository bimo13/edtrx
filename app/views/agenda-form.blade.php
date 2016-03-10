@extends('dashboard')

@section('web-content')
<div class="container-fluid">
    <div class="col-lg-12">
        <div class="main-form-wrapper" >
            @if(isset($model))
                {{ Form::model($model, array('method' => 'PUT', 'route' => array('agenda.update', $model->id), 'autocomplete' => 'off')) }}
            @else
                {{ Form::open(array('method' => 'POST', 'url' => 'agenda', 'autocomplete' => 'off')) }}
            @endif

                    @if(isset($model))
                        {{ Form::hidden('id', $model->id) }}
                    @endif

                    {{ Form::hidden('teacher_id', Sentry::getUser()->id) }}
                    @if ($errors->has('teacher_id'))
                        <div class="col-lg-12">
                            <div class="form-group">
                                {{ $errors->first('teacher_id', '<div class="text-danger">:message</div>') }}
                            </div>
                        </div>
                    @endif

                    <div class="col-lg-4">
                        <div class="form-group">
                            {{ Form::label('date', 'Date:') }}
                            {{ Form::text('date', null, array('class' => 'form-control')) }}
                            {{ $errors->first('date', '<div class="text-danger">:message</div>') }}
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            {{ Form::label('time_start', 'Time Start:') }}
                            {{ Form::text('time_start', null, array('class' => 'form-control')) }}
                            {{ $errors->first('time_start', '<div class="text-danger">:message</div>') }}
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            {{ Form::label('time_end', 'Time End:') }}
                            {{ Form::text('time_end', null, array('class' => 'form-control')) }}
                            {{ $errors->first('time_end', '<div class="text-danger">:message</div>') }}
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            {{ Form::label('description', 'Description:') }}
                            @if(isset($model))
                                {{ Form::textarea('description', null, array('class' => 'form-control')) }}
                            @else
                                {{ Form::textarea('description', null, array('class' => 'form-control')) }}
                            @endif
                            {{ $errors->first('description', '<div class="text-danger">:message</div>') }}
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
                        </div>
                    </div>

            <!-- conditional-lines indent -->
                {{ Form::close() }}
            <!-- conditional-lines indent -->
        </div>
    </div>
</div>
@stop