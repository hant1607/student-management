<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;

class StudentController extends Controller
{
    public function getList(){
        $student = Student::all();
        return view('admin.students.list', ['studentData'=>$student]);
    }

    public function getAdd(){
        return view('admin.students.add');
    }

    public function getUpdate(){
        return view('admin.students.update');
    }
}
