<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jeniskaduan extends Model
{
    use HasFactory;
    protected $table = "jeniskaduan";
    protected $fillable = [
        'jen_kaduan', 'opd', 'icon',
    ];

    // public function petugas()
    // {

    //     return $this->haveMany('App\Models\Petugas');
    // }
}
