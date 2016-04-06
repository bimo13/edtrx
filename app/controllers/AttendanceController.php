<?php

class AttendanceController extends BaseController {

    public function rulesList() {
        
    }

    public function messagesList() {
        
    }

    public function index() {
        return View::make('attendance');
    }

    public function create() {
        $classes = Attendance::getClassData();
        $students = Attendance::getStudentsData();
        return View::make('attendance-form', compact('classes', 'students'));
    }

    public function store() {
        return Attendance::saveNewAttendance(array('input' => Input::all(), 'rules' => $this->rulesList(), 'messages' => $this->messagesList()));
    }

    public function showStudent($student_id) {
        return View::make('attendance-student-detail');
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
