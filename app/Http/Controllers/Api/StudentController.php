<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StudentRequest;
use App\Models\Student;
use App\Models\Subject;
use App\Repositories\ClassRepository;
use App\Repositories\StudentRepository;
use App\Repositories\SubjectRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Student as StudentResource;

class StudentController extends Controller
{
    protected $studentRepository;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(StudentRepository $studentRepository)
    {
        parent::__construct();
        $this->studentRepository = $studentRepository;
    }

    public function index(Request $request)
    {
//        $students = $this->studentRepository->search($request->all());
//        return $students;
        $students = Student::limit(10)->get();
        return $students;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequest $request)
    {
        $data = $this->studentRepository->uploadImage($request);
        return Student::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $results = $this->studentRepository->getOne($id);
        return $results;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StudentRequest $request, Student $student)
    {
        $data = $this->studentRepository->uploadImage($request);
        return $student->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->delete();
    }
}
