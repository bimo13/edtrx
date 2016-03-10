<?php

use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Student extends Model {

    protected $table = 'students';

    public function scopeSaveNewStudent($query,$params) {

        $input = $params['input'];
        $rules = $params['rules'];

        $imgRule = array('photo' => 'required|image|mimes:png,gif,jpg,jpeg,bmp|max:20000');
        $rules = $rules + $imgRule;

        $image = Input::file('photo');
        $rawPath = 'assets/uploads/students/';
        $uplPath = public_path($rawPath);
        
        $validating = Validator::make($input, $rules);
        if ($validating->fails()) {
            return Redirect::route('students.create')->withInput()->withErrors($validating);
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
        $this->student_no = Input::get('student_no');
        $this->first_name = Input::get('first_name');
        $this->last_name = Input::get('last_name');
        $this->address = Input::get('address');
        $this->phone = Input::get('phone');
        $this->ice_number = Input::get('ice_number');
        $this->birth_place = Input::get('birth_place');
        $this->birth_date = Input::get('birth_date');
        $this->gender = Input::get('gender');
        $this->parent_id = Input::get('parent_id');
        $this->class_id = Input::get('class_id');
        $this->photo = $imagePath;
        $this->save();

        return Redirect::route('students.index');

    }

    public function scopeUpdateStudent($query,$params) {

        $input = $params['input'];
        $rules = $params['rules'];

        if (Input::hasFile('photo')) {
            $imgRule = array('photo' => 'image|mimes:png,gif,jpg,jpeg,bmp|max:20000');
            $rules = $rules + $imgRule;
        }

        $validating = Validator::make($input, $rules);
        if ($validating->fails()) {
            return Redirect::route('students.edit', array(Input::get('id')))->withInput()->withErrors($validating);
        }

        $update = $this->findOrFail(Input::get('id'));

        // Check if there's an update on student's photo
        if (Input::hasFile('photo')) {
            $image = Input::file('photo');
            $rawPath = 'assets/uploads/students/';
            $uplPath = public_path($rawPath);

            // Prevent "directory not exists" error
            if(!File::exists($uplPath)) {
                File::makeDirectory($path, $mode=0755, $recursive=false);
            }

            // Delete old photo
            if($update->photo != NULL && $update->photo != "") {
                unlink(public_path($update->photo));
                $thumbPath = str_replace('assets/uploads/students/', 'assets/uploads/students/thumb-', $update->photo);
                unlink(public_path($thumbPath));
            }

            $uniqid = uniqid();
            $imagePath = $uplPath.$uniqid.'-'.$image->getClientOriginalName();
            $thumbPath = $uplPath.'thumb-'.$uniqid.'-'.$image->getClientOriginalName();
            Image::make($image)->save($imagePath);
            Image::make($image)->resize(200, 200)->save($thumbPath);
            $imagePath = $rawPath.$uniqid.'-'.$image->getClientOriginalName();

            // Set the update form photo field here
            $update->photo = $imagePath;
        }

        // Handle inputs and process to database
        $update->student_no = Input::get('student_no');
        $update->first_name = Input::get('first_name');
        $update->last_name = Input::get('last_name');
        $update->address = Input::get('address');
        $update->phone = Input::get('phone');
        $update->ice_number = Input::get('ice_number');
        $update->birth_place = Input::get('birth_place');
        $update->birth_date = Input::get('birth_date');
        $update->gender = Input::get('gender');
        $update->parent_id = Input::get('parent_id');
        $update->class_id = Input::get('class_id');
        $update->update();

        return Redirect::route('students.index');

    }

}