<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    // GET /api/kategori
    public function index()
    {
        $kategori = Kategori::withCount('buku')->get();

        return response()->json([
            'status'  => true,
            'message' => 'Data kategori berhasil diambil.',
            'data'    => $kategori,
        ]);
    }

    // POST /api/kategori
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $kategori = Kategori::create([
            'nama' => $request->nama,
        ]);

        return response()->json([
            'status'  => true,
            'message' => 'Kategori berhasil ditambahkan.',
            'data'    => $kategori,
        ], 201);
    }

    // GET /api/kategori/{kategori}
    public function show(Kategori $kategori)
    {
        return response()->json([
            'status'  => true,
            'message' => 'Detail kategori berhasil diambil.',
            'data'    => $kategori->load('buku'),
        ]);
    }

    // PUT /api/kategori/{kategori}
    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $kategori->update([
            'nama' => $request->nama,
        ]);

        return response()->json([
            'status'  => true,
            'message' => 'Kategori berhasil diperbarui.',
            'data'    => $kategori,
        ]);
    }

    // DELETE /api/kategori/{kategori}
    public function destroy(Kategori $kategori)
    {
        $kategori->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Kategori berhasil dihapus.',
        ]);
    }
}