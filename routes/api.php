<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IotController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/scan', [IotController::class, 'scan']);
Route::post('/fill-id-card',[IotController::class, 'fillIdCard']); // pakai yang ini buat ujicoba (http://localhost:8000//api/fill-id-card) / (http://127.0.0.1:8000//api/fill-id-card)
