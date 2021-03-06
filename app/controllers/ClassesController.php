<?php

use DataTables\DataTablesCustom as DatatablesCustom;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ClassesController extends BaseController {

    protected function redirectNotFound() {
        return $this->redirect('classes.index')
            ->withFlashMessage('Data not found, please try again.')
            ->withFlashType('danger');
    }

    public function rulesList() {
        return $rules = array(
            'class_name'  => 'required|max:255',
            'grade_level'  => 'required|integer',
            'teacher_id'   => 'required|integer'
        );
    }

    public function index() {
        $user = Sentry::getUser();
        return View::make('class', compact('user'));
    }

    public function create() {
        $user = Sentry::getUser();
        $blankArray = array('' => '');
        $teachers = User::select(DB::raw('CONCAT(first_name, " ", last_name) AS full_name, id'))->where('id', '!=', 1)->orderBy('full_name')->lists('full_name', 'id');
        $teachers = $blankArray + $teachers;
        $teachers = array_map(function($word) { return ucwords(strtolower($word)); }, $teachers);
        return View::make('class-form', compact('user', 'blankArray', 'teachers'));
    }

    public function store() {
        return Classes::saveNewClass(array('input' => Input::all(), 'rules' => $this->rulesList()));
    }

    public function show($id) {
        //
    }

    public function edit($id) {
        $user = Sentry::getUser();
        try {
            $model = Classes::findOrFail($id);
            $blankArray = array('' => '');
            $teachers = User::select(DB::raw('CONCAT(first_name, " ", last_name) AS full_name, id'))->where('id', '!=', 1)->orderBy('full_name')->lists('full_name', 'id');
            $teachers = $blankArray + $teachers;
            $teachers = array_map(function($word) { return ucwords(strtolower($word)); }, $teachers);
            return View::make('class-form', compact('model', 'user', 'blankArray', 'teachers'));
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    public function update($id) {
        return Classes::updateClass(array('input' => Input::all(), 'rules' => $this->rulesList()));
    }

    public function destroy($id) {
        return Classes::deleteClass(array('id' => $id));
    }

    // END OF RESTful ROUTING
    // BEGIN DATA-TRANSACTION ROUTING (AJAX NECESSITIES)
    public function getClassesData() {
        // Get all classes from Model's scope
        $classes = Classes::getAllData();

        // Begin constructing data for datatables
        $datatable = DatatablesCustom::of($classes);
        $datatable->remove_column('id');
        $datatable->edit_column('teacher_id', function($obj) {
            if ($obj->user->userDetail->gender == "male")
                $honorifics = "Mr.";
            else
                $honorifics = "Mrs.";

            $first_name = ucwords(strtolower($obj->user->first_name));
            $last_name = ucwords(strtolower($obj->user->last_name));
            return $honorifics." ".$first_name." ".$last_name;
        });
        $datatable->edit_column('action', function($obj) {
            $ret = '<a href="' . URL::route('classes.edit', array($obj->id)) . '"><i class="glyphicon glyphicon-pencil"></i></a>
                    &middot;
                    <a href="javascript:void(0);" data-toggle="modal" data-target="#modal-delete" data-id="' . $obj->id . '" data-title="classes" data-preview="' . $obj->class_name . '">
                        <i class="text-danger glyphicon glyphicon-trash"></i>
                    </a>';
            return $ret;
        });
        return $datatable->out();
    }

}
