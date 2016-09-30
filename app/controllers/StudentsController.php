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
        $user = Sentry::getUser();
        try {
            $student = Student::findOrFail($id);
            return View::make('students-detail', compact('user', 'student'));
        } catch (ModelNotFoundException $e) {
            return Redirect::to('/students/')->withErrors(array('msg' => 'Failed to parse pinboard data, please try again.'));
        }
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

    public function search() {
        $user = Sentry::getUser();
        $keyword = Input::get('student-search');
        if ($keyword != NULL && $keyword != "") {
            $students = Student::where('first_name', 'LIKE', '%'.$keyword.'%')
                                    ->orWhere('last_name', 'LIKE', '%'.$keyword.'%')
                                    ->orWhere('student_no', 'LIKE', '%'.$keyword.'%');
            if ($students->count() > 0) {
                $students = $students->get();
                return View::make('students', compact('user', 'students'));
            } else {
                Session::flash('message', 'No data has been found. Please try another keyword.'); 
                Session::flash('alert-class', 'danger');
                return Redirect::to('/students');
            }
        } else {
            Session::flash('message', 'Keyword cannot be empty. Please try again.'); 
            Session::flash('alert-class', 'danger');
            return Redirect::to('/students');
        }
    }

    // END OF RESTful ROUTING
    // BEGIN DATA-TRANSACTION ROUTING (AJAX NECESSITIES)
    public function getMyStudents() {
        $students = Student::getMyStudent();

        // Begin constructing data for datatables
        $datatable = DatatablesCustom::of($students);
        $datatable->remove_column('id');
        $datatable->edit_column('action', function($obj) {
            $ret = '<a href="' . URL::to("/attendance/student/".$obj->id) . '">View Detail</a>';
            return $ret;
        });
        return $datatable->make();
    }

}