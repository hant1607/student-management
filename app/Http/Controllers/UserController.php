<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Http\Requests\UserRequest;
use App\Repositories\StudentRepository;
use App\Repositories\UserRepository;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Response;

class UserController extends Controller
{
    protected $userRepository;
    protected $studentRepository;

    public function __construct(UserRepository $userRepository, StudentRepository $studentRepository)
    {
        parent::__construct();
        $this->userRepository = $userRepository;
        $this->studentRepository = $studentRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = $this->userRepository->getAll();
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
        return view('admin.user.profile', compact('user', 'student'));
    }

    public function editProfile($id)
    {
        $students = $this->userRepository->getStudentLogin($id)->toJson();
        $user = $this->userRepository->find($id);
        return Response::json(array($user, $students));
    }

    public function updateProfile(StudentRequest $request)
    {
        $id = $request->id;
        DB::beginTransaction();
        try {
            $user = $this->userRepository->update($id, $request->all());
            $data = $this->studentRepository->uploadImage($request);
            $data['user_id'] = $user->id;
            $student = $this->studentRepository->update($id, $data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }
        return Response::json(array($user, $student));
    }
}
