<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Edutrax</title>
        {{ HTML::style('assets/css/bootstrap/bootstrap.min.css') }}
        {{ HTML::style('assets/css/font-awesome/font-awesome.min.css') }}
        {{ HTML::style('assets/qblox/libs/stickerpipe/css/stickerpipe.min.css') }}
        {{ HTML::style('assets/qblox/css/style.css') }}
        {{ HTML::style('assets/css/custom/my.css') }}
        {{ HTML::style('assets/css/custom/dashboard.css') }}
        {{ HTML::style('assets/css/custom/edutrax.css') }}
        @yield('styles')
    </head>
    <body>

        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ URL::to('/dashboard') }}">EDU<b>TRAX</b></a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#">Chat</a></li>
                        <li><a href="#" onclick="showNewDialogPopup()">Create dialog</a></li>
                        <li><a href="#" onclick="showDialogInfoPopup()">Dialog info</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="{{ URL::to('/logout') }}"><i class="glyphicon glyphicon-off"></i></a></li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </nav>

        <!-- Main block -->
        <div class="container">
            <div id="main_block">

                <div class="panel panel-primary">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="list-header">
                                    <h4 class="list-header-title">History</h4>
                                </div>
                                <div class="list-group pre-scrollable nice-scroll" id="dialogs-list">
                                    <!-- list of chat dialogs will be here -->
                                </div>
                            </div>
                            <div id="mcs_container" class="col-md-8 nice-scroll">
                                <div class="customScrollBox">
                                    <div class="container del-style">
                                        <div class="content list-group pre-scrollable nice-scroll" id="messages-list">
                                            <!-- list of chat messages will be here -->
                                        </div>
                                    </div>
                                </div>
                                <div><img src="{{ asset('assets/qblox/images/ajax-loader.gif') }}" class="load-msg"></div>
                                <form class="form-inline" role="form" method="POST" action="" onsubmit="return submit_handler(this)">
                                    <div class="input-group">
                                        <span class="input-group-btn input-group-btn_change_load">
                                            <input id="load-img" type="file">
                                            <button type="button" id="attach_btn" class="btn btn-default" onclick="$('#load-img').click();">
                                                <i class="icon-photo"></i>
                                            </button>
                                        </span>
                                        <span class="input-group-btn input-group-btn_change_load">
                                            <button type="button" id="stickers_btn" class="btn btn-default" onclick="">
                                                <i class="icon-sticker"></i>
                                            </button>
                                        </span>

                                        <span class="input-group-btn" style="width: 100%;">
                                            <input type="text" class="form-control" id="message_text" placeholder="Enter message">
                                        </span>

                                        <span class="input-group-btn">
                                            <button  type="submit" id="send_btn" class="btn btn-default" onclick="clickSendMessage()">Send</button>
                                        </span>
                                    </div>
                                    <img src="{{ asset('assets/qblox/images/ajax-loader.gif') }}" id="progress">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Modal (login to chat)-->
        <div id="loginForm" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Sign In to QuickBlox Chat demo</h3>
                    </div>
                    <div class="modal-body">
                        <button type="button" value="Quick" id="user1" class="btn btn-primary btn-lg btn-block">Sign in with Quick</button>
                        <button type="button" value="Blox" id="user2" class="btn btn-success btn-lg btn-block">Sign in with Blox</button>
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal (new dialog)-->
        <div id="add_new_dialog" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Choose users to create a dialog with</h3>
                    </div>
                    <div class="modal-body">
                        <div class="list-group pre-scrollable for-scroll">
                            <div id="users_list" class="clearfix"></div>
                        </div>
                        <div class="img-place"><img src="{{ asset('assets/qblox/images/ajax-loader.gif') }}" id="load-users"></div>
                        <input type="text" class="form-control" id="dlg_name" placeholder="Enter dialog name">
                        <button id="add-dialog" type="button" value="Confirm" id="" class="btn btn-success btn-lg btn-block" onclick="createNewDialog()">Create dialog</button>
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal (update dialog)-->
        <div id="update_dialog" class="modal fade row" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Dialog info</h3>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12 col-sm-12 col-xs-12 new-info">
                            <h5 class="col-md-12 col-sm-12 col-xs-12">Name:</h5>
                            <input type="text" class="form-control" id="dialog-name-input">
                        </div>
                        <h5 class="col-md-12 col-sm-12 col-xs-12 push">Add more user (select to add):</h5>
                        <div class="list-group pre-scrollable occupants" id="push_usersList">
                            <div id="add_new_occupant" class="clearfix"></div>
                        </div>
                        <h5 class="col-md-12 col-sm-12 col-xs-12 dialog-type-info"></h5>
                        <h5 class="col-md-12 col-sm-12 col-xs-12" id="all_occupants"></h5>
                        <button id="update_dialog_button" type="button" value="Confirm" id="" class="btn btn-success btn-ms btn-block"
                        onclick="onDialogUpdate()">Update</button>
                        <button id="delete_dialog_button" type="button" value="Confirm" id="for_width" class="btn btn-danger btn-ms btn-block"
                        onclick="onDialogDelete()">Delete dialog</button>
                    </div>
                </div>
            </div>
        </div>

        <?php $user = Sentry::getUser(); ?>

        <script type="text/javascript">
            var QBLoginEdtrx = {
                login: '{{ Session::get("email"); }}',
                pass: '{{ Session::get("password"); }}'
            };
        </script>

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