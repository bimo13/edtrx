<?php

use DataTables\DataTablesCustom as DatatablesCustom;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PinboardController extends BaseController {

    protected function redirectNotFound() {
        return $this->redirect('pinboard.index')
            ->withFlashMessage('Data not found, please try again.')
            ->withFlashType('danger');
    }

    public function rulesList() {
        return $rules = array(
            'name'     => 'required|max:255',
            'file'     => 'required',
            'share_to' => 'arrayofint',
        );
    }

    public function messagesList() {
        return $rules = array(
            'file.required' => 'You need to upload a file for this pinboard.',
            'share_to.arrayofint' => 'An error occured during saving your sharing list, please try again.'
        );
    }

    public function index() {
        $user = Sentry::getUser();
        $pinboards = Pinboard::get();
        return View::make('pinboard', compact('user', 'pinboards'));
    }

    public function create() {
        $user = Sentry::getUser();
        $parents = StudentParent::select(DB::raw("CONCAT(first_name,' ',last_name) AS full_name, id"))->lists('full_name','id');
        return View::make('pinboard-form', compact('user', 'parents'));
    }

    public function store() {
        return Pinboard::saveNewPinboard(array('input' => Input::all(), 'rules' => $this->rulesList(), 'messages' => $this->messagesList()));
    }

    public function show($id) {
        try {
            $user = Sentry::getUser();
            $pinboard = Pinboard::findOrFail($id);
            return View::make('pinboard-detail', compact('user', 'pinboard'));
        } catch (ModelNotFoundException $e) {
            return Redirect::to('/pinboard/')->withErrors(array('msg' => 'Failed to parse pinboard data, please try again.'));
        }
    }


    public function edit($id) {
        //
    }


    public function update($id) {
        //
    }


    public function destroy($id) {
        return Pinboard::deletePinboard(array('id' => $id));
    }

/*
|--------------------------------------------------------------------------
| New Layout
|--------------------------------------------------------------------------
|
*/

    public function newLayout() {
        $pinboards = Pinboard::get();
        return View::make('new-pinboard', compact('pinboards'));
    }

    public function newFormLayout() {
        $parents = StudentParent::select(DB::raw("CONCAT(first_name,' ',last_name) AS full_name, id"))->lists('full_name','id');
        return View::make('new-pinboard-form', compact('parents'));
    }

}