<?php

use DataTables\DataTablesCustom as DatatablesCustom;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UsersController extends BaseController {

    public function rulesList() {
        return $rules = array(
            'email'       => 'required|max:255|email|unique:users',
            'password'    => 'required|max:255',
            'first_name'  => 'required|max:255',
            'last_name'   => 'required|max:255',
            'teacher_no'  => 'required|max:255|unique:teacher_details',
            'address'     => 'required|max:255',
            'phone_1'     => 'required|max:255',
            'birth_place' => 'required|max:255',
            'birth_date'  => 'required|date',
            'gender'      => 'required|in:male,female'
        );
    }

    public function index() {
        $user = Sentry::getUser();
        return View::make('users', compact('user'));
    }

    public function create() {
        $user = Sentry::getUser();
        $blankArray = array('' => '');
        return View::make('users-form', compact('user', 'blankArray'));
    }

    public function store() {
        return User::saveNewUser(array('input' => Input::all(), 'rules' => $this->rulesList()));
    }

    public function show($id) {
        //
    }

    public function edit($id) {
        $user = Sentry::getUser();
        try {
            $model = User::join('teacher_details', 'users.id', '=', 'teacher_details.user_id')
                ->select('users.*', 'teacher_details.*')
                ->where('users.id', '=', $id)
                ->first();
            $blankArray = array('1' => 'SAMPLE');
            return View::make('users-form', compact('user', 'model','blankArray'));
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    public function update($id) {
        return User::updateUser(array('input' => Input::all(), 'rules' => $this->rulesList()));
    }

    public function destroy($id) {
        return User::deleteUser(array('id' => $id));
    }

    // END OF RESTful ROUTING
    // BEGIN DATA-TRANSACTION ROUTING (AJAX NECESSITIES)
    public function getUsersData() {
        // Get all classes from Model's scope
        $users = User::getAllData();
        // var_dump($users->first()->userDetail); die();

        // Begin constructing data for datatables
        $datatable = DatatablesCustom::of($users);
        $datatable->remove_column('id');
        $datatable->edit_column('full_name', function($obj) {
            if ($obj->userDetail->gender == "male")
                $honorifics = "Mr.";
            else
                $honorifics = "Mrs.";

            $name = ucwords(strtolower($obj->full_name));
            return $honorifics." ".$name;
        });
        $datatable->edit_column('action', function($obj) {
            $ret = '<a href="' . URL::route('users.edit', array($obj->id)) . '"><i class="glyphicon glyphicon-pencil"></i></a>
                    &middot;
                    <a href="javascript:void(0);" data-toggle="modal" data-target="#modal-delete" data-id="' . $obj->id . '" data-title="users" data-preview="' . $obj->full_name . '">
                        <i class="text-danger glyphicon glyphicon-trash"></i>
                    </a>';
            return $ret;
        });
        return $datatable->make();
    }

}
