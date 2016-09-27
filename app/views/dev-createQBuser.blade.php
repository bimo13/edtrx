<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Edutrax</title>
        @yield('styles')
    </head>
    <body>

        

        <?php $user = Sentry::getUser(); ?>

        {{ HTML::script('assets/js/jquery.js') }}
        {{ HTML::script('assets/js/bootstrap.min.js') }}
        {{ HTML::script('https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.6.0/jquery.nicescroll.min.js') }}
        {{ HTML::script('https://cdnjs.cloudflare.com/ajax/libs/jquery-timeago/1.4.1/jquery.timeago.min.js') }}

        {{ HTML::script('assets/qblox/js/quickblox.min.js') }}
        {{ HTML::script('assets/qblox/libs/stickerpipe/js/stickerpipe.js') }}
        {{ HTML::script('assets/qblox/js/config.js') }}
        {{ HTML::script('assets/qblox/js/connection.js') }}
        {{ HTML::script('assets/qblox/js/messages.js') }}
        {{ HTML::script('assets/qblox/js/stickerpipe.js') }}
        {{ HTML::script('assets/qblox/js/ui_helpers.js') }}
        {{ HTML::script('assets/qblox/js/dialogs.js') }}
        {{ HTML::script('assets/qblox/js/users.js') }}
        @yield('scripts')
    </body>
</html>