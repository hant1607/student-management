<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['name', 'class_id', 'birthday', 'gender', 'phone', 'image', 'user_id'];
    protected $table = 'students';
    const VIETTEL = 1;
    const MOBI = 2;
    const VINA = 3;
    const PHONES = [
        self::VIETTEL => '^((016)[2-9]{1}|09[876]|086)[0-9]{7}$',
        self::MOBI => '^(089|090|093|0120|0121|0122|0126|0128){1}[0-9]{7}$',
        self::VINA => '^(088|091|094|0123|0124|0125|0127|0129){1}[0-9]{7}$',
    ];

    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'class_id', 'id');
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'results');
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }
}
