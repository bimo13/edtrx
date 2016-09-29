<?php

use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model {

    protected $table = 'classes';

    public function user() {
        return $this->hasOne('User', 'id', 'teacher_id');
    }

    public function students() {
        return $this->hasMany('Student', 'class_id', 'id');
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

    public function scopeUpdateClass($query,$params) {

        $input = $params['input'];
        $rules = $params['rules'];

        $validating = Validator::make($input, $rules);
        if ($validating->fails()) {
            return Redirect::route('classes.create')->withInput()->withErrors($validating);
        }

        $update = $this->findOrFail(Input::get('id'));

        $update->class_name = Input::get('class_name');
        $update->grade_level = Input::get('grade_level');
        $update->teacher_id = Input::get('teacher_id');
        $update->update();

        return Redirect::back();

    }

    public function scopeDeleteClass($query,$params) {

        $response = array();
        $response['status'] = 0;
        $response['message'] = "An error occured, please try again.";

        if($this->destroy($params['id'])) {
            $response['status'] = 1;
            $response['message'] = "Data has been deleted successfully.";
        }

        return Redirect::route('classes.index');

    }

}