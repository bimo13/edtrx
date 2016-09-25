<?php

class AuthController extends BaseController {

    public function login() {
        try {
            $credentials = array(
                'email'    => Input::get('email'),
                'password' => Input::get('password'),
            );

            $user = Sentry::authenticate($credentials, false);
            Session::put('email',Input::get('email'));
            Session::put('password',Input::get('password'));
            return Redirect::to('/dashboard');
        } catch (Cartalyst\Sentry\Users\LoginRequiredException $e) {
            return Redirect::to('/')->withErrors(array(Lang::get('Login field is required.')));
        } catch (Cartalyst\Sentry\Users\PasswordRequiredException $e) {
            return Redirect::to('/')->withErrors(array(Lang::get('Password field is required.')));
        } catch (Cartalyst\Sentry\Users\WrongPasswordException $e) {
            return Redirect::to('/')->withErrors(array(Lang::get('Password incorrect, try again.')));
        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
            return Redirect::to('/')->withErrors(array(Lang::get('User not found.')));
        } catch (Cartalyst\Sentry\Users\UserNotActivatedException $e) {
            return Redirect::to('/')->withErrors(array(Lang::get('User not activated.')));
        }
    }

    public function logout() {
        Sentry::logout();
        Session::forget('email');
        Session::forget('password');
        return Redirect::to('/');
    }

}