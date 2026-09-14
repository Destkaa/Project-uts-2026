<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BukuController;
use App\Http\Controllers\Api\KategoriController;
use App\Http\Controllers\Api\KeranjangController;
use App\Http\Controllers\Api\WishlistController;
use App\Http\Controllers\Api\PeminjamanController;
use App\Http\Controllers\Api\DendaController;
use App\Http\Controllers\Api\ProfileController;

/*
|--------------------------------------------------------------------------
| Public Routes (Tanpa Otentikasi)
|--------------------------------------------------------------------------
*/
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Eksplorasi Katalog Buku & Kategori
Route::get('/buku', [BukuController::class, 'index']);
Route::get('/buku/{buku}', [BukuController::class, 'show']);
Route::get('/kategori', [KategoriController::class, 'index']);
Route::get('/kategori/{kategori}', [KategoriController::class, 'show']);

/*
|--------------------------------------------------------------------------
| Protected Routes (Wajib Auth Sanctum)
|--------------------------------------------------------------------------
*/
Route::middleware('auth:sanctum')->group(function () {
    
    // Auth & User Profile
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
    
    // Profile Management (POST untuk support upload foto multipart/form-data)
    Route::get('/profile', [ProfileController::class, 'show']);
    Route::post('/profile', [ProfileController::class, 'update']);

    // Master Data Buku (Admin)
    Route::post('/buku', [BukuController::class, 'store']);
    Route::put('/buku/{buku}', [BukuController::class, 'update']);
    Route::delete('/buku/{buku}', [BukuController::class, 'destroy']);

    // Master Data Kategori (Admin)
    Route::post('/kategori', [KategoriController::class, 'store']);
    Route::put('/kategori/{kategori}', [KategoriController::class, 'update']);
    Route::delete('/kategori/{kategori}', [KategoriController::class, 'destroy']);

    // Keranjang (Cart)
    Route::apiResource('keranjang', KeranjangController::class)->only(['index', 'store', 'destroy']);

    // Wishlist
    Route::apiResource('wishlist', WishlistController::class)->only(['index', 'store', 'destroy']);

    // Peminjaman (Full CRUD)
    Route::apiResource('peminjaman', PeminjamanController::class);

    // Denda
    Route::get('/denda', [DendaController::class, 'index']);
    Route::get('/denda/{denda}', [DendaController::class, 'show']);
    Route::post('/denda/{denda}/bayar', [DendaController::class, 'bayar']);
    Route::delete('/denda/{denda}', [DendaController::class, 'destroy']);
});