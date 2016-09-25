<!DOCTYPE html>
<html>
    <head>
        <title>
            eduTRAX - @yield('title')
        </title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Bootstrap core CSS -->
        {{ HTML::style('assets/css/bootstrap/bootstrap.min.css') }}
        {{ HTML::style('assets/css/font-awesome/font-awesome.min.css') }}
        {{ HTML::style('assets/css/custom/my.css') }}
        {{ HTML::style('assets/css/custom/dashboard.css') }}
        {{ HTML::style('assets/css/custom/edutrax.css') }}

        @yield('styles')
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>

        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ URL::to('/dashboard') }}">EDU<b>TRAX</b></a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="{{ URL::to('/logout') }}"><i class="glyphicon glyphicon-off"></i></a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-2 sidebar">
                    <ul class="nav nav-sidebar">
                        @if($user->hasAnyAccess(array('admin')))
                    <li>
                        <a href="{{ URL::to('/classes') }}"><i class="fa fa-graduation-cap"></i>CLASSES</a>
                    </li>
                    @endif
                    @if($user->hasAnyAccess(array('admin.timeline')))
                    <li>
                        <a href="{{ URL::to('/timeline') }}"><i class="fa fa-line-chart"></i>TIMELINE</a>
                    </li>
                    @endif
                    @if($user->hasAnyAccess(array('admin.attendance')))
                    <li>
                        <a href="{{ URL::to('/attendance') }}"><i class="fa fa-file-text-o"></i>ATTENDANCE</a>
                    </li>
                    @endif
                    @if($user->hasAnyAccess(array('admin.agenda')))
                    <li>
                        <a href="{{ URL::to('/agenda') }}"><i class="fa fa-calendar"></i>AGENDA</a>
                    </li>
                    @endif
                    @if($user->hasAnyAccess(array('admin.grade')))
                    <li>
                        <a href="#"><i class="fa fa-font"></i>GRADE</a>
                    </li>
                    @endif
                    @if($user->hasAnyAccess(array('admin.student')))
                    <li>
                        <a href="{{ URL::to('/students') }}"><i class="fa fa-users"></i>STUDENT</a>
                    </li>
                    @endif
                    @if($user->hasAnyAccess(array('admin.gallery')))
                    <li>
                        <a href="{{ URL::to('/gallery') }}"><i class="fa fa-image"></i>GALLERY</a>
                    </li>
                    @endif
                    @if($user->hasAnyAccess(array('admin.pinboard')))
                    <li>
                        <a href="{{ URL::to('/pinboard') }}"><i class="glyphicon glyphicon-pushpin"></i>PIN BOARD</a>
                    </li>
                    @endif
                    @if($user->hasAnyAccess(array('admin.todo')))
                    <li>
                        <a href="{{ URL::to('/todo') }}"><i class="glyphicon glyphicon-file"></i>TO DO LIST</a>
                    </li>
                    @endif
                    @if($user->hasAnyAccess(array('admin.inbox')))
                    <li>
                        <a href="#"><i class="fa fa-inbox"></i>INBOX</a>
                    </li>
                    @endif
                    <li>
                        <a href="{{ URL::to('/help') }}"><i class="fa fa-question-circle"></i>HELP</a>
                    </li>
                    @if($user->hasAnyAccess(array('admin.users')))
                    <li>
                        <a href="{{ URL::to('/users') }}"><i class="fa fa-user"></i>USER MANAGEMENT</a>
                    </li>
                    @endif
                    <li>
                        <a href="{{ URL::to('/chat') }}"><i class="fa fa-comments-o"></i>CHAT</a>
                    </li>
                    <li>
                        <a href="{{ URL::to('/account') }}"><img src="{{ asset('assets/img/user.png') }}" alt="..." class="img-circle" style="width: 40px;height: auto">ACCOUNT</a>
                    </li>
                    </ul>
                    <div class="clear"></div>
                </div>
                <div class="col-sm-10 col-sm-offset-2 main">
                    @yield('main-content')
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

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        {{ HTML::script('assets/js/jquery.js') }}
        {{ HTML::script('assets/js/bootstrap/bootstrap.min.js') }}
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        {{ HTML::script('assets/js/bootstrap/ie10-viewport-bug-workaround.js') }}
        @yield('scripts')
    </body>
</html>