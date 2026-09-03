<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class KategoriController extends Controller implements HasMiddleware
{
    /**
     * Definisi middleware untuk Laravel 11+
     */
    public static function middleware(): array
    {
        return [
            new Middleware('auth'),
            new Middleware('role:admin', except: ['index', 'show']),
        ];
    }

    public function index()
    {
        $kategori = Kategori::withCount('bukus')->latest()->paginate(10);

        return view('admin.kategori.index', compact('kategori'));
    }

    public function create()
    {
        return view('admin.kategori.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100|unique:kategoris,nama',
        ]);

        $kategori = Kategori::create($validated);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Kategori berhasil ditambahkan.',
                'data' => $kategori,
            ], 201);
        }

        return redirect()
            ->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function show(Kategori $kategori)
    {
        $kategori->load('bukus');

        return view('admin.kategori.show', compact('kategori'));
    }

    public function edit(Kategori $kategori)
    {
        return view('admin.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, Kategori $kategori)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100|unique:kategoris,nama,' . $kategori->id,
        ]);

        $kategori->update($validated);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Kategori berhasil diperbarui.',
                'data' => $kategori,
            ]);
        }

        return redirect()
            ->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Kategori $kategori)
    {
        $kategori->delete();

        if (request()->expectsJson()) {
            return response()->json([
                'message' => 'Kategori berhasil dihapus.',
            ]);
        }

        return redirect()
            ->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}