<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    public function index()
    {
        $keranjangs = Keranjang::with('buku')
            ->where('user_id', Auth::id())
            ->get();

        return response()->json([
            'message' => 'Data keranjang berhasil diambil.',
            'data'    => $keranjangs,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'buku_id' => 'required|exists:bukus,id',
            'jumlah'  => 'required|integer|min:1',
        ]);

        $buku = Buku::findOrFail($request->buku_id);

        if ($buku->stok < $request->jumlah) {
            return response()->json(['message' => 'Stok buku tidak mencukupi.'], 422);
        }

        $item = Keranjang::where('user_id', Auth::id())
            ->where('buku_id', $request->buku_id)
            ->first();

        if ($item) {
            $item->increment('jumlah', $request->jumlah);
            $item->refresh();
        } else {
            $item = Keranjang::create([
                'user_id' => Auth::id(),
                'buku_id' => $request->buku_id,
                'jumlah'  => $request->jumlah,
            ]);
        }

        return response()->json([
            'message' => 'Buku berhasil ditambahkan ke keranjang.',
            'data'    => $item->load('buku'),
        ], 201);
    }

    public function destroy(Keranjang $keranjang)
    {
        if ($keranjang->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $keranjang->delete();

        return response()->json(['message' => 'Item keranjang berhasil dihapus.']);
    }
}