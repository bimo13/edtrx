<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;

class ParentsController extends BaseController {

    protected function redirectNotFound() {
        return $this->redirect('parents.create')
            ->withFlashMessage('An error occured, please try again.')
            ->withFlashType('danger');
    }

    public function rulesList() {
        return $rules = array(
            'first_name'  => 'required|max:255',
            'last_name'   => 'required|max:255',
            'address'     => 'required|max:255',
            'phone_1'     => 'required|max:255',
            'email'       => 'required|email|max:255',
            'password'    => 'required|min:8|max:255',
            'captcha'     => 'required|captcha'
        );
    }

    public function create() {
        return View::make('parents-registrationForm');
    }

    public function store() {
        return StudentParent::saveNewParent(array('input' => Input::all(), 'rules' => $this->rulesList()));
    }

}
