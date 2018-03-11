<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use App\User;

class IndividualAdvertiserController extends Controller
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
        $individual_advertisers = User::UsersByType(6, $this->per_page);
        return view('individual_advertisers.list', ['individual_advertisers' => $individual_advertisers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->index();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->index();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->index();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->index();
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
        return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->index();
    }

    public function filter(Request $request){
        $individual_advertisers = User::UsersByType(6, $this->per_page, $request->search);
        return view('individual_advertisers.list', ['individual_advertisers' => $individual_advertisers, 'request' => $request]);
    }

    public function change_status(Request $request){
        $user = User::find($request->id);
        $user->is_active = ($request->active == 'true') ? true : false;
        $user->update();

        if(($request->active == 'true')){
            parent::userLog(Auth::user()->id, 'Individual Advertisers activated #'.$user->id);
        }
        else{
            parent::userLog(Auth::user()->id, 'Individual Advertisers deactivated #'.$user->id);
        }
    }
}
