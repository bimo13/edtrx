<?php

class AttendanceController extends BaseController {

    public function rulesList() {
        // return $rules = array(
        //     'name'       => 'required|max:255',
        //     'date_taken' => 'date',
        //     'images'     => 'required'
        // );
    }

    public function messagesList() {
        // return $rules = array(
        //     'images.required' => 'Either you haven\'t upload an image, or your image(s) size exceed 2Mb.'
        // );
    }

    public function index() {
        $classes = Attendance::getClassData();
        $students = Attendance::getStudentsData();
        return View::make('attendance', compact('classes', 'students'));
    }

    public function create() {
        //
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
