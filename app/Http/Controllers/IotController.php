<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;

class IotController extends Controller
{
    public function scan(Request $request)
    {
        $id_card = $request->input('id_card');

        // Proses lebih lanjut untuk ID Card yang diterima dari IoT
        $anggota = Anggota::where('id_card', $id_card)->first();
        if ($anggota) {
            return response()->json(['status' => 'success', 'message' => 'Anggota found', 'data' => $anggota]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Anggota not found']);
        }
    }

    public function fillIdCard(Request $request)
    {
        $id_card = $request->input('id_card'); // Logika untuk memeriksa dan mengirimkan data ID Card 
        return response()->json(['id_card' => $id_card]);
    }

}
