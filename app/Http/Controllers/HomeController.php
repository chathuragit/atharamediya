<?php

namespace App\Http\Controllers;

use App\Advertisment;
use App\Banner;
use App\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->per_page  = 15;
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ParentCategories = Category::where('parent_category_id' , 0)->where('is_active' , 1)->get();
        return view('home', ['ParentCategories' => $ParentCategories]);
    }

    public function all_ads(Request $request)
    {
        $Advertisments = Advertisment::FilterAdvertisment(2, $this->per_page, $request);
        $ParentCategories = Category::where('parent_category_id' , 0)->where('is_active' , 1)->get();

        $left_web_space_banners = Banner::web_space_banners(1, null, 3);

        return view('advertisments', ['ParentCategories' => $ParentCategories, 'Advertisments' => $Advertisments,  'left_web_space_banners' => $left_web_space_banners]);
    }

    public function advertisment(Request $request, $slug){
        $Advertisment = Advertisment::where('slug', $slug)->where('is_active', true)->where('status', 2)->first();
        $ParentCategories = Category::where('parent_category_id' , 0)->where('is_active' , 1)->get();

        $Advertisments = Advertisment::similar_ads($Advertisment, 3);
        $left_web_space_banners = Banner::web_space_banners(1, $Advertisment->category_id, 3);

        return view('advertisment', ['ParentCategories' => $ParentCategories, 'Advertisment' => $Advertisment, 'Advertisments' => $Advertisments,
            'left_web_space_banners' => $left_web_space_banners]);
    }
}
