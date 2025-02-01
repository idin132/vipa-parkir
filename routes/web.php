<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PengunjungController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('admin.auth.login');
});
Route::get('/table', function () {
    return view('admin.anggota.index');
});

Route::get('/TopUp-Saldo', function () {
    return view('admin.anggota.TopUp');
});

// Login/Logout
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('logout', [LoginController::class, 'actionlogout'])->name('logout');
Route::post('/actionlogin', [LoginController::class, 'actionlogin'])->name('actionlogin');

Route::get('/anggota/{id_card}/top-up', [AnggotaController::class, 'showTopUpForm'])->name('FormTopUp');
Route::post('/anggota/{id_card}/top-up', [AnggotaController::class, 'topUp'])->name('TopUp');

Route::post('/block-user/{id_card}', [AnggotaController::class, 'blokir'])->name('block-user');
Route::post('/aktif-user/{id_card}', [AnggotaController::class, 'BukaBlokir'])->name('aktif-user');
Route::get('/history/{id_card}/riwayat', [AnggotaController::class, 'History'])->name('transaction-history');



Route::get('adminlte', function() {
    return view('admin/layouts/template');
});



// Untuk Admin
Route::group(['middleware' => ['auth']], function () {
    Route::resource('dashboard', DashboardController::class);
    // resource controller
    Route::resource('anggota', AnggotaController::class);
    Route::resource('pengunjung', PengunjungController::class);

});

