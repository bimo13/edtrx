@extends('dashboard')

@section('styles')
{{ HTML::style('assets/css/agenda.css') }}
{{ HTML::style('assets/css/datetimepicker/datepicker.css') }}
@stop

@section('web-content')
<div class="row">
    <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12 tanggal">
        <div class="form-group">
            <input id="datepicker" type="hidden" class="date_first">
        </div>
        <div class="clr"></div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-left relative">
            <button class="btn btn-primary btn-flat" onclick="window.location.href='{{ URL::route('agenda.create') }}'"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;&nbsp;Add New</button>
        </div>
    </div>
    <div class="col-lg-8 col-md-7 col-sm-6 col-xs-12">
        <div class="title-tanggal">
            <input type="text" id="date_first" class="isi-day" value="<?php echo date('l') ?>" readonly /><br>
            <input type="text" id="date_scnd" class="isi-date" value="<?php echo date('F d, Y') ?>" readonly />
        </div>
        <div class="table-agenda">
            <table class="table-time" id="schedule">
                
            </table>
            <!-- <div class="img-agenda"><img src="{{ asset('assets/img/agenda.png') }}"></div>
            <a class="btn-agenda" style="">CREATE NEW AGENDA</a> -->
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="modal-delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Confirm Deletion</h4>
            </div>
            <div class="modal-body">
                <p></p>
            </div>
            <div class="modal-footer">
                {{ Form::open(['method' => 'DELETE', 'id' => 'form-delete'])}}
                    <button type="submit" class="btn btn-danger">Yes</button>
                    <button type="button" class="btn btn-grey" data-dismiss="modal">No</button>
                {{ Form::close() }}
            </div>
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