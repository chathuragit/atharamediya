<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

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
    protected $redirectTo = '/dashboard';

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
        if($user->role > 2){
            parent::userLog($user->id, 'Logged in to system');
            return Redirect::to('/dashboard');
        }
        else{
            parent::userLog($user->id, 'Logged in to system');
            return Redirect::to('/advertisments/create');
        }
    }

    public function logout(Request $request)
    {
        $user = Auth::user();
        parent::userLog($user->id, 'Logout from system');
        $this->guard()->logout();
        return redirect()->route('login');
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'email';
    }

    //change credentials to use the field user_name instead of the default email
    protected function credentials(Request $request)
    {
        //return $request->only('username', 'password', 'active');
        return [
            'email' => $request->email,
            'password' => $request->password,
            'is_active' => '1',
        ];
    }
}
