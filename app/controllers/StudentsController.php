<?php

use DataTables\DataTablesCustom as DatatablesCustom;
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
        $user = Sentry::getUser();
        $students = Student::get();
        return View::make('students', compact('user', 'students'));
    }

    public function create() {
        $user = Sentry::getUser();
        $blankArray = array('' => '');
        $genders = array('' => '', 'male' => 'Male', 'female' => 'Female');
        $parents = StudentParent::select(DB::raw("CONCAT(first_name,' ',last_name) AS full_name, id"))->lists('full_name','id');
        $parents = $blankArray + $parents;
        $class_id = Classes::lists('class_name', 'id');
        $class_id = $blankArray + $class_id;
        return View::make('students-form', compact('user', 'blankArray', 'genders', 'parents', 'class_id'));
    }

    public function store() {
        return Student::saveNewStudent(array('input' => Input::all(), 'rules' => $this->rulesList()));
    }

    public function show($id) {
        //
    }


    public function edit($id) {
        $user = Sentry::getUser();
        try {
            $model = Student::findOrFail($id);
            $blankArray = array('' => '');
            $genders = array('' => '', 'male' => 'Male', 'female' => 'Female');
            $parents = StudentParent::select(DB::raw("CONCAT(first_name,' ',last_name) AS full_name, id"))->lists('full_name','id');
            $parents = $blankArray + $parents;
            $class_id = Classes::lists('class_name', 'id');
            $class_id = $blankArray + $class_id;
            return View::make('students-form', compact('user', 'model', 'blankArray', 'genders', 'parents', 'class_id'));
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }


    public function update($id) {
        return Student::updateStudent(array('input' => Input::all(), 'rules' => $this->rulesList()));
    }


    public function destroy($id) {
        return Student::deleteStudent(array('id' => $id));
    }

    // END OF RESTful ROUTING
    // BEGIN DATA-TRANSACTION ROUTING (AJAX NECESSITIES)
    public function getMyStudents() {
        $students = Student::getMyStudent();

        // Begin constructing data for datatables
        $datatable = DatatablesCustom::of($students);
        $datatable->remove_column('id');
        $datatable->edit_column('action', function($obj) {
            $ret = '<a href="javascript:void(0);">View Detail</a>';
            return $ret;
        });
        return $datatable->out();
    }

}