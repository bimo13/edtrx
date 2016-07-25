@extends('dashboard')

@section('title')
    New Agenda
@stop

@section('styles')
    {{ HTML::style('assets/css/sa-datetimepicker/bootstrap-datetimepicker.css') }}
    {{ HTML::style('assets/css/custom/agenda-form.css') }}
@stop

@section('main-content')

    <div class="row">
        @if(isset($model))
            {{ Form::model($model, array('id' => 'agenda-form', 'method' => 'PUT', 'route' => array('agenda.update', $model->id), 'autocomplete' => 'off')) }}
        @else
            {{ Form::open(array('id' => 'agenda-form', 'method' => 'POST', 'url' => 'agenda', 'autocomplete' => 'off')) }}
        @endif

                @if(isset($model))
                    {{ Form::hidden('id', $model->id) }}
                @endif

                {{ Form::hidden('teacher_id', Sentry::getUser()->id) }}
                @if ($errors->has('teacher_id'))
                    <div class="col-sm-12">
                        <div class="form-group">
                            {{ $errors->first('teacher_id', '<div class="text-danger">:message</div>') }}
                        </div>
                    </div>
                @endif

                <div class="col-sm-4">
                    {{ Form::label('date', 'Date:') }}
                    <div class="form-group agenda-form">
                        <div class='input-group date' id='agendaDate'>
                            {{ Form::text('date', null, array('class' => 'form-control', 'readonly')) }}
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                        {{ $errors->first('date', '<div class="text-danger">:message</div>') }}
                    </div>
                </div>
                <div class="col-sm-4">
                    {{ Form::label('time_start', 'Time Start:') }}
                    <div class="form-group agenda-form">
                        <div class='input-group date' id='agendaTS'>
                            {{ Form::text('time_start', null, array('class' => 'form-control', 'readonly')) }}
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-time"></span>
                            </span>
                        </div>
                        {{ $errors->first('time_start', '<div class="text-danger">:message</div>') }}
                    </div>
                </div>
                <div class="col-sm-4">
                    {{ Form::label('time_end', 'Time End:') }}
                    <div class="form-group agenda-form">
                        <div class='input-group date' id='agendaTE'>
                            {{ Form::text('time_end', null, array('class' => 'form-control', 'readonly')) }}
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-time"></span>
                            </span>
                        </div>
                        {{ $errors->first('time_end', '<div class="text-danger">:message</div>') }}
                    </div>
                </div>

                <div class="col-lg-12">
                    {{ Form::label('description', 'Description:') }}
                    <div class="form-group agenda-form">
                        @if(isset($model))
                            {{ Form::textarea('description', null, array('class' => 'form-control')) }}
                        @else
                            {{ Form::textarea('description', null, array('class' => 'form-control')) }}
                        @endif
                        {{ $errors->first('description', '<div class="text-danger">:message</div>') }}
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group text-right">
                        {{ Form::submit($buttonText, array('class' => 'btn roundless btn-edutrax-cyan')) }}
                        <a href="javascript:void(0);" class="btn roundless btn-edutrax-grey">Cancel</a>
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
    <script type="text/javascript">
        $(function () {
            $('#agendaDate').datetimepicker({
                format: 'YYYY/MM/DD',
                ignoreReadonly: true
            });

            $('#agendaTS, #agendaTE').datetimepicker({
                format: 'HH:mm',
                ignoreReadonly: true
            });
        });
    </script>
@stop