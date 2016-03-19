<?php

class MainController extends BaseController {

    public function index() {
        return View::make('login');
    }

    public function dashboard() {
        // try {
        //     $user = Sentry::getUser();
        //     // $user = Sentry::findUserByID(1);
        //     $userGroup = $user->hasAccess('admin');
        // } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
        //     echo 'User was not found.';
        // }

        // var_dump($userGroup); die();

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
