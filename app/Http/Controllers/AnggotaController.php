<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;

class AnggotaController extends Controller
{

    public function index()
    {
        $anggota = Anggota::all();
        return view("admin.anggota.index", compact("anggota"));
    }

    // Metode lainnya tetap seperti sebelumnya...

    public function showTopUpForm($id_card)
    {
        $anggota = Anggota::where('id_card', $id_card)->first();
        return view('admin.anggota.TopUp', compact('anggota'));
    }

    public function topUp(Request $request, $id_card)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        $anggota = Anggota::where('id_card', $id_card)->first();
        if ($anggota) {
            $anggota->topUp($request->input('amount'));
            return redirect()->route('anggota.index')->with('success', 'Saldo berhasil ditambahkan.');
        } else {
            return redirect()->back()->with('error', 'Anggota tidak ditemukan.');
        }
    }



    public function create()
    {
        return view("admin.anggota.create");
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_card',
            'id_chat',
            'nama_anggota',
            'jenis_kelamin',
            'saldo',
        ]);
        $anggota = new Anggota($validated);
        $anggota->save();

        return redirect()->route('admin.anggota.index')->with('success', 'Member created successfully.');
    }

    public function edit($id_card)
    {
        $anggota = Anggota::where('id_card', $id_card)->first();
        return view('admin.anggota.edit', compact('anggota'));
    }

    public function update(Request $request, $id_card)
    {
        $validated = $request->validate([
            'id_card',
            'id_chat',
            'nama_anggota',
            'jenis_kelamin',
            'saldo',
            'telegram' => 'enable',
            'status' => 'aktif'
        ]);

        $anggota = Anggota::where('id_card', $id_card)->first();
        $anggota->update($request->all());
        return redirect()->route('anggota.index')->with(['message' => 'Data Berhasil Diupdate']);

    }
}
