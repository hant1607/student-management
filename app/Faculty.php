<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    protected $table = 'faculties';

    public function classs(){
        return $this->hasMany('App\ClassModel', 'faculty_id', 'id');
    }
    public function student(){
        return $this->hasManyThrough('App\Student', 'App\ClassModel', 'faculty_id', 'class_id', 'id');
    }
}
