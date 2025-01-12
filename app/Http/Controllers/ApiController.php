<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;

class ApiController extends Controller
{
    public function handleScan(Request $request)
    {
        $idCard = $request->input('id_card');

        // Simpan atau update data ke database
        $user = Anggota::updateOrCreate(
            ['id_card' => $idCard],
            ['id_chat' => $request->input('id_chat'),
             'nama_lengkap' => $request->input('nama_lengkap'),
             'jenis_kelamin' => $request->input('jenis_kelamin'),
             'saldo' => $request->input('saldo')]
        );

        return response()->json(['id_card' => $idCard]);
    }
}


