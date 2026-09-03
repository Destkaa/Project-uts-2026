<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class BukuController extends Controller implements HasMiddleware
{
    /**
     * Definisi middleware untuk controller di Laravel 11+
     */
    public static function middleware(): array
    {
        return [
            new Middleware('auth'),
            new Middleware('admin'),
        ];
    }

    public function index()
    {
        $bukus     = Buku::with('kategori')->latest()->paginate(10);
        $kategoris = Kategori::orderBy('nama')->get();

        return view('admin.buku.index', compact('bukus', 'kategoris'));
    }

    public function create()
    {
        $kategoris = Kategori::orderBy('nama')->get();

        return view('admin.buku.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul'       => 'required|string|max:255',
            'penulis'     => 'required|string|max:255',
            'kategori_id' => 'nullable|exists:kategoris,id',
            'stok'        => 'required|integer|min:0',
            'deskripsi'   => 'nullable|string',
            'gambar'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $ext            = $request->file('gambar')->extension();
            $data['gambar'] = $request->file('gambar')
                ->storeAs('buku', Str::uuid().'.'.$ext, 'public');
        }

        $buku = Buku::create($data);
        $buku->load('kategori');

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Buku berhasil ditambahkan.', 'data' => $buku], 201);
        }

        return redirect()->route('admin.buku.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    public function show(Buku $buku)
    {
        $buku->load(['kategori', 'peminjaman.user']);

        return view('admin.buku.show', compact('buku'));
    }

    public function edit(Buku $buku)
    {
        $kategoris = Kategori::orderBy('nama')->get();

        return view('admin.buku.edit', compact('buku', 'kategoris'));
    }

    public function update(Request $request, Buku $buku)
    {
        $data = $request->validate([
            'judul'       => 'required|string|max:255',
            'penulis'     => 'required|string|max:255',
            'kategori_id' => 'nullable|exists:kategoris,id',
            'stok'        => 'required|integer|min:0',
            'deskripsi'   => 'nullable|string',
            'gambar'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            if ($buku->gambar && Storage::disk('public')->exists($buku->gambar)) {
                Storage::disk('public')->delete($buku->gambar);
            }
            $ext            = $request->file('gambar')->extension();
            $data['gambar'] = $request->file('gambar')
                ->storeAs('buku', Str::uuid().'.'.$ext, 'public');
        }

        $buku->update($data);
        $buku->load('kategori');

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Buku berhasil diperbarui.', 'data' => $buku]);
        }

        return redirect()->route('admin.buku.index')->with('success', 'Buku berhasil diperbarui.');
    }

    public function destroy(Buku $buku)
    {
        if ($buku->gambar && Storage::disk('public')->exists($buku->gambar)) {
            Storage::disk('public')->delete($buku->gambar);
        }
        $buku->delete();

        if (request()->expectsJson()) {
            return response()->json(['message' => 'Buku berhasil dihapus.']);
        }

        return redirect()->route('admin.buku.index')->with('success', 'Buku berhasil dihapus.');
    }
}