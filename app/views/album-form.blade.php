@extends('dashboard')

@section('main-content')
<div class="container-fluid">
    <div class="col-lg-12">
        <div class="main-form-wrapper" >
            @if(isset($model))
                {{ Form::model($model, array('method' => 'PUT', 'url' => 'album/update/'.$model->id)) }}
            @else
                {{ Form::open(array('method' => 'POST', 'url' => 'album', 'autocomplete' => 'off')) }}
            @endif

                    <div class="form-group">
                        {{ Form::label('name', 'Album Name:') }}
                        {{ Form::text('name', null, array('class' => 'form-control')) }}
                        {{ $errors->first('name', '<div class="text-danger">:message</div>') }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('description', 'Description/Notes:') }}
                        @if(isset($model))
                            {{ Form::textarea('description', null, array('class' => 'form-control')) }}
                        @else
                            {{ Form::textarea('description', null, array('class' => 'form-control')) }}
                        @endif
                        {{ $errors->first('description', '<div class="text-danger">:message</div>') }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('venue', 'Venue:') }}
                        {{ Form::text('venue', null, array('class' => 'form-control')) }}
                        {{ $errors->first('venue', '<div class="text-danger">:message</div>') }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('date_taken', 'Date Taken:') }}
                        {{ Form::text('date_taken', null, array('class' => 'form-control')) }}
                        {{ $errors->first('date_taken', '<div class="text-danger">:message</div>') }}
                    </div>

                    <div class="form-group">
                        {{ Form::submit('Next', array('class' => 'btn btn-primary')) }}
                    </div>

            <!-- conditional-lines indent -->
                {{ Form::close() }}
            <!-- conditional-lines indent -->
        </div>
    </div>
</div>
@stop