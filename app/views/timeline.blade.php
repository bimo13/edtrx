@extends('dashboard')

@section('title')
    Timeline
@stop

@section('styles')
    {{ HTML::style('assets/css/sa-datetimepicker/bootstrap-datetimepicker.min.css') }}
    {{ HTML::style('assets/css/custom/timeline.css') }}
@stop

@section('main-content')

    @foreach($timelineDates as $timelineDate)

        <div class="col-sm-2 col-sm-offset-5 text-center date-wrapper">
            <div class="date">{{ strtoupper(date('D', strtotime($timelineDate->day))) }}, {{ date('d M', strtotime($timelineDate->day)) }}</div>
        </div>

        <?php $timelines = Timeline::whereDate('created_at', '=', $timelineDate->day)->get(); ?>
        @foreach($timelines as $timeline)

            @if ($timeline->category == "agenda")
                <?php
                    $timelineDetail = Agenda::find($timeline->post_id);
                    $link = URL::to('/agenda?d='.$timelineDetail->date);
                ?>
                @if ($timelineDetail->date != $timelineDate->day)
                    <div class="col-sm-6 col-sm-offset-3 text-right assigned-date mg-bottom-15px-min paddingless">
                        {{ date('F d, Y', strtotime($timelineDetail->date)) }}, {{ date('H:i', strtotime($timelineDetail->time_start)) }}
                    </div>
                @endif
            @elseif ($timeline->category == "todo")
                <?php
                    $timelineDetail = ToDo::find($timeline->post_id);
                    $link = URL::to('/todo/'.$timeline->post_id);
                ?>
                <div class="col-sm-6 col-sm-offset-3 text-right assigned-date mg-bottom-15px-min paddingless">
                    {{ date('F d, Y', strtotime($timelineDetail->date)) }}
                </div>
            @elseif ($timeline->category == "gallery")
                <?php
                    $timelineDetail = Album::find($timeline->post_id);
                    $link = URL::to('/album/'.$timeline->post_id);
                ?>
            @elseif ($timeline->category == "pinboard")
                <?php
                    $timelineDetail = Pinboard::find($timeline->post_id);
                    $link = URL::to('/pinboard/'.$timeline->post_id);
                ?>
            @endif

            <a href="{{ $link }}">
                <div class="col-sm-6 col-sm-offset-3 bg-ffffff timeline-wrapper pd-top-25px pd-bottom-15px pd-left-40px pd-right-25px mg-top-15px mg-bottom-15px relative">
                    <div class="profpic" style="background-image: url('{{ asset($timeline->User->UserDetail->photo) }}');"></div>
                    <div class="title">
                        @if ($user->id == $timeline->user_id) You @else {{ ucwords(strtolower($timeline->User->first_name)) }} {{ ucwords(strtolower($timeline->User->last_name)) }} @endif posted new @if ($timeline->category == "todo") To Do List @elseif ($timeline->category == "gallery") Album Gallery @else {{ ucwords($timeline->category) }} @endif
                    </div>
                    <div class="detail">
                        @if ($timeline->category == "agenda")
                            {{ Trim\TrimCustom::GetTrim($timelineDetail->description, 50); }}, {{ date('H:i', strtotime($timelineDetail->time_start)) }} - {{ date('H:i', strtotime($timelineDetail->time_end)) }}
                        @else
                            {{ $timelineDetail->name }}
                        @endif
                    </div>
                    @if ($timeline->category == "gallery")
                        <div class="gallery-preview">
                            <?php $previews = Gallery::where('album_id', '=', $timelineDetail->id)->limit(3)->get(); ?>
                            @foreach ($previews as $preview)
                                <div class="col-sm-4 wrapper paddingless">
                                    <div class="thumbnail" style="background-image: url('{{ asset($preview->image_path) }}');"></div>
                                </div>
                            @endforeach
                        </div>
                    @elseif ($timeline->category == "pinboard")
                        <div class="col-sm-4 paddingless">
                            @if ($timelineDetail->file_type == "xlsx")
                                <img src="{{ asset('assets/img/icon-xlsx.png') }}" class="wd-full" />
                            @elseif ($timelineDetail->file_type == "xls")
                                <img src="{{ asset('assets/img/icon-xls.png') }}" class="wd-full" />
                            @elseif ($timelineDetail->file_type == "docx")
                                <img src="{{ asset('assets/img/icon-docx.png') }}" class="wd-full" />
                            @elseif ($timelineDetail->file_type == "doc")
                                <img src="{{ asset('assets/img/icon-doc.png') }}" class="wd-full" />
                            @elseif ($timelineDetail->file_type == "pptx")
                                <img src="{{ asset('assets/img/icon-pptx.png') }}" class="wd-full" />
                            @elseif ($timelineDetail->file_type == "ppt")
                                <img src="{{ asset('assets/img/icon-ppt.png') }}" class="wd-full" />
                            @elseif ($timelineDetail->file_type == "pdf")
                                <img src="{{ asset('assets/img/icon-pdf.png') }}" class="wd-full" />
                            @endif
                        </div>
                    @endif
                </div>
            </a>

        @endforeach

    @endforeach

@stop