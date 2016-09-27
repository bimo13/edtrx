@extends('dashboard')

@section('title')
    Album &bull; {{ $album->name }}
@stop

@section('styles')
    {{ HTML::style('assets/css/custom/album-detail.css') }}
@stop

@section('main-content')
    <div class="col-sm-12 album-title">
        {{ $album->name }}
    </div>
    <div class="col-sm-12 album-details">
        <p>{{ $album->description }}</p>
        <p>Venue: @if($album->venue != "") {{ $album->venue }} @else - @endif || Date Taken: @if($album->date_taken != "0000-00-00") {{ date("d F, Y", strtotime($album->date_taken)) }} @else - @endif</p>
        @if ($album->teacher_id == $user->id)
            <p>
                <a class="btn btn-edutrax-cyan roundless" href="{{ URL::route('gallery.edit', array($album->id)) }}"><i class="glyphicon glyphicon-pencil"></i></a>
                <a class="btn btn-danger roundless" href="javascript:void(0);" data-toggle="modal" data-target="#modal-delete" data-id="{{ $album->id }}" data-title="album" data-preview="{{ $album->name }}"><i class="glyphicon glyphicon-trash"></i></a>
            </p>
        @endif
    </div>
    <div class="clear"></div>
    <div class="row marginless paddingless">
        <section class="relative" id="bloggrid">
            @foreach($galleries as $gallery)
                <article class="absolute">
                    <div class="col-sm-12 marginless pd-all-5px gallery-box">
                        <img src="{{ asset($gallery->image_path) }}" class="wd-full" />
                        <span class="pull-right txt-size-12px pd-top-5px">
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#modal-delete" data-id="{{ $gallery->id }}" data-title="gallery" data-preview="{{ $gallery->image_path }}">delete</a>
                        </span>
                    </div>
                </article>
            @endforeach
        </section>
    </div>
@stop

@section('scripts')
    {{ HTML::script('assets/js/masonry/pinterest.grid.js') }}
    <script type="text/javascript">
        var base_url = "{{ url() }}";
        var teacher_id = "{{ Sentry::getUser()->id }}";

        $(window).load(function(){
            $('#bloggrid').pinterest_grid({
                no_columns: 4,
                padding_x: 15,
                padding_y: 15,
                margin_bottom: 0,
                single_column_breakpoint: 700
            });
        });
    </script>
    {{ HTML::script('assets/js/custom/album.js') }}
@stop