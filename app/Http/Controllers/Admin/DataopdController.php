<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\OpdModel;

class DataopdController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Data OPD | Superadmin';
        $opd = OpdModel::all();
        return view('admin.opd')->with('title', $title)->with('opd', $opd);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([

            'nama_opd' => 'required',
            'description' => 'required'
        ]);
        $jen = $request['nama_opd'];
        $opd = $request['description'];
        /* Store $imageName name in DATABASE from HERE */
        $image      =  OpdModel::create(["nama_opd" => $jen, "description" => $opd]);
        return redirect()->route('opd.index')->with('message', 'Data Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Jabatan $jabatan)

    {
        $title = 'Jabatan | Superadmin';

        return view('admin.jabatanedit', compact('jabatan'))->with('title', $title);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jabatan $jabatan)

    {

        $request->validate([

            'jabatan' => 'required',
            'keterangan' => 'required',

        ]);



        $jabatan->update($request->all());
        return redirect()->route('jabatan.index')
            ->with('message', 'data berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($opd)
    {
        //fungsi eloquent untuk menghapus data
        OpdModel::find($opd)->delete();
        return redirect()->route('opd.index')
            ->with('message', 'Data Berhasil Dihapus');
    }
}
