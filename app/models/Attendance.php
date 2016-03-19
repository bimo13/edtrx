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

}