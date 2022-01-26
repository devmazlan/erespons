<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KecModel extends Model
{
    use HasFactory;
    protected $table = "tb_kecamatan";
    protected $fillable = [
        'id', 'kecamatan',
    ];
}
