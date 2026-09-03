<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Menampilkan daftar semua kategori beserta jumlah bukunya.
     */
    public function index()
    {
        return response()->json([
            'message' => 'Daftar kategori berhasil diambil.',
            'data'    => Kategori::withCount('bukus')->get()
        ]);
    }

    /**
     * Menyimpan kategori baru.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:100|unique:kategoris,nama',
        ]);

        $kategori = Kategori::create($data);

        return response()->json([
            'message' => 'Kategori berhasil ditambahkan.',
            'data'    => $kategori,
        ], 201);
    }

    /**
     * Menampilkan detail satu kategori beserta daftar bukunya.
     */
    public function show(Kategori $kategori)
    {
        return response()->json([
            'message' => 'Detail kategori berhasil diambil.',
            'data'    => $kategori->load('bukus'),
        ]);
    }

    /**
     * Memperbarui data kategori.
     */
    public function update(Request $request, Kategori $kategori)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:100|unique:kategoris,nama,' . $kategori->id,
        ]);

        $kategori->update($data);

        return response()->json([
            'message' => 'Kategori berhasil diperbarui.',
            'data'    => $kategori,
        ]);
    }

    /**
     * Menghapus kategori.
     */
    public function destroy(Kategori $kategori)
    {
        $kategori->delete();

        return response()->json([
            'message' => 'Kategori berhasil dihapus.',
        ]);
    }
}