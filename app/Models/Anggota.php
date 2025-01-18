<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;
    protected $table = 'anggota';
    protected $fillable = [
        'id_card',
        'id_chat',
        'nama_anggota',
        'jenis_kelamin',
        'saldo',
        'telegram'
    ];
    
    public function topUp($saldo)
    {
        $this->saldo += $saldo;
        $this->save();
    }
}
