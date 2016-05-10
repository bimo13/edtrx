<?php

class MainController extends BaseController {

    public function index() {
        return View::make('login');
    }

    public function dashboard() {
        $user = Sentry::getUser();
        return View::make('dashboard', compact('user'));
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

/*
|--------------------------------------------------------------------------
| New Layout
|--------------------------------------------------------------------------
|
*/

    public function newLayout() {
        return View::make('new-dashboard');
    }

}
