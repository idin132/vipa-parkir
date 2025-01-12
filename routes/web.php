<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\LoginController;
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
    return view('welcome');
});
Route::get('/table', function() {
    return view('admin.anggota.index');
});

// Login/Logout
Route::get('/login', [LoginController::class,'index'])->name('login');
Route::post('logout', [LoginController::class,'actionlogout'])->name('logout');
Route::post('/actionlogin', [LoginController::class,'actionlogin'])->name('actionlogin');

// Untuk Admin
Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard.index');
    });
    // resource controller
    Route::resource('anggota', AnggotaController::class);
    
    // Route::get('/form', 'MemberController@create')->name('members.create'); 
    // Route::post('/members', 'MemberController@store')->name('members.store');
    
});

