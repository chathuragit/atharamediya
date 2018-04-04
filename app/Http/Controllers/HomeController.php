<?php

namespace App\Http\Controllers;

use App\Advertisment;
use App\Banner;
use App\Category;
use App\Member;
use App\Page;
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
    public function index(Request $request)
    {
        $ParentCategories = Category::where('parent_category_id' , 0)->where('is_active' , 1)->get();
        $Page = Page::find(1);
        $Article = $Page->page_articles($Page->id, 1, 1);
        return view('home', ['ParentCategories' => $ParentCategories, 'request' => $request, 'Page' => $Page, 'Article' => $Article]);
    }

    public function all_ads(Request $request)
    {
        $Page = Page::find(4);
        $ArticlesLeft = $Page->page_articles($Page->id, 2, 1);
        $ArticlesRight = $Page->page_articles($Page->id, 3);

        $Advertisments = Advertisment::FilterAdvertisment(2, $this->per_page, $request);
        $ParentCategories = Category::where('parent_category_id' , 0)->where('is_active' , 1)->get();
        $SelectedCategory = Category::where('slug', $request->category)->first();
        if($SelectedCategory != null){
            $SubCategories = Category::where('parent_category_id', $SelectedCategory->id)->where('is_active', true)->get();
        }
        else{
            $SubCategories = null;
        }

        $left_web_space_banners = Banner::web_space_banners(1, null, 3);
        $listing_web_space_banners = Banner::web_space_banners(3, null, 3);

        return view('advertisments', ['ParentCategories' => $ParentCategories, 'Advertisments' => $Advertisments,  'left_web_space_banners' => $left_web_space_banners
            , 'listing_web_space_banners' => $listing_web_space_banners, 'request' => $request, 'Page' => $Page
            , 'SubCategories' => $SubCategories, 'SelectedCategory' => $SelectedCategory, 'ArticlesLeft' => $ArticlesLeft, 'ArticlesRight' => $ArticlesRight]);
    }

    public function advertisment(Request $request, $slug){
        $Page = Page::find(4);
        $ArticlesLeft = $Page->page_articles($Page->id, 2, 1);
        $ArticlesRight = $Page->page_articles($Page->id, 3);

        $Advertisment = Advertisment::where('slug', $slug)->where('is_active', true)->where('status', 2)->first();
        $AdvertismentAttributes =$Advertisment->advertisment_attributes_and_values($Advertisment->id);
        $ParentCategories = Category::where('parent_category_id' , 0)->where('is_active' , 1)->get();

        $Advertisment_user = $Advertisment->advertisment_user($Advertisment->id);

        $SelectedCategory = Category::where('id', $Advertisment->category_id)->first();
        if($SelectedCategory != null){
            $SubCategories = Category::where('parent_category_id', $SelectedCategory->id)->where('is_active', true)->get();
        }
        else{
            $SubCategories = null;
        }

        $Advertisments = Advertisment::similar_ads($Advertisment, 3);
        $left_web_space_banners = Banner::web_space_banners(1, $Advertisment->category_id, 3);
        $listing_web_space_banners = Banner::web_space_banners(3, null, 1);

        return view('advertisment', ['ParentCategories' => $ParentCategories, 'Advertisment' => $Advertisment, 'Advertisments' => $Advertisments,
            'left_web_space_banners' => $left_web_space_banners, 'AdvertismentAttributes' => $AdvertismentAttributes, 'Advertisment_user' => $Advertisment_user
            , 'listing_web_space_banners' => $listing_web_space_banners, 'request' => $request, 'Page' => $Page, 'SubCategories' => $SubCategories, 'SelectedCategory' => $SelectedCategory
            , 'ArticlesLeft' => $ArticlesLeft, 'ArticlesRight' => $ArticlesRight]);
    }

    public function members(){
        $Page = Page::find(3);
        $ArticlesLeft = $Page->page_articles($Page->id, 2);
        $ArticlesRight = $Page->page_articles($Page->id, 3);

        $Members = Member::memberslist($this->per_page, 4);
        return view('members', ['Members' => $Members, 'Page' => $Page, 'ArticlesLeft' => $ArticlesLeft, 'ArticlesRight' => $ArticlesRight]);
    }

    public function member($slug){
        $Page = Page::find(3);
        $Member = Member::where('slug', $slug)->first();

        $ArticlesLeft = $Member->page_articles($Member->id, 2, $count = null, 4);
        $ArticlesRight = $Member->page_articles($Member->id, 3, $count = null, 4);

        $Advertisments = Advertisment::where('user_id', $Member->user_id)->where('is_active', true)->where('status', 2)->orderBy('id', 'DESC')->paginate(15);
        return view('member', ['Member' => $Member, 'Advertisments' => $Advertisments, 'Page' => $Page, 'ArticlesLeft' => $ArticlesLeft, 'ArticlesRight' => $ArticlesRight]);
    }

    public function ad_collectors(){
        $Page = Page::find(2);
        $ArticlesLeft = $Page->page_articles($Page->id, 2);
        $ArticlesRight = $Page->page_articles($Page->id, 3);

        $Members = Member::memberslist($this->per_page, 3);
        return view('ad_collectors', ['Members' => $Members, 'Page' => $Page, 'ArticlesLeft' => $ArticlesLeft, 'ArticlesRight' => $ArticlesRight]);
    }

    public function ad_collector($slug){
        $Page = Page::find(2);
        $Member = Member::where('slug', $slug)->first();

        $ArticlesLeft = $Member->page_articles($Member->id, 2, $count = null, 3);
        $ArticlesRight = $Member->page_articles($Member->id, 3, $count = null, 3);

        $Advertisments = Advertisment::where('user_id', $Member->user_id)->where('is_active', true)->where('status', 2)->orderBy('id', 'DESC')->paginate(15);
        return view('ad_collector', ['Member' => $Member, 'Advertisments' => $Advertisments, 'Page' => $Page, 'ArticlesLeft' => $ArticlesLeft, 'ArticlesRight' => $ArticlesRight]);
    }

    public function static_page(Request $request){
        $Page = Page::where('slug', $request->segment(1))->first();

        $ArticlesMain = $Page->page_articles($Page->id, 1);
        $ArticlesLeft = $Page->page_articles($Page->id, 2);
        $ArticlesRight = $Page->page_articles($Page->id, 3);

        return view('page',['ArticlesLeft' => $ArticlesLeft, 'ArticlesRight' => $ArticlesRight, 'ArticlesMain' => $ArticlesMain]);
    }
}
