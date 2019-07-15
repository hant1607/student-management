<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';

    public function classs(){
        return $this->belongsTo('App\ClassModel', 'class_id', 'id');
    }
    public function result(){
        return $this->hasMany('App\Result', 'student_id', 'id');
    }
}
