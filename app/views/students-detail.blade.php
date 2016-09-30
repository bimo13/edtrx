@extends('dashboard')

@section('title')
    Student's Detail
@stop

@section('main-content')

    <div class="col-sm-3">
        <img src="{{ asset($student->photo) }}" class="wd-full" />
    </div>

    <div class="col-sm-9">
        <table class="table table-striped">
            <tr>
                <th>Student No.</th>
                <td>:</td>
                <td>{{ $student->student_no }}</td>
            </tr>
            <tr>
                <th>Student Name</th>
                <td>:</td>
                <td>{{ $student->first_name }} {{ $student->last_name }}</td>
            </tr>
            <tr>
                <th>Address</th>
                <td>:</td>
                <td>{{ $student->address }}</td>
            </tr>
            <tr>
                <th>Phone No.</th>
                <td>:</td>
                <td>+62 {{ $student->phone }}</td>
            </tr>
            <tr>
                <th>ICE No.</th>
                <td>:</td>
                <td>+62 {{ $student->ice_number }}</td>
            </tr>
            <tr>
                <th>Place and Date of Birth</th>
                <td>:</td>
                <td>{{ $student->birth_place }}, {{ date("d F Y", strtotime($student->birth_date)) }}</td>
            </tr>
            <tr>
                <th>Gender</th>
                <td>:</td>
                <td>{{ ucfirst($student->gender) }}</td>
            </tr>
            <tr>
                <th>Parent</th>
                <td>:</td>
                <td>{{ $student->StudentParent->first_name }} {{ $student->StudentParent->last_name }}</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td colspan="3">
                    <a href="{{ URL::to('students') }}" class="btn btn-orange roundless">Back</a>
                </td>
            </tr>
        </table>
    </div>

@stop

@section('scripts')
    <script type="text/javascript">
        var base_url = "{{ url() }}";
        var teacher_id = "{{ Sentry::getUser()->id }}";
    </script>
@stop