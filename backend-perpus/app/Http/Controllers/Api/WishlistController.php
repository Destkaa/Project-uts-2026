<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlists = Wishlist::with('buku.kategori')
            ->where('user_id', Auth::id())
            ->get();

        return response()->json([
            'message' => 'Data wishlist berhasil diambil.',
            'data'    => $wishlists,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'buku_id' => 'required|exists:bukus,id',
        ]);

        $wishlist = Wishlist::firstOrCreate([
            'user_id' => Auth::id(),
            'buku_id' => $request->buku_id,
        ]);

        return response()->json([
            'message' => 'Buku berhasil ditambahkan ke wishlist.',
            'data'    => $wishlist->load('buku'),
        ], 201);
    }

    public function destroy(Wishlist $wishlist)
    {
        if ($wishlist->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $wishlist->delete();

        return response()->json(['message' => 'Item wishlist berhasil dihapus.']);
    }
}