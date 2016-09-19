@extends('dashboard')

@section('styles')
{{ HTML::style('assets/css/datatables/jquery.dataTables.css') }}
@stop

@section('web-content')

<div class="container-fluid">
    @if(Session::has('message'))
        <div class="col-lg-12 bg-{{ Session::get('alert-class', 'alert-info') }} pd-all-15px mg-bottom-10px">
            <p class="text-{{ Session::get('alert-class', 'alert-info') }} marginless">{{ Session::get('message') }}</p>
        </div>
        <div id="QB-alertWrap" class="col-lg-12 pd-all-15px mg-bottom-25px bg-info">
            <p id="QB-alertText" class="marginless text-info"><i class="fa fa-spinner fa-spin"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Creating chat user.</p>
        </div>
    @endif

    <div class="col-sm-6">
        <button data-toggle="modal" data-target="#modal-search" class="btn btn-flat" id="search-btn"><i class="fa fa-search"></i> Search</button>
        <button class="btn btn-flat" id="refresh-btn">Refresh Table / Clear Search</button>
    </div>
    <div class="col-sm-6 text-right">
        <button class="btn btn-flat" onclick="window.location.href='{{ URL::route('users.create') }}'"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;&nbsp;Add New</button>
    </div>
    <div class="col-lg-12">

        <table id="datatables" class="table table-bordered table-condensed table-striped">
            <thead>
                <tr>
                    <th>Teacher No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
        </table>

    </div>
</div>

@stop

@section('scripts')
<script type="text/javascript">var base_url = "{{ url() }}";</script>
{{ HTML::script('assets/js/datatables/jquery.dataTables.min.js') }}
{{ HTML::script('assets/js/index-pages/users.js') }}
{{ HTML::script('assets/qblox/js/quickblox.min.js') }}
{{ HTML::script('assets/qblox/js/config.js') }}
<script>
    QB.init(QBApp.appId, QBApp.authKey, QBApp.authSecret);
    $(document).ready(function() {
        QB.createSession(function(err,result){
            console.log('Session create callback', err, result);
        });
    });
</script>
@if(Session::has('message') && Session::get('alert-class') == "success")
    <script type="text/javascript">
        $(document).ready(function() {
            setTimeout( function(){
                var login    = "{{ Session::get('usnm') }}";
                var password = "{{ Session::get('pswd') }}";
                var fullname = "{{ Session::get('fullname') }}";
                var params   = { 'login': login, 'password': password, 'full_name': fullname, 'email': login, 'tag_list': "teacher"};

                QB.users.create(params, function(err, user){
                    if (user) {
                        $("#QB-alertWrap").removeClass('bg-info');
                        $("#QB-alertText").removeClass('text-info');
                        $("#QB-alertWrap").addClass('bg-success');
                        $("#QB-alertText").addClass('text-success');
                        $("#QB-alertText").empty();
                        $("#QB-alertText").html('Chat user successfully created.');
                    } else  {
                        $("#QB-alertWrap").removeClass('bg-info');
                        $("#QB-alertText").removeClass('text-info');
                        $("#QB-alertWrap").addClass('bg-danger');
                        $("#QB-alertText").addClass('text-danger');
                        $("#QB-alertText").empty();
                        $("#QB-alertText").html('Can\'t create chat user, please contact us to report this error.<br />' + JSON.stringify(err));
                    }
                });
            }, 2000);
        });
    </script>
@endif
@stop