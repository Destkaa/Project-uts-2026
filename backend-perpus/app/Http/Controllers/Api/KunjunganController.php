<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kunjungan;
use Illuminate\Http\Request;

class KunjunganController extends Controller
{
    // GET /api/kunjungan (Admin: Lihat Daftar Kunjungan + Filter Tanggal)
    public function index(Request $request)
    {
        $query = Kunjungan::with('user:id,name,email');

        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        return response()->json(
            $query->latest()->paginate($request->get('per_page', 10))
        );
    }

    // POST /api/kunjungan (Form Buku Tamu Digital)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id'         => 'nullable|exists:users,id',
            'nama_pengunjung' => 'required|string|max:255',
            'institusi'       => 'nullable|string|max:255',
            'tujuan'          => 'required|string|max:255',
            'tanggal'         => 'nullable|date',
        ]);

        // Auto isi tanggal hari ini jika tidak dikirim
        $validated['tanggal'] = $validated['tanggal'] ?? now()->toDateString();

        // Jika user sedang login, otomatis kaitkan user_id & nama
        if ($request->user()) {
            $validated['user_id'] = $request->user()->id;
            $validated['nama_pengunjung'] = $request->user()->name;
        }

        $kunjungan = Kunjungan::create($validated);

        return response()->json([
            'status'  => true,
            'message' => 'Kehadiran berhasil dicatat dalam buku tamu.',
            'data'    => $kunjungan,
        ], 201);
    }

    // DELETE /api/kunjungan/{kunjungan}
    public function destroy(Kunjungan $kunjungan)
    {
        $kunjungan->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Data kunjungan berhasil dihapus.',
        ]);
    }
}