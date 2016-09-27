<?php

use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model {

    protected $table = 'galleries';

    public function album() {
        return $this->belongsTo('Album', 'album_id', 'id');
    }

    public function scopeDeleteGallery($query,$params) {

        $response = array();
        $response['status'] = 0;
        $response['message'] = "An error occured, please try again.";

        if($this->destroy($params['id'])) {
            $response['status'] = 1;
            $response['message'] = "Data has been deleted successfully.";
        }

        return Redirect::back();

    }

}