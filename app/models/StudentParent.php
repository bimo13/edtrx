<?php

use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class StudentParent extends Model {

    protected $table = 'parents';

    public function Students() {
        return $this->hasMany('Student', 'parent_id', 'id');
    }

    public function scopeSaveNewParent($query,$params) {

        $response = array();
        $input = $params['input'];
        $rules = $params['rules'];

        $imgRule = array('photo' => 'required|image|mimes:png,gif,jpg,jpeg,bmp|max:20000');
        $rules = $rules + $imgRule;

        $image = Input::file('photo');
        $rawPath = 'assets/uploads/parents/';
        $uplPath = public_path($rawPath);
        
        $validating = Validator::make($input, $rules);
        if ($validating->fails()) {
            return Redirect::route('parents.create')->withInput()->withErrors($validating);
        }

        // Prevent "directory not exists" error
        if(!\File::exists($uplPath))
            \File::makeDirectory($uplPath, $mode=0755, $recursive=false);

        // Handle image upload with image-intervention.io
        $uniqid = uniqid();
        $imagePath = $uplPath.$uniqid.'-'.$image->getClientOriginalName();
        $thumbPath = $uplPath.'thumb-'.$uniqid.'-'.$image->getClientOriginalName();
        Image::make($image)->save($imagePath);
        Image::make($image)->resize(200, 200)->save($thumbPath);
        $imagePath = $rawPath.$uniqid.'-'.$image->getClientOriginalName();

        $usnm = Input::get('email');
        $pswd = Input::get('password');
        $full_name = Input::get('first_name') . " " . Input::get('last_name');

        // Handle inputs and process to database
        $this->first_name = Input::get('first_name');
        $this->last_name = Input::get('last_name');
        $this->address = Input::get('address');
        $this->phone_1 = Input::get('phone_1');
        $this->phone_2 = Input::get('phone_2');
        $this->photo = $imagePath;
        $this->email = $usnm;
        $this->password = Hash::make($pswd);

        if($this->save()) {
            Session::flash('message', 'Data saved successfully.'); 
            Session::flash('alert-class', 'success');
            Session::flash('usnm', $usnm);
            Session::flash('pswd', $pswd);
            Session::flash('fullname', $full_name);
        } else {
            Session::flash('message', 'An error occured, cannot save to database. Please try again.'); 
            Session::flash('alert-class', 'danger');
        }

        return Redirect::route('parents.create');

    }

}