<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Faculty;

class FacultyController extends Controller
{
    public function getList()
    {
        $faculty = Faculty::all();
        return view('admin.faculties.list', ['facultyData' => $faculty]);
    }

    public function getAdd()
    {
        return view('admin.faculties.add');
    }

    public function postAdd(Request $request)
    {
        $this->validate($request,
            ['name' => 'required'],
            ['name.required' => 'Please enter name!']);
        $faculty = new Faculty;
        $faculty->name = $request->name;
        $faculty->save();
        return redirect('admin/faculty/add')->with('noti', 'Add successful');
    }

    public function getUpdate($id)
    {
        $faculty = Faculty::find($id);
        return view('admin.faculties.update', ['facultyData' => $faculty]);
    }

    public function postUpdate(Request $request, $id)
    {
        $faculty = Faculty::find($id);
        $this->validate($request, ['name' => 'required|unique:faculties,name,' . $id], ['name.required' => 'Please enter name', 'name.unique' => "This faculty name already exists"]);
        //$faculty = new Faculty;
        $faculty->name = $request->name;
        $faculty->save();
        return redirect('admin/faculty/list')->with('noti', 'Edit success');

    }

    public function getDelete($id)
    {
        $faculty = Faculty::find($id);
        $faculty->delete();
        return redirect('admin/faculty/list')->with('noti', 'Delete successful');
    }
}
