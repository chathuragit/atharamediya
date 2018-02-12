<?php

namespace App\Http\Controllers;

use App\Advertisment;
use App\AdvertismentAttribute;
use App\AdvertismentMedia;
use App\AdvertismentStatus;
use App\Category;
use App\District;
use App\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;


class AdvertismentController extends Controller
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
        $status = request()->segment(1);
        switch($status){
            case 'advertisments_active' :
                $advertisments = Advertisment::FilterAdvertisment(2, $this->per_page);
                break;

            case 'advertisments_pending' :
                $advertisments = Advertisment::FilterAdvertisment(1, $this->per_page);
                break;

             case 'advertisments_expired' :
                $advertisments = Advertisment::FilterAdvertisment(3, $this->per_page);
                break;

            default :
                $advertisments = Advertisment::FilterAdvertisment(null, $this->per_page);
                break;
        }

        return view('advertisments.list', ['advertisments' => $advertisments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('is_active', 1)->get();
        $districts = District::all();
        return view('advertisments.create', ['categories' => $categories, 'districts' => $districts]);
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
            'advertisment_location' => 'required',
            //'locationlocation' => 'required',
            'advertisment_desc' => 'required',
        );


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()){
            return redirect()->back()->withErrors($validator->errors())->withInput(Input::all());
        }
        else{
            $Advertisment = new Advertisment();
            $Advertisment->title = $request->advertisment_title;
            $Advertisment->category_id = $request->category;
            $Advertisment->user_id = Auth::user()->id;
            $Advertisment->is_active = false;
            $Advertisment->status = 1;
            $Advertisment->description =  $request->advertisment_desc;
            $Advertisment->location_id =  $request->advertisment_location;
            $Advertisment->save();

            $files = $request->file('images');

            if($files != null){
                parent::multiple_upload($Advertisment->id, $default_pic = '');
            }

            if(count($request->advertisment_attribute) > 0){
                foreach ($request->advertisment_attribute as $key => $attribute){
                    $AdvertismentAttribute = new AdvertismentAttribute();
                    $AdvertismentAttribute->advertisment_id = $Advertisment->id;
                    $AdvertismentAttribute->attribute_id = $key;
                    $AdvertismentAttribute->attribute_value = (is_array($attribute)) ? serialize($attribute) : $attribute;
                    $AdvertismentAttribute->save();
                }
            }

            parent::userLog(Auth::user()->id, 'Created Advertisment #'.$Advertisment->id);

            $request->session()->flash('message', "Advertisment Created Successfully!");
            $request->session()->flash('is_error', false);
            return Redirect::to('/advertisments');
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
        $Advertisment = Advertisment::find($id);
        $categories = Category::where('is_active', 1)->get();
        $districts = District::all();
        return view('advertisments.show', ['categories' => $categories, 'districts' => $districts, 'Advertisment' => $Advertisment]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Advertisment = Advertisment::find($id);
        $categories = Category::where('is_active', 1)->get();
        $districts = District::all();
        $AdvertismentStatus = AdvertismentStatus::all();
        return view('advertisments.edit', ['categories' => $categories, 'districts' => $districts, 'Advertisment' => $Advertisment, 'AdvertismentStatus' => $AdvertismentStatus]);
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
        $Advertisment = Advertisment::find($id);
        $rules = array(
            'advertisment_title' => 'required',
            'category' => 'required',
            'advertisment_location' => 'required',
            //'locationlocation' => 'required',
            'advertisment_desc' => 'required',
        );


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()){
            return redirect()->back()->withErrors($validator->errors())->withInput(Input::all());
        }
        else{

            $Advertisment->title = $request->advertisment_title;
            $Advertisment->category_id = $request->category;
            $Advertisment->user_id = Auth::user()->id;

            if(Auth::user()->user_role > 2) {
                $Advertisment->is_active = false;
            }

            $Advertisment->status = (isset($request->advertisment_status)) ? $request->advertisment_status : 1;
            $Advertisment->description =  $request->advertisment_desc;
            $Advertisment->location_id =  $request->advertisment_location;
            $Advertisment->update();

            if(!is_null($request->advertisment_attribute)){
                AdvertismentAttribute::where('advertisment_id',$Advertisment->id)->whereNotIn('attribute_id', $request->advertisment_attribute)->delete();

                foreach ($request->advertisment_attribute as $key => $attribute){
                    $AdvertismentAttribute = AdvertismentAttribute::where('advertisment_id', $Advertisment->id)->where('attribute_id', $key)->first();
                    if(is_null($AdvertismentAttribute)){
                        $AdvertismentAttribute = new AdvertismentAttribute();
                    }

                    $AdvertismentAttribute->advertisment_id = $Advertisment->id;
                    $AdvertismentAttribute->attribute_id = $key;
                    $AdvertismentAttribute->attribute_value = (is_array($attribute)) ? serialize($attribute) : $attribute;
                    $AdvertismentAttribute->save();
                }
            }else{
                AdvertismentAttribute::where('advertisment_id',$Advertisment->id)->delete();
            }

            $oldImages = Input::get('oldImages');
            $default_pic = Input::get('default_pic');
            $Advertisment->advertisment_media()->delete();
            if(is_array($oldImages) && !empty($oldImages)){
                foreach ($oldImages as $filename){
                    $AdvertismentMedia = new AdvertismentMedia();
                    $AdvertismentMedia->advertisment_id = $id;
                    $AdvertismentMedia->data_url = $filename;
                    $AdvertismentMedia->is_active = true;
                    if(($default_pic != '') && ($default_pic == $filename)){
                        $AdvertismentMedia->default_pic  = 1;
                    }
                    $AdvertismentMedia->save();
                }
            }

            $files = $request->file('images');

            if($files != null) {
                parent::multiple_upload($id);
            }

            parent::userLog(Auth::user()->id, 'Updated Advertisment #'.$Advertisment->id);

            $request->session()->flash('message', "Advertisment Updated Successfully!");
            $request->session()->flash('is_error', false);
            return Redirect::to('/advertisments');
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
        $Advertisment = Advertisment::find($id);
       // $Advertisment->advertisment_attributes()->delete();
       // $Advertisment->advertisment_media()->delete();
       // $Advertisment->delete();

        $Advertisment->status = 5;
        $Advertisment->is_active = 0;
        $Advertisment->update();

        parent::userLog(Auth::user()->id, 'Deleted Advertisment #'.$Advertisment->id);

        $request->session()->flash('message', "Advertisment Deleted Successfully!");
        $request->session()->flash('is_error', false);
    }

    public function filter(Request $request){
        $advertisments = Advertisment::FilterAdvertisment(null, $this->per_page);
        return view('advertisments.list', ['advertisments' => $advertisments, 'request' => $request]);
    }

    public function change_status(Request $request){
        $Advertisment = Advertisment::find($request->id);
        $Advertisment->is_active = ($request->active == 'true') ? true : false;
        $Advertisment->update();

        if(($request->active == 'true')){
            parent::userLog(Auth::user()->id, 'Advertisment activated #'.$Advertisment->id);
        }
        else{
            parent::userLog(Auth::user()->id, 'Advertisment deactivated #'.$Advertisment->id);
        }
    }

    public function advertisment_attributes(Request $request){
        $Category = Category::find($request->category);
        $Attributes = $Category->assigned_attributes;

        return view('advertisments.attributes', ['Attributes' => $Attributes, 'Category' => $Category]);
    }

    public function remove_image(){
        $filename = Input::get('filename');
        $rowid = Input::get('id');
        AdvertismentMedia::where('id', $rowid)->delete();
        File::delete('uploads/'.$filename);
    }
}
