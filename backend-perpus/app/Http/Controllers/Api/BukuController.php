<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index(Request $request)
    {
        $query = Buku::with('kategori:id,nama');

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('judul', 'like', '%'.$request->search.'%')
                  ->orWhere('penulis', 'like', '%'.$request->search.'%');
            });
        }

        if ($request->filled('stok')) {
            $query->where('stok', '>', 0);
        }

        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        $bukus = $query->latest()->paginate($request->get('per_page', 10));

        return response()->json($bukus);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'kategori_id' => 'nullable|exists:kategoris,id',
            'judul'       => 'required|string|max:255',
            'penulis'     => 'required|string|max:255',
            'stok'        => 'required|integer|min:0',
            'deskripsi'   => 'nullable|string',
            'gambar'      => 'nullable|string',
        ]);

        $buku = Buku::create($data);

        return response()->json([
            'message' => 'Buku berhasil ditambahkan.',
            'data'    => $buku->load('kategori:id,nama'),
        ], 201);
    }

    public function show(Buku $buku)
    {
        return response()->json($buku->load(['kategori:id,nama', 'detailPeminjaman']));
    }

    public function update(Request $request, Buku $buku)
    {
        $data = $request->validate([
            'kategori_id' => 'nullable|exists:kategoris,id',
            'judul'       => 'sometimes|required|string|max:255',
            'penulis'     => 'sometimes|required|string|max:255',
            'stok'        => 'sometimes|required|integer|min:0',
            'deskripsi'   => 'nullable|string',
            'gambar'      => 'nullable|string',
        ]);

        $buku->update($data);

        return response()->json([
            'message' => 'Buku berhasil diperbarui.',
            'data'    => $buku->load('kategori:id,nama'),
        ]);
    }

    public function destroy(Buku $buku)
    {
        $buku->delete(); // Mendukung SoftDeletes sesuai Model

        return response()->json(['message' => 'Buku berhasil dihapus.']);
    }
}