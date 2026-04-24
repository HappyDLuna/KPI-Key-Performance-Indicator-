<?php

namespace App\Http\Controllers;

use App\Models\Kpireq;
use App\Http\Requests\StorekpireqRequest;
use App\Http\Requests\UpdatekpireqRequest;
use App\Models\Role;
use App\Models\Vocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class KpireqController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Kpireq::all();
        return view("layout.tables-kpi",['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $select1 = Role::all();
        $select2 = Vocation::all();
        return view("layout.form-kpi",['select1' => $select1, 'select2'=>$select2]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = array(
            'name' => 'required',
            'jabatan' => 'required',
            'unit' => 'required',
        );

        $messages = array(
            'name.required' => 'Nama tidak boleh kosong',
            'jabatan.required' => 'Jabatan tidak boleh kosong',
            'unit.required' => 'Unit Tidak Boleh Kosong'
        );

        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return redirect('/kpi/tambah-kpi')
            ->withErrors($validator);
        }

        Kpireq::updateOrCreate([
            'name' => $request->name,
            'id_role' => $request->jabatan,
            'id_vocation' => $request->unit
        ]);

        return redirect('/kpi/tabel-kpi')->with('alert','Penambahan KPI berhasil');
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Kpireq::find($id);
        $select1 = Role::all();
        $select2 = Vocation::all();
        return view('layout.edit-kpi',['data' => $data,'select1' => $select1, 'select2'=>$select2]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $rules = array(
            'name' => 'required',
            'jabatan' => 'required',
            'unit' => 'required',
        );

        $messages = array(
            'name.required' => 'Nama tidak boleh kosong',
            'jabatan.required' => 'Jabatan tidak boleh kosong',
            'unit.required' => 'Unit Tidak Boleh Kosong'
        );

        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return redirect('/kpi/edit-kpi')
            ->withErrors($validator);
        }

        Kpireq::updateOrCreate(
            ['id' => $id],
        [
            'name' => $request->name,
            'id_role' => $request->jabatan,
            'id_vocation' => $request->unit
        ]);

        return redirect('/kpi/tabel-kpi')->with('alert','Perubahan KPI berhasil');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Kpireq::where('id',$id)->delete();
        return redirect('/kpi/tabel-kpi')->with('alert','Penghapusan KPI berhasil');
    }
}
