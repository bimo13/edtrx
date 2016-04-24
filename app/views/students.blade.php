@extends('dashboard')

@section('web-content')
<div class="container-fluid">
    <div class="col-lg-12">
        <h5>STUDENTS</h5>
        <form>
            <div class="form-group">
                <div class="input-border">
                    <div class="input-group studentSearch">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
                        </span>
                    </div><!-- /input-group -->
                </div>
            </div>
            <!-- 
            <div class="row filterStudents">
                <div class="col-lg-5 col-xs-12 pull-right">
                    <div class="row">
                        <div class="col-lg-2 no-padding-right xspaddedLeft">
                            Sort by :
                        </div>
                        <div class="col-lg-5">
                            <select class="form-control"><option>Name </option></select>
                        </div>
                        <div class="col-lg-5">
                            <button class="btn form-control"><i class="fa fa-check-circle-o"></i> Select All</button>
                        </div>
                    </div>
                </div>
            </div>
             -->
        </form>
        <div class="studentList">
            <div class="row">
                @foreach($students as $student)
                <div class="col-lg-4">
                    <div class="studentCard">
                        <div class="studentCardToolbar">
                            <a class="block-info" href="{{ URL::to('/students/'.$student->id.'/edit') }}"><i class="fa fa-pencil"></i></a>
                            <a class="block-danger" href="javascript:void(0);" data-toggle="modal" data-target="#modal-delete" data-id="{{ $student->id }}" data-title="student" data-preview="{{ ucwords(strtolower($student->first_name)) }} {{ ucwords(strtolower($student->last_name)) }}">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                        <div class="studentImage">
                            <img src="{{ asset($student->photo) }}" class="img">
                        </div>
                        <div class="studentName">
                            {{ ucwords(strtolower($student->first_name)) }} {{ ucwords(strtolower($student->last_name)) }}
                            <div class="studentSquad">
                                {{ $student->student_no }} / Kelas II A
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="modal-delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Confirm Deletion</h4>
            </div>
            <div class="modal-body">
                <p></p>
            </div>
            <div class="modal-footer">
                {{ Form::open(['method' => 'DELETE', 'id' => 'form-delete'])}}
                    <button type="submit" class="btn btn-danger">Yes</button>
                    <button type="button" class="btn btn-grey" data-dismiss="modal">No</button>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@stop

@section('scripts')
<script type="text/javascript">
    var base_url = "{{ url() }}";
    var teacher_id = "{{ Sentry::getUser()->id }}";
</script>
{{ HTML::script('assets/js/index-pages/students.js') }}
@stop