@extends('dashboard')

@section('styles')
{{ HTML::style('assets/css/datetimepicker/datepicker.css') }}
@stop

@section('web-content')
<div class="row">
    <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12 tanggal">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-left">
            <button class="btn btn-primary btn-flat" onclick="window.location.href='{{ URL::route('agenda.create') }}'"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;&nbsp;Add New</button>
        </div>
        <div class="form-group">
            <input id="datepicker" type="hidden" class="date_first">
        </div>
    </div>
    <div class="col-lg-8 col-md-7 col-sm-6 col-xs-12">
        <div class="title-tanggal">
            <input type="text" id="date_first" class="isi-day" value="<?php echo date('l') ?>"><br>
            <input type="text" id="date_scnd" class="isi-date" value="<?php echo date('F d, Y') ?>">
        </div>
        <div class="table-agenda">
            <table class="table-time" id="schedule">
                <!-- <tr>
                    <td class="time">09.00</td>
                    <td class="line">-</td>
                    <td class="desc">Armory Education</td>
                </tr>
                <tr>
                    <td class="time">10.00</td>
                    <td class="line">-</td>
                    <td class="desc"></td>
                </tr>
                <tr>
                    <td class="time">10.00</td>
                    <td class="line">-</td>
                    <td class="desc">Armory Education</td>
                </tr> -->
            </table>
            <div class="img-agenda"><img src="{{ asset('assets/img/agenda.png') }}"></div>
            <a class="btn-agenda" style="">CREATE NEW AGENDA</a>
        </div>
    </div>
</div>
@stop

@section('scripts')
<script type="text/javascript">
    var base_url = "{{ url() }}";
    var teacher_id = "{{ Sentry::getUser()->id }}";
</script>
{{ HTML::script('assets/js/bootstrap-datepicker.js') }}
{{ HTML::script('assets/js/index-pages/agenda.js') }}
@stop