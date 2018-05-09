<?php

namespace App\Http\Controllers;

use App\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use App\Category;
use App\AdvertismentStatus;
use Illuminate\Support\Facades\File;

class BannerController extends Controller
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
        $advertisments = Banner::FilterBannerAdvertisment(null, $this->per_page);
        return view('banners.list', ['advertisments' => $advertisments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('is_active', 1)->get();
        return view('banners.create', ['categories' => $categories]);
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
            'advertisment_title' => 'required',
            'category' => 'required',
            'display_position' => 'required',
            'display_period' => 'required',
        );


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()){
            return redirect()->back()->withErrors($validator->errors())->withInput(Input::all());
        }
        else{
            $Advertisment = new Banner();
            $Advertisment->title = $request->advertisment_title;
            $Advertisment->category_id = $request->category;
            $Advertisment->link_url = $request->link_url;
            $Advertisment->user_id = Auth::user()->id;
            $Advertisment->display_in = $request->display_position;
            $Advertisment->display_period = $request->display_period;

            if(Auth::user()->role > 2) {
                $Advertisment->is_active = false;
                $Advertisment->status = 1;
            }
            else{
                $Advertisment->is_active = true;
                $Advertisment->status = 2;
                $Advertisment->approved_by = Auth::user()->id;
            }

            $files = $request->file('banner_image');

            if($files != null){
                $filename = parent::file_uploader($files);
                $Advertisment->data_url = $filename;
            }

            $Advertisment->save();

            parent::userLog(Auth::user()->id, 'Created Banner Advertisment #'.$Advertisment->id);

            $request->session()->flash('message', "Banner Advertisment Created Successfully!");
            $request->session()->flash('is_error', false);
            return Redirect::to('/banners');
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
        $Advertisment = Banner::find($id);
        $categories = Category::where('is_active', 1)->get();

        return view('banners.show', ['categories' => $categories, 'Advertisment' => $Advertisment]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Advertisment = Banner::find($id);
        $categories = Category::where('is_active', 1)->get();
        $AdvertismentStatus = AdvertismentStatus::all();

        return view('banners.edit', ['categories' => $categories, 'Advertisment' => $Advertisment, 'AdvertismentStatus' => $AdvertismentStatus]);
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
            'advertisment_title' => 'required',
            'category' => 'required',
            'display_position' => 'required',
            'display_period' => 'required',
        );


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()){
            return redirect()->back()->withErrors($validator->errors())->withInput(Input::all());
        }
        else{
            $Advertisment = Banner::find($id);
            $Advertisment->title = $request->advertisment_title;
            $Advertisment->category_id = $request->category;
            $Advertisment->link_url = $request->link_url;
            $Advertisment->display_in = $request->display_position;
            $Advertisment->display_period = $request->display_period;

            if(Auth::user()->role > 2) {
                $Advertisment->is_active = false;
                $Advertisment->approved_by = 0;
                $Advertisment->status = 1;
            }
            else{
                $Advertisment->status = (isset($request->advertisment_status)) ? $request->advertisment_status : $Advertisment->status;
            }

            if((isset($request->advertisment_status)) && ($request->advertisment_status == 2)){
                $Advertisment->approved_by = Auth::user()->id;
                $Advertisment->is_active = true;
            }else{
                $Advertisment->is_active = false;
            }

            $files = $request->file('banner_image');

            if($files != null){
                File::delete('uploads/'.$Advertisment->data_url);
                $filename = parent::file_uploader($files);
                $Advertisment->data_url = $filename;
            }

            $Advertisment->update();

            parent::userLog(Auth::user()->id, 'Updated Banner Advertisment #'.$Advertisment->id);

            $request->session()->flash('message', "Banner Advertisment Updated Successfully!");
            $request->session()->flash('is_error', false);
            return Redirect::to('/banners');
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
        $Advertisment = Banner::find($id);
        // $Advertisment->advertisment_attributes()->delete();
        // $Advertisment->advertisment_media()->delete();
        // $Advertisment->delete();

        $Advertisment->status = 5;
        $Advertisment->is_active = 0;
        $Advertisment->update();

        parent::userLog(Auth::user()->id, 'Deleted Banner Advertisment #'.$Advertisment->id);

        $request->session()->flash('message', "Banner Advertisment Deleted Successfully!");
        $request->session()->flash('is_error', false);
    }

    public function filter(Request $request){
        $advertisments = Banner::FilterBannerAdvertisment(null, $this->per_page);
        return view('banners.list', ['advertisments' => $advertisments, 'request' => $request]);
    }

    public function change_status(Request $request){
        $Advertisment = Banner::find($request->id);
        $Advertisment->is_active = ($request->active == 'true') ? true : false;
        if($Advertisment->status == 1){
            $Advertisment->status = 2;
            $Advertisment->approved_by = Auth::user()->id;
        }
        $Advertisment->update();

        if(($request->active == 'true')){
            parent::userLog(Auth::user()->id, 'Banner Advertisment activated #'.$Advertisment->id);
        }
        else{
            parent::userLog(Auth::user()->id, 'Banner Advertisment deactivated #'.$Advertisment->id);
        }
    }
}
