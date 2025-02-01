<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IotController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/scan', [IotController::class, 'scan']);
Route::post('/store-id_card', [IotController::class, 'storeIDCard']);
Route::get('/allowed-uids', [IotController::class, 'allowedUIDs']); // Route baru untuk mengambil UID yang diizinkan
Route::post('/handle-tap', [IotController::class, 'handleTap']);
Route::post('/fill-id-card', [IotController::class, 'fillIdCard']); // pakai yang ini buat ujicoba (http://localhost:8000//api/fill-id-card) / (http://127.0.0.1:8000//api/fill-id-card)
?>
