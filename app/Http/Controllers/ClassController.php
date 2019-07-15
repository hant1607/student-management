<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Faculty;
use App\ClassModel;

class ClassController extends Controller
{
    public function getList()
    {
        $class = ClassModel::all();
        return view('admin.classes.list', ['classData' => $class]);
    }

    public function getAdd()
    {
        $faculty = Faculty::all();
        return view('admin.classes.add', ['facultyData'=>$faculty]);
    }

    public function postAdd(Request $request)
    {
        $this->validate($request,
            ['className'=>'required', 'facultyID'=>'required'],
            ['className.require'=>'Please enter class name', 'facultyID.required'=>"Please choose faculty"]
        );
        $class = new ClassModel;
        $class->name = $request->className;
        $class->faculty_id = $request->facultyID;
        $class->save();
        return redirect('admin/class/add')->with('noti','Add success!');
    }

    public function getUpdate($id)
    {
        $faculty = Faculty::all();
        $class = ClassModel::find($id);
        return view('admin.classes.update', ['classData'=>$class], ['facultyData'=>$faculty]);
    }

    public function postUpdate(Request $request, $id)
    {
        $class = ClassModel::find($id);
        $this->validate($request,
            ['className'=>'required|unique:classes,name,' . $id, 'facultyID'=>'required|unique:classes,faculty_id,' . $id],
            ['className.require'=>'Please enter class name', 'className.unique' => "This class name already exists", 'facultyID.required'=>"Please choose faculty", 'facultyID.unique' => "This faculty name already exists"]
        );
        $class->name = $request->className;
        $class->faculty_id = $request->facultyID;
        $class->save();
        return redirect('admin/class/list')->with('noti', 'Update successful');
    }

    public function getDelete($id)
    {
        $class = ClassModel::find($id);
        $class->delete();
        return redirect('admin/class/list')->with('noti', 'Delete successul');
    }
}
