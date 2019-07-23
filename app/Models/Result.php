<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = ['student_id', 'subject_id', 'mark'];
    protected $table = 'results';

    public function student(){
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }
    public function subject(){
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }
}
