<?php

class AlbumsController extends BaseController {

    public function rulesList() {
        return $rules = array(
            'name'       => 'required|max:255',
            'date_taken' => 'date',
            'images'     => 'required'
        );
    }

    public function messagesList() {
        return $rules = array(
            'images.required' => 'Either you haven\'t upload an image, or your image(s) size exceed 2Mb.'
        );
    }

    public function create() {
        $blankArray = array('' => '');
        return View::make('album-form', compact('blankArray'));
    }

    public function store() {
        return Album::saveNewAlbum(array('input' => Input::all(), 'rules' => $this->rulesList(), 'messages' => $this->messagesList()));
    }

    public function show($id) {
        echo"welcome";
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
