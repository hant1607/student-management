<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['name'];
    protected $table = 'subjects';

    public function result(){
        return $this->hasMany(Result::class, 'subject_id', 'id');
    }
}
