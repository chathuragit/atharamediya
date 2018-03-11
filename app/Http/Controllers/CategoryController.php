<?php

namespace App\Http\Controllers;

use App\Attribute;
use App\Category;
use App\CategoryAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
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
        $categories = Category::FilterCategory($this->per_page);
        return view('categories.list', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('is_active', 1)->get();
        $attributes = Attribute::where('is_active', 1)->get();
        return view('categories.create', ['categories' => $categories, 'attributes' => $attributes]);
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
            'category_name' => 'required',
            'default_attribute' => 'required',
        );


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()){
            return redirect()->back()->withErrors($validator->errors())->withInput(Input::all());
        }
        else{
            $Category = new Category();
            $Category->category_name = $request->category_name;
            $Category->fontawesome = $request->category_icon;
            $Category->parent_category_id = $request->parent_category;
            $Category->is_active = true;
            $Category->save();

            if(count($request->category_attributes) > 0){
                foreach ($request->category_attributes as $attribute){
                    $Attribute = new CategoryAttribute();
                    $Attribute->attribute_id = $attribute;
                    $Attribute->category_id = $Category->id;
                    $Attribute->is_default = ($attribute == $request->default_attribute) ? 1 : 0;
                    $Attribute->save();
                }
            }

            parent::userLog(Auth::user()->id, 'Created Category #'.$Category->id);

            $request->session()->flash('message', "Category Created Successfully!");
            $request->session()->flash('is_error', false);
            return Redirect::to('/categories');
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
        $Category = Category::find($id);
        $categories = Category::where('id', $Category->parent_category_id)->get();
        $attributes = Attribute::where('is_active', 1)->get();
        $default_attribute = CategoryAttribute::where('is_default', 1)->where('category_id', $Category->id)->first();
        return view('categories.show', ['categories' => $categories, 'attributes' => $attributes, 'default_attribute' => $default_attribute, 'Category' => $Category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Category = Category::find($id);
        $categories = Category::where('id', '!=',  $id)->where('is_active', 1)->get();
        $attributes = Attribute::where('is_active', 1)->get();
        $default_attribute = CategoryAttribute::where('is_default', 1)->where('category_id', $Category->id)->first();
        return view('categories.edit', ['categories' => $categories, 'attributes' => $attributes, 'default_attribute' => $default_attribute, 'Category' => $Category]);
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
        $Category = Category::find($id);

        $rules = array(
            'category_name' => 'required',
            'default_attribute' => 'required',
        );


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()){
            return redirect()->back()->withErrors($validator->errors())->withInput(Input::all());
        }
        else{

            $Category->category_name = $request->category_name;
            $Category->fontawesome = $request->category_icon;
            $Category->parent_category_id = $request->parent_category;
            $Category->is_active = true;
            $Category->update();

            if(!is_null($request->category_attributes)){

                CategoryAttribute::where('category_id',$Category->id)->whereNotIn('attribute_id', $request->category_attributes)->delete();

                foreach ($request->category_attributes as $attribute){
                    $isExcistAttribute = CategoryAttribute::where('category_id', $Category->id)->where('attribute_id', $attribute)->first();
                    if(is_null($isExcistAttribute) || (count($isExcistAttribute) == 0)){
                        $Attribute = new CategoryAttribute();
                        $Attribute->attribute_id = $attribute;
                        $Attribute->category_id = $Category->id;
                        $Attribute->is_default = ($attribute == $request->default_attribute) ? 1 : 0;
                        $Attribute->save();
                    }
                }
            }else{
                CategoryAttribute::where('category_id',$Category->id)->delete();
            }

            parent::userLog(Auth::user()->id, 'Updated Category #'.$Category->id);

            $request->session()->flash('message', "Category Updated Successfully!");
            $request->session()->flash('is_error', false);
            return Redirect::to('/categories');
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
        $Category = Category::find($id);
        $Category->assigned_attributes()->delete();
        $Category->delete();

        parent::userLog(Auth::user()->id, 'Deleted Category #'.$Category->id);

        $request->session()->flash('message', "Category Deleted Successfully!");
        $request->session()->flash('is_error', false);
    }

    public function filter(Request $request){
        $categories = Category::FilterCategory($this->per_page, $request->search);
        return view('categories.list', ['categories' => $categories, 'request' => $request]);
    }

    public function change_status(Request $request){
        $Category = Category::find($request->id);
        $Category->is_active = ($request->active == 'true') ? true : false;
        $Category->update();

        if(($request->active == 'true')){
            parent::userLog(Auth::user()->id, 'Category activated #'.$Category->id);
        }
        else{
            parent::userLog(Auth::user()->id, 'Category deactivated #'.$Category->id);
        }
    }
}
