<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResultRequest;
use App\Repositories\ResultRepository;
use App\Models\Result;
use App\Models\Student;
use App\Models\Subject;

class ResultController extends Controller
{
    protected $resultRepository;

    public function __construct(ResultRepository $resultRepository)
    {
        $this->resultRepository = $resultRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = $this->resultRepository->getAll();
        return view('admin.results.list', ['results'=>$results]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjects = Subject::all();
        $students = Student::all();
        return view('admin.results.add', ['students'=>$students, 'subjects'=>$subjects]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Result $result)
    {
        $subjects = Subject::all();
        $students = Student::all();
        return view('admin.results.update', ['result'=>$result, 'subjects'=>$subjects, 'students'=>$students]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->resultRepository->delete($id);
        return redirect(route('results.index'))->with('noti', 'Delete successful');
    }
}
