<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;

class SubjectController extends Controller
{
    public function getList(){
        $subject = Subject::all();
        return view('admin.subjects.list', ['subjectData'=>$subject]);
    }

    public function getAdd(){
        return view('admin.subjects.add');
    }

    public function getUpdate(){
        return view('admin.subject.update');
    }
}
