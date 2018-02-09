<?php

namespace App\Http\Controllers;

use App\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->per_page  = 100;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Logs = Log::log_filter($this->per_page);
        return view('logs.list', ['Logs' => $Logs]);
    }

    public function filter(Request $request)
    {
        $Logs = Log::log_filter($this->per_page, $request->search);
        return view('logs.list', ['Logs' => $Logs, 'request' => $request]);
    }
}
