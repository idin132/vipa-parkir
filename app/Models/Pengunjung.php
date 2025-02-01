<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengunjung extends Model
{
    use HasFactory;
    protected $table = 'pengunjung';
    protected $fillable = [
        'id_card',
        'nama',
        'tanggal',
        'jam_masuk',
        'durasi',
        'jam_keluar',
        'tarif',
        'status',
    ];
}
