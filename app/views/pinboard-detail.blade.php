@extends('dashboard')

@section('web-content')

    <div class="col-lg-12">
        <p>Name : {{ $pinboard->name }}</p>
        <p>Description : {{ $pinboard->description }}</p>
        <p>Created at : {{ date("d F Y", strtotime($pinboard->created_at)) }}</p>
        <p><a href="{{ url($pinboard->file_path) }}" target="_blank" download="{{ $pinboard->name }}">Download</a></p>
    </div>

@stop