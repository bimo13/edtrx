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
        // $trim = Trim::GetTrim("Lorem Ipsum Dolor",10);
        // var_dump($trim); die();
        $albums = Album::getAllAlbum();
        return View::make('gallery', compact('albums'));
    }

    public function create() {
        $blankArray = array('' => '');
        return View::make('gallery-form', compact('blankArray'));
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


}
