<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use App\User;

class AdvertisingMemberController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->per_page  = 2;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $advertising_members = User::UsersByType(4, $this->per_page);
        return view('advertising_members.list', ['advertising_members' => $advertising_members]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('advertising_members.create');
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
            $user->role = 4;
            $user->is_active = true;
            $user->save();

            parent::userLog(Auth::user()->id, 'Created Advertising Member User #'.$user->id);

            $request->session()->flash('message', "Advertising Member User Created Successfully!");
            $request->session()->flash('is_error', false);
            return Redirect::to('/advertising_members');
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
        return view('advertising_members.show', ['User' => $User]);
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
        return view('advertising_members.edit', ['User' => $User]);
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

            parent::userLog(Auth::user()->id, 'Updated Advertising Member User #'.$user->id);

            $request->session()->flash('message', "Advertising Member User Updated Successfully!");
            $request->session()->flash('is_error', false);
            return Redirect::to('/advertising_members');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $user = User::find($id);
        $user->delete();

        parent::userLog(Auth::user()->id, 'Deleted Advertising Member User #'.$user->id);

        $request->session()->flash('message', "Advertising Member User Deleted Successfully!");
        $request->session()->flash('is_error', false);
    }

    public function filter(Request $request){
        $advertisement_collectors = User::UsersByType(4, $this->per_page, $request->search);
        return view('advertising_members.list', ['advertisement_collectors' => $advertisement_collectors, 'request' => $request]);
    }

    public function changePasswordRequest($id){
        return view('advertising_members.changePassword', ['User' => User::find($id)]);
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

            parent::userLog(Auth::user()->id, 'Password Updated for Advertising Member User #'.$User->id);

            $request->session()->flash('message', "Advertising Member User Password Updated Successfully!");
            $request->session()->flash('is_error', false);
            return Redirect::to('/advertising_members');
        }
    }

    public function change_status(Request $request){
        $user = User::find($request->id);
        $user->is_active = ($request->active == 'true') ? true : false;
        $user->update();

        if(($request->active == 'true')){
            parent::userLog(Auth::user()->id, 'Advertising Member User activated #'.$user->id);
        }
        else{
            parent::userLog(Auth::user()->id, 'Advertising Member User deactivated #'.$user->id);
        }
    }
}
