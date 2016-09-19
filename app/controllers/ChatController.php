<?php

class ChatController extends BaseController {

    public function index() {
        return View::make('chatroom');
    }

    public function createUser() {
        return View::make('dev-createQBuser');
    }

}
