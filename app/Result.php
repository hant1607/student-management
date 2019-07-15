<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $table = 'results';

    public function student(){
        return $this->belongsTo('App\Student', 'student_id', 'id');
    }
    public function subject(){
        return $this->belongsTo('App\Subject', 'subject_id', 'id');
    }
}
