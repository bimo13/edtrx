<?php

use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;

class Timeline extends Model {

    protected $table = 'timeline';

    public function User() {
        return $this->belongsTo('User', 'user_id', 'id');
    }

    public function scopeSaveNewTimeline($query,$params) {

        $this->user_id = $params['user_id'];
        $this->category = $params['category'];
        $this->post_id = $params['post_id'];
        $this->publicity = $params['publicity'];
        if ($this->save())
            return true;
        else
            return false;

    }

}