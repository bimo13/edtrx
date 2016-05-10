@extends('dashboard')

@section('title')
    Gallery
@stop

@section('styles')
    {{ HTML::style('assets/css/custom/gallery.css') }}
@stop

@section('main-content')
    <div class="col-sm-12 mg-bottom-20px">
        <a href="{{ URL::route('gallery.create') }}" class="btn btn-edutrax-cyan roundless"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;&nbsp;Create Album</a>
    </div>

    @foreach($albums as $album)
        <?php $cover = Gallery::where('album_id', '=', $album->id)->first(); ?>
        <div class="col-sm-4 mg-bottom-20px">
            <a href="{{ URL::to('/album/'.$album->id) }}">
                <div class="cover" style="background-image: url('{{ asset($cover->image_path) }}');"></div>
            </a>
            <div class="title">
                <a href="{{ URL::to('/album/'.$album->id) }}">{{ $album->name }}</a>
            </div>
            <div class="date">
                {{ date("d F, Y", strtotime($album->created_at)) }}
            </div>
        </div>
    @endforeach
@stop

@section('scripts')

@stop