<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubjectRequest;
use App\Models\Subject;
use App\Repositories\ResultRepository;
use App\Repositories\SubjectRepository;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    protected $subjectRepository;
    protected $resultRepository;

    public function __construct(SubjectRepository $subjectRepository, ResultRepository $resultRepository)
    {
        parent::__construct();
        $this->subjectRepository = $subjectRepository;
        $this->resultRepository = $resultRepository;

        $this->middleware('permission:subject-list');
        $this->middleware('permission:subject-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:subject-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:subject-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $subjects = $this->subjectRepository->getPanigate();
//        return view('admin.subjects.list', ['subjects' => $subjects]);

        /*api*/
        $request = Request::create('/api/subjects', 'GET');
        $subjects = \Route::dispatch($request);
        $data = json_decode($subjects->getContent(), true);
        return view('admin.api_subjects.list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        return view('admin.subjects.add');

        /*api*/
        return view('admin.api_subjects.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubjectRequest $request)
    {
//        $this->subjectRepository->create($request->all());
//        return redirect()->back()->with('noti', "Add successful");

        /*api*/
        $request = Request::create('/api/subjects', 'POST');
        \Route::dispatch($request);
        return redirect()->back()->with('noti', 'Add subjects using api successful!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
//        return view('admin/subjects/update', compact('subject'));

        /*api*/
        return view('admin.api_subjects.update', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(SubjectRequest $request, $id)
    {
//        $this->subjectRepository->update($id, $request->all());
//        return redirect(route('subjects.index'))->with('noti', 'Update successful');

        /*api*/
        $request = Request::create("/api/subjects/$id", 'PUT');
        \Route::dispatch($request);
        return redirect(route('subjects.index'))->with('noti', 'Update subject using api successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//        $this->subjectRepository->delete($id);
//        return redirect(route('subjects.index'))->with('noti', 'Delete successful');

        /*api*/
        $request = Request::create("/api/subjects/$id", 'DELETE');
        \Route::dispatch($request);
        return redirect(route('subjects.index'))->with('noti', 'Delete subject using api successful');
    }
}
