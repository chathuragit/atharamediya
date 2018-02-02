<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;

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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function authenticated($request , $user){
        if($user->role > 1){
            parent::userLog($user->id, 'Logged in to system');
            return Redirect::to('/');
        }else{
            parent::userLog($user->id, 'Logged in to system');
            return Redirect::to('/');
        }
    }

    public function logout(Request $request)
    {
        $user = Auth::user();
        parent::userLog($user->id, 'Logout from system');
        $this->guard()->logout();
        return redirect()->route('login');
    }
}
