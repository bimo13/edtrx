<?php

class MainController extends BaseController {

    public function index() {
        return View::make('login');
    }

    public function dashboard() {
        // $credentials = array(
        //     'email'    => 'admin@edutrax.com',
        //     'password' => 'Administrator321+',
        // );

        // $user = Sentry::authenticate($credentials);
        // Sentry::logout();
        return View::make('dashboard');
    }

    public function account() {
        return View::make('account');
    }

    public function agenda() {
        return View::make('agenda');
    }

    public function gallery() {
        return View::make('gallery');
    }

    public function help() {
        return View::make('help');
    }

}
