<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Edutrax</title>
        {{ HTML::style('assets/css/bootstrap.css') }}
        {{ HTML::style('assets/css/font-awesome.min.css') }}
        {{ HTML::style('assets/css/my.css') }}
        {{ HTML::style('assets/css/custom.css') }}
        @yield('styles')
    </head>
    <body>
        <?php $user = Sentry::getUser(); ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-xs-12 topbar-nav">
                    <div class="col-md-2 logoContainer">

                        <button class="btn hidden-lg hidden-md hidden-sm menuToggle"><i class="fa fa-bars"></i> </button>
                        <a href="" style="text-decoration: none"><h2>EDU<b>TRACK</b></h2></a>
                    </div>
                    <div class="col-md-5 hidden-xs">
                        <span>HI, {{ $user->first_name; }} {{ $user->last_name; }}</span>
                    </div>
                    <div class="col-md-5 hidden-xs form-right">
                        <div class="input-group text-search">
                            <input type="text" class="form-control" id="searchText" />
                            <div class="input-group-addon" id="searchToggle"><i class="fa fa-search"></i></div>
                        </div>
                        <div class="config">
                            <a href="#"><i class="fa fa-cog"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="wrapper">

            <!-- Sidebar -->
            <div id="sidebar-wrapper">
                <ul class="sidebar-nav">
                    @if($user->hasAnyAccess(array('admin')))
                    <li>
                        <a href="{{ URL::to('/classes') }}"><i class="fa fa-graduation-cap"></i>CLASSES</a>
                    </li>
                    @endif
                    @if($user->hasAnyAccess(array('admin.timeline')))
                    <li>
                        <a href="#"><i class="fa fa-line-chart"></i>TIMELINE</a>
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
                        <a href="{{ URL::to('/account') }}"><img src="{{ asset('assets/img/user.png') }}" alt="..." class="img-circle" style="width: 40px;height: auto">ACCOUNT</a>
                    </li>
                </ul>
            </div>
            <!-- /#sidebar-wrapper -->

            <!-- Page Content -->
            <div id="page-content-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            @yield('web-content')
                            <!-- {{ Sentry::getUser() }} -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- /#page-content-wrapper -->

        </div>

        {{ HTML::script('assets/js/jquery.js') }}
        {{ HTML::script('assets/js/bootstrap.min.js') }}
        @yield('scripts')

        <script>
            $(".menuToggle").click(function (e) {
                e.preventDefault();
                $("#sidebar-wrapper").toggleClass("in");
            });
            $(".input-group-addon#searchToggle").click(function (e) {
                e.preventDefault();
                $("#searchText").toggleClass("active").focus();
                $(this).toggleClass("active");
            });

        </script>
    </body>
</html>