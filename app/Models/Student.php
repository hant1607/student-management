<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['name', 'class_id', 'birthday', 'gender', 'image'];
    protected $table = 'students';

    public function class(){
        return $this->belongsTo(ClassModel::class, 'class_id', 'id');
    }
    public function result(){
        return $this->hasMany(Result::class, 'student_id', 'id');
    }
}
