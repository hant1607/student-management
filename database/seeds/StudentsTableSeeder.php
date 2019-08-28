<?php

use Illuminate\Database\Seeder;
use \App\Models\Student;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        factory(ClassModel::class, 1)->create()->each(function ($class) {
//            $class->student()->saveMany(
//              factory(Student::class, 1)->create()
//            );
//        });
        factory(Student::class, 1000)->create();
    }
}
