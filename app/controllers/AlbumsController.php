<?php

class AlbumsController extends BaseController {

    public function rulesList() {
        return $rules = array(
            'name'       => 'required|max:255',
            'date_taken' => 'date',
            'images'     => 'required',
            'share_to'   => 'arrayofint',
        );
    }

    public function messagesList() {
        return $rules = array(
            'images.required' => 'Either you haven\'t upload an image, or your image(s) size exceed 2Mb.',
            'share_to.arrayofint' => 'An error occured during saving your sharing list, please try again.'
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
        try {
            $user = Sentry::getUser();
            $album = Album::findOrFail($id);
            $galleries = Gallery::where('album_id', '=', $id)->get();
            return View::make('album-detail', compact('user', 'album', 'galleries'));
        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
            $user = Sentry::getUser();
            $albums = Album::getAllAlbum();
            return View::make('gallery', compact('user', 'albums'));
        }
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

    public function newAlbumDetail($id) {
        try {
            $album = Album::findOrFail($id);
            $galleries = Gallery::where('album_id', '=', $id)->get();
            return View::make('new-album-detail', compact('album', 'galleries'));
        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
            $albums = Album::getAllAlbum();
            return View::make('new-gallery', compact('albums'));
        }
    }

}
