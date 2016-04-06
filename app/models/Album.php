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

        Input::merge(array_map('trim', Input::except('images')));

        if (Input::hasFile('images'))
            $input = Input::all();
        else
            $input = Input::except('images');

        $response = array();
        $rules = $params['rules'];
        $messages = $params['messages'];
        $images = Input::file('images');
        $mobile = Input::get('mobile');

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

        $validating = Validator::make($input, $rules, $messages);
        if ($validating->fails()) {
            if ($mobile == 'on') {
                header('Content-Type: application/json');
                $response['status'] = 0;
                $response['message'] = $validating->messages();
                echo json_encode($response);
                die();
            } else {
                return Redirect::route('gallery.create')->withInput()->withErrors($validating);
            }
        }

        $this->name = Input::get('name');
        $this->description = Input::get('description');
        $this->venue = Input::get('venue');
        $this->date_taken = Input::get('date_taken');
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

        $response['status'] = 1;
        $response['message'] = "Data saved successfully.";

        if ($mobile == 'on') {
            header('Content-Type: application/json');
            echo json_encode($response);
            die();
        } else {
            return Redirect::route('gallery.index');
        }

    }

}