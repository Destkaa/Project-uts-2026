<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/buku/{id}', function ($id) {
    return view('detail-buku');
})->name('buku.detail');

Route::get('/koleksi-buku', function () {
    return view('koleksi');
})->name('koleksi');

Route::get('/kategori', function () {
    return view('kategori');
})->name('kategori');

Route::get('/tentang', function () {
    return view('tentang');
})->name('tentang');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


