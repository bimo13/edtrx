@extends('dashboard')

@section('styles')
{{ HTML::style('assets/css/select2.css') }}
@stop

@section('web-content')

<div class="container-fluid">
    <div class="col-lg-12">
        <div class="main-form-wrapper" >
            @if(isset($model))
                {{ Form::model($model, array('method' => 'PUT', 'files' => true, 'route' => array('pinboard.update', $model->id))) }}
            @else
                {{ Form::open(array('method' => 'POST', 'route' => array('pinboard.store'), 'files' => 'true', 'autocomplete' => 'off')) }}
            @endif

                    {{ Form::hidden('teacher_id', Sentry::getUser()->id) }}
                    <div class="form-group">
                        {{ Form::label('name', 'Board Name:') }}
                        {{ Form::text('name', null, array('class' => 'form-control')) }}
                        {{ $errors->first('name', '<div class="text-danger">:message</div>') }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('description', 'Description:') }}
                        {{ Form::textarea('description', null, array('class' => 'form-control')) }}
                        {{ $errors->first('description', '<div class="text-danger">:message</div>') }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('file', 'File:') }}
                        {{ Form::file('file', array('class' => 'filestyle', 'data-buttonText' => '&nbsp;&nbsp;Browse', 'data-buttonName' => 'btn-primary')) }}
                        {{ $errors->first('file', '<div class="text-danger">:message</div>') }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('share_to', 'Share to:') }}
                        {{ Form::select('share_to[]', $parents, null, array('id' => 'share_to', 'class' => 'form-control', 'multiple' => 'multiple')) }}
                        {{ $errors->first('share_to', '<div class="text-danger">:message</div>') }}
                        <div class="text-info">*leave blank to set gallery as public</div>
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
{{ HTML::script('assets/js/select2.js') }}
<script type="text/javascript">
    $("#share_to").select2();
</script>
@stop