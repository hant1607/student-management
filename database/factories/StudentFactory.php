<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Student;
use App\Models\ClassModel;
use Faker\Generator as Faker;
$faker = \Faker\Factory::create('vi_VN');

$class = ClassModel::select('id')->get();

$factory->define(ClassModel::class, function (Faker $faker){
    return [
      'name' => $faker->name,
    ];
});

$factory->define(Student::class, function () use ($faker, $class){
    return [
        'name' => $faker->name,
        'user_id' => 1,
        'class_id' => $class->shuffle()->first()->id,
        'birthday'=>$faker->date('Y-m-d', 'now'),
        'gender'=> rand(1,2),
        'phone'=>$faker->phoneNumber,
        'image'=>$faker->image('public/upload', 100, 70, null, false)
    ];
});
