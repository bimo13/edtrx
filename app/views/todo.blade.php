@extends('dashboard')

@section('title')
    To Do List
@stop

@section('styles')
    {{ HTML::style('assets/css/sa-datetimepicker/bootstrap-datetimepicker.min.css') }}
    {{ HTML::style('assets/css/custom/todo.css') }}
@stop

@section('main-content')
    <div class="col-sm-4">
        {{ Form::open(array('id' => 'todo-search-form', 'class' => 'hidden', 'method' => 'POST', 'url' => 'pinboard.search', 'autocomplete' => 'off')) }}
            <div class="form-group todo-form">
                <div class='input-group date' id='todoSearchDate'>
                    {{ Form::text('date', null, array('class' => 'form-control', 'readonly')) }}
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
                {{ $errors->first('date', '<div class="text-danger">:message</div>') }}
            </div>
        {{ Form::close() }}
    </div>
    <div class="col-sm-4 col-sm-offset-4">
        <a href="{{ URL::route('todo.create') }}" class="btn btn-edutrax-cyan roundless add-todo-btn pull-right">
            <i class="fa fa-plus-circle"></i>&nbsp;&nbsp;&nbsp;Add New Task
        </a>
    </div>

    @foreach ($todoDates as $todoDate)
        <div class="row marginless paddingless">
            <div class="col-sm-12 todo-view-date mg-bottom-20px">
                {{ strtoupper(date("l", strtotime($todoDate->date))) }}, {{ date("d F Y", strtotime($todoDate->date)) }}
            </div>
            <table class="table table-striped mg-bottom-40px">
                <tr>
                    <th class="col-sm-3">Task</th>
                    <th class="col-sm-9" colspan="2">Description</th>
                </tr>
                <?php $todos = ToDo::where('date', '=', $todoDate->date)->orderBy('name')->get(); ?>
                @foreach ($todos as $todo)
                    <tr>
                        <td class="col-sm-3">{{ $todo->name }}</td>
                        <td class="col-sm-7">{{ $todo->description }}</td>
                        <td class="col-sm-2 text-right">
                            <a href="{{ URL::route('todo.edit', array($todo->id)) }}" class="btn btn-edutrax-cyan roundless"><i class="glyphicon glyphicon-pencil"></i></a>
                            <a href="javascript:void(0);" class="btn roundless btn-danger" data-toggle="modal" data-target="#modal-delete" data-id="{{ $todo->id }}" data-title="todo" data-preview="{{ ucwords(strtolower($todo->name)) }}"><i class="glyphicon glyphicon-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    @endforeach
@stop

@section('scripts')
    <script type="text/javascript">
        var base_url = "{{ url() }}";
        var teacher_id = "{{ Sentry::getUser()->id }}";
    </script>
    {{ HTML::script('assets/js/sa-datetimepicker/moment.js') }}
    {{ HTML::script('assets/js/sa-datetimepicker/transition.js') }}
    {{ HTML::script('assets/js/sa-datetimepicker/collapse.js') }}
    {{ HTML::script('assets/js/sa-datetimepicker/bootstrap-datetimepicker.min.js') }}
    {{ HTML::script('assets/js/custom/todo.js') }}
    <script type="text/javascript">
        $(function () {
            $('#todoSearchDate').datetimepicker({
                format: 'YYYY/MM/DD',
                ignoreReadonly: true
            });
        });
    </script>
@stop