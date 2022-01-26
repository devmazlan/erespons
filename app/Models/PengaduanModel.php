<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class PengaduanModel extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = "tb_pengaduan";
    protected $fillable = [

        'idPengaduan',
        'idUsers',
        'photo_pengaduan_from_user',
        'deskripsi_from_user',
        'jenis_pengaduan',
        'address',
        'kecamatan',
        'kelurahan',
        'id_Satgas',
        'photo_pengaduan_from_satgas',
        'description_pengaduan_from_satgas',
        'status',
        'lat',
        'lng',
        'tglwaktu',

    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
