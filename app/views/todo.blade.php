@extends('dashboard')

@section('web-content')
<div class="row filterStudents">
    <div class="col-xs-12">
        <div class="row">
            <div class="col-lg-12">
                <form class="form-horizontal">
                    <div class="form-group form-gallery">
                        <div class="col-sm-3">
                            <button type="button" class="btn btn-flat" onclick="window.location.href='{{ URL::route('todo.create') }}'"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;&nbsp;Add New</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="col-xs-12">
    @foreach ($todoDates as $todoDate)
        {{ date("d F Y", strtotime($todoDate->date)) }}
        <?php $todos = ToDo::where('date', '=', $todoDate->date)->orderBy('name')->get(); ?>
        @foreach ($todos as $todo)
            <p>Task: {{ $todo->name }}</p>
            <p>Description: {{ $todo->description }}</p>
            <p>Has File: @if ($todo->has_file) Yes @else No @endif</p>
        @endforeach
    @endforeach
</div>

@stop