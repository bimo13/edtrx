<?php

use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model {

    protected $table = 'galleries';

    public function album() {
        return $this->belongsTo('Album', 'album_id', 'id');
    }

}