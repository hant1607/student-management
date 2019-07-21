<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    protected $table = 'faculties';

    protected $fillable = ['name'];

    public function class(){
        return $this->hasMany(ClassModel::class, 'faculty_id', 'id');
    }
    public function student(){
        return $this->hasManyThrough(Student::class, 'App\ClassModel', 'faculty_id', 'class_id', 'id');
    }
}
