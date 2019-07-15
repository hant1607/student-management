<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Result;

class ResultController extends Controller
{
    public function getList(){
        $result = Result::all();
        return view('admin.results.list', ['resultData'=>$result]);
    }

    public function getAdd(){
        return view('admin.results.add');
    }

    public function getUpdate(){
        return view('admin.results.update');
    }
}
