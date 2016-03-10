<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;

class StudentsController extends BaseController {

    protected function redirectNotFound() {
        return $this->redirect('students.index')
            ->withFlashMessage('Data not found, please try again.')
            ->withFlashType('danger');
    }

    public function rulesList() {
        return $rules = array(
            'student_no'  => 'required|max:255',
            'first_name'  => 'required|max:255',
            'last_name'   => 'required|max:255',
            'address'     => 'required|max:255',
            'phone'       => 'required|max:255',
            'ice_number'  => 'required|max:255',
            'birth_place' => 'required|max:255',
            'birth_date'  => 'required|date',
            'gender'      => 'required|in:male,female',
            'parent_id'   => 'required|integer',
            'class_id'    => 'required|integer'
        );
    }

    public function index() {
        $students = Student::get();
        return View::make('students', compact('students'));
    }

    public function create() {
        $blankArray = array('1' => 'SAMPLE');
        return View::make('students-form', compact('blankArray'));
    }

    public function store() {
        return Student::saveNewStudent(array('input' => Input::all(), 'rules' => $this->rulesList()));
    }

    public function show($id) {
        //
    }


    public function edit($id) {
        try {
            $model = Student::findOrFail($id);
            $blankArray = array('1' => 'SAMPLE');
            return View::make('students-form', compact('model','blankArray'));
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }


    public function update($id) {
        return Student::updateStudent(array('input' => Input::all(), 'rules' => $this->rulesList()));
    }


    public function destroy($id) {
        //
    }

}