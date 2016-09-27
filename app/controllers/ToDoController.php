<?php

use DataTables\DataTablesCustom as DatatablesCustom;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ToDoController extends BaseController {

    protected function redirectNotFound() {
        return $this->redirect('todo.index')
            ->withFlashMessage('Data not found, please try again.')
            ->withFlashType('danger');
    }

    public function rulesList() {
        return $rules = array(
            'date'        => 'required|date',
            'name'        => 'required|max:255',
            'description' => 'required',
            'share_to'    => 'arrayofint',
        );
    }

    public function messagesList() {
        return $rules = array(
            'name.required'       => 'The task field is required.',
            'share_to.arrayofint' => 'An error occured during saving your sharing list, please try again.'
        );
    }

    public function index() {
        $user = Sentry::getUser();
        $todoDates = ToDo::select('date')->groupBy('date')->get();
        return View::make('todo', compact('user', 'todoDates'));
    }

    public function create() {
        $parents = StudentParent::select(DB::raw("CONCAT(first_name,' ',last_name) AS full_name, id"))->lists('full_name','id');
        $user = Sentry::getUser();
        return View::make('todo-form', compact('user', 'parents'));
    }

    public function store() {
        return ToDo::saveNewToDo(array('input' => Input::all(), 'rules' => $this->rulesList(), 'messages' => $this->messagesList()));
    }

    public function show($id) {
        //
    }


    public function edit($id) {
        $parents = StudentParent::select(DB::raw("CONCAT(first_name,' ',last_name) AS full_name, id"))->lists('full_name','id');
        $user = Sentry::getUser();
        try {
            $model = ToDo::findOrFail($id);
            $blankArray = array('' => '');
            return View::make('todo-form', compact('model', 'user', 'parents'));
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }


    public function update($id) {
        return ToDo::updateToDo(array('input' => Input::all(), 'rules' => $this->rulesList(), 'messages' => $this->messagesList()));
    }


    public function destroy($id) {
        return ToDo::deleteToDo(array('id' => $id));
    }

/*
|--------------------------------------------------------------------------
| New Layout
|--------------------------------------------------------------------------
|
*/

    public function newLayout() {
        $todoDates = ToDo::select('date')->groupBy('date')->get();
        return View::make('new-todo', compact('todoDates'));
    }

    // public function newFormLayout() {
    //     $parents = StudentParent::select(DB::raw("CONCAT(first_name,' ',last_name) AS full_name, id"))->lists('full_name','id');
    //     return View::make('new-pinboard-form', compact('parents'));
    // }

}