@extends('dashboard')

@section('web-content')
<div class="row filterStudents">
    <div class="col-xs-12">
        <div class="row">
            <div class="col-lg-12">
                <form class="form-horizontal">
                    <div class="form-group form-gallery">
                        <div class="col-sm-3">
                            <button type="button" class="btn btn-flat" onclick="window.location.href='{{ URL::route('gallery.create') }}'"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;&nbsp;Add New</button>
                        </div>
                        <div class="col-md-6 control-label">Sort by :</div>
                        <div class="col-md-3"><select class="form-control"><option>Name </option></select></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row galleryContainer">

    @foreach($albums as $album)
    <?php $cover = Gallery::where('album_id', '=', $album->id)->first(); ?>
    <div class="col-lg-4 col-xs-12">
        <div class="gallery">
            <div class="imagegallery" style="text-align: center;"><img src="{{ asset($cover->image_path) }}" width="100%"></div>
            <div class="textgallery">
                <span class="tetxttitle">
                    <a href="{{ url('/album/'.$album->id) }}">{{ $album->name }}</a>
                </span>
                <p>{{ substr($album->description,0,80) }}...</p>
                <span>{{ date("d F, Y", strtotime($album->created_at)); }}</span>
            </div>
        </div>
    </div>
    @endforeach

</div>
@stop