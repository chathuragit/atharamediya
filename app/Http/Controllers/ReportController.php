<?php

namespace App\Http\Controllers;

use App\User;
use App\UserRole;
use Illuminate\Http\Request;
use App\Package;
use App\Category;

class ReportController extends Controller
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

    public function index(Request $request)
    {
        $categories = Category::where('is_active', 1)->get();
        $administrators = User::whereIn('role', [1,2])->get();
        $users = User::whereIn('role', [1,2,3,4,6])->where('is_active', true)->get();
        $userTypes = UserRole::all();
        $webspaceusers = User::where('role', 5)->where('is_active', true)->get();
        return view('reports.list', ['categories' => $categories, 'request' => $request, 'administrators' => $administrators, 'users' => $users, 'userTypes' => $userTypes, 'webspaceusers' => $webspaceusers]);
    }
}
