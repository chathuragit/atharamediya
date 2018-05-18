<?php

namespace App\Http\Controllers;

use App\Advertisment;
use App\Banner;
use App\Category;
use App\Member;
use App\Page;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;

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
        $right_web_space_banners = Banner::web_space_banners(2, null, 3);
        $listing_web_space_banners = Banner::web_space_banners(3, null, 3);

        return view('advertisments', ['ParentCategories' => $ParentCategories, 'Advertisments' => $Advertisments,  'left_web_space_banners' => $left_web_space_banners
            , 'listing_web_space_banners' => $listing_web_space_banners, 'right_web_space_banners' => $right_web_space_banners, 'request' => $request, 'Page' => $Page
            , 'SubCategories' => $SubCategories, 'SelectedCategory' => $SelectedCategory, 'ArticlesLeft' => $ArticlesLeft, 'ArticlesRight' => $ArticlesRight, 'maincategory' => 0]);
    }

    public function advertisment(Request $request, $slug){
        $Page = Page::find(4);
        $ArticlesLeft = $Page->page_articles($Page->id, 2, 1);
        $ArticlesRight = $Page->page_articles($Page->id, 3);

        $Advertisment = Advertisment::where('slug', $slug)->where('is_active', true)->where('status', 2)->first();
        if(is_object($Advertisment)){
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
            $right_web_space_banners = Banner::web_space_banners(2,  $Advertisment->category_id, 3);
            $listing_web_space_banners = Banner::web_space_banners(3, null, 1);
            $maincategory = $Advertisment->category_id;
        }
        else{
            $AdvertismentAttributes = null;
            $ParentCategories = null;
            $Advertisment_user = null;
            $SelectedCategory = null;
            $SubCategories = null;
            $Advertisments = null;
            $left_web_space_banners = null;
            $listing_web_space_banners = null;
            $right_web_space_banners = null;
            $maincategory = 0;
        }

        return view('advertisment', ['ParentCategories' => $ParentCategories, 'Advertisment' => $Advertisment, 'Advertisments' => $Advertisments,
            'left_web_space_banners' => $left_web_space_banners, 'AdvertismentAttributes' => $AdvertismentAttributes, 'Advertisment_user' => $Advertisment_user
            , 'listing_web_space_banners' => $listing_web_space_banners, 'right_web_space_banners' => $right_web_space_banners, 'request' => $request, 'Page' => $Page, 'SubCategories' => $SubCategories, 'SelectedCategory' => $SelectedCategory
            , 'ArticlesLeft' => $ArticlesLeft, 'ArticlesRight' => $ArticlesRight, 'maincategory' => $maincategory]);
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

    public function confirm_email($email, $confirmation_code){
        $user = User::where('email', $email)->where('confirmation_code', $confirmation_code)->first();
        if($user){
            $user->confirmed = true;
            $user->update();
        }

        return Redirect::to('/');
    }

    public function web_banners_ajax(Request $request){
        if($request->side = 1){
            $category = $request->category;
            $left_web_space_banners = Banner::web_space_banners(1, $category, 3);
            $right_web_space_banners = Banner::web_space_banners(2, $category, 3);

            if(isset($left_web_space_banners) && (count($left_web_space_banners) > 0)){
                foreach($left_web_space_banners as $left_banner){
                    echo '<figure>';
                    if($left_banner->link_url != ''){
                        echo '<a href="'.$left_banner->link_url.'" target="_blank" class="img-fluid">';
                    }

                    echo '<img src="'. asset('uploads/'.$left_banner->data_url).'" alt="'.$left_banner->title.'" class="img-fluid">';
                    echo '<figcaption class="text-center">'.$left_banner->title.'</figcaption>';
                    if($left_banner->link_url != ''){
                        echo '</a>';
                    }

                    echo '</figure>';
                }
            }

            if(isset($right_web_space_banners) && (count($right_web_space_banners) > 0)){
                foreach($right_web_space_banners as $right_banner){
                    echo '<figure>';
                    if($right_banner->link_url != ''){
                        echo '<a href="'.$right_banner->link_url.'" target="_blank" class="img-fluid">';
                    }

                    echo '<img src="'. asset('uploads/'.$right_banner->data_url).'" alt="'.$right_banner->title.'" class="img-fluid">';
                    echo '<figcaption class="text-center">'.$right_banner->title.'</figcaption>';
                    if($right_banner->link_url != ''){
                        echo '</a>';
                    }

                    echo '</figure>';
                }
            }
        }
    }
}
