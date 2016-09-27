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
            @if(isset($model))
                {{ Form::hidden('id', $model->id, ['id' => 'id']) }}
            @endif

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

            @if(isset($model) && $model->file_type != "" && $model->file_type != NULL)

                <div class="col-sm-2">
                    <div class="form-group todo-form">
                        @if ($model->file_type == "xlsx")
                            <img src="{{ asset('assets/img/icon-xlsx.png') }}" class="wd-full" />
                        @elseif ($model->file_type == "xls")
                            <img src="{{ asset('assets/img/icon-xls.png') }}" class="wd-full" />
                        @elseif ($model->file_type == "docx")
                            <img src="{{ asset('assets/img/icon-docx.png') }}" class="wd-full" />
                        @elseif ($model->file_type == "doc")
                            <img src="{{ asset('assets/img/icon-doc.png') }}" class="wd-full" />
                        @elseif ($model->file_type == "pptx")
                            <img src="{{ asset('assets/img/icon-pptx.png') }}" class="wd-full" />
                        @elseif ($model->file_type == "ppt")
                            <img src="{{ asset('assets/img/icon-ppt.png') }}" class="wd-full" />
                        @elseif ($model->file_type == "pdf")
                            <img src="{{ asset('assets/img/icon-pdf.png') }}" class="wd-full" />
                        @endif
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="help-block marginless paddingless mg-top-5px txt-size-12px">
                        Current File :<br />
                        {{ $model->file_name }}
                    </div>
                </div>

                <div class="clear mg-bottom-15px"></div>

            @endif

            <div class="col-sm-12">
                @if(isset($model))
                    {{ Form::label('file', 'Replace File:') }}
                @else
                    {{ Form::label('file', 'Attach File:') }}
                @endif
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
                    @if(isset($model))
                        {{ Form::submit('Save Changes', array('class' => 'btn roundless btn-edutrax-cyan')) }}
                    @else
                        {{ Form::submit('Create Task', array('class' => 'btn roundless btn-edutrax-cyan')) }}
                    @endif
                    <a href="{{ URL::to('/todo') }}" class="btn roundless btn-edutrax-grey">Cancel</a>
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