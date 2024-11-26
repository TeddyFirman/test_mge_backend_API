<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('logout', [AuthController::class, 'logout']);

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {

    // Dashboard Barang
    Route::get('admin/barang', [BarangController::class, 'index']);
    Route::post('admin/barang', [BarangController::class, 'store']);
    Route::put('admin/barang/{id}', [BarangController::class, 'update']);
    Route::delete('admin/barang/{id}', [BarangController::class, 'destroy']);

    Route::patch('admin/barang/{id}/updateStok', [BarangController::class, 'updateStock']);
    Route::patch('admin/barang/{id}/minusStok', [BarangController::class, 'minusStock']);
    Route::post('admin/barang/{id}/harga', [BarangController::class, 'addHarga']);
    Route::get('admin/barang/stok/{date}', [BarangController::class, 'getStockByDate']);
    Route::get('admin/barang/harga/{date}', [BarangController::class, 'getHargaByDate']);

    Route::get('search', [BarangController::class, 'search']);
});
