<?php

use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model {

    protected $table = 'classes';

    public function user() {
        return $this->hasOne('User', 'id', 'teacher_id');
    }

    public function scopeGetAllData($query) {
        $query->select(array(
            'id',
            'class_name',
            'grade_level',
            'teacher_id'
        ));
        return $query;
    }

    public function scopeSaveNewClass($query,$params) {

        $input = $params['input'];
        $rules = $params['rules'];

        $validating = Validator::make($input, $rules);
        if ($validating->fails()) {
            return Redirect::route('classes.create')->withInput()->withErrors($validating);
        }

        $this->class_name = Input::get('class_name');
        $this->grade_level = Input::get('grade_level');
        $this->teacher_id = Input::get('teacher_id');
        $this->save();

        return Redirect::route('classes.index');

    }

}