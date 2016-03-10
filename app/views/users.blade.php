@extends('dashboard')

@section('styles')
{{ HTML::style('assets/css/datatables/jquery.dataTables.css') }}
@stop

@section('web-content')

<div class="container-fluid">
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
@stop