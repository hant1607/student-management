<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['name'];
    protected $table = 'subjects';

    public function results(){
        return $this->hasMany(Result::class, 'subject_id', 'id');
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'results');
    }

    public function result() {
        return $this->hasOne(Result::class, 'subject_id', 'id')->where('student_id', auth()->user()->student->id);
    }
}
