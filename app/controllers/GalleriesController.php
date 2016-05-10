<?php

use Trim\TrimCustom as Trim;

class GalleriesController extends BaseController {

    public function rulesList() {
        return $rules = array(
            'name'       => 'required|max:255',
            'date_taken' => 'date'
        );
    }

    public function index() {
        $user = Sentry::getUser();
        $albums = Album::getAllAlbum();
        return View::make('gallery', compact('user', 'albums'));
    }

    public function create() {
        $user = Sentry::getUser();
        $blankArray = array('' => '');
        $parents = StudentParent::select(DB::raw("CONCAT(first_name,' ',last_name) AS full_name, id"))->lists('full_name','id');
        return View::make('gallery-form', compact('user', 'blankArray', 'parents'));
    }

    public function store() {
        //
    }

    public function show($id) {
        //
    }

    public function edit($id) {
        //
    }

    public function update($id) {
        //
    }

    public function destroy($id) {
        //
    }

/*
|--------------------------------------------------------------------------
| New Layout
|--------------------------------------------------------------------------
|
*/

    public function newLayout() {
        $albums = Album::getAllAlbum();
        return View::make('new-gallery', compact('albums'));
    }

    public function newFormLayout() {
        $blankArray = array('' => '');
        $parents = StudentParent::select(DB::raw("CONCAT(first_name,' ',last_name) AS full_name, id"))->lists('full_name','id');
        return View::make('new-gallery-form', compact('blankArray', 'parents'));
    }

}
