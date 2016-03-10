<?php

use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model {

    protected $table = 'teacher_details';

    public function user() {
        return $this->belongsTo('User', 'user_id', 'id');
    }

}
