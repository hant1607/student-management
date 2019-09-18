<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use Sluggable;
    protected $table = 'faculties';

    protected $fillable = ['name'];

    public function class(){
        return $this->hasMany(ClassModel::class, 'faculty_id', 'id');
    }
    public function student(){
        return $this->hasManyThrough(Student::class, 'App\ClassModel', 'faculty_id', 'class_id', 'id');
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        // TODO: Implement sluggable() method.
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
