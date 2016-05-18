<?php

use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;

class User extends Model {

    protected $table = 'users';

    public function userDetail() {
        return $this->hasOne('UserDetail', 'user_id', 'id');
    }

    public function timeline() {
        return $this->hasMany('Timeline', 'user_id', 'id');
    }

    public function classes() {
        return $this->belongsTo('Classes', 'id', 'teacher_id');
    }

    public function scopeGetAllData($query) {
        // $query->select(array(
        //     'id',
        //     'email',
        //     'first_name',
        //     'last_name'
        // ))->where('id', '!=', 1);
        $query->select(
            'users.id',
            'teacher_details.teacher_no',
            DB::raw('CONCAT(first_name, " ", last_name) as full_name'),
            'users.email'
        )->join('teacher_details', 'users.id', '=', 'teacher_details.user_id');
        return $query;
    }

    public function scopeSaveNewUser($query,$params) {

        $input = $params['input'];
        $rules = $params['rules'];

        $imgRule = array('photo' => 'required|image|mimes:png,gif,jpg,jpeg,bmp|max:20000');
        $rules = $rules + $imgRule;

        $image = Input::file('photo');
        $rawPath = 'assets/uploads/teachers/';
        $uplPath = public_path($rawPath);

        $validating = Validator::make($input, $rules);
        if ($validating->fails()) {
            return Redirect::route('users.create')->withInput()->withErrors($validating);
        }

        // Prevent "directory not exists" error
        if(!\File::exists($uplPath))
            \File::makeDirectory($path, $mode=0755, $recursive=false);

        // Handle image upload with image-intervention.io
        $uniqid = uniqid();
        $imagePath = $uplPath.$uniqid.'-'.$image->getClientOriginalName();
        $thumbPath = $uplPath.'thumb-'.$uniqid.'-'.$image->getClientOriginalName();
        Image::make($image)->save($imagePath);
        Image::make($image)->resize(200, 200)->save($thumbPath);
        $imagePath = $rawPath.$uniqid.'-'.$image->getClientOriginalName();

        // Handle inputs and process to database
        // Main users table
        Sentry::getUserProvider()->create(array(
            'email'       => Input::get('email'),
            'password'    => Input::get('password'),
            'first_name'  => strtoupper(Input::get('first_name')),
            'last_name'   => strtoupper(Input::get('last_name')),
            'activated'   => 1,
        ));
        // Assign user permissions
        $teacherUser  = Sentry::getUserProvider()->findByLogin(Input::get('email'));
        $teacherGroup = Sentry::getGroupProvider()->findByName('Teacher');
        $teacherUser->addGroup($teacherGroup);

        try {
            $user = Sentry::findUserByLogin(Input::get('email'));
        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
            return Redirect::route('users.create')->withInput()->withErrors("An error occured while saving data, please try again.");
        }

        // Users detail table
        $userDetail = new UserDetail;
        $userDetail->user_id = $user->id;
        $userDetail->teacher_no = Input::get('teacher_no');
        $userDetail->address = strtoupper(Input::get('address'));
        $userDetail->phone_1 = Input::get('phone_1');
        $userDetail->phone_2 = Input::get('phone_2');
        $userDetail->birth_place = strtoupper(Input::get('birth_place'));
        $userDetail->birth_date = Input::get('birth_date');
        $userDetail->gender = Input::get('gender');
        $userDetail->photo = $imagePath;
        $userDetail->save();

        return Redirect::route('users.index');

    }

}
