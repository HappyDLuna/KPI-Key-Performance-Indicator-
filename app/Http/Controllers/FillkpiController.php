<?php

namespace App\Http\Controllers;

use App\Models\Kpiquestion;
use App\Models\Kpireq;
use App\Models\Kpiscore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class FillkpiController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $idr = Auth::user()->id_role;
        $idu = Auth::user()->id_vocation;
        $idk = Kpireq::where("id_role", $idr)
                     ->where("id_vocation", $idu)
                     ->get();
        // $data =  Kpiquestion::where("id_kpi", $idk)->get();
        return view("layout.rekap-kinerja",['data' => $idk]);
        }
        
        public function laporan(){
            $idr = Auth::user()->id_role;
            $idu = Auth::user()->id_vocation;
            $idk = Kpireq::where("id_role", $idr)
            ->where("id_vocation", $idu)
            ->get();
            // $data =  Kpiquestion::where("id_kpi", $idk)->get();
            return view("layout.laporan-tendik",['data' => $idk]);
    }

    public function isikpi($id){
        $data =  Kpiquestion::whereDoesntHave('kpiscore', function ($query){
            $query->where('id_user', Auth::user()->id);
        })->where('id_kpi',$id)->get();
        return view("layout.kpi-fill",['data' => $data]);
    }

    public function laporan_kpi($id){
        $data =  Kpiscore::with('kpiquestion')->where('id_user',Auth::user()->id)->get();
        return view("layout.laporan-kpi",['data' => $data]);
    }

    public function verifikasi(){
        $idu = Auth::user()->id_vocation;
        $data = Kpiscore::select('id_user')->where('status',0)->groupBy('id_user')->get();
        // $data = Kpireq::with('kpiscore', function($query){
        //     $query->groupBy('id_user');
        // })->get();
        $user = User::all();
        return view("layout.verifikasi",['data' => $data, 'user' => $user]);
    }

    public function verifikasi_kpi($id){
        $data = Kpiscore::with('kpiquestion')->where('id_user',$id)->where('status',0)->get();
        return view("layout.verifikasi-kpi",['data' => $data]);
    }

    public function ubah_status(Request $request){
        for ($x = 0; $x < count($request->kpi); $x++){
            Kpiscore::updateOrCreate([
                'id' => $request->kpi[$x]],
            [
                'status' => 1,
        ]);
        }
        $idu = Auth::user()->id_vocation;
        $data = Kpiscore::select('id_user')->where('status',0)->groupBy('id_user')->get();
        $user = User::all();
        return view("layout.verifikasi",['data' => $data, 'user' => $user]);
    }

    public function store(Request $request){
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
            return redirect('/tendik/jawabkpi/'.$request->idkpireq)
            ->withErrors($validator);
        }
        for ($x = 0; $x < count($request->idkpi); $x++){
            Kpiscore::create([
            'id_kpiquestion' => $request->idkpi[$x],
            'id_user' => Auth::user()->id,
            'skor' => $request->nilaikpi[$x],
            'keterangan' => '-',
            'status' => 0
        ]);
        }
        

        return redirect('/tendik/rekap')->with('alert','Penambahan Jawaban KPI berhasil');
    }

     public function editkpi($id){
        $data =  Kpiscore::with('kpiquestion')->where('id_user',Auth::user()->id)->where('status',0)->get();
        return view("layout.kpi-edit",['data' => $data]);
    }

    public function update(Request $request){
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

        for ($x = 0; $x < count($request->id); $x++){
            Kpiscore::updateOrCreate([
            'id' => $request->id[$x]],
            [
            'skor' => $request->nilaikpi[$x],
        ]);
        }

        return redirect('/tendik/rekap')->with('alert','Pengubahan Jawaban KPI berhasil');
    }
}
