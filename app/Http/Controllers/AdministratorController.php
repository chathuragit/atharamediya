<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

class AdministratorController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->per_page  = 25;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $administrators = User::UsersByType(2, $this->per_page);
        return view('administrators.list', ['administrators' => $administrators]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administrators.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'name' => 'required',
            'email' => "required|email|max:191|unique:users,email",
            'password' => 'required|confirmed'
        );


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()){
            return redirect()->back()->withErrors($validator->errors())->withInput(Input::all());
        }
        else{
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->role = 2;
            $user->is_active = true;
            $user->save();

            parent::userLog(Auth::user()->id, 'Created Administrator User #'.$user->id);

            $request->session()->flash('message', "Administrator User Created Successfully!");
            $request->session()->flash('is_error', false);
            return Redirect::to('/administrators');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $User = User::find($id);
        return view('administrators.show', ['User' => $User]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $User = User::find($id);
        return view('administrators.edit', ['User' => $User]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $rules = array(
            'name' => 'required',
            'email' => "required|email|max:191|unique:users,email,$user->id",
        );


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()){
            return redirect()->back()->withErrors($validator->errors())->withInput(Input::all());
        }
        else{
            $user->name = $request->name;
            $user->email = $request->email;
            $user->update();

            parent::userLog(Auth::user()->id, 'Updated Administrator User #'.$user->id);

            $request->session()->flash('message', "Administrator User Updated Successfully!");
            $request->session()->flash('is_error', false);
            return Redirect::to('/administrators');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $user = User::find($id);
        $user->delete();

        parent::userLog(Auth::user()->id, 'Deleted Administrator User #'.$user->id);

        $request->session()->flash('message', "Administrator User Deleted Successfully!");
        $request->session()->flash('is_error', false);
    }

    public function filter(Request $request){
        $administrators = User::UsersByType(2, $this->per_page, $request->search);
        return view('administrators.list', ['administrators' => $administrators, 'request' => $request]);
    }

    public function changePasswordRequest($id){
        return view('administrators.changePassword', ['User' => User::find($id)]);
    }

    public function changePassword(Request $request){
        $rules = array(
            'password' => 'required|confirmed'
        );


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()){
            return redirect()->back()->withErrors($validator->errors())->withInput(Input::all());
        }
        else{
            $User = User::find($request->user_id);
            $User->password = bcrypt($request->password);
            $User->update();

            parent::userLog(Auth::user()->id, 'Password Updated for Administrator User #'.$User->id);

            $request->session()->flash('message', "Administrator User Password Updated Successfully!");
            $request->session()->flash('is_error', false);
            return Redirect::to('/administrators');
        }
    }

    public function change_status(Request $request){
        $user = User::find($request->id);
        $user->is_active = ($request->active == 'true') ? true : false;
        $user->update();

        if(($request->active == 'true')){
            parent::userLog(Auth::user()->id, 'Administrator User activated #'.$user->id);
        }
        else{
            parent::userLog(Auth::user()->id, 'Administrator User deactivated #'.$user->id);
        }
    }
}
