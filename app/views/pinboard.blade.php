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

    @foreach($pinboards as $pinboard)

        <div class="col-lg-3 col-xs-12">
            <div class="gallery">
                <div class="imagegallery" style="text-align: center; background-color: #5D5D5D;">
                    @if ($pinboard->file_type == "xlsx" || $pinboard->file_type == "xls")
                        <img src="{{ asset('assets/img/pin-excel.jpg') }}" height="100%" />
                    @elseif ($pinboard->file_type == "docx" || $pinboard->file_type == "doc")
                        <img src="{{ asset('assets/img/pin-word.jpg') }}" height="100%" />
                    @elseif ($pinboard->file_type == "pptx" || $pinboard->file_type == "ppt")
                        <img src="{{ asset('assets/img/pin-ppt.jpg') }}" height="100%" />
                    @elseif ($pinboard->file_type == "pdf")
                        <img src="{{ asset('assets/img/pin-pdf.jpg') }}" height="100%" />
                    @endif
                </div>
                <div class="textgallery">
                    <div class="tetxttitle">
                        <a href="{{ url('/pinboard/'.$pinboard->id) }}">
                            {{ $pinboard->name }}
                        </a>
                    </div>
                    <div class="textdate">
                        {{ date("d F Y", strtotime($pinboard->created_at)) }}
                    </div>
                </div>
            </div>
        </div>

    @endforeach

    <div class="clr"></div>

</div>
@stop