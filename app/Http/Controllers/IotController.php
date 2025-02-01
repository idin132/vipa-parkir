<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\Pengunjung;
use Carbon\Carbon;

class IotController extends Controller
{
    // Fungsi untuk mendapatkan daftar UID yang diizinkan
    public function allowedUIDs()
    {
        $anggota = Anggota::pluck('id_card');
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

        return response()->json(['message' => 'ID Card berhasil disimpan.']);
    }

    // Fungsi untuk menangani tap kartu
    public function handleTap(Request $request)
    {
        $idCard = $request->id_card;
        $anggota = Anggota::where('id_card', $idCard)->first();

        if ($anggota) {
            $pengunjung = Pengunjung::where('id_card', $idCard)->where('status', 'aktif')->first();
            if ($pengunjung) {
                // Update data ketika keluar parkir
                $jam_keluar = Carbon::now();
                $durasi = $jam_keluar->diffInSeconds(Carbon::parse($pengunjung->jam_masuk));
                $tarif = min(10000, ceil($durasi / 3600) * 2000);

                if ($anggota->saldo >= $tarif) {
                    $anggota->saldo -= $tarif;
                    $anggota->save();

                    $pengunjung->jam_keluar = $jam_keluar;
                    $pengunjung->durasi = gmdate('H:i:s', $durasi);
                    $pengunjung->tarif = $tarif;
                    $pengunjung->status = 'selesai';
                    $pengunjung->save();

                    return response()->json(['message' => 'Proses berhasil.']);
                } else {
                    return response()->json(['message' => 'Saldo tidak mencukupi.'], 400);
                }
            } else {
                // Simpan data ketika masuk parkir
                Pengunjung::create([
                    'id_card' => $anggota->id_card,
                    'nama' => $anggota->nama,
                    'tanggal' => Carbon::now()->toDateString(),
                    'jam_masuk' => Carbon::now(),
                    'status' => 'aktif'
                ]);
            }

            return response()->json(['message' => 'Proses berhasil.']);
        }

        return response()->json(['message' => 'ID Card tidak ditemukan.'], 404);
    }
}
