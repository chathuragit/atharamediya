<?php

namespace App\Http\Controllers;

use App\Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

class AttributeController extends Controller
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
        $attributes = Attribute::FilterAttributes($this->per_page);
        return view('attributes.list', ['attributes' => $attributes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('attributes.create');
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
            'attribute_name' => 'required',
            'attribute_type' => 'required'
        );


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()){
            return redirect()->back()->withErrors($validator->errors())->withInput(Input::all());
        }
        else{
            $Attribute = new Attribute();
            $Attribute->attribute_name = $request->attribute_name;
            $Attribute->attribute_values = $request->attribute_values;
            $Attribute->attribute_type = $request->attribute_type;
            $Attribute->is_active = true;
            $Attribute->save();

            parent::userLog(Auth::user()->id, 'Created Attribute #'.$Attribute->id);

            $request->session()->flash('message', "Attribute Created Successfully!");
            $request->session()->flash('is_error', false);
            return Redirect::to('/attributes');
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
        $Attribute = Attribute::find($id);
        return view('attributes.show', ['Attribute' => $Attribute]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Attribute = Attribute::find($id);
        return view('attributes.edit', ['Attribute' => $Attribute]);
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
        $Attribute = Attribute::find($id);
        $rules = array(
            'attribute_name' => 'required',
            'attribute_type' => 'required'
        );


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()){
            return redirect()->back()->withErrors($validator->errors())->withInput(Input::all());
        }
        else{
            $Attribute->attribute_name = $request->attribute_name;
            $Attribute->attribute_values = $request->attribute_values;
            $Attribute->attribute_type = $request->attribute_type;
            $Attribute->update();

            parent::userLog(Auth::user()->id, 'Updated Attribute #'.$Attribute->id);

            $request->session()->flash('message', "Attribute Updated Successfully!");
            $request->session()->flash('is_error', false);
            return Redirect::to('/attributes');
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
        $Attribute = Attribute::find($id);
        $Attribute->delete();

        parent::userLog(Auth::user()->id, 'Deleted Attribute #'.$Attribute->id);

        $request->session()->flash('message', "Attribute Deleted Successfully!");
        $request->session()->flash('is_error', false);
    }

    public function filter(Request $request){
        $attributes = Attribute::FilterAttributes($this->per_page, $request->search);
        return view('attributes.list', ['attributes' => $attributes, 'request' => $request]);
    }

    public function change_status(Request $request){
        $Attribute = Attribute::find($request->id);
        $Attribute->is_active = ($request->active == 'true') ? true : false;
        $Attribute->update();

        if(($request->active == 'true')){
            parent::userLog(Auth::user()->id, 'Attribute activated #'.$Attribute->id);
        }
        else{
            parent::userLog(Auth::user()->id, 'Attribute deactivated #'.$Attribute->id);
        }
    }
}
