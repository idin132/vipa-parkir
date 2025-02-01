<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\Pengunjung;

class DashboardController extends Controller
{
    public function index() {
        $total_anggota = Anggota::count();
        $pengunjung_aktif = Pengunjung::where('status',['aktif'])->count();
        $total_pengunjung = Pengunjung::count();
        $total_pendapatan = Pengunjung::sum('tarif');
        return view('admin.dashboard.index', compact('total_anggota','pengunjung_aktif','total_pengunjung','total_pendapatan'));
    }
}
