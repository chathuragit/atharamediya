<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use App\User;

class AdvertisementCollectorController extends Controller
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
        $advertisement_collectors = User::UsersByType(3, $this->per_page);
        return view('advertisement_collectors.list', ['advertisement_collectors' => $advertisement_collectors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('advertisement_collectors.create');
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
            $user->role = 3;
            $user->is_active = true;
            $user->save();

            parent::userLog(Auth::user()->id, 'Created Advertisement Collector User #'.$user->id);

            $request->session()->flash('message', "Advertisement Collector User Created Successfully!");
            $request->session()->flash('is_error', false);
            return Redirect::to('/advertisement_collectors');
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
        return view('advertisement_collectors.show', ['User' => $User]);
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
        return view('advertisement_collectors.edit', ['User' => $User]);
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

            parent::userLog(Auth::user()->id, 'Updated Advertisement Collector User #'.$user->id);

            $request->session()->flash('message', "Advertisement Collector User Updated Successfully!");
            $request->session()->flash('is_error', false);
            return Redirect::to('/advertisement_collectors');
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

        parent::userLog(Auth::user()->id, 'Deleted Advertisement Collector User #'.$user->id);

        $request->session()->flash('message', "Advertisement Collector User Deleted Successfully!");
        $request->session()->flash('is_error', false);
    }

    public function filter(Request $request){
        $advertisement_collectors = User::UsersByType(3, $this->per_page, $request->search);
        return view('advertisement_collectors.list', ['advertisement_collectors' => $advertisement_collectors, 'request' => $request]);
    }

    public function changePasswordRequest($id){
        return view('advertisement_collectors.changePassword', ['User' => User::find($id)]);
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

            parent::userLog(Auth::user()->id, 'Password Updated for Advertisement Collector User #'.$User->id);

            $request->session()->flash('message', "Advertisement Collector User Password Updated Successfully!");
            $request->session()->flash('is_error', false);
            return Redirect::to('/advertisement_collectors');
        }
    }

    public function change_status(Request $request){
        $user = User::find($request->id);
        $user->is_active = ($request->active == 'true') ? true : false;
        $user->update();

        if(($request->active == 'true')){
            parent::userLog(Auth::user()->id, 'Advertisement Collector User activated #'.$user->id);
        }
        else{
            parent::userLog(Auth::user()->id, 'Advertisement Collector User deactivated #'.$user->id);
        }
    }
}
