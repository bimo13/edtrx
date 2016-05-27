@extends('dashboard')

@section('title')
    Pinboard
@stop

@section('styles')
    {{ HTML::style('assets/css/custom/pinboard.css') }}
@stop

@section('main-content')
    <div class="col-sm-4">
        {{ Form::open(array('id' => 'pinboard-search-form', 'method' => 'POST', 'url' => 'pinboard.search', 'autocomplete' => 'off')) }}
            <div class="form-group pinboard-search-form">
                <div class="input-group">
                    {{ Form::text('pinboard-search', null, array('class' => 'form-control roundless', 'placeholder' => 'Search Board Name')) }}
                    <span class="input-group-btn">
                        {{ Form::button('<i class="glyphicon glyphicon-search"></i>', array('type' => 'submit', 'class' => 'btn roundless btn-edutrax-cyan')) }}
                    </span>
                </div>
            </div>
        {{ Form::close() }}
    </div>
    <div class="col-sm-4 col-sm-offset-4">
        <a href="{{ URL::route('pinboard.create') }}" class="btn btn-edutrax-cyan roundless add-board-btn pull-right">
            <i class="fa fa-plus-circle"></i>&nbsp;&nbsp;&nbsp;Add Board
        </a>
    </div>
    <div class="col-sm-12 marginless paddingless">
        @foreach($pinboards as $pinboard)
            <div class="col-sm-3 mg-bottom-15px">
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
                <div class="col-sm-12 marginless paddingless pinboard-name">
                    {{ $pinboard->name }}
                </div>
                <div class="col-sm-12 marginless paddingless pinboard-date">
                    {{ date("d F, Y", strtotime($pinboard->created_at)) }}
                </div>
            </div>
        @endforeach
    </div>
@stop

@section('scripts')
    
@stop