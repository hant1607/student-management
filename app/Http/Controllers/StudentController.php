<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Http\Requests\StudentRequest;
use App\Repositories\StudentRepository;
use App\Models\Student;
use App\Repositories\SubjectRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Jobs\SendEmailJob;


class StudentController extends Controller
{
    protected $studentRepository;
    protected $subjectRepository;
    protected $userRepository;

    public function __construct(StudentRepository $studentRepository,
                                SubjectRepository $subjectRepository,
                                UserRepository $userRepository)
    {
        $this->studentRepository = $studentRepository;
        $this->subjectRepository = $subjectRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $students = $this->studentRepository->search($request->all());
        $subjects = $this->subjectRepository->getAll();
        $sj = $subjects->pluck('name', 'id')->all();

        return view('admin.students.list', ['students' => $students, 'subjects' => $subjects, 'sj' => $sj]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = ClassModel::all();
        return view('admin.students.add', ['classes' => $classes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = $this->userRepository->create($request->all());
            $data = $this->studentRepository->uploadImage($request);
            $data['user_id'] = $user->id;
            $this->studentRepository->create($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }
        return redirect()->back()->with('noti', 'Add successful!');
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
        return view('admin.results.student_result', ['results' => $results, 'id' => $id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        $class = ClassModel::all();
        return view('admin.students.update', ['student' => $student, 'classes' => $class]);
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
    }
    public function sendEmail(){
        $students = $this->studentRepository->studentToSendEmail();
        $subjects = $this->subjectRepository->getAll();
        $sj = $subjects->pluck('name', 'id')->all();
        foreach ($students as $student){
            $this->dispatch(new SendEmailJob($student));
        }
        return view('admin.students.list', ['students' => $students, 'subjects' => $subjects, 'sj' => $sj]);
    }
}
