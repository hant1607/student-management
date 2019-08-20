<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClassRequest;
use App\Models\Faculty;
use App\Models\ClassModel;
use App\Repositories\ClassRepository;
use App\Repositories\FacultyRepository;
use Illuminate\Support\Facades\Gate;

class ClassController extends Controller
{
    protected $classRepository;
    protected $facultyRepository;

    public function __construct(ClassRepository $classRepository, FacultyRepository $facultyRepository)
    {
        parent::__construct();
        $this->classRepository = $classRepository;
        $this->facultyRepository = $facultyRepository;
    }

    public function getList()
    {
        $class = $this->classRepository->getAll();

        return view('admin.classes.index', ['classData' => $class]);
    }

    public function getAdd()
    {
        $faculties = $this->facultyRepository->getAll();
        $faculty = $faculties->pluck('name', 'id')->all();
        return view('admin.classes.add', ['faculty' => $faculty]);
    }

    public function postAdd(ClassRequest $request)
    {
        $this->classRepository->create($request->all());
        return redirect()->back()->with('noti', 'Add success!');
    }

    public function getUpdate(ClassModel $class)
    {
        $faculties = $this->facultyRepository->getAll();
        $faculty = $faculties->pluck('name', 'id')->all();
        return view('admin.classes.update', ['classData' => $class], ['faculty' => $faculty]);
    }

    public function postUpdate(ClassRequest $request, $id)
    {
        $this->classRepository->update($id, $request->all());
        return redirect(route('class.index'))->with('noti', 'Update successful');
    }

    public function getDelete($id)
    {
        if (Gate::allows('can-delete', 'user')) {
            $this->classRepository->delete($id);
            return redirect(route('class.index'))->with('noti', 'Delete successful');
        }
        return redirect(route('class.index'))->with('error', 'You are not admin. Can not delete');
    }
}
