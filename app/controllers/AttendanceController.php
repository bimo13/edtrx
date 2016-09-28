<?php
use DataTables\DataTablesCustom as DatatablesCustom;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
        $user = Sentry::getUser();
        try {
            $student = Student::findOrFail($student_id);
            $attendances = Attendance::where('student_id', '=', $student_id)->orderBy('date', 'desc');
            return View::make('attendance-student-detail', compact('user', 'student', 'attendances'));
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

    // END OF RESTful ROUTING
    // BEGIN DATA-TRANSACTION ROUTING (AJAX NECESSITIES)
    public function getDetail($id) {
        $attendances = Attendance::getDetail($id);

        // Begin constructing data for datatables
        $datatable = DatatablesCustom::of($attendances);
        $datatable->remove_column('id');
        $datatable->remove_column('time_arrive');
        $datatable->remove_column('student_id');
        $datatable->remove_column('description');
        $datatable->edit_column('attendance', function($obj) {
            if($obj->attendance && $obj->time_arrive == "08:00:00") {
                $ret = "<i class=\"text-success glyphicon glyphicon-ok\"></i>";
            } elseif($obj->attendance && $obj->time_arrive != "08:00:00") {
                $ret = "<i class=\"text-warning glyphicon glyphicon-ok\"></i>";
            } else {
                $ret = "<i class=\"text-danger glyphicon glyphicon-remove\"></i>";
            }
            
            return $ret;
        });
        $datatable->edit_column('lateness', function($obj) {
            if($obj->attendance && $obj->time_arrive != "08:00:00") {
                $ret = "<span class=\"text-danger\">" . date('H:i', strtotime($obj->time_arrive)) . "</span>";
            } else {
                $ret = "<i class=\"text-info glyphicon glyphicon-minus\"></i>";
            }
            
            return $ret;
        });
        $datatable->edit_column('apparel', function($obj) {
            if($obj->description == "" || $obj->description == NULL) {
                $ret = "<i class=\"text-success glyphicon glyphicon-ok\"></i>";
            } else {
                $ret = "<i class=\"text-danger glyphicon glyphicon-remove\"></i>";
            }
            
            return $ret;
        });
        $datatable->edit_column('notes', function($obj) {
            if($obj->description == "" || $obj->description == NULL) {
                $ret = "<i class=\"text-info glyphicon glyphicon-minus\"></i>";
            } else {
                $ret = $obj->description;
            }
            
            return $ret;
        });
        return $datatable->make();
    }

}
