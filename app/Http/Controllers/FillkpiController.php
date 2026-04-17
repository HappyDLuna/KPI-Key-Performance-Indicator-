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
        // $data =  Kpiquestion::where("id_kpi", $idk)->get();
        return view("layout/rekap-kinerja",['data' => $idk]);
    }

    public function isikpi($id){
        $data =  Kpiquestion::where("id_kpi", $id)->get();
        return view("layout/kpi-fill",['data' => $data]);
    }

    public function store($id, Request $request){
        $rules = array(
            'nilaikpi' => 'required',
            'nilaikpi' => 'max:100'
        );

        $messages = array(
            'nilaikpi.required' => 'Nilai Kpi harus Di isi',
            'nilaikpi.max' => 'Nilai Kpi tidak bisa melebihi 100'
        );

        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return redirect('/tendik/jawabkpi/'.$id)
            ->withErrors($validator);
        }

        Kpireq::updateOrCreate([
            'id_kpiquestion' => $id,
            'id_user' => Auth::user()->id,
            'skor' => $request->nilaikpi,
            'keterangan' => 'nihil',
            'status' => 'Belom Dikonfirmasi'
        ]);

        return redirect('/kpi/tabel-kpi')->with('alert','Penambahan KPI berhasil');
    }
}
