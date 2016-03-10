@extends('dashboard')

@section('web-content')
<div class="container-fluid">
    <div class="col-lg-12">
        <div class="main-form-wrapper" >
            @if(isset($model))
                {{ Form::model($model, array('method' => 'PUT', 'files' => true, 'route' => array('album.update', $model->id))) }}
            @else
                {{ Form::open(array('method' => 'POST', 'route' => array('album.store'), 'files' => 'true', 'autocomplete' => 'off')) }}
            @endif

                    <div class="form-group">
                        {{ Form::label('name', 'Album Name:') }}
                        {{ Form::text('name', null, array('class' => 'form-control')) }}
                        {{ $errors->first('name', '<div class="text-danger">:message</div>') }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('description', 'Description:') }}
                        {{ Form::textarea('description', null, array('class' => 'form-control')) }}
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
                        {{ Form::label('images', 'Images:') }}
                        {{ $errors->first('images', '<div class="text-danger">:message</div>') }}
                        {{ Form::file('images[0]', array('class' => 'filestyle', 'data-buttonText' => '&nbsp;&nbsp;Browse', 'data-buttonName' => 'btn-primary')) }}
                        {{ $errors->first('images.0', '<div class="text-danger">:message</div>') }}
                    </div>
                    <div class="form-group">
                        {{ Form::file('images[1]', array('class' => 'filestyle', 'data-buttonText' => '&nbsp;&nbsp;Browse', 'data-buttonName' => 'btn-primary')) }}
                        {{ $errors->first('images.1', '<div class="text-danger">:message</div>') }}
                    </div>
                    <div class="form-group">
                        {{ Form::file('images[2]', array('class' => 'filestyle', 'data-buttonText' => '&nbsp;&nbsp;Browse', 'data-buttonName' => 'btn-primary')) }}
                        {{ $errors->first('images.2', '<div class="text-danger">:message</div>') }}
                    </div>
                    <div class="form-group">
                        {{ Form::file('images[3]', array('class' => 'filestyle', 'data-buttonText' => '&nbsp;&nbsp;Browse', 'data-buttonName' => 'btn-primary')) }}
                        {{ $errors->first('images.3', '<div class="text-danger">:message</div>') }}
                    </div>
                    <div class="form-group">
                        {{ Form::file('images[4]', array('class' => 'filestyle', 'data-buttonText' => '&nbsp;&nbsp;Browse', 'data-buttonName' => 'btn-primary')) }}
                        {{ $errors->first('images.4', '<div class="text-danger">:message</div>') }}
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

@section('scripts')
<!-- JQuery Bootstrap.Filestyle -->
{{ HTML::script('assets/js/forms.filestyle.js') }}
@stop