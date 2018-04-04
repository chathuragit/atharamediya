<?php

namespace App\Http\Controllers;

use App\MemberArticle;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MemberArticleController extends Controller
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
        if(Auth::user()->role <= 1){
            $articles = MemberArticle::orderBy('id', 'DESC')->paginate($this->per_page);
        }else{
            $member_id = (is_object(Auth::user()->assigned_member)) ? Auth::user()->assigned_member->id : 0;
            $articles = MemberArticle::where('member_id', $member_id)->where('type', Auth::user()->role)->orderBy('id', 'DESC')->paginate($this->per_page);
        }

        return view('member_articles.list', ['articles' => $articles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('member_articles.create');
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
            $Article = new MemberArticle();
            $Article->title = $request->title;
            $Article->desc = $request->description;
            $Article->member_id = (is_object(Auth::user()->assigned_member)) ? Auth::user()->assigned_member->id : 0;
            $Article->type = Auth::user()->role;
            $Article->show_in = $request->display_in;
            $Article->is_active = false;
            $Article->save();

            parent::userLog(Auth::user()->id, 'Created Member Article #'.$Article->id);

            $request->session()->flash('message', "Article Created Successfully! Now Pending For Administrators Approval");
            $request->session()->flash('is_error', false);
            return Redirect::to('/member_articles');
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
        $Article = MemberArticle::find($id);
        return view('member_articles.show', ['Article' => $Article]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Article = MemberArticle::find($id);
        return view('member_articles.edit', ['Article' => $Article]);
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
            'title' => 'required',
            'description' => 'required',
            'display_in' => 'required:not_in:0',
        );


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()){
            return redirect()->back()->withErrors($validator->errors())->withInput(Input::all());
        }
        else {
            $Article = MemberArticle::find($id);
            $Article->title = $request->title;
            $Article->desc = $request->description;
            $Article->type = Auth::user()->role;
            $Article->show_in = $request->display_in;
            $Article->is_active = false;
            $Article->update();

            parent::userLog(Auth::user()->id, 'Updated Member Article #' . $Article->id);

            $request->session()->flash('message', "Article Updated Successfully! Now Pending For Administrators Approval");
            $request->session()->flash('is_error', false);
            return Redirect::to('/member_articles');
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
        $Article = MemberArticle::find($id);
        $Article->delete();

        parent::userLog(Auth::user()->id, 'Deleted Article #'.$Article->id);

        $request->session()->flash('message', "Article Deleted Successfully!");
        $request->session()->flash('is_error', false);
    }

    public function filter(Request $request){
        if(Auth::user()->role <= 1){
            $articles = MemberArticle::where('title', 'like', '%' . $request->search . '%')->paginate($this->per_page);
        }else{
            $member_id = (is_object(Auth::user()->assigned_member)) ? Auth::user()->assigned_member->id : 0;
            $articles = MemberArticle::where('member_id', $member_id)->where('type', Auth::user()->role)->where('title', 'like', '%' . $request->search . '%')->paginate($this->per_page);
        }

        return view('member_articles.list', ['articles' => $articles, 'request' => $request]);
    }

    public function change_status(Request $request){
        $Article = MemberArticle::find($request->id);
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
