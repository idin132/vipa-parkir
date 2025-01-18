<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Events\AnggotaUpdated;


class IotController extends Controller
{
    // Fungsi untuk mendapatkan daftar UID yang diizinkan
    public function allowedUIDs()
    {
        $anggota = Anggota::pluck('id_card', );
        return response()->json($anggota);
    }

    // Fungsi untuk menyimpan UID ke database
    public function storeIDCard(Request $request)
    {
        $validated = $request->validate([
            'id_card' => 'required|unique:anggota,id_card',
        ]);

        $anggota = new Anggota();
        $anggota->id_card = $validated['id_card'];
        $anggota->save();
        // broadcast(new AnggotaUpdated($anggota))->toOthers();

        return response()->json(['message' => 'ID Card berhasil disimpan.']);
    }

    public function updateAnggota(Request $request)
    {
        $anggota = Anggota::find($request->id);
        $anggota->update($request->all());

        // broadcast(new AnggotaUpdated($anggota))->toOthers();

        return response()->json(['success' => true]);
    }
}
?>