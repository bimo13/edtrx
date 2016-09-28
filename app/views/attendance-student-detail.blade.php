@extends('dashboard')

@section('title')
    Attendance &bull; {{ $student->first_name }} {{ $student->last_name }}
@stop

@section('styles')
    {{ HTML::style('assets/css/datatables/jquery.dataTables.css') }}
    {{ HTML::style('assets/css/custom/attendance-detail.css') }}
@stop

@section('main-content')

    <div class="col-sm-12 attendance-title">
        Attendance Report
    </div>
    <div class="col-sm-12 attendance-details">
        <p>Student No: <b>{{ $student->student_no }}</b></p>
        <p>Student Name: <b>{{ $student->first_name }} {{ $student->last_name }}</b></p>
    </div>

    <div class="clear"></div>

    <div class="col-sm-12">
        <table id="datatables" class="table table-bordered table-condensed table-striped">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Attendance</th>
                    <th>Lateness</th>
                    <th>Apparel</th>
                    <th>Notes</th>
                </tr>
            </thead>
        </table>
    </div>

@stop

@section('scripts')
<script type="text/javascript">
    var base_url = "{{ url() }}";
    var student_id = "{{ $student->id }}";
</script>
{{ HTML::script('assets/js/datatables/jquery.dataTables.min.js') }}
{{ HTML::script('assets/js/custom/attendance-detail.js') }}
@stop