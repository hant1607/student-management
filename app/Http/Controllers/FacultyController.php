<?php

namespace App\Http\Controllers;

use App\Http\Requests\FacultyRequest;
use App\Repositories\FacultyRepository;
use App\Models\Faculty;
use Illuminate\Support\Facades\Gate;


class FacultyController extends Controller
{
    protected $facultyRepository;

    public function __construct(FacultyRepository $facultyRepository)
    {
        parent::__construct();
        $this->facultyRepository = $facultyRepository;
    }

    public function getList()
    {
        $faculty = $this->facultyRepository->getAll();
        return view('admin.faculties.list', ['facultyData' => $faculty]);
    }

    public function getAdd()
    {
        return view('admin.faculties.add');
    }

    public function postAdd(FacultyRequest $request)
    {
        $this->facultyRepository->create($request->all());
        return redirect(route('faculty.create'))->with('noti', 'Add successful');
    }

    public function getUpdate(Faculty $faculty)
    {
        return view('admin.faculties.update', ['facultyData' => $faculty]);
    }

    public function postUpdate(FacultyRequest $request, $id)
    {
        $this->facultyRepository->update($id, $request->all());
        return redirect(route('faculty.index'))->with('noti', 'Edit successful');

    }

    public function getDelete($id)
    {
        if(Gate::allows('can-delete', 'user')){
            $this->facultyRepository->delete($id);
            return redirect(route('faculty.index'))->with('noti', 'Delete successful');
        }
        return redirect(route('faculty.index'))->with('error', 'You are not admin. Can not delete');

    }
}
