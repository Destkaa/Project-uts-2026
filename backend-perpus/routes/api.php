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
use App\Http\Controllers\Api\KunjunganController;

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

// Public Auth (Bisa digunakan pengunjung untuk daftar / admin tambah anggota)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Authenticated User
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
});


/*
|--------------------------------------------------------------------------
| BUKU (CRUD + IMPORT EXCEL)
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/buku/import', [BukuController::class, 'import']);
    
    Route::get('/buku', [BukuController::class, 'index']);
    Route::post('/buku', [BukuController::class, 'store']);
    Route::get('/buku/{buku}', [BukuController::class, 'show']);
    Route::put('/buku/{buku}', [BukuController::class, 'update']);
    Route::delete('/buku/{buku}', [BukuController::class, 'destroy']);
});


/*
|--------------------------------------------------------------------------
| KATEGORI
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/kategori', [KategoriController::class, 'index']);
    Route::post('/kategori', [KategoriController::class, 'store']);
    Route::get('/kategori/{kategori}', [KategoriController::class, 'show']);
    Route::put('/kategori/{kategori}', [KategoriController::class, 'update']);
    Route::delete('/kategori/{kategori}', [KategoriController::class, 'destroy']);
});


/*
|--------------------------------------------------------------------------
| PROFILE & HISTORI
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show']);
    Route::post('/profile', [ProfileController::class, 'update']);
});


/*
|--------------------------------------------------------------------------
| KERANJANG & WISHLIST
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->group(function () {
    // Keranjang (Cart Pinjam)
    Route::get('/keranjang', [KeranjangController::class, 'index']);
    Route::post('/keranjang', [KeranjangController::class, 'store']);
    Route::delete('/keranjang/{keranjang}', [KeranjangController::class, 'destroy']);

    // Wishlist
    Route::get('/wishlist', [WishlistController::class, 'index']);
    Route::post('/wishlist', [WishlistController::class, 'store']);
    Route::delete('/wishlist/{wishlist}', [WishlistController::class, 'destroy']);
});


/*
|--------------------------------------------------------------------------
| PEMINJAMAN (MULTIPLE PINJAM, PENGEMBALIAN & EXPORT/IMPORT)
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->group(function () {
    // Export & Import Laporan Peminjaman
    Route::get('/peminjaman/export', [PeminjamanController::class, 'export']);
    Route::post('/peminjaman/import', [PeminjamanController::class, 'import']);
    
    // Multiple Pinjam (Checkout Keranjang)
    Route::post('/peminjaman/checkout', [PeminjamanController::class, 'checkout']);
    
    // Pengembalian Buku & Hitung Denda
    Route::post('/peminjaman/{peminjaman}/kembali', [PeminjamanController::class, 'kembalikan']);

    // CRUD Standar Peminjaman
    Route::get('/peminjaman', [PeminjamanController::class, 'index']);
    Route::post('/peminjaman', [PeminjamanController::class, 'store']);
    Route::get('/peminjaman/{peminjaman}', [PeminjamanController::class, 'show']);
    Route::put('/peminjaman/{peminjaman}', [PeminjamanController::class, 'update']);
    Route::delete('/peminjaman/{peminjaman}', [PeminjamanController::class, 'destroy']);
});


/*
|--------------------------------------------------------------------------
| DENDA
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/denda', [DendaController::class, 'index']);
    Route::get('/denda/{denda}', [DendaController::class, 'show']);
    Route::post('/denda/{denda}/bayar', [DendaController::class, 'bayar']);
    Route::delete('/denda/{denda}', [DendaController::class, 'destroy']);
});


/*
|--------------------------------------------------------------------------
| DAFTAR KUNJUNGAN (BUKU TAMU DIGITAL)
|--------------------------------------------------------------------------
*/

// Form Kunjungan Publik (Bisa diisi tamu digital tanpa login)
Route::post('/kunjungan', [KunjunganController::class, 'store']);

// Manajemen Kunjungan untuk Admin
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/kunjungan', [KunjunganController::class, 'index']);
    Route::delete('/kunjungan/{kunjungan}', [KunjunganController::class, 'destroy']);
});