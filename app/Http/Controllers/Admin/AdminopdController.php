<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\OpdModel;
use App\Models\JeniskaduanModel;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminopdController extends Controller
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
        $title = 'Data Admin OPD | Superadmin';
        $datauser = DB::table('users')
            ->join('tb_opd', 'users.opd', '=', 'tb_opd.id')
            ->select('users.*', 'tb_opd.nama_opd as namaopd',)

            ->where('role', 'opd')->get();

        $jk = User::all();
        $opds = OpdModel::all();


        return view('admin.adminopd')->with('title', $title)->with('jk', $jk)->with('opds', $opds)->with('datauser', $datauser);
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

            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'opd' => 'required',
            'role' => 'required',
        ]);

        $a = $request['name'];
        $b = $request['email'];
        $c = $request['role'];
        $op = $request['opd'];
        $pass = bcrypt($request['password']);

        /* Store $imageName name in DATABASE from HERE */
        $image      =     User::create(["password" =>  $pass, "name" => $a, "email" => $b, "opd" => $op, "role" => $c]);
        return redirect()->route('adminopd.index')->with('message', 'Data Berhasil Disimpan');
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
    public function destroy($id)
    {
        //fungsi eloquent untuk menghapus data
        User::find($id)->delete();
        return redirect()->route('adminopd.index')
            ->with('message', 'Data Berhasil Dihapus');
    }
}
