@extends('new-dashboard')

@section('title')
    Agenda
@stop

@section('styles')
    {{ HTML::style('assets/css/custom/agenda.css') }}
    {{ HTML::style('assets/css/custom/agenda-datepicker.css') }}
@stop

@section('main-content')

    <div class="container-fluid marginless paddingless">
        <div class="row marginless paddingless">

                <div class="col-sm-3 dp-col">
                    <div class="form-group relative dp-box">
                        <input type="hidden" id="datepicker" class="date_first" />
                        <div class="clear"></div>
                    </div>
                    <div class="form-group">
                        <a href="{{ URL::to('/new-layout/agenda-form') }}" class="btn btn-edutrax-cyan roundless pull-right">
                            <i class="fa fa-plus-circle"></i>&nbsp;&nbsp;&nbsp;Create Agenda
                        </a>
                    </div>
                </div>

                <div class="col-sm-9 col-sm-offset-3 agenda-box">

                    <div class="col-sm-12 agenda-day" id="agenda-day">
                        {{ strtoupper(date('l')) }}
                    </div>
                    <div class="col-sm-12 agenda-text" id="agenda-date">
                        {{ strtoupper(date('F d, Y')) }}
                    </div>

                </div>

                <div class="col-sm-9 col-sm-offset-3 schedule-box">
                    <table id="table-schedule">
                        <tr><td>No agenda for this date.</td></tr>
                    </table>
                </div>

        </div>
    </div>

@stop

@section('scripts')
    <script type="text/javascript">
        var base_url = "{{ url() }}";
        var teacher_id = "{{ Sentry::getUser()->id }}";
    </script>
    {{ HTML::script('assets/js/custom/agenda-datepicker.js') }}
    {{ HTML::script('assets/js/custom/agenda.js') }}
@stop