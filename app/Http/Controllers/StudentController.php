<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Repositories\ClassRepository;
use App\Repositories\StudentRepository;
use App\Repositories\SubjectRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Jobs\SendEmailJob;
use Illuminate\Support\Facades\Response;
//use Illuminate\Support\Facades\DB;


class StudentController extends Controller
{
    protected $studentRepository;
    protected $subjectRepository;
    protected $userRepository;
    protected $classRepository;

    public function __construct(StudentRepository $studentRepository,
                                SubjectRepository $subjectRepository,
                                UserRepository $userRepository,
                                ClassRepository $classRepository)
    {
        parent::__construct();
        $this->studentRepository = $studentRepository;
        $this->subjectRepository = $subjectRepository;
        $this->userRepository = $userRepository;
        $this->classRepository = $classRepository;

        $this->middleware('permission:student-list');
        $this->middleware('permission:student-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:student-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:student-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        /*api*/
//        $request = Request::create('/api/students', 'GET');
//        $students = \Route::dispatch($request);
//        $data = json_decode($students->getContent(), true);
//        return view('admin.api_students.list', compact('data'));

        $record = $request->record == null ? 50 : $request->record;
        $data['students'] = $this->studentRepository->search($request->all())->paginate($record);
        $data['classes'] = $this->classRepository->getAll();
        $subjects = $this->subjectRepository->getAll();
        $data['sj'] = $subjects->pluck('name', 'id')->all();
        return view('admin.students.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = $this->classRepository->getAll();
        $class = $classes->pluck('name', 'id')->all();
        return view('admin.students.add', ['class' => $class]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequest $request)
    {
        \DB::beginTransaction();
        try {
            $user = $this->userRepository->create($request->all());
            $user->assignRole('member');
            $data = $this->studentRepository->uploadImage($request);
            $data['user_id'] = $user->id;
            $this->studentRepository->create($data);
            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollBack();
            throw new \Exception($e->getMessage());
        }
        return redirect()->back()->with('noti', 'Add successful!');

        /*api*/
//        $request = StudentRequest::create('/api/students', 'POST');
//        \Route::dispatch($request);
//        return redirect()->back()->with('noti', 'Add students using api successful!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $results = $this->studentRepository->getOne($id);
        return view('admin.results.student_result', compact('results', 'id'));


        /*api*/
//        $request = StudentRequest::create("/api/students/$id", 'GET');
//        $students = \Route::dispatch($request);
//        $data = json_decode($students->getContent(), true);
//        return view('admin.api_students.student_result', compact('data', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
//        $classes = $this->classRepository->getAll();
//        $class = $classes->pluck('name', 'id')->all();
//        return view('admin.api_students.update', compact('student', 'class'));


        /*edit by popup*/
        $student = $this->studentRepository->find($id);
        return Response::json($student);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StudentRequest $request, $id)
    {
        $data = $this->studentRepository->uploadImage($request);
        $this->studentRepository->update($id, $data);
        return redirect(route('students.index'))->with('noti', 'Update successful');


        /*api*/
//        $request = Request::create("/api/students/$id", 'PUT');
//        \Route::dispatch($request);
//        return redirect(route('students.index'))->with('noti', 'Update student using api successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->studentRepository->delete($id);
        return redirect(route('students.index'))->with('noti', 'Delete successful');

        /*api*/
//        $request = Request::create("/api/students/$id", 'DELETE');
//        \Route::dispatch($request);
//        return redirect(route('students.index'))->with('noti', 'Delete student using api successful');
    }

    public function sendEmail()
    {
        $students = $this->studentRepository->studentToSendEmail();
        $subjects = $this->subjectRepository->getAll();
        $sj = $subjects->pluck('name', 'id')->all();
        $classes = $this->classRepository->getAll();
        foreach ($students as $student) {
            $this->dispatch(new SendEmailJob($student));
        }
        return view('admin.students.list', compact('students', 'sj', 'classes'));
    }

    public function ajaxUpdate(StudentRequest $request)
    {
        $id = $request->id;
        $data = $this->studentRepository->uploadImage($request);
        $student = $this->studentRepository->update($id, $data);
        $student->class_id = $student->class->name;
        if ($student->gender == 1) {
            $student->gender = 'Male';
        } else {
            $student->gender = 'Female';
        }
        return Response::json($student);
    }
}
