<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;

class DaftarBukuController extends Controller
{
    /**
     * Menampilkan daftar buku publik/katalog pengguna.
     */
    public function index(Request $request)
    {
        $kategoris = Kategori::orderBy('nama', 'asc')->get();

        $query = Buku::with('kategori');

        // Filter berdasarkan kategori jika dipillih
        if ($request->filled('kategori')) {
            $query->where('kategori_id', $request->kategori);
        }

        // Pencarian judul atau penulis jika ada query pencarian
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('judul', 'like', '%' . $request->search . '%')
                  ->orWhere('penulis', 'like', '%' . $request->search . '%');
            });
        }

        // Menggunakan paginasi agar performa tetap cepat
        $bukus = $query->latest()->paginate(12)->withQueryString();

        return view('daftarbuku', compact('bukus', 'kategoris'));
    }

    /**
     * Menampilkan detail buku tertentu.
     */
    public function show(Buku $buku)
    {
        $buku->load('kategori');

        return view('detailbuku', compact('buku'));
    }
}