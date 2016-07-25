<?php

class AttendanceController extends BaseController {

    public function rulesList() {
        
    }

    public function messagesList() {
        
    }

    public function index() {
        $user = Sentry::getUser();
        return View::make('attendance', compact('user'));
    }

    public function create() {
        $user = Sentry::getUser();
        $classes = Attendance::getClassData();
        $students = Attendance::getStudentsData();
        return View::make('attendance-form', compact('user', 'classes', 'students'));
    }

    public function store() {
        return Attendance::saveNewAttendance(array('input' => Input::all(), 'rules' => $this->rulesList(), 'messages' => $this->messagesList()));
    }

    public function showStudent($student_id, $date = NULL) {
        try {
            $student = Student::findOrFail($id);
            $attendances = Attendance::where('student_id', '=', $student_id);
            return View::make('attendance-student-detail');
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
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

    public function newLayout() {
        return View::make('new-attendance');
    }

    public function newFormLayout() {
        $user = Sentry::getUser();
        $classes = Attendance::getClassData();
        $students = Attendance::getStudentsData();
        return View::make('new-attendance-form', compact('user', 'classes', 'students'));
    }

}
