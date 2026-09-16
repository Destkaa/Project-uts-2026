<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index(Request $request)
    {
        $query = Buku::with(['kategori:id,nama']);

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('judul', 'like', "%{$search}%")
                  ->orWhere('penulis', 'like', "%{$search}%");
        }

        if ($request->has('stok')) {
            $query->where('stok', '>', 0);
        }

        if ($request->has('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        $buku = $query->latest()->paginate($request->input('per_page', 10));

        return response()->json([
            'status'  => true,
            'message' => 'Daftar buku berhasil diambil.',
            'data'    => $buku,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'kategori_id' => 'nullable|exists:kategori,id',
            'judul'       => 'required|string|max:255',
            'penulis'     => 'required|string|max:255',
            'stok'        => 'required|integer|min:0',
            'deskripsi'   => 'nullable|string',
            'gambar'      => 'nullable|string',
        ]);

        $buku = Buku::create($data);

        return response()->json([
            'status'  => true,
            'message' => 'Buku berhasil ditambahkan.',
            'data'    => $buku->load('kategori:id,nama'),
        ], 201);
    }

    public function show(Buku $buku)
    {
        return response()->json([
            'status' => true,
            'data'   => $buku->load(['kategori:id,nama', 'peminjaman.user:id,name']),
        ]);
    }

    public function update(Request $request, Buku $buku)
    {
        $data = $request->validate([
            'kategori_id' => 'nullable|exists:kategori,id',
            'judul'       => 'sometimes|required|string|max:255',
            'penulis'     => 'sometimes|required|string|max:255',
            'stok'        => 'sometimes|required|integer|min:0',
            'deskripsi'   => 'nullable|string',
            'gambar'      => 'nullable|string',
        ]);

        $buku->update($data);

        return response()->json([
            'status'  => true,
            'message' => 'Buku berhasil diperbarui.',
            'data'    => $buku->load('kategori:id,nama'),
        ]);
    }

    public function destroy(Buku $buku)
    {
        $buku->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Buku berhasil dihapus.',
        ]);
    }
}