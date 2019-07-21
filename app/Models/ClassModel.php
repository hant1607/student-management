<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    protected $fillable = ['name', 'faculty_id'];

    protected $table = 'classes';

    public function faculty(){
        return $this->belongsTo(Faculty::class);
    }

    public function student(){
        return $this->hasMany(Student::class);
    }
}
