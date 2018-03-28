<?php

namespace App\Http\Controllers;

use App\Article;
use App\ArticlePage;
use App\Page;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ArticleController extends Controller
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
        $articles = Article::orderBy('id', 'DESC')->paginate($this->per_page);
        return view('articles.list', ['articles' => $articles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.create', ['pages' => Page::all()]);
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
            'title' => 'required',
            'description' => 'required',
            'display_in' => 'required:not_in:0',
        );


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()){
            return redirect()->back()->withErrors($validator->errors())->withInput(Input::all());
        }
        else{
            $Article = new Article();
            $Article->title = $request->title;
            $Article->desc = $request->description;
            $Article->show_in = $request->display_in;
            $Article->is_active = true;
            $Article->save();

            if(count($request->pages) > 0){
                foreach ($request->pages as $page){
                    $ArticlePage = new ArticlePage();
                    $ArticlePage->page_id = $page;
                    $ArticlePage->article_id = $Article->id;
                    $ArticlePage->save();
                }
            }

            parent::userLog(Auth::user()->id, 'Created Article #'.$Article->id);

            $request->session()->flash('message', "Article Created Successfully!");
            $request->session()->flash('is_error', false);
            return Redirect::to('/articles');
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
        $Article = Article::find($id);
        $SelectedPages = collect($Article->assigned_pages)->map(function($x){ return $x->page_id;})->toArray();
        return view('articles.show', ['pages' => Page::all(), 'Article' => $Article, 'SelectedPages' => $SelectedPages]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Article = Article::find($id);
        $SelectedPages = collect($Article->assigned_pages)->map(function($x){ return $x->page_id;})->toArray();
        return view('articles.edit', ['pages' => Page::all(), 'Article' => $Article, 'SelectedPages' => $SelectedPages]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = array(
            'title' => 'required',
            'description' => 'required',
            'display_in' => 'required:not_in:0',
        );


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()){
            return redirect()->back()->withErrors($validator->errors())->withInput(Input::all());
        }
        else{
            $Article = Article::find($id);
            $Article->title = $request->title;
            $Article->desc = $request->description;
            $Article->show_in = $request->display_in;
            $Article->is_active = true;
            $Article->update();

            $Article->assigned_pages()->delete();

            if(count($request->pages) > 0){
                foreach ($request->pages as $page){
                    $ArticlePage = new ArticlePage();
                    $ArticlePage->page_id = $page;
                    $ArticlePage->article_id = $Article->id;
                    $ArticlePage->save();
                }
            }

            parent::userLog(Auth::user()->id, 'Updated Article #'.$Article->id);

            $request->session()->flash('message', "Article Updated Successfully!");
            $request->session()->flash('is_error', false);
            return Redirect::to('/articles');
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
        $Article = Article::find($id);
        $Article->assigned_pages()->delete();
        $Article->delete();

        parent::userLog(Auth::user()->id, 'Deleted Article #'.$Article->id);

        $request->session()->flash('message', "Article Deleted Successfully!");
        $request->session()->flash('is_error', false);
    }

    public function filter(Request $request){
        $articles = Article::where('title', 'like', '%' . $request->search . '%')->paginate($this->per_page);
        return view('articles.list', ['articles' => $articles, 'request' => $request]);
    }

    public function change_status(Request $request){
        $Article = Article::find($request->id);
        $Article->is_active = ($request->active == 'true') ? true : false;
        $Article->update();

        if(($request->active == 'true')){
            parent::userLog(Auth::user()->id, 'Article activated #'.$Article->id);
        }
        else{
            parent::userLog(Auth::user()->id, 'Article deactivated #'.$Article->id);
        }
    }
}
