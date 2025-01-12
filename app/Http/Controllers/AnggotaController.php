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

    public function create()
    {
        return view("admin.anggota.create");
    }

    public function store(Request $request)
    {
        $validated = $request->validate(['id_card' => 'required|unique:anggota', 'id_chat' => 'required', 'nama_anggota' => 'required', 'jenis_kelamin' => 'required|in:laki-laki,wanita', 'saldo' => 'required|numeric',]);
        $anggota = new Anggota($validated);
        $anggota->save();
        return redirect()->route('anggota.index')->with('success', 'Member created successfully.');
    }
}
