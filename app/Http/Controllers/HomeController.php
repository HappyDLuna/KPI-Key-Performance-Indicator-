<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kpiscore;
use App\Models\Kpiquestion;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = Kpiscore::where('status',1)->get();
        $dontexist = Kpiquestion::whereDoesntHave('kpiscore')->get();
        $pendingdata = Kpiscore::where('status',0)->get();
        $nocount = $dontexist->count();
        $pendingcount = $pendingdata->count();
        $count = $data->count();
        return view('layout.dashboard-kpi',['count' => $count,'nocount' => $nocount,'pendingcount' => $pendingcount]);
    }
}
