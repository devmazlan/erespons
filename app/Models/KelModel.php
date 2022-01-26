<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelModel extends Model
{
    use HasFactory;
    protected $table = "tb_kelurahan";
    protected $fillable = [
        'id', 'kec_id', 'kelurahan',
    ];
}
