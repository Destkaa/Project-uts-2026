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
        $kategori = Kategori::withCount('bukus')->get();

        return response()->json([
            'message' => 'Data kategori berhasil diambil.',
            'data' => $kategori
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
            'message' => 'Kategori berhasil ditambahkan.',
            'data' => $kategori
        ], 201);
    }

    // GET /api/kategori/{id}
    public function show($id)
    {
        $kategori = Kategori::with('bukus')->findOrFail($id);

        return response()->json([
            'message' => 'Detail kategori berhasil diambil.',
            'data' => $kategori
        ]);
    }

    // PUT /api/kategori/{id}
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $kategori = Kategori::findOrFail($id);

        $kategori->update([
            'nama' => $request->nama,
        ]);

        return response()->json([
            'message' => 'Kategori berhasil diperbarui.',
            'data' => $kategori
        ]);
    }

    // DELETE /api/kategori/{id}
    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);

        $kategori->delete();

        return response()->json([
            'message' => 'Kategori berhasil dihapus.'
        ]);
    }
}