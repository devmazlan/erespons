<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Kaduan extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = "kaduan";
    protected $fillable = [

        'tiket',
        'keterangan',
        'foto',
        'jen_kaduan',
        'opd',
        'kecamatan',
        'kelurahan',
        'latitude',
        'longitude',
        'username',
        'device_id',
        'status',
        'petugas',
        'tglwaktu',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
