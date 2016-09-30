@extends('dashboard')

@section('title')
    Students
@stop

@section('styles')
    {{ HTML::style('assets/css/custom/students.css') }}
@stop

@section('main-content')

    <div class="col-sm-8">
        {{ Form::open(array('id' => 'student-search-form', 'method' => 'POST', 'url' => 'students/search', 'autocomplete' => 'off')) }}
            <div class="form-group student-search-form">
                <div class="input-group">
                    {{ Form::text('student-search', null, array('class' => 'form-control roundless', 'placeholder' => 'Search Student')) }}
                    <span class="input-group-btn">
                        {{ Form::button('<i class="glyphicon glyphicon-search"></i>', array('type' => 'submit', 'class' => 'btn roundless btn-edutrax-cyan')) }}
                    </span>
                </div>
            </div>
        {{ Form::close() }}
    </div>

    <div class="col-sm-4">
        <a href="{{ URL::route('students.create') }}" class="btn btn-edutrax-cyan roundless add-student-btn pull-right">
            <i class="fa fa-plus-circle"></i>&nbsp;&nbsp;&nbsp;Add New Student
        </a>
    </div>

    <div class="clear"></div>

    @if(Session::has('message'))
        <div class="col-sm-12 bg-{{ Session::get('alert-class', 'alert-info') }} pd-all-15px mg-bottom-10px">
            <p class="text-{{ Session::get('alert-class', 'alert-info') }} marginless">{{ Session::get('message') }}</p>
        </div>
    @endif

    <div class="clear"></div>

    @foreach($students as $student)
        <div class="col-sm-4 mg-bottom-15px">
            <div class="col-sm-12 marginless pd-top-20px pd-bottom-20px bg-ffffff">
                <div class="col-sm-3 relative paddingless">
                    <div class="photo-wrapper" style="background-image: url('{{ asset($student->photo) }}');"></div>
                </div>
                <div class="col-sm-9 paddingless bg-ffffff relative">
                    <div class="col-sm-12 paddingless text-right btn-menu">
                        <a href="{{ URL::route('students.edit', array($student->id)) }}" class="btn roundless btn-edutrax-cyan">
                            <i class="glyphicon glyphicon-pencil"></i>
                        </a>
                        <a class="btn roundless btn-danger" href="javascript:void(0);" data-toggle="modal" data-target="#modal-delete" data-id="{{ $student->id }}" data-title="student" data-preview="{{ ucwords(strtolower($student->first_name)) }} {{ ucwords(strtolower($student->last_name)) }}">
                            <i class="glyphicon glyphicon-trash"></i>
                        </a>
                    </div>
                    <div class="col-sm-12 paddingless student-name">
                        <a href="{{ URL::route('students.show', $student->id) }}" class="color-333333">{{ ucwords(strtolower($student->first_name)) }} {{ ucwords(strtolower($student->last_name)) }}</a>
                    </div>
                    <div class="col-sm-12 paddingless student-class">
                        {{ $student->student_no }} / Kelas II A
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@stop

@section('scripts')
    <script type="text/javascript">
        var base_url = "{{ url() }}";
        var teacher_id = "{{ Sentry::getUser()->id }}";
    </script>
    {{ HTML::script('assets/js/custom/students.js') }}
@stop