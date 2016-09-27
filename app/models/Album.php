<?php

use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Slugify\SlugifyCustom as Slugify;

class Album extends Model {

    protected $table = 'albums';

    public function galleries() {
        return $this->hasMany('Gallery', 'album_id', 'id');
    }

    public function scopeGetAllAlbum($query) {
        return $query->get();
    }

    public function scopeSaveNewAlbum($query,$params) {

        // var_dump(count(Input::file('images'))); die();

        // $var = Input::get('share_to');
        // var_dump($var);
        // die();

        Input::merge(array_map('trim', Input::except('images','share_to')));

        if (Input::hasFile('images'))
            $input = Input::all();
        else
            $input = Input::except('images');

        $response = array();
        $rules = $params['rules'];
        $imageRules = array('images' => 'required');
        $rules = $rules + $imageRules;
        $messages = $params['messages'];
        $images = Input::file('images');

        if ($images != null && $images != "") {
            foreach(Input::file('images') as $key => $value) {
                $imgNumber = $key + 1;
                $ends = array('th','st','nd','rd','th','th','th','th','th','th');
                if (($imgNumber %100) >= 11 && ($imgNumber%100) <= 13)
                   $abbreviation = $imgNumber. 'th';
                else
                   $abbreviation = $imgNumber. $ends[$imgNumber % 10];
                $rules['images.'.$key] = "image|mimes:png,gif,jpg,jpeg,bmp|max:20000";
                $messages['images.'.$key.'.image'] = $abbreviation." image is not an image.";
                $messages['images.'.$key.'.mimes'] = $abbreviation." image type is invalid, allowed image types are: .jpg, .jpeg, .png, .gif, and .bmp";
            }
        }

        Validator::extend('arrayofint', function($attribute, $value, $parameters) {
            foreach($value as $v):
                if (!preg_match('/^\d+$/',$v)) return false;
            endforeach;
            return true;
        });

        $validating = Validator::make($input, $rules, $messages);
        if ($validating->fails()) {
            return Redirect::route('gallery.create')->withInput()->withErrors($validating);
        }

        $this->teacher_id = Input::get('teacher_id');
        $this->name = Input::get('name');
        $this->description = Input::get('description');
        $this->venue = Input::get('venue');
        $this->date_taken = Input::get('date_taken');
        if (is_array(Input::get('share_to')) && Input::get('share_to') != "")
            $publicity = implode(',',Input::get('share_to'));
        else
            $publicity = "public";

        $this->publicity = $publicity;
        $this->save();

        // Set album directory name
        $dirName = $this->id.'-'.Slugify::GetSlug(Input::get('name'));
        $rawPath = 'assets/uploads/galleries/'.$dirName.'/';
        $uplPath = public_path($rawPath);
        // Create the album directory
        if(!\File::exists($uplPath))
            \File::makeDirectory($uplPath, $mode=0755, $recursive=false);

        foreach (Input::file('images') as $image) {
            if ($image != NULL && $image != null && $image != "") {
                // Handle each images uploaded with image-intervention.io
                $uniqid = uniqid();
                $imagePath = $uplPath.$uniqid.'-'.$image->getClientOriginalName();
                $thumbPath = $uplPath.'thumb-'.$uniqid.'-'.$image->getClientOriginalName();
                Image::make($image)->save($imagePath);
                Image::make($image)->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($thumbPath);
                $imagePath = $rawPath.$uniqid.'-'.$image->getClientOriginalName();

                $gallery = new Gallery;
                $gallery->album_id = $this->id;
                $gallery->image_path = $imagePath;
                $gallery->description = null;
                $gallery->save();
            }
        }

        $timeline = new Timeline;
        if ($timeline->saveNewTimeline(array('user_id' => Input::get('teacher_id'), 'category' => 'gallery', 'post_id' => $this->id, 'publicity' => $publicity))) {
            $response['status'] = 1;
            $response['message'] = "Data saved successfully.";
        } else {
            $response['status'] = 1;
            $response['message'] = "Data saved successfully, yet it failed to be saved into timeline.";
        }

        return Redirect::route('gallery.index');

    }

