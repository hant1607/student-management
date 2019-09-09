<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountRequest;
use App\Http\Requests\UserRequest;
use App\Repositories\ClassRepository;
use App\Repositories\StudentRepository;
use App\Repositories\SubjectRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Spatie\Permission\Models\Role;

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

        //$this->middleware('permission:profile-view', ['only'=>["getProfile"]]);
        //Auth::user()->middleware('permission:profile-view', ['only'=>['getProfile', 'editProfile', 'updateProfile']]);
        $this->middleware('permission:user-list');
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userRepository->getPanigate();
        //$roles = Role::pluck('name', 'name')->all();
        return view('admin.user.list', compact('users', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        $userRole = Auth::user()->roles->pluck('name', 'name')->all();
        return view('admin.user.add', compact('roles', 'userRole'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = $this->userRepository->create($request->all());
        $user->assignRole($request->roles);
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
    public function edit($id)
    {
        $user = $this->userRepository->find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();
        return view('admin.user.update', compact('user', 'roles', 'userRole'));
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
        $user = $this->userRepository->update($id, $request->all());
        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $user->assignRole($request->roles);
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
        $this->userRepository->delete($id);
        return redirect(route('users.index'))->with('noti', 'Delete successful');
    }

    public function getProfile($id)
    {
        if ($id == Auth::id()) {
            $student = $this->userRepository->getStudentLogin($id)->first();
            $user = $this->userRepository->find($id);
            $classes = $this->classRepository->getAll();
            if ($student) {
                $subjects = $this->userRepository->getSubjectNotStudy();
            }
            return view('admin.user.profile', compact('user', 'student', 'classes', 'subjects'));
        }
        return view('admin.errors.401');
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
