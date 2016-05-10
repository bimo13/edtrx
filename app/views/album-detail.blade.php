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
    </div>
    <div class="clear"></div>
    <div class="row marginless paddingless">
        <section class="relative" id="bloggrid">
            @foreach($galleries as $gallery)
                <article class="absolute">
                    <div class="col-sm-12 marginless pd-all-5px gallery-box">
                        <img src="{{ asset($gallery->image_path) }}" class="wd-full" />
                    </div>
                </article>
            @endforeach
        </section>
    </div>
@stop

@section('scripts')
    {{ HTML::script('assets/js/masonry/pinterest.grid.js') }}
    <script type="text/javascript">
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
@stop