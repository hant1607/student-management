<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    //

    protected $table = 'classes';

    public function faculty(){
        return $this->belongsTo('App\Faculty', 'faculty_id', 'id');
    }

    public function student(){
        return $this->hasMany('App\Student', 'student_id', 'id');
    }
}
