<?php

use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Slugify\SlugifyCustom as Slugify;

class Pinboard extends Model {

    protected $table = 'pinboard';

    public function User() {
        return $this->belongsTo('User', 'teacher_id', 'id');
    }

    public function scopeSaveNewPinboard($query,$params) {

        Input::merge(array_map('trim', Input::except('file','share_to')));

        if (Input::hasFile('file'))
            $input = Input::all();
        else
            $input = Input::except('file');

        $response = array();
        $rules = $params['rules'];
        $messages = $params['messages'];
        $file = Input::file('file');
        $mobile = Input::get('mobile');

        Validator::extend('arrayofint', function($attribute, $value, $parameters) {
            foreach($value as $v):
                if (!preg_match('/^\d+$/',$v)) return false;
            endforeach;
            return true;
        });

        $validating = Validator::make($input, $rules, $messages);
        if ($validating->fails()) {
            if ($mobile == 'on') {
                header('Content-Type: application/json');
                $response['status'] = 0;
                $response['message'] = $validating->messages();
                echo json_encode($response);
                die();
            } else {
                return Redirect::route('pinboard.create')->withInput()->withErrors($validating);
            }
        }

        // Preparing the file
        $file = Input::file('file');
        $origName = $file->getClientOriginalName();
        $fileType = $file->getClientOriginalExtension();
        $fileName = Slugify::GetSlug(Input::get('name'));
        $fileName = uniqid().'-'.$fileName.'.'.$fileType;
        // Preparing the directory
        $rawPath  = 'assets/uploads/pinboards/';
        $uplPath  = public_path($rawPath);
        if(!\File::exists($uplPath))
            \File::makeDirectory($uplPath, $mode=0755, $recursive=false);
        // Uploading the file
        if (Input::file('file')->move($uplPath, $fileName)) {
            $filePath = $rawPath.$fileName;
            $this->teacher_id = Input::get('teacher_id');
            $this->name = Input::get('name');
            $this->description = Input::get('description');
            $this->file_path = $filePath;
            $this->file_name = $origName;
            $this->file_type = $fileType;
            if (is_array(Input::get('share_to')) && Input::get('share_to') != "") {
                $publicity = implode(',',Input::get('share_to'));
                $this->publicity = implode(',',Input::get('share_to'));
            } else {
                $publicity = "public";
                $this->publicity = "public";
            }

            if($this->save()) {
                $response['status'] = 1;
                $response['message'] = "Data saved successfully.";
            } else {
                $response['status'] = 0;
                $response['message'] = "An error occured, cannot save to database.";
            }

            $timeline = new Timeline;
            if ($timeline->saveNewTimeline(array('user_id' => Input::get('teacher_id'), 'category' => 'pinboard', 'post_id' => $this->id, 'publicity' => $publicity))) {
                $response['status'] = 1;
                $response['message'] = "Data saved successfully.";
            } else {
                $response['status'] = 1;
                $response['message'] = "Data saved successfully, yet it failed to be saved into timeline.";
            }

            if ($mobile == 'on') {
                header('Content-Type: application/json');
                echo json_encode($response);
                die();
            } else {
                return Redirect::route('pinboard.index');
            }
        }

    }

    public function scopeDeletePinboard($query,$params) {

        $response = array();
        $response['status'] = 0;
        $response['message'] = "An error occured, please try again.";

        $delTimeline = Timeline::where('category', '=', 'pinboard')
                    ->where('post_id', '=', $params['id'])
                    ->delete();
        if($delTimeline && $this->destroy($params['id'])) {
            $response['status'] = 1;
            $response['message'] = "Data has been deleted successfully.";
        }

        return Redirect::route('pinboard.index');

    }

}