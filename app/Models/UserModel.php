<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class UserModel extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "tb_users";
    protected $fillable = [
        'name',
        'photo',
        'jk',
        'email',
        'username',
        'password',
        'nik',
        'phone_number',
        'address',
        'kecamatan',
        'kelurahan',
        'level',
        'active_status',
        'status_user',
        'point',
        'opd',
        'jenisPengaduan',

    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
