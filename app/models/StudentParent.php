<?php

use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;

class StudentParent extends Model {

    protected $table = 'parents';

    public function Students() {
        return $this->hasMany('Student', 'parent_id', 'id');
    }

}