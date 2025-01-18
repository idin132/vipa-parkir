<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengunjung;

class PengunjungController extends Controller
{
    public function index() {
        $pengunjung = Pengunjung::all();
        return view ('admin.pengunjung.index', compact('pengunjung'));
    }
}
