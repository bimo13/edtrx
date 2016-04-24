@extends('dashboard')

@section('web-content')
<div class="row filterStudents">
    <div class="col-xs-12">
        <div class="row">
            <div class="col-lg-12">
                <form class="form-horizontal">
                    <div class="form-group form-gallery">
                        <div class="col-sm-3">
                            <button type="button" class="btn btn-flat" onclick="window.location.href='{{ URL::route('pinboard.create') }}'"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;&nbsp;Add New</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row galleryContainer">

    <div class="col-lg-3 col-xs-12">
        <div class="gallery">
            <div class="imagegallery" style="text-align: center; background-color: #5D5D5D;"><img src="{{ asset('assets/img/pin-excel.jpg') }}" height="100%"></div>
            <div class="textgallery">
                <span class="tetxttitle">
                    <a href="{{ url('/pinboard/') }}">Sample</a>
                </span>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-xs-12">
        <div class="gallery">
            <div class="imagegallery" style="text-align: center; background-color: #5D5D5D;"><img src="{{ asset('assets/img/pin-word.jpg') }}" height="100%"></div>
            <div class="textgallery">
                <span class="tetxttitle">
                    <a href="{{ url('/pinboard/') }}">Sample</a>
                </span>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-xs-12">
        <div class="gallery">
            <div class="imagegallery" style="text-align: center; background-color: #5D5D5D;"><img src="{{ asset('assets/img/pin-ppt.jpg') }}" height="100%"></div>
            <div class="textgallery">
                <span class="tetxttitle">
                    <a href="{{ url('/pinboard/') }}">Sample</a>
                </span>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-xs-12">
        <div class="gallery">
            <div class="imagegallery" style="text-align: center; background-color: #5D5D5D;"><img src="{{ asset('assets/img/pin-excel.jpg') }}" height="100%"></div>
            <div class="textgallery">
                <span class="tetxttitle">
                    <a href="{{ url('/pinboard/') }}">Sample</a>
                </span>
            </div>
        </div>
    </div>

</div>
@stop