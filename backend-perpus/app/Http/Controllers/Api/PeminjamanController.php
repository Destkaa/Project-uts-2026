<?php

namespace App\Http\Controllers\Api;

use App\Exports\PeminjamanExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePeminjamanRequest;
use App\Http\Requests\UpdatePeminjamanRequest;
use App\Imports\PeminjamanImport;
use App\Models\Peminjaman;
use App\Services\PeminjamanService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PeminjamanController extends Controller
{
    public function __construct(private PeminjamanService $service) {}

    // GET /api/peminjaman (Admin / General Index dengan Filter & Pagination)
    public function index(Request $request)
    {
        $query = Peminjaman::with(['user:id,name,email', 'buku:id,judul,penulis']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        return response()->json(
            $query->latest()->paginate($request->get('per_page', 10))
        );
    }

    // GET /api/peminjaman/history (Khusus User Login - Riwayat Peminjaman Pribadi)
    public function history(Request $request)
    {
        $history = Peminjaman::with(['buku:id,judul,penulis', 'denda'])
            ->where('user_id', $request->user()->id)
            ->latest()
            ->paginate($request->get('per_page', 10));

        return response()->json([
            'status'  => true,
            'message' => 'History peminjaman berhasil diambil.',
            'data'    => $history,
        ]);
    }

    // POST /api/peminjaman (Buat Transaksi Peminjaman Baru)
    public function store(StorePeminjamanRequest $request)
    {
        try {
            $peminjaman = $this->service->buat($request->validated());
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }

        return response()->json([
            'status'  => true,
            'message' => 'Peminjaman berhasil dibuat.',
            'data'    => $peminjaman->load(['user:id,name', 'buku:id,judul']),
        ], 201);
    }

    // GET /api/peminjaman/{peminjaman} (Detail Single Transaksi Peminjaman)
    public function show(Peminjaman $peminjaman)
    {
        return response()->json(
            $peminjaman->load(['user:id,name,email', 'buku:id,judul,penulis', 'denda'])
        );
    }

    // PUT /api/peminjaman/{peminjaman} (Update Status / Pengembalian Peminjaman)
    public function update(UpdatePeminjamanRequest $request, Peminjaman $peminjaman)
    {
        try {
            $peminjaman = $this->service->ubah($peminjaman, $request->validated());
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }

        return response()->json([
            'status'  => true,
            'message' => 'Peminjaman berhasil diperbarui.',
            'data'    => $peminjaman->load(['user:id,name', 'buku:id,judul', 'denda']),
        ]);
    }

    // DELETE /api/peminjaman/{peminjaman} (Hapus Transaksi Peminjaman)
    public function destroy(Peminjaman $peminjaman)
    {
        $peminjaman->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Peminjaman berhasil dihapus.',
        ]);
    }

    // GET /api/peminjaman/export (Download Excel Data Peminjaman)
    public function export()
    {
        return Excel::download(new PeminjamanExport, 'data-peminjaman.xlsx');
    }

    // POST /api/peminjaman/import (Upload & Import Data dari File Excel)
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        try {
            Excel::import(new PeminjamanImport, $request->file('file'));

            return response()->json([
                'status'  => true,
                'message' => 'Data peminjaman berhasil di-import.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Gagal meng-import data: ' . $e->getMessage(),
            ], 500);
        }
    }
}