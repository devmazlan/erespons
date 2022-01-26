<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\OpdModel;

use App\Models\JeniskaduanModel;

class UjeniskaduanController extends Controller
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

        $title = 'Data Jenis Kaduan| Admin OPD';
        $user = Auth::user();
        $jk = JeniskaduanModel::where('opd', $user->opd)->get();
        $opds = OpdModel::all();

        return view('user.ujeniskaduan')->with('title', $title)->with('jk', $jk)->with('opds', $opds)->with('user', $user);
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

            'JenisPengaduan' => 'required',
            'description' => 'required',
            'opd' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg',
        ]);
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('jeniskaduan'), $imageName);
        $a = $request['JenisPengaduan'];
        $des = $request['description'];
        $op = $request['opd'];

        /* Store $imageName name in DATABASE from HERE */
        $image      =     JeniskaduanModel::create(["logo_jenis_pengaduan" =>  $imageName, "JenisPengaduan" => $a, "description" => $des, "opd" => $op]);
        return redirect()->route('ujeniskaduan.index')->with('message', 'Data Berhasil Disimpan');
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
        JeniskaduanModel::find($id)->delete();
        return redirect()->route('ujeniskaduan.index')
            ->with('message', 'Data Berhasil Dihapus');
    }
}
