<?php

namespace App\Http\Controllers;

use App\Models\Kpiscore;
use App\Http\Requests\StorekpiscoreRequest;
use App\Http\Requests\UpdatekpiscoreRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class KpiscoreController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
            $question = Kpiscore::where('id_kpi',$id)->get();
            return view('layout.tables-detailkpi',['data' => $data,'id' => $id]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        return view('layout.form-detail-kpi',['id' => $id]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,$id)
    {
        $rules = array(
            'kpi' => 'required',
            'target' => 'required',
            'keterangan' => 'required'
        );

        $messages = array(
            'kpi.required' => 'Nama KPI tidak boleh kosong',
            'target.required' => 'Target tidak boleh kosong',
            'keterangan.required' => 'Keterangan tidak boleh kosong',
        );

        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return redirect('/kpi/edit-kpi')
            ->withErrors($validator);
        }

        Kpiscore::updateOrCreate(
        [
            'keterangan' => $request->keterangan,
        ]);

        return redirect('/kpi/detail-kpi/'.$id)->with('alert','Penambahan Detail KPI berhasil');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Kpiscore::find($id);
        return view('layout.edit-detail-kpi',['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rules = array(
            'kpi' => 'required',
            'target' => 'required',
            'keterangan' => 'required'
        );

        $messages = array(
            'kpi.required' => 'Nama KPI tidak boleh kosong',
            'target.required' => 'Target tidak boleh kosong',
            'keterangan.required' => 'Keterangan tidak boleh kosong',
        );

        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return redirect('/kpi/edit-kpi')
            ->withErrors($validator);
        }

        Kpiscore::updateOrCreate(
        ['id' => $id],
            [
            'keterangan' => $request->keterangan,
        ]);

        return redirect('/kpi/detail-kpi/'.$request->id_kpi)->with('alert','Pengubahan Detail KPI berhasil');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id,$rid)
    {
        Kpiscore::where('id',$id)->delete();
        return redirect('/kpi/detail-kpi/'.$rid)->with('alert','Penghapusan Detail KPI berhasil');
    }
}
