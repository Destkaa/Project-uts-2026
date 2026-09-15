<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    // GET SEMUA BUKU + SEARCH + FILTER
    public function index(Request $request)
    {
        $query = Buku::with('kategori:id,nama');

        // Search judul atau penulis
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', '%' . $search . '%')
                    ->orWhere('penulis', 'like', '%' . $search . '%');
            });
        }

        // Hanya buku yang stoknya tersedia
        if ($request->filled('stok')) {
            $query->where('stok', '>', 0);
        }

        // Filter kategori
        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        $bukus = $query
            ->latest()
            ->paginate($request->get('per_page', 10));

        return response()->json([
            'status' => true,
            'message' => 'Daftar buku berhasil diambil.',
            'data' => $bukus
        ]);
    }

    // POST TAMBAH BUKU
    public function store(Request $request)
    {
        $data = $request->validate([
            'kategori_id' => 'nullable|exists:kategoris,id',
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|string',
        ]);

        $buku = Buku::create($data);

        return response()->json([
            'status' => true,
            'message' => 'Buku berhasil ditambahkan.',
            'data' => $buku->load('kategori:id,nama'),
        ], 201);
    }

    // GET DETAIL BUKU
    public function show(Buku $buku)
    {
        return response()->json([
            'status' => true,
            'message' => 'Detail buku ditemukan.',
            'data' => $buku->load([
                'kategori:id,nama',
                'peminjaman.user:id,name',
            ]),
        ]);
    }

    // PUT UPDATE BUKU
    public function update(Request $request, Buku $buku)
    {
        $data = $request->validate([
            'kategori_id' => 'nullable|exists:kategoris,id',
            'judul' => 'sometimes|required|string|max:255',
            'penulis' => 'sometimes|required|string|max:255',
            'stok' => 'sometimes|required|integer|min:0',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|string',
        ]);

        $buku->update($data);

        return response()->json([
            'status' => true,
            'message' => 'Buku berhasil diperbarui.',
            'data' => $buku->load('kategori:id,nama'),
        ]);
    }

    // DELETE BUKU
    public function destroy(Buku $buku)
    {
        $buku->delete();

        return response()->json([
            'status' => true,
            'message' => 'Buku berhasil dihapus.',
        ]);
    }
}