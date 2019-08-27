<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddMoreRequest;
use App\Http\Requests\ResultRequest;
use App\Repositories\ResultRepository;
use App\Models\Result;
use App\Repositories\StudentRepository;
use App\Repositories\SubjectRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ResultController extends Controller
{
    protected $resultRepository;
    protected $studentRepository;
    protected $subjectRepository;

    public function __construct(ResultRepository $resultRepository,
                                StudentRepository $studentRepository,
                                SubjectRepository $subjectRepository)
    {
        parent::__construct();
        $this->resultRepository = $resultRepository;
        $this->studentRepository = $studentRepository;
        $this->subjectRepository = $subjectRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $results = $this->resultRepository->getPanigate();
        return view('admin.results.list', ['results' => $results]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjects = $this->subjectRepository->getAll();
        $subject = $subjects->pluck('name', 'id')->all();
        $students = $this->studentRepository->getAll();
        $student = $students->pluck('name', 'id')->all();
        return view('admin.results.add', ['student' => $student, 'subject' => $subject]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ResultRequest $request)
    {
        $this->resultRepository->create($request->all());
        return redirect()->back()->with('noti', 'Add successful');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Result $result)
    {
        $subjects = $this->subjectRepository->getAll();
        $subject = $subjects->pluck('name', 'id')->all();
        $students = $this->studentRepository->getAll();
        $student = $students->pluck('name', 'id')->all();
        return view('admin.results.update', ['result' => $result, 'subject' => $subject, 'student' => $student]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ResultRequest $request, $id)
    {
        $this->resultRepository->update($id, $request->all());
        return redirect(route('results.index'))->with('noti', 'Update successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Gate::allows('can-delete', 'user')) {
            $this->resultRepository->delete($id);
            return redirect(route('results.index'))->with('noti', 'Delete successful');
        }
        return redirect()->back()->with('error', 'You are not admin. Can not delete');
    }

    public function getAddStudentResult($id)
    {
        if (Gate::allows('can-delete', 'user')) {
            $subjects = $this->subjectRepository->getAll();
            //$subject = $subjects->pluck('name', 'id')->all();
            $results = $this->studentRepository->getOne($id);
            return view('admin.results.add_student_result', compact('subjects', 'results', 'id'));
        }
        return redirect()->back()->with('error', 'You are not admin. Can not edit mark');
    }

    public function postStudentResult(AddMoreRequest $request, $id)
    {
        if (!empty($request->subject_id)) {
            $results = $this->studentRepository->find($id);
            $results->subjects()->detach();
            foreach ($request->subject_id as $key => $subject_id) {
                $results->subjects()->attach($subject_id,
                    [
                        'mark' => $request->mark[$key]
                    ]);
            }
        }
        return redirect(route('students.show', $results->id))->with('noti', 'Add successful');
    }

    public function updateUserResult(Request $request, $id)
    {
        $student = $this->studentRepository->find($id);
        foreach ($request->subject_id as $subject_id){
            $student->subjects()->attach($subject_id,
                [
                   'mark' => '0'
                ]);
        }
        return redirect(route('students.show', $student->id))->with('noti', 'Add successful');
    }
}
