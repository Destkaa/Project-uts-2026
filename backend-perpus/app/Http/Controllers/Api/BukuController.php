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
        $query = Buku::with(['kategori:id,nama']);

<<<<<<< HEAD
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
=======
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
>>>>>>> 9b722131a8699dcbbe4c4573178facaba08cd562

        return response()->json([
            'status'  => true,
            'message' => 'Daftar buku berhasil diambil.',
            'data'    => $buku,
        ]);
    }

    // POST TAMBAH BUKU
    public function store(Request $request)
    {
        $data = $request->validate([
<<<<<<< HEAD
            'kategori_id' => 'nullable|exists:kategori,id',
            'judul'       => 'required|string|max:255',
            'penulis'     => 'required|string|max:255',
            'stok'        => 'required|integer|min:0',
            'deskripsi'   => 'nullable|string',
            'gambar'      => 'nullable|string',
=======
            'kategori_id' => 'nullable|exists:kategoris,id',
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|string',
>>>>>>> 9b722131a8699dcbbe4c4573178facaba08cd562
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
<<<<<<< HEAD
            'data'   => $buku->load(['kategori:id,nama', 'peminjaman.user:id,name']),
=======
            'message' => 'Detail buku ditemukan.',
            'data' => $buku->load([
                'kategori:id,nama',
                'peminjaman.user:id,name',
            ]),
>>>>>>> 9b722131a8699dcbbe4c4573178facaba08cd562
        ]);
    }

    // PUT UPDATE BUKU
    public function update(Request $request, Buku $buku)
    {
        $data = $request->validate([
<<<<<<< HEAD
            'kategori_id' => 'nullable|exists:kategori,id',
            'judul'       => 'sometimes|required|string|max:255',
            'penulis'     => 'sometimes|required|string|max:255',
            'stok'        => 'sometimes|required|integer|min:0',
            'deskripsi'   => 'nullable|string',
            'gambar'      => 'nullable|string',
=======
            'kategori_id' => 'nullable|exists:kategoris,id',
            'judul' => 'sometimes|required|string|max:255',
            'penulis' => 'sometimes|required|string|max:255',
            'stok' => 'sometimes|required|integer|min:0',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|string',
>>>>>>> 9b722131a8699dcbbe4c4573178facaba08cd562
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
<<<<<<< HEAD
            'status'  => true,
=======
            'status' => true,
>>>>>>> 9b722131a8699dcbbe4c4573178facaba08cd562
            'message' => 'Buku berhasil dihapus.',
        ]);
    }
}