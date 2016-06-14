@extends('dashboard')

@section('title')
    Pinboard
@stop

@section('main-content')

    <!-- 
    <div class="col-lg-12">
        <p>Name : {{ $pinboard->name }}</p>
        <p>Description : {{ $pinboard->description }}</p>
        <p>Created at : {{ date("d F Y", strtotime($pinboard->created_at)) }}</p>
        <p><a href="{{ url($pinboard->file_path) }}" target="_blank" download="{{ $pinboard->name }}">Download</a></p>
    </div>
     -->

     <div class="col-sm-3">
         @if ($pinboard->file_type == "xlsx")
            <img src="{{ asset('assets/img/icon-xlsx.png') }}" class="wd-full" />
        @elseif ($pinboard->file_type == "xls")
            <img src="{{ asset('assets/img/icon-xls.png') }}" class="wd-full" />
        @elseif ($pinboard->file_type == "docx")
            <img src="{{ asset('assets/img/icon-docx.png') }}" class="wd-full" />
        @elseif ($pinboard->file_type == "doc")
            <img src="{{ asset('assets/img/icon-doc.png') }}" class="wd-full" />
        @elseif ($pinboard->file_type == "pptx")
            <img src="{{ asset('assets/img/icon-pptx.png') }}" class="wd-full" />
        @elseif ($pinboard->file_type == "ppt")
            <img src="{{ asset('assets/img/icon-ppt.png') }}" class="wd-full" />
        @elseif ($pinboard->file_type == "pdf")
            <img src="{{ asset('assets/img/icon-pdf.png') }}" class="wd-full" />
        @endif
     </div>

    <div class="col-sm-9">
        <table class="table table-striped">
            <tr>
                <th>Board Name</th>
                <td>:</td>
                <td>{{ $pinboard->name }}</td>
            </tr>
            <tr>
                <th>Created By</th>
                <td>:</td>
                <td>
                    @if ($pinboard->teacher_id == $user->id)
                        You
                    @else
                        {{ ucwords(strtolower($pinboard->User->first_name)) }} {{ ucwords(strtolower($pinboard->User->last_name)) }}
                    @endif
                </td>
            </tr>
            <tr>
                <th>Created At</th>
                <td>:</td>
                <td>{{ date("F d, Y", strtotime($pinboard->created_at)) }}</td>
            </tr>
            <tr>
                <th>File Name</th>
                <td>:</td>
                <td>{{ $pinboard->file_name }}</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td colspan="3">
                    <a href="{{ url($pinboard->file_path) }}" class="btn btn-orange roundless" target="_blank" download="{{ $pinboard->name }}">Download</a>
                </td>
            </tr>
        </table>
    </div>

@stop