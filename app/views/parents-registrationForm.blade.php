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
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-xs-12 topbar-nav">
                    <div class="col-md-2 logoContainer">

                        <button class="btn hidden-lg hidden-md hidden-sm menuToggle"><i class="fa fa-bars"></i> </button>
                        <a href="" style="text-decoration: none"><h2>EDU<b>TRACK</b></h2></a>
                    </div>
                    <div class="col-md-5 hidden-xs">
                        <span>Welcome to EduTrax</span>
                    </div>
                </div>
            </div>
        </div>
        <div id="wrapper">

            <!-- Sidebar -->
            <div id="sidebar-wrapper">
                <ul class="sidebar-nav">
                    <li>
                        <a href="{{ URL::to('/') }}"><i class="fa fa-home"></i>MAIN PAGE</a>
                    </li>
                </ul>
            </div>
            <!-- /#sidebar-wrapper -->

            <!-- Page Content -->
            <div id="page-content-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="container-fluid">
                                <div class="col-lg-12">
                                    <div class="main-form-wrapper" >

                                        @if(Session::has('message'))
                                            <div class="col-lg-12 bg-{{ Session::get('alert-class', 'alert-info') }} pd-all-15px mg-bottom-10px">
                                                <p class="text-{{ Session::get('alert-class', 'alert-info') }} marginless">{{ Session::get('message') }}</p>
                                            </div>
                                            <div id="QB-alertWrap" class="col-lg-12 pd-all-15px mg-bottom-25px bg-info">
                                                <p id="QB-alertText" class="marginless text-info"><i class="fa fa-spinner fa-spin"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Creating chat user.</p>
                                            </div>
                                        @endif

                                        {{ Form::open(array('method' => 'POST', 'route' => array('parents.store'), 'files' => 'true', 'autocomplete' => 'off')) }}

                                            <div class="form-group col-lg-6">
                                                {{ Form::label('first_name', 'First Name:') }}
                                                {{ Form::text('first_name', null, array('class' => 'form-control')) }}
                                                {{ $errors->first('first_name', '<div class="text-danger">:message</div>') }}
                                            </div>

                                            <div class="form-group col-lg-6">
                                                {{ Form::label('last_name', 'Last Name:') }}
                                                {{ Form::text('last_name', null, array('class' => 'form-control')) }}
                                                {{ $errors->first('last_name', '<div class="text-danger">:message</div>') }}
                                            </div>

                                            <div class="form-group col-lg-12">
                                                {{ Form::label('address', 'Address:') }}
                                                {{ Form::textarea('address', null, array('class' => 'form-control')) }}
                                                {{ $errors->first('address', '<div class="text-danger">:message</div>') }}
                                            </div>

                                            <div class="form-group col-lg-6">
                                                {{ Form::label('phone_1', 'Phone #1:') }}
                                                {{ Form::text('phone_1', null, array('class' => 'form-control')) }}
                                                {{ $errors->first('phone_1', '<div class="text-danger">:message</div>') }}
                                            </div>

                                            <div class="form-group col-lg-6">
                                                {{ Form::label('phone_2', 'Phone #2:') }}
                                                {{ Form::text('phone_2', null, array('class' => 'form-control')) }}
                                                {{ $errors->first('phone_2', '<div class="text-danger">:message</div>') }}
                                            </div>

                                            <div class="form-group col-lg-12">
                                                {{ Form::label('photo', 'Photo:') }}
                                                {{ Form::file('photo', array('class' => 'filestyle', 'data-buttonText' => '&nbsp;&nbsp;Browse', 'data-buttonName' => 'btn-primary')) }}
                                                {{ $errors->first('photo', '<div class="text-danger">:message</div>') }}
                                            </div>

                                            <div class="form-group col-lg-6">
                                                {{ Form::label('email', 'Email:') }}
                                                {{ Form::text('email', null, array('class' => 'form-control')) }}
                                                {{ $errors->first('email', '<div class="text-danger">:message</div>') }}
                                            </div>

                                            <div class="form-group col-lg-6">
                                                {{ Form::label('password', 'Password:') }}
                                                {{ Form::password('password', array('class' => 'form-control')) }}
                                                {{ $errors->first('password', '<div class="text-danger">:message</div>') }}
                                            </div>

                                            <div class="form-group col-lg-6">
                                                {{ Form::label('captcha', 'Captcha:') }}<br />
                                                {{ HTML::image(Captcha::img(), 'Captcha image') }}
                                                {{ Form::text('captcha', null, array('class' => 'form-control')) }}
                                                {{ $errors->first('captcha', '<div class="text-danger">:message</div>') }}
                                            </div>

                                            <div class="form-group col-lg-12">
                                                {{ Form::submit('Register', array('class' => 'btn btn-primary')) }}
                                            </div>

                                        {{ Form::close() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /#page-content-wrapper -->

        </div>

        {{ HTML::script('assets/js/jquery.js') }}
        {{ HTML::script('assets/js/bootstrap.min.js') }}
        {{ HTML::script('assets/js/forms.filestyle.js') }}
        {{ HTML::script('assets/qblox/js/quickblox.min.js') }}
        {{ HTML::script('assets/qblox/js/config.js') }}

        @yield('scripts')

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
                        var params   = { 'login': login, 'password': password, 'full_name': fullname, 'email': login, 'tag_list': "parent"};

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