<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PagesController extends Controller
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
        return view('pages.list', ['pages' => Page::paginate($this->per_page)]);
    }

    public function filter(Request $request){
        $pages = Page::where('page', 'like', '%' . $request->search . '%')->paginate($this->per_page);
        return view('pages.list', ['pages' => $pages, 'request' => $request]);
    }

    public function edit($id){
        $page = Page::find($id);
        return view('pages.edit', ['page' => $page]);
    }

    public function update(Request $request, $id)
    {
        $Page = Page::find($id);
        $rules = array(
            'page' => 'required',
        );

        if ($request->file('images')){
            //$rules['images'] = 'required|image|mimes:jpeg,png,jpg|max:2048';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()){
            return redirect()->back()->withErrors($validator->errors())->withInput(Input::all());
        }
        else{

            $Page->page = $request->page;
            $Page->page_title = $request->page_title;
            $Page->page_meta_data = $request->page_meta_data;

            if ($request->file('images')) {
                $file = $request->file('images');
                $file_name = parent::file_uploader($file);

                if (!is_null($file_name)) {

                    if (($Page->cover_image != null) && (file_exists(public_path() . '/uploads/' . $Page->cover_image))) {
                        unlink(public_path() . '/uploads/' . $Page->cover_image);
                    }

                    $Page->cover_image = $file_name;
                }
            }

            $Page->update();


            parent::userLog(Auth::user()->id, 'Updated Page #'.$Page->id);

            $request->session()->flash('message', "Page Updated Successfully!");
            $request->session()->flash('is_error', false);
            return Redirect::to('/pages');
        }
    }
}
