<?php

namespace App\Http\Controllers;

use App\Package;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PackageController extends Controller
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
        $Packages = Package::orderBy('id', 'DESC')->paginate($this->per_page);
        return view('packages.list', ['Packages' => $Packages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('packages.create');
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
            'package_name' => 'required',
            'package_period' => 'required',
            'package_price' => 'required',
            'package_advertisments' => 'required',
        );


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()){
            return redirect()->back()->withErrors($validator->errors())->withInput(Input::all());
        }
        else{
            $Package = new Package();
            $Package->package_name = $request->package_name;
            $Package->package_period = $request->package_period;
            $Package->package_price = $request->package_price;
            $Package->package_advertisments = $request->package_advertisments;
            $Package->advertisment_life_time = $request->advertisment_life_time;
            $Package->save();

            parent::userLog(Auth::user()->id, 'Created Package #'.$Package->id);

            $request->session()->flash('message', "Package Created Successfully!");
            $request->session()->flash('is_error', false);
            return Redirect::to('/packages');
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
        return view('packages.show', ['Package' => Package::find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('packages.edit', ['Package' => Package::find($id)]);
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
        $rules = array(
            'package_name' => 'required',
            'package_period' => 'required',
            'package_price' => 'required',
            'package_advertisments' => 'required',
        );


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()){
            return redirect()->back()->withErrors($validator->errors())->withInput(Input::all());
        }
        else{
            $Package = Package::find($id);
            $Package->package_name = $request->package_name;
            $Package->package_period = $request->package_period;
            $Package->package_price = $request->package_price;
            $Package->package_advertisments = $request->package_advertisments;
            $Package->advertisment_life_time = $request->advertisment_life_time;
            $Package->save();

            parent::userLog(Auth::user()->id, 'Updated Package #'.$Package->id);

            $request->session()->flash('message', "Package Updated Successfully!");
            $request->session()->flash('is_error', false);
            return Redirect::to('/packages');
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
        $Package = Package::find($id);
        $Package->delete();

        parent::userLog(Auth::user()->id, 'Deleted Package #'.$Package->id);

        $request->session()->flash('message', "Package Deleted Successfully!");
        $request->session()->flash('is_error', false);
    }

    public function filter(Request $request){
        $Packages = Package::where('package_name', 'like', '%' . $request->search . '%')->paginate($this->per_page);
        return view('packages.list', ['Packages' => $Packages, 'request' => $request]);
    }
}
