<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Netizens;
use App\Models\Jeniskaduan;
use App\Models\JeniskaduanModel;
use App\Models\PengaduanModel;
use App\Models\Kaduan;
use App\Models\Petugas;
use GrahamCampbell\ResultType\Success;
use Validator;
use Illuminate\Support\Facades\DB;


class DataController extends BaseController
{

    public function jeniskaduan()
    {
        $jenis = JeniskaduanModel::all();
        return response()->json(
            [
                'success' => true,
                'data' => $jenis,
            ]

        );
    }

    public function postkaduan(Request $request)
    {
        $messages = [
            'required' => ':attribute tidak boleh kosong',

        ];

        $validator = Validator::make(
            $request->all(),
            [

                'idUsers' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,svg',
                'deskripsi_from_user' => 'required',
                'jenis_pengaduan' => 'required',
                'address' => 'required',
                'kecamatan' => 'required',
                'kelurahan' => 'required',
                'status' => 'required',
                'lat' => 'required',
                'lng' => 'required',
                'tglwaktu' => 'required',
            ],

            $messages
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' =>   $validator->errors()->first(),
            ]);
        }
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('kaduan'), $imageName);
        $a = $request['idUsers'];
        $b = $request['deskripsi_from_user'];
        $c = $request['kecamatan'];
        $d = $request['kelurahan'];
        $e = $request['lat'];
        $f = $request['lng'];
        $g = $request['jenis_pengaduan'];
        $h = $request['id_Satgas'];
        $i = $request['status'];
        $k = $request['tglwaktu'];
        $l = $request['address'];

        $user = PengaduanModel::create(
            [
                "photo_pengaduan_from_user" =>  $imageName,
                'idUsers' => $a,
                'deskripsi_from_user' => $b,
                'jenis_pengaduan' => $g,
                'address' => $l,
                'kecamatan' => $c,
                'kelurahan' => $d,
                'id_Satgas' => $h,
                'status' => $i,
                'lat' => $e,
                'lng' => $f,
                'tglwaktu' => $k,
            ]
        );


        $success['token'] =  $user->createToken('Pengguna')->accessToken;
        return response()->json([
            'success' => true,
            'message' => 'kaduan berhasil diposting',
            'status' => $user['status'],
            'idUsers' => $user['idUsers'],
            'kelurahan' => $user['kelurahan'],
            'kecamatan' => $user['kecamatan'],

            'tokens' => $success['token'],

        ]);
    }

    // semua kaduan 
    public function getkaduan()
    {
        $datakaduan = DB::table('tb_pengaduan')
            ->join('tb_users', 'tb_pengaduan.idUsers', '=', 'tb_users.id')
            ->join('tb_jenispengaduan', 'tb_pengaduan.jenis_pengaduan', '=', 'tb_jenispengaduan.id')
            ->select('tb_pengaduan.*', 'tb_users.name as namauser', 'tb_jenispengaduan.JenisPengaduan as jenka')
            ->get();

        return response()->json(
            [
                'success' => true,
                'data' => $datakaduan,
            ]

        );
    }

    //kaduan per id user yg login
    public function getkaduanbyid()
    {
        $id =  Auth::guard('Pengguna')->user()->id;
        $datakaduan = DB::table('tb_pengaduan')
            ->join('tb_users', 'tb_pengaduan.idUsers', '=', 'tb_users.id')
            ->join('tb_jenispengaduan', 'tb_pengaduan.jenis_pengaduan', '=', 'tb_jenispengaduan.id')
            ->select('tb_pengaduan.*', 'tb_users.name as namauser', 'tb_jenispengaduan.JenisPengaduan as jenka')
            ->where('idUsers', $id)->get();

        return response()->json(
            [
                'success' => true,
                'id' => $id,
                'data' => $datakaduan,

            ]

        );
    }
}
