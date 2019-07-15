<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'subjects';

    public function result(){
        return $this->hasMany('App\Result', 'subject_id', 'id');
    }
}
