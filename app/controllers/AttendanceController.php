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
        $input = Input::all();
        $rules = array();
        $messages = array();

        foreach (Input::get('student_id') as $student_id) {

            // $messages['att_late_'.$student_id.'.required'] = "Please input time if this student late.";
            $messages['app_desc_'.$student_id.'.required'] = "Please input description.";

        }

        $validating = Validator::make($input, $rules, $messages);

        foreach (Input::get('student_id') as $student_id) {
            /*$validating->sometimes('att_late_'.$student_id, 'required', function($input) use ($student_id) {
                $attendance = Input::get('att_'.$student_id);
                if ($attendance == NULL)
                    return true;
                else
                    return false;
            });*/

            $validating->sometimes('app_desc_'.$student_id, 'required', function($input) use ($student_id) {
                $attendance = Input::get('app_'.$student_id);
                if ($attendance == NULL)
                    return true;
                else
                    return false;
            });
        }

        if ($validating->fails()) {
            return Redirect::route('attendance.index')->withInput()->withErrors($validating);
        } else {
            var_dump("expression");
        }

        foreach (Input::get('student_id') as $student_id) {
            if (Input::get('att_'.$student_id) != NULL && (Input::get('att_late_'.$student_id) == NULL || Input::get('att_late_'.$student_id) == "")) {
                $time = Input::get('att_'.$student_id);
                $attn = 1;
            } elseif (Input::get('att_'.$student_id) == NULL && (Input::get('att_late_'.$student_id) != NULL && Input::get('att_late_'.$student_id) != "")) {
                $time = Input::get('att_late_'.$student_id);
                $attn = 1;
            } else {
                $time = "00:00";
                $attn = 0;
            }


            $attendance = new Attendance;
            $attendance->date = date("Y-m-d");
            $attendance->time_arrive = $time;
            $attendance->student_id = $student_id;
            $attendance->attendance = $attn;
            $attendance->description = Input::get('app_desc_'.$student_id);
            $attendance->save();
        }

        return Redirect::route('attendance.index');

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
