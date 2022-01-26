<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Netizens extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = "netizens";
    protected $fillable = [
        'nama',
        'profesi',
        'jk',
        'foto',
        'profesi',
        'username',
        'password',
        'device_id',
        'alamat',

    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
