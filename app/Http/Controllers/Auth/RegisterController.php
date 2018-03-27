<?php

namespace App\Http\Controllers\Auth;

use App\Individual;
use App\Member;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'member_type' => 'required|not_in:0',
            'contact_number' => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => $data['member_type'],
            'is_active' => false,
        ]);


        if($data['member_type'] == 6){
            Individual::create([
                'user_id' => $user->id,
                'contact_number' => $data['contact_number'],
                'contact_email' => $data['email'],
                'is_active' => false,
            ]);
        }

        if(($data['member_type'] == 4) || ($data['member_type'] == 3)){
            Member::create([
                'user_id' => $user->id,
                'contact_number' => $data['contact_number'],
                'contact_email' => $data['email'],
                'package_id' => $data['package'],
                'is_active' => false,
            ]);
        }

        return $user;
    }

    /*public function showRegistrationForm()
    {
        return redirect('login');
    }*/

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /*public function register(Request $request)
    {
        abort(404);
    }*/
}
