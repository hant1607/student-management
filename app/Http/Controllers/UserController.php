<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getList(){
        return view('admin.user.list');
    }

    public function getAdd(){
        return view('admin.user.add');
    }

    public function getUpdate(){
        return view('admin.user.update');
    }
}
