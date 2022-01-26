<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JeniskaduanModel extends Model
{
    use HasFactory;
    protected $table = "tb_jenispengaduan";
    protected $fillable = [
        'id', 'JenisPengaduan', 'logo_jenis_pengaduan', 'description', 'opd',
    ];
}
