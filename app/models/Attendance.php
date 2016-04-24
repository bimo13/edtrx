<?php

use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model {

    protected $table = 'attendance';

    public function scopeGetClassData($query) {

        $teacher_id = Sentry::getUser()->id;
        $classes = Classes::where('teacher_id', '=', $teacher_id)->first();
        return $classes;

    }

    public function scopeGetStudentsData($query) {

        $teacher_id = Sentry::getUser()->id;
        $class_id = Classes::where('teacher_id', '=', $teacher_id)->first()->id;
        $students = Student::where('class_id', '=', $class_id)->get();
        return $students;

    }

    public function scopeSaveNewAttendance($query) {

        $input = Input::all();
        $rules = array();
        $messages = array();

        foreach (Input::get('student_id') as $student_id) {
            $messages['app_desc_'.$student_id.'.required'] = "Please input description.";
        }

        $validating = Validator::make($input, $rules, $messages);

        foreach (Input::get('student_id') as $student_id) {
            $validating->sometimes('app_desc_'.$student_id, 'required', function($input) use ($student_id) {
                $attendance = Input::get('app_'.$student_id);
                if ($attendance == NULL)
                    return true;
                else
                    return false;
            });
        }

        if ($validating->fails()) {
            return Redirect::route('attendance.create')->withInput()->withErrors($validating);
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

}