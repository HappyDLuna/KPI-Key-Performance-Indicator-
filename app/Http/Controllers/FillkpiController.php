<?php

namespace App\Http\Controllers;

use App\Models\Kpiquestion;
use App\Models\Kpireq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FillkpiController extends Controller
{
    public function index(){
        $idr = Auth::user()->id_role;
        $idu = Auth::user()->id_vocation;
        $idk = Kpireq::where("id_role", $idr)
                     ->where("id_vocation", $idu)
                     ->get();
        $data =  Kpiquestion::where("id_kpi", $idk)->get();
        return view("layout/rekap-kinerja",['data' => $data]);
    }
}
