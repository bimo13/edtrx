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
                            <a class="block-danger" href=""><i class="fa fa-times"></i></a>
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
@stop