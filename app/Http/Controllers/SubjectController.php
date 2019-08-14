<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubjectRequest;
use App\Models\Subject;
use App\Repositories\ResultRepository;
use App\Repositories\SubjectRepository;
use Illuminate\Support\Facades\Gate;

class SubjectController extends Controller
{
    protected $subjectRepository;
    protected $resultRepository;

    public function __construct(SubjectRepository $subjectRepository, ResultRepository $resultRepository)
    {
        parent::__construct();
        $this->subjectRepository = $subjectRepository;
        $this->resultRepository = $resultRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = $this->subjectRepository->getAll();
        return view('admin.subjects.list', ['subjects'=>$subjects]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.subjects.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubjectRequest $request)
    {
        $this->subjectRepository->create($request->all());
        return redirect()->back()->with('noti', "Add successful");
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
        return view('admin/subjects/update', ['subject' => $subject]);
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
        $this->subjectRepository->update($id, $request->all());
        return redirect(route('subjects.index'))->with('noti', 'Update successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Gate::allows('can-delete', 'user')){
            $this->subjectRepository->delete($id);
            return redirect(route('subjects.index'))->with('noti', 'Delete successful');
        }
        return redirect(route('subjects.index'))->with('noti', 'You are not admin. Can not delete');
    }
}