    public function scopeUpdateAlbum($query,$params) {

        Input::merge(array_map('trim', Input::except('images','share_to')));

        if (Input::hasFile('images'))
            $input = Input::all();
        else
            $input = Input::except('images');

        $response = array();
        $rules = $params['rules'];
        $messages = $params['messages'];
        $images = Input::file('images');

        if ($images != null && $images != "") {
            foreach(Input::file('images') as $key => $value) {
                $imgNumber = $key + 1;
                $ends = array('th','st','nd','rd','th','th','th','th','th','th');
                if (($imgNumber %100) >= 11 && ($imgNumber%100) <= 13)
                   $abbreviation = $imgNumber. 'th';
                else
                   $abbreviation = $imgNumber. $ends[$imgNumber % 10];
                $rules['images.'.$key] = "image|mimes:png,gif,jpg,jpeg,bmp|max:20000";
                $messages['images.'.$key.'.image'] = $abbreviation." image is not an image.";
                $messages['images.'.$key.'.mimes'] = $abbreviation." image type is invalid, allowed image types are: .jpg, .jpeg, .png, .gif, and .bmp";
            }
        }

        Validator::extend('arrayofint', function($attribute, $value, $parameters) {
            foreach($value as $v):
                if (!preg_match('/^\d+$/',$v)) return false;
            endforeach;
            return true;
        });

        $validating = Validator::make($input, $rules, $messages);
        if ($validating->fails()) {
            return Redirect::route('gallery.edit', array(Input::get('id')))->withInput()->withErrors($validating);
        }

        $update = $this->findOrFail(Input::get('id'));

        $update->teacher_id = Input::get('teacher_id');
        $update->name = Input::get('name');
        $update->description = Input::get('description');
        $update->venue = Input::get('venue');
        $update->date_taken = Input::get('date_taken');
        if (is_array(Input::get('share_to')) && Input::get('share_to') != "")
            $publicity = implode(',',Input::get('share_to'));
        else
            $publicity = "public";

        $update->publicity = $publicity;

        // Set album directory name
        $dirName = Input::get('id').'-'.Slugify::GetSlug(Input::get('name'));
        $rawPath = 'assets/uploads/galleries/'.$dirName.'/';
        $uplPath = public_path($rawPath);
        // Create the album directory
        if(!\File::exists($uplPath))
            \File::makeDirectory($uplPath, $mode=0755, $recursive=false);

        foreach (Input::file('images') as $image) {
            if ($image != NULL && $image != null && $image != "") {
                // Handle each images uploaded with image-intervention.io
                $uniqid = uniqid();
                $imagePath = $uplPath.$uniqid.'-'.$image->getClientOriginalName();
                $thumbPath = $uplPath.'thumb-'.$uniqid.'-'.$image->getClientOriginalName();
                Image::make($image)->save($imagePath);
                Image::make($image)->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($thumbPath);
                $imagePath = $rawPath.$uniqid.'-'.$image->getClientOriginalName();

                $gallery = new Gallery;
                $gallery->album_id = Input::get('id');
                $gallery->image_path = $imagePath;
                $gallery->description = null;
                $gallery->save();
            }
        }

        $update->update();
        return Redirect::back();

    }

    public function scopeDeleteAlbum($query,$params) {

        $response = array();
        $response['status'] = 0;
        $response['message'] = "An error occured, please try again.";

        $cleanTimeline = Timeline::where('category', '=', 'gallery')->where('post_id', '=', $params['id'])->delete();
        if($cleanTimeline && $this->destroy($params['id'])) {
            Gallery::where('album_id', '=', $params['id'])->delete();
            $response['status'] = 1;
            $response['message'] = "Data has been deleted successfully.";
        }

        return Redirect::route('gallery.index');

    }

}