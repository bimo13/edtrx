<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Edutrax</title>
        {{ HTML::style('assets/css/bootstrap.css') }}
        {{ HTML::style('assets/css/font-awesome.min.css') }}
        {{ HTML::style('assets/css/custom.css') }}
    </head>
    <body class="body-login">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 box-login">
                    <h3>EDU<b>TRAX</b></h3>
                    <h5>LOG INTO EDUTRACK ACCOUNT</h5>
                    <form class="form-horizontal" method="POST" action="./login">
                        <div class="form-group">
                            <div class="col-md-12"><input name="email" type="email" class="form-control" placeholder="email" /></div>
                            <div class="col-md-12"><input name="password" type="password" class="form-control" placeholder="password" /></div>
                            <div class="col-md-12"><input type="submit" class="btn btn-orange" value="Login" /></div>
                        </div>
                        @if($errors->any())
                            <div class="text-danger">{{ $errors->first() }}</div>
                        @endif
                    </form>
                </div>
                <!-- <div class="col-md-3 footer-login">
                    <a href="#" class="pull-left">Forgot Password?</a>
                    <a href="http://raditya-pratama.com/edutrax/sign_up.php" class="pull-right" style="left: 15px;">Don't have account?<span>Get Started</span></a>
                </div> -->
            </div>
        </div>
        <div class="navbar-fixed-bottom">
            <div class="col-md-3 login-footer">
                <a href="javascript:void(0);">Forgot Password?</a>
                <a href="javascript:void(0);">Don't have account? <span>Get Started</span></a>
            </div>
        </div>
        {{ HTML::script('assets/js/jquery.js') }}
        {{ HTML::script('assets/js/bootstrap.min.js') }}
    </body>
</html>