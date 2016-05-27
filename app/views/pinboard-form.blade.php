@extends('dashboard')

@section('title')
    Pinboard
@stop

@section('styles')
    {{ HTML::style('assets/css/select2/select2.css') }}
    {{ HTML::style('assets/css/custom/pinboard-form.css') }}
@stop

@section('main-content')
    <div class="row">
        @if(isset($model))
            {{ Form::model($model, array('id' => 'pinboard-form', 'method' => 'PUT', 'files' => true, 'route' => array('pinboard.update', $model->id), 'autocomplete' => 'off')) }}
        @else
            {{ Form::open(array('id' => 'pinboard-form', 'method' => 'POST', 'files' => true, 'url' => 'pinboard', 'autocomplete' => 'off')) }}
        @endif
                @if(isset($model))
                    {{ Form::hidden('id', $model->id) }}
                @endif

                {{ Form::hidden('teacher_id', Sentry::getUser()->id) }}

                <div class="col-sm-12">
                    {{ Form::label('name', 'Board Name:') }}
                    <div class="form-group pinboard-form">
                        {{ Form::text('name', null, array('class' => 'form-control')) }}
                        {{ $errors->first('name', '<div class="text-danger">:message</div>') }}
                    </div>
                </div>

                <div class="col-lg-12">
                    {{ Form::label('description', 'Description:') }}
                    <div class="form-group pinboard-form">
                        @if(isset($model))
                            {{ Form::textarea('description', null, array('class' => 'form-control')) }}
                        @else
                            {{ Form::textarea('description', null, array('class' => 'form-control')) }}
                        @endif
                        {{ $errors->first('description', '<div class="text-danger">:message</div>') }}
                    </div>
                </div>

                <div class="col-sm-12">
                    {{ Form::label('file', 'Attach File:') }}
                    <div class="form-group pinboard-form">
                        {{ Form::file('file', array('class' => 'filestyle', 'data-buttonText' => '&nbsp;&nbsp;Browse', 'data-buttonName' => 'btn-edutrax-cyan')) }}
                        {{ $errors->first('file', '<div class="text-danger">:message</div>') }}
                    </div>
                </div>

                <div class="col-sm-12">
                    {{ Form::label('share_to', 'Sharing Option:') }}
                    <div class="form-group pinboard-form">
                        {{ Form::select('share_to[]', $parents, null, array('id' => 'share_to', 'class' => 'form-control', 'multiple' => 'multiple')) }}
                        {{ $errors->first('share_to', '<div class="text-danger">:message</div>') }}
                    </div>
                    <div class="text-info">*leave blank to set gallery as public</div>
                </div>

                <div class="col-lg-12 mg-top-35px">
                    <div class="form-group text-right">
                        {{ Form::submit('Create Board', array('class' => 'btn roundless btn-edutrax-cyan')) }}
                        <a href="javascript:void(0);" class="btn roundless btn-edutrax-grey">Cancel</a>
                    </div>
                </div>
        <!-- conditional-lines indent -->
            {{ Form::close() }}
        <!-- conditional-lines indent -->
    </div>
@stop

@section('scripts')
    {{ HTML::script('assets/js/forms.filestyle.js') }}
    {{ HTML::script('assets/js/select2.js') }}
    <script type="text/javascript">
        $("#share_to").select2();
    </script>
@stop