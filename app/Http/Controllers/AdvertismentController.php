<?php

namespace App\Http\Controllers;

use App\Advertisment;
use App\AdvertismentAttribute;
use App\AdvertismentMedia;
use App\AdvertismentStatus;
use App\Category;
use App\District;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

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
        $this->per_page  = 10;
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

             case 'advertisments_blocked' :
                $advertisments = Advertisment::FilterAdvertisment(4, $this->per_page);
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
        $categories = Category::where('parent_category_id', 0)->where('is_active', 1)->get();
        $districts = District::all();

        $profile = null;
        $assigned_individual = Auth::user()->assigned_individual;
        if(!is_null($assigned_individual)){
            $profile = $assigned_individual;
        }else{
            $assigned_member = Auth::user()->assigned_member;
            if(!is_null($assigned_member)){
                $profile = $assigned_member;
            }
        }

        return view('advertisments.create', ['categories' => $categories, 'districts' => $districts, 'profile' => $profile]);
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
            'location' => 'required',
            'selling_type' => 'required',
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
            $Advertisment->sub_category_id = $request->sub_category;
            $Advertisment->user_id = Auth::user()->id;

            if(Auth::user()->role > 2) {
                $Advertisment->is_active = false;
                $Advertisment->status = 1;
            }
            else{
                $Advertisment->is_active = true;
                $Advertisment->status = 2;
                $Advertisment->approved_by = Auth::user()->id;
            }

            $Advertisment->description =  $request->advertisment_desc;
            $Advertisment->location_id =  $request->advertisment_location;
            $Advertisment->location =  $request->location;
            $Advertisment->price =  $request->price;
            $Advertisment->selling_type =  ($request->selling_type == 'Whole_Selling') ? 1 : 0;
            $Advertisment->is_negotiable = $request->negotiable;
            $Advertisment->contact_email = $request->contact_email;
            $Advertisment->contact_mobile = $request->contact_number;
            $Advertisment->expier_at = Carbon::now()->addDays(env('ATHARAMEDIYA_ALLOWED_TIME_FRAME_FOR_MEMBER'));
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
        $categories = Category::where('parent_category_id', 0)->where('is_active', 1)->get();
        $SubCategories = Category::where('parent_category_id' , $Advertisment->category_id)->where('is_active' , 1)->get();
        $districts = District::all();
        return view('advertisments.show', ['categories' => $categories, 'SubCategories' => $SubCategories, 'districts' => $districts, 'Advertisment' => $Advertisment]);
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
        $categories = Category::where('parent_category_id', 0)->where('is_active', 1)->get();
        $SubCategories = Category::where('parent_category_id' , $Advertisment->category_id)->where('is_active' , 1)->get();
        $districts = District::all();
        $AdvertismentStatus = AdvertismentStatus::all();

        $profile = null;
        $assigned_individual = Auth::user()->assigned_individual;
        if(!is_null($assigned_individual)){
            $profile = $assigned_individual;
        }else{
            $assigned_member = Auth::user()->assigned_member;
            if(!is_null($assigned_member)){
                $profile = $assigned_member;
            }
        }

        return view('advertisments.edit', ['categories' => $categories, 'SubCategories' => $SubCategories, 'profile' => $profile, 'districts' => $districts, 'Advertisment' => $Advertisment, 'AdvertismentStatus' => $AdvertismentStatus]);
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
            'location' => 'required',
            'selling_type' => 'required',
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
            $Advertisment->sub_category_id = $request->sub_category;
            $Advertisment->user_id = Auth::user()->id;

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

            //$Advertisment->status = (isset($request->advertisment_status)) ? $request->advertisment_status : $Advertisment->status;
            $Advertisment->description =  $request->advertisment_desc;
            $Advertisment->location_id =  $request->advertisment_location;
            $Advertisment->selling_type =  ($request->selling_type == 'Whole_Selling') ? 1 : 0;
            $Advertisment->location =  $request->location;
            $Advertisment->price =  $request->price;
            $Advertisment->is_negotiable = $request->negotiable;
            $Advertisment->contact_email = $request->contact_email;
            $Advertisment->contact_mobile = $request->contact_number;
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
        if($Advertisment->status == 1){
            $Advertisment->status = 2;
            $Advertisment->approved_by = Auth::user()->id;
        }
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

    public function sub_categories(Request $request){
        $SubCategories = Category::where('parent_category_id' , $request->category)->where('is_active' , 1)->get();

        $SubCategorySelect = '<option value="0">Select Sub Category</option>';

        if(count($SubCategories) > 0){
            foreach ($SubCategories as $SubCategory){
                $SubCategorySelect .= '<option value="'.$SubCategory->id.'">'.$SubCategory->category_name.'</option>';
            }
        }

        return $SubCategorySelect;
    }

    public function remove_image(){
        $filename = Input::get('filename');
        $rowid = Input::get('id');
        AdvertismentMedia::where('id', $rowid)->delete();
        File::delete('uploads/'.$filename);
    }
}
