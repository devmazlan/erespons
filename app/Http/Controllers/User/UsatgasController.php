<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\OpdModel;
use App\Models\User;
use App\Models\KecModel;
use App\Models\KelModel;
use App\Models\JeniskaduanModel;
use App\Models\UserModel;
use Illuminate\Support\Facades\DB;

class UsatgasController extends Controller
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
        $user = Auth::user();
        $title = 'Data Satgas OPD | Admin OPD';
        $datauser = DB::table('tb_users')
            ->join('tb_jenispengaduan', 'tb_users.jenisPengaduan', '=', 'tb_jenispengaduan.id')
            ->join('tb_kelurahan', 'tb_users.kelurahan', '=', 'tb_kelurahan.id')
            ->select('tb_users.*', 'tb_jenispengaduan.JenisPengaduan as jeniskaduans', 'tb_kelurahan.kelurahan as kel',)
            ->where('tb_users.level', '3')
            ->where('tb_users.opd', $user->opd)
            ->get();

        $jk = User::all();
        $opds = OpdModel::all();
        $data['countries'] = KecModel::get(["kecamatan", "id"]);
        $jenis = JeniskaduanModel::where('opd', $user->opd)->get();


        return view('user.usatgas', $data)->with('title', $title)->with('jk', $jk)->with('opds', $opds)->with('datauser', $datauser)->with('user', $user)->with('jenis', $jenis);
    }


    public function fetchCity(Request $request)
    {
        $data['states'] = KelModel::where("kec_id", $request->kec_id)->get(["kelurahan", "id"]);
        return response()->json($data);
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
            'jk' => 'required',
            'email' => 'required',
            'username' => 'required',
            'password' => 'required',
            'nik' => 'required',
            'phone_number' => 'required',
            'address' => 'required',
            'kecamatan' => 'required',
            'kelurahan' => 'required',
            'opd' => 'required',
            'jenisPengaduan' => 'required',

        ]);



        $a = $request['name'];
        $b = $request['jk'];
        $c = $request['email'];
        $d = $request['username'];
        $e = bcrypt($request['password']);
        $f = $request['nik'];
        $g = $request['phone_number'];
        $h = $request['address'];
        $i = $request['kecamatan'];
        $j = $request['kelurahan'];
        $k = $request['opd'];
        $l = $request['jenisPengaduan'];


        /* Store $imageName name in DATABASE from HERE */
        $image      =  UserModel::create(
            [
                "name" =>  $a,
                "jk" => $b,
                "email" => $c,
                "username" => $d,
                "password" => $e,
                "nik" => $f,
                "phone_number" => $g,
                "address" => $h,
                "kecamatan" => $i,
                "kelurahan" => $j,
                "opd" => $k,
                "jenisPengaduan" => $l,
                "level" => '3',

            ]
        );
        return redirect()->route('usatgas.index')->with('message', 'Data Berhasil Disimpan');
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
        UserModel::find($id)->delete();
        return redirect()->route('usatgas.index')
            ->with('message', 'Data Berhasil Dihapus');
    }
}
