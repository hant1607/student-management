<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->middleware('guest')->except('logout');
        parent::__construct();
        $this->userRepository = $userRepository;
    }
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
//    protected $redirectTo = '';

    public function redirectTo()
    {
        $userLogin = Auth::user();
        return route('users.profile', $userLogin->id);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
}
