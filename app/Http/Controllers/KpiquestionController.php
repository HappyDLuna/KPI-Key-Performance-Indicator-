<?php

namespace App\Http\Controllers;

use App\Models\Kpiquestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KpiquestionController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id)
    {
        $data = Kpiquestion::where('id_kpi',$id)->get();
        return view('layout.tables-questionkpi',['data' => $data, 'id' => $id]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        return view('layout.form-questionkpi',['id'=>$id]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = array(
            'kpi' => 'required',
            'target' => 'required',
            'bobot' => 'required',
            'keterangan' => 'required'
        );

        $messages = array(
            'kpi.required' => 'Pertanyaan KPI tidak boleh kosong',
            'target.required' => 'Target tidak boleh kosong',
            'bobot.required' => 'Bobot todak boleh kosong',
            'keterangan.required' => 'Keterangan tidak boleh kosong',
        );

        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return redirect('/kpi/pertanyaan-kpi/tambah/'.$request->id)
            ->withErrors($validator);
        }

        Kpiquestion::updateOrCreate([
            'id_kpi' => $request->id,
            'kpi' => $request->kpi,
            'target' => $request->target,
            'bobot' => $request->bobot,
            'keterangan' => $request->keterangan,
        ]);

        return redirect('/kpi/pertanyaan-kpi/'.$request->id)->with('alert','Penambahan Pertanyaan KPI berhasil');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kpiquestion $kpiquestion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Kpiquestion::find($id);
        return view('layout.edit-questionkpi',['data'=> $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
         $rules = array(
            'kpi' => 'required',
            'target' => 'required',
            'bobot' => 'required',
            'keterangan' => 'required'
        );

        $messages = array(
            'kpi.required' => 'Pertanyaan KPI tidak boleh kosong',
            'target.required' => 'Target tidak boleh kosong',
            'bobot.required' => 'Bobot todak boleh kosong',
            'keterangan.required' => 'Keterangan tidak boleh kosong',
        );

        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return redirect('/kpi/pertanyaan-kpi/edit/'.$request->id)
            ->withErrors($validator);
        }

        Kpiquestion::updateOrCreate(
            ['id' => $id],
            [
            'kpi' => $request->kpi,
            'target' => $request->target,
            'bobot' => $request->bobot,
            'keterangan' => $request->keterangan,
        ]);

        return redirect('/kpi/pertanyaan-kpi/'.$id)->with('alert','Pengubahan Pertanyaan KPI berhasil');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id,$rid)
    {
        Kpiquestion::find($id)->delete();
        return redirect()->route('/kpi/pertanyaan-kpi/',$rid)->with('alert','Penghapusan Pertanyaan KPI berhasil');
    }
}
