<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClassRequest;
use App\Models\Faculty;
use App\Models\ClassModel;
use App\Repositories\ClassRepository;

class ClassController extends Controller
{
    protected $classRepository;

    public function __construct(ClassRepository $classRepository)
    {
        $this->classRepository = $classRepository;
    }

    public function getList()
    {
        $class = $this->classRepository->getAll();

        return view('admin.classes.index', ['classData' => $class]);
    }

    public function getAdd()
    {
        $faculty = Faculty::all();
        return view('admin.classes.add', ['facultyData' => $faculty]);
    }

    public function postAdd(ClassRequest $request)
    {
        $this->classRepository->create($request->all());
        return redirect()->back()->with('noti', 'Add success!');
    }

    public function getUpdate(ClassModel $class)
    {
        $faculty = Faculty::all();
        return view('admin.classes.update', ['classData' => $class], ['facultyData' => $faculty]);
    }

    public function postUpdate(ClassRequest $request, $id)
    {
        $this->classRepository->update($id, $request->all());
        return redirect(route('class.index'))->with('noti', 'Update successful');
    }

    public function getDelete($id)
    {
        $this->classRepository->delete($id);
        return redirect(route('class.index'))->with('noti', 'Delete successful');
    }
}
