<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountRequest;
use App\Http\Requests\StudentRequest;
use App\Http\Requests\UserRequest;
use App\Repositories\ClassRepository;
use App\Repositories\StudentRepository;
use App\Repositories\SubjectRepository;
use App\Repositories\UserRepository;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Response;

class UserController extends Controller
{
    protected $userRepository;
    protected $studentRepository;
    protected $classRepository;
    protected $subjectRepository;

    public function __construct(UserRepository $userRepository,
                                StudentRepository $studentRepository,
                                ClassRepository $classRepository,
                                SubjectRepository $subjectRepository)
    {
        parent::__construct();
        $this->userRepository = $userRepository;
        $this->studentRepository = $studentRepository;
        $this->classRepository = $classRepository;
        $this->subjectRepository = $subjectRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = $this->userRepository->getPanigate();
        return view('admin.user.list', ['users' => $user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $this->userRepository->create($request->all());
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.user.update', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $this->userRepository->update($id, $request->all());
        return redirect(route('users.index'))->with('noti', 'Update successful');
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
            $this->userRepository->delete($id);
            return redirect(route('users.index'))->with('noti', 'Delete successful');
        }
        return redirect(route('users.index'))->with('error', 'You are not admin. Can not delete');
    }

    public function getProfile($id)
    {
        $student = $this->userRepository->getStudentLogin($id)->first();
        $user = $this->userRepository->find($id);
        $classes = $this->classRepository->getAll();
        if ($student) {
            $subjects = $this->userRepository->getSubjectNotStudy();
        }
        return view('admin.user.profile', compact('user', 'student', 'classes', 'subjects'));
    }

    public function editProfile($id)
    {
        $students = $this->userRepository->getStudentLogin($id)->first();
        $user = $this->userRepository->find($id);
        return Response::json(array($user, $students));
    }

    public function updateProfile(AccountRequest $request)
    {
        $userId = $request->userId;
        $studentId = $request->studentId;
        if ($studentId) {
            DB::beginTransaction();
            try {
                $user = $this->userRepository->update($userId, $request->all());

                $data = $request->all();
                if ($request->hasFile('image')) {
                    $file = $request->file('image');
                    $end = $file->getClientOriginalExtension();
                    if ($end != 'jpg' && $end != 'png' && $end != 'jpeg') {
                        return redirect()->back()->with('error', 'You have to enter image have .jpg or .png or .jpeg');
                    }
                    $name = $file->getClientOriginalName();
                    $file->move(public_path('upload'), $name);
                    $data['image'] = $name;
                }
                $data['user_id'] = $user->id;
                $student = $this->studentRepository->update($studentId, $data);
                if ($student->gender == 1) {
                    $student->gender = 'Male';
                } else {
                    $student->gender = 'Female';
                }
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                throw new \Exception($e->getMessage());
            }
            return Response::json(array($user, $student));
        } else {
            $user = $this->userRepository->update($userId, $request->all());
            return Response::json($user);
        }

    }
}
