@extends('dashboard')

@section('title')
    New To Do List
@stop

@section('styles')
    {{ HTML::style('assets/css/select2/select2.css') }}
    {{ HTML::style('assets/css/sa-datetimepicker/bootstrap-datetimepicker.min.css') }}
    {{ HTML::style('assets/css/custom/todo-form.css') }}
@stop

@section('main-content')

<div class="col-sm-12">
    @if(isset($model))
        {{ Form::model($model, array('method' => 'PUT', 'id' => 'todo-form', 'files' => true, 'route' => array('todo.update', $model->id))) }}
    @else
        {{ Form::open(array('method' => 'POST', 'id' => 'todo-form', 'route' => array('todo.store'), 'files' => 'true', 'autocomplete' => 'off')) }}
    @endif

            {{ Form::hidden('teacher_id', Sentry::getUser()->id) }}

            <div class="col-sm-6">
                {{ Form::label('name', 'Task:') }}
                <div class="form-group todo-form">
                    {{ Form::text('name', null, array('class' => 'form-control')) }}
                    {{ $errors->first('name', '<div class="text-danger">:message</div>') }}
                </div>
            </div>

            <div class="col-sm-6">
                {{ Form::label('date', 'Date:') }}
                <div class="form-group todo-form">
                    <div class='input-group date' id='todoDate'>
                        {{ Form::text('date', null, array('class' => 'form-control', 'readonly')) }}
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                    {{ $errors->first('date', '<div class="text-danger">:message</div>') }}
                </div>
            </div>

            <div class="col-lg-12">
                {{ Form::label('description', 'Description:') }}
                <div class="form-group todo-form">
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
                <div class="form-group todo-form">
                    {{ Form::file('file', array('class' => 'filestyle', 'data-buttonText' => '&nbsp;&nbsp;Browse', 'data-buttonName' => 'btn-edutrax-cyan')) }}
                    {{ $errors->first('file', '<div class="text-danger">:message</div>') }}
                </div>
            </div>

            <div class="col-sm-12">
                {{ Form::label('share_to', 'Sharing Option:') }}
                <div class="form-group todo-form">
                    {{ Form::select('share_to[]', $parents, null, array('id' => 'share_to', 'class' => 'form-control', 'multiple' => 'multiple')) }}
                    {{ $errors->first('share_to', '<div class="text-danger">:message</div>') }}
                </div>
                <div class="text-info">*leave blank to set gallery as public</div>
            </div>

            <div class="col-lg-12">
                <div class="form-group text-right">
                    {{ Form::submit('Create Task', array('class' => 'btn roundless btn-edutrax-cyan')) }}
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
    {{ HTML::script('assets/js/forms.filestyle.js') }}
    {{ HTML::script('assets/js/select2.js') }}
    <script type="text/javascript">
        $(function () {
            $('#todoDate').datetimepicker({
                format: 'YYYY/MM/DD',
                ignoreReadonly: true
            });
            $("#share_to").select2();
        });
    </script>
@stop