<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\User;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $User = Auth::user();
        return view('profile.profile', ['User' => $User]);
    }

    public function change_credentials(Request $request){

        $user = User::find($request->user_id);

        $rules = array(
            'name' => 'required',
            'email' => "required|email|max:191|unique:users,email,$user->id",
            'password' => 'required|confirmed'
        );


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()){
            return redirect()->back()->withErrors($validator->errors())->withInput(Input::all());
        }
        else{

            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->update();

            parent::userLog(Auth::user()->id, 'Profile Credientials Updated For User #'.$user->id);

            $request->session()->flash('message', "Profile Credientials Updated Successfully!");
            $request->session()->flash('is_error', false);
            return Redirect::to('/profile');
        }
    }
}
