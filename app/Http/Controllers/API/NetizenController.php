<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Netizens;
use App\Models\Jeniskaduan;
use App\Models\Kaduan;
use App\Models\Petugas;
use GrahamCampbell\ResultType\Success;
use Validator;

class NetizenController extends BaseController
{
    public function daftar(Request $request)
    {
        $messages = [
            'required' => ':attribute tidak boleh kosong',
            'unique' => ':attribute  sudah digunakan',
            'regex' => ':attribute tidak boleh ada spasi !',
            'between' => ':attribute tidak boleh lebih 12 karakter !',
            'max' => ':attribute tidak boleh lebih 25 karakter !',
            'min' => ':attribute harus lebih 8 karakter !',
            'same' => ':attribute konfirmasi tidak cocok !',
        ];

        $validator = Validator::make(
            $request->all(),
            [
                'nama' => 'required|max:25',
                'profesi' => 'required',
                'jk' => 'required',
                'device_id' => 'required',
                'username' => 'required|between:2,12|regex:/^\S*$/u|unique:netizens',
                'password' => 'required|min:8',
                'c_password' => 'required|same:password',
            ],
            $messages
        );
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' =>   $validator->errors()->first(),
            ]);
        } else {
            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
            $user = Netizens::create($input);
            $success['token'] = $user->createToken('Netizen')->accessToken;
            return response()->json([
                'success' => true,
                'message' => 'akun berhasil terdaftar',
                'nama' => $input['nama'],
                'foto' => $input['foto'],
                'username' => $input['username'],
                'profesi' => $input['profesi'],
                'jk' => $input['jk'],
                'tokens' => $success['token'],

            ]);

            $success['nama'] =  $user->nama;

            return $this->sendResponse($success, 'User register successfully.');
        }
    }
    public function login()
    {

        if (Auth::guard('Netizen-web')->attempt(['username' => request('username'), 'password' => request('password')])) {
            // $appname = request('appname');
            $user = Auth::guard('Netizen-web')->user();
            $success['token'] = $user->createToken('Netizen')->accessToken;
            //After successfull authentication, notice how I return json parameters
            return response()->json([
                'success' => true,
                'id' => $user['id'],
                'nama' => $user['nama'],
                'username' => $user['username'],
                'profesi' => $user['profesi'],
                'jk' => $user['jk'],
                'device_id' => $user['device_id'],

                'foto' => $user['foto'],
                'tokens' => $success['token'],
            ]);
        } else {
            //if authentication is unsuccessfull, notice how I return json parameters
            return response()->json([
                'success' => false,
                'message' => 'akun tidak terdaftar !',
            ], 401);
        }
    }
    public function getKaduan()
    {
        $jenis = Jeniskaduan::all();
        return response()->json(
            [
                'success' => true,
                'data' => $jenis,
            ]

        );
    }

    public function postKaduan(Request $request)
    {
        $messages = [
            'required' => ':attribute tidak boleh kosong',

        ];

        $validator = Validator::make(
            $request->all(),
            [
                'tiket' => 'required',
                'keterangan' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,svg',
                'kecamatan' => 'required',
                'kelurahan' => 'required',
                'latitude' => 'required',
                'longitude' => 'required',
                'username' => 'required',
                'device_id' => 'required',
                'status' => 'required',
                'petugas' => 'required',
                'tglwaktu' => 'required',
                'jen_kaduan' => 'required',
                'opd' => 'required',
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
        $tiket = $request['tiket'];
        $ket = $request['keterangan'];
        $kec = $request['kecamatan'];
        $kel = $request['kelurahan'];
        $lat = $request['latitude'];
        $long = $request['longitude'];
        $sername = $request['username'];
        $device = $request['device_id'];
        $st = $request['status'];
        $petugas = $request['petugas'];
        $wak = $request['tglwaktu'];
        $jen = $request['jen_kaduan'];
        $opd = $request['opd'];

        $user = Kaduan::create(
            [
                "foto" =>  $imageName,
                "tiket" => $tiket,
                "keterangan" => $ket,
                "jen_kaduan" => $jen,
                "opd" => $opd,
                "kecamatan" => $kec,
                "kelurahan" => $kel,
                "latitude" => $lat,
                "longitude" => $long,
                "username" => $sername,
                "device_id" => $device,
                "status" => $st,
                "petugas" => $petugas,
                "tglwaktu" => $wak,

            ]


        );


        $success['token'] =  $user->createToken('Netizen')->accessToken;
        return response()->json([
            'success' => true,
            'message' => 'kaduan berhasil diposting',
            'tiket' => $user['tiket'],
            'kelurahan' => $user['kelurahan'],
            'kecamatan' => $user['kecamatan'],
            'petugas' => $user['petugas'],
            'username' => $user['username'],
            'device_id' => $user['device_id'],
            'tokens' => $success['token'],

        ]);
    }

    public function dataKaduan()
    {
        $jenis = Kaduan::all();
        return response()->json(
            $jenis,
        );
    }
}
