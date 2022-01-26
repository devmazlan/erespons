<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpdModel extends Model
{
    use HasFactory;
    protected $table = "tb_opd";
    protected $fillable = [
        'id', 'nama_opd', 'description',
    ];
}
