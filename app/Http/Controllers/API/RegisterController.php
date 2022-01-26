<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Petugas;
use App\Models\Ataprumah;
use App\Models\UserModel;
use Validator;
use Illuminate\Support\Str;




class RegisterController extends BaseController
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'jk' => 'required',
            'email' => 'required|email',
            'nik' => 'required|unique:tb_users',
            'level' => 'required',



            'username' => 'required|unique:tb_users',
            'password' => 'required',
            'c_password' => 'required|same:password',


        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' =>   $validator->errors()->first(),
            ]);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = UserModel::create($input);
        $success['token'] =  $user->createToken('Pengguna')->accessToken;
        if ($input['level'] == '4') {
            return response()->json([
                'success' => true,
                'message' => 'akun berhasil terdaftar',
                'name' => $input['name'],

                'username' => $input['username'],
                'jk' => $input['jk'],
                'email' => $input['email'],
                'tokens' => $success['token'],

            ]);
        } else if ($input['level'] == '3') {
            return response()->json([
                'success' => true,
                'message' => 'akun berhasil terdaftar sebagai satgas',
                'name' => $input['name'],
                'photo' => $input['photo'],
                'username' => $input['username'],
                'nik' => $input['nik'],
                'jk' => $input['jk'],
                'email' => $input['email'],
                'phone_number' => $input['phone_number'],
                'opd' => $input['opd'],
                'jenisPengaduan' => $input['jenisPengaduan'],
                'tokens' => $success['token'],

            ]);
        } else {
            return response()->json([
                'success' => true,
                'message' => 'akun berhasil terdaftar ',
                'name' => $input['name'],
                'photo' => $input['photo'],
                'username' => $input['username'],
                'nik' => $input['nik'],
                'jk' => $input['jk'],
                'email' => $input['email'],
                'phone_number' => $input['phone_number'],
                'opd' => $input['opd'],
                'jenisPengaduan' => $input['jenisPengaduan'],
                'tokens' => $success['token'],

            ]);
        }


        return $this->sendResponse($success, 'User register successfully.');
    }

    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {

        if (Auth::guard('Pengguna-web')->attempt(['username' => request('username'), 'password' => request('password')])) {
            $user = Auth::guard('Pengguna-web')->user();
            $success['token'] = $user->createToken('Pengguna')->accessToken;

            return response()->json([
                'success' => true,
                'id' => $user['id'],
                'message' => 'login berhasil',
                'nama' => $user['name'],
                'foto' => $user['photo'],
                'username' => $user['username'],
                'jk' => $user['jk'],
                'email' => $user['email'],
                'tokens' => $success['token'],
            ]);
        } else {
            //if authentication is unsuccessfull, notice how I return json parameters
            return response()->json([
                'success' => false,
                'message' => 'Akun tidak terdaftar !',
            ], 401);
        }
    }

    public function loginsat()
    {

        if (Auth::guard('Pengguna-web')->attempt(['username' => request('username'), 'password' => request('password'), 'level' => request('level')])) {
            $user = Auth::guard('Pengguna-web')->user();
            $success['token'] = $user->createToken('Pengguna')->accessToken;


            return response()->json([
                'success' => true,
                'id' => $user['id'],
                'message' => 'login berhasil',
                'nama' => $user['name'],
                'foto' => $user['photo'],
                'username' => $user['username'],
                'jk' => $user['jk'],
                'email' => $user['email'],
                'tokens' => $success['token'],
            ]);
        } else {
            //if authentication is unsuccessfull, notice how I return json parameters
            return response()->json([
                'success' => false,
                'message' => 'Akun tidak terdaftar !',
            ], 401);
        }
    }

    // public function verifikassi(Request $request)
    // {
    //     $messages = [
    //         'required' => ':attribute tidak boleh kosong',
    //         'unique' => ':attribute No KK sudah ada tersimpan di database',

    //         'digits_between' => ':attribute Perhatikan No KK Harus 16 Digit !',
    //     ];

    //     $validator = Validator::make(
    //         $request->all(),
    //         [
    //             'nokk' => 'required|numeric|digits_between:16,16|unique:ataprumah',
    //             'kelurahan' => 'required',
    //             'kecamatan' => 'required',
    //             'latitude' => 'required',
    //             'longitude' => 'required',
    //             'image' => 'required|image|mimes:jpeg,png,jpg,svg',
    //             'petugas' => 'required',
    //             'email' => 'required',
    //             'rw' => 'required',
    //             'rt' => 'required',

    //         ],

    //         $messages
    //     );

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'success' => false,
    //             'message' =>   $validator->errors()->first(),
    //         ]);
    //     }
    //     $imageName = time() . '.' . $request->image->extension();
    //     $request->image->move(public_path('uploads'), $imageName);
    //     $kk = $request['nokk'];
    //     $kec = $request['kecamatan'];
    //     $kel = $request['kelurahan'];
    //     $rt = $request['rt'];
    //     $rw = $request['rw'];
    //     $lat = $request['latitude'];
    //     $long = $request['longitude'];
    //     $petugas = $request['petugas'];
    //     $email = $request['email'];

    //     $user = Ataprumah::create(
    //         [
    //             "foto" =>  $imageName,
    //             "kecamatan" => $kec,
    //             "kelurahan" => $kel,
    //             "nokk" => $kk,
    //             "rt" => $rt,
    //             "rw" => $rw,
    //             "latitude" => $lat,
    //             "longitude" => $long,
    //             "petugas" => $petugas,
    //             "email" => $email,

    //         ]


    //     );
    //     $success['token'] =  $user->createToken('MyApp')->accessToken;
    //     return response()->json([
    //         'success' => true,
    //         'message' => 'data berhasil disimpan',
    //         'nokk' => $user['nokk'],
    //         'kelurahan' => $user['kelurahan'],
    //         'kecamatan' => $user['kecamatan'],
    //         'petugas' => $user['petugas'],
    //         'rw' => $user['rw'],
    //         'rt' => $user['rt'],
    //         'tokens' => $success['token'],

    //     ]);
    // }
}
