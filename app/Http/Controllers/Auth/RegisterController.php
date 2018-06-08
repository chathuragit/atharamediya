<?php

namespace App\Http\Controllers\Auth;

use App\Individual;
use App\Member;
use App\Package;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
use Carbon\Carbon;

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
    protected $redirectTo = '/advertisments/create';

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
        $confirmation_code = uniqid();

        if (isset($data['package'])){
            $package = Package::find($data['package']);
        }
        else{
            $package = null;
        }
        $today = Carbon::today();


       // dd($today->addDays($package->package_period));
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => $data['member_type'],
            'confirmation_code' => $confirmation_code,
            'expier_at' => (is_object($package) && (count($package) > 0)) ? ($today->addDays($package->package_period)) : '0000-00-00 00:00:00',
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

            if($data['member_type'] == 4){
                Member::create([
                    'user_id' => $user->id,
                    'contact_number' => $data['contact_number'],
                    'contact_email' => $data['email'],
                    'package_id' => $data['package'],
                    'expier_at' => (is_object($package) && (count($package) > 0)) ? ($today->addDays($package->package_period)) : '0000-00-00 00:00:00',
                    'is_active' => false,
                ]);
            }
            else{
                Member::create([
                    'user_id' => $user->id,
                    'contact_number' => $data['contact_number'],
                    'contact_email' => $data['email'],
                    'expier_at' => (is_object($package) && (count($package) > 0)) ? ($today->addDays($package->package_period)) : '0000-00-00 00:00:00',
                    'is_active' => false,
                ]);
            }

        }

        Mail::to($data['email'])->send(new WelcomeMail($user));

        return $user;
    }


    //https://scqq.blogspot.com/2016/11/laravel-5-tutorial-email-verification.html
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
