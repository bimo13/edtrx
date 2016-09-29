@extends('dashboard')

@section('styles')
    {{ HTML::style('assets/css/datatables/jquery.dataTables.css') }}
    {{ HTML::style('assets/css/custom/users.css') }}
@stop

@section('main-content')

    <div class="container-fluid">

        <div class="col-sm-12 mg-bottom-10px">
            <button class="btn btn-edutrax-cyan roundless" id="search-btn" data-toggle="modal" data-target="#modal-search"><i class="fa fa-search"></i> Search</button>
            <button class="btn btn-edutrax-cyan roundless" id="refresh-btn">Refresh Table / Clear Search</button>
            <a href="{{ URL::route('users.create') }}" class="btn btn-edutrax-cyan roundless pull-right"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;&nbsp;Add New</a>
        </div>

        <div class="col-sm-12">

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