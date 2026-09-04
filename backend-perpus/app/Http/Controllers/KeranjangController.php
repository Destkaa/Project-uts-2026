<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth'),
        ];
    }

    public function index()
    {
        $keranjangs = Keranjang::with('buku')
            ->where('user_id', Auth::id())
            ->get();

        return view('keranjang.index', compact('keranjangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'buku_id' => 'required|exists:bukus,id',
            'jumlah'  => 'required|integer|min:1',
        ]);

        $buku = Buku::findOrFail($request->buku_id);

        if ($buku->stok < $request->jumlah) {
            return back()->with('error', 'Stok buku tidak mencukupi.');
        }

        $item = Keranjang::where('user_id', Auth::id())
            ->where('buku_id', $request->buku_id)
            ->first();

        if ($item) {
            $item->increment('jumlah', $request->jumlah);
        } else {
            Keranjang::create([
                'user_id' => Auth::id(),
                'buku_id' => $request->buku_id,
                'jumlah'  => $request->jumlah,
            ]);
        }

        return redirect()->route('keranjang.index')->with('success', 'Buku berhasil ditambahkan ke keranjang.');
    }

    public function update(Request $request, Keranjang $keranjang)
    {
        if ($keranjang->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'jumlah' => 'required|integer|min:1',
        ]);

        if ($keranjang->buku->stok < $request->jumlah) {
            return back()->with('error', 'Stok buku tidak mencukupi.');
        }

        $keranjang->update(['jumlah' => $request->jumlah]);

        return back()->with('success', 'Jumlah keranjang berhasil diperbarui.');
    }

    public function destroy(Keranjang $keranjang)
    {
        if ($keranjang->user_id !== Auth::id()) {
            abort(403);
        }

        $keranjang->delete();

        return back()->with('success', 'Buku berhasil dihapus dari keranjang.');
    }
}