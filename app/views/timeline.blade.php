@extends('dashboard')

@section('web-content')

    @foreach($timeline as $post)
        {{ $post->user->first_name }} {{ $post->user->last_name }} just posted a new {{ strtoupper($post->category) }},
    @endforeach

@stop