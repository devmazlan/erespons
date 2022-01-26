<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\JeniskaduanModel;
use App\Models\UserModel;
use App\Models\PengaduanModel;

use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $title = 'Dashboard | Admin OPD';
        $user = Auth::user();
        $datauser = DB::table('users')
            ->join('tb_opd', 'users.opd', '=', 'tb_opd.id')
            ->select('users.*', 'tb_opd.nama_opd as namaopd',)
            ->where('tb_opd.id', $user->opd)->first();

        $jeniskaduans = JeniskaduanModel::where('opd', $user->opd)->count();
        $satgas = UserModel::where('opd', $user->opd)->where('level', '3')->count();


        $pengaduan = DB::table('tb_pengaduan')
            ->join('tb_users', 'tb_pengaduan.idUsers', '=', 'tb_users.id')
            ->join('tb_jenispengaduan', 'tb_pengaduan.jenis_pengaduan', '=', 'tb_jenispengaduan.id')
            ->select('tb_pengaduan.*', 'tb_users.name as namauser', 'tb_users.phone_number as nohp', 'tb_jenispengaduan.JenisPengaduan as jenka')
            ->where('tb_users.opd', $user->opd)
            ->where('tb_jenispengaduan.opd', $user->opd)->count();

        $belum = DB::table('tb_pengaduan')
            ->join('tb_users', 'tb_pengaduan.idUsers', '=', 'tb_users.id')
            ->join('tb_jenispengaduan', 'tb_pengaduan.jenis_pengaduan', '=', 'tb_jenispengaduan.id')
            ->select('tb_pengaduan.*', 'tb_users.name as namauser', 'tb_users.phone_number as nohp', 'tb_jenispengaduan.JenisPengaduan as jenka')
            ->where('tb_users.opd', $user->opd)
            ->where('tb_pengaduan.status', '0')
            ->where('tb_jenispengaduan.opd', $user->opd)->count();

        $sedang = DB::table('tb_pengaduan')
            ->join('tb_users', 'tb_pengaduan.idUsers', '=', 'tb_users.id')
            ->join('tb_jenispengaduan', 'tb_pengaduan.jenis_pengaduan', '=', 'tb_jenispengaduan.id')
            ->select('tb_pengaduan.*', 'tb_users.name as namauser', 'tb_users.phone_number as nohp', 'tb_jenispengaduan.JenisPengaduan as jenka')
            ->where('tb_users.opd', $user->opd)
            ->where('tb_pengaduan.status', '1')
            ->where('tb_jenispengaduan.opd', $user->opd)->count();

        $selesai = DB::table('tb_pengaduan')
            ->join('tb_users', 'tb_pengaduan.idUsers', '=', 'tb_users.id')
            ->join('tb_jenispengaduan', 'tb_pengaduan.jenis_pengaduan', '=', 'tb_jenispengaduan.id')
            ->select('tb_pengaduan.*', 'tb_users.name as namauser', 'tb_users.phone_number as nohp', 'tb_jenispengaduan.JenisPengaduan as jenka')
            ->where('tb_users.opd', $user->opd)
            ->where('tb_pengaduan.status', '2')
            ->where('tb_jenispengaduan.opd', $user->opd)->count();



        return view('user.home', compact('user'))->with('title', $title)->with('datauser', $datauser)
            ->with('jeniskaduans', $jeniskaduans)
            ->with('pengaduan', $pengaduan)
            ->with('satgas', $satgas)
            ->with('belum', $belum)
            ->with('sedang', $sedang)
            ->with('selesai', $selesai);
    }
}
