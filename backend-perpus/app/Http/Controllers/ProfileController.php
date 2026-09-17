<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProfileController extends Controller implements HasMiddleware
{
    /**
     * Definisi middleware untuk ProfileController (Laravel 11+)
     */
    public static function middleware(): array
    {
        return [
            'auth',
        ];
    }

    public function show()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $profile = $user->profile;

        // 📝 Menambahkan History Peminjaman Buku milik user yang sedang login
        $historyPeminjaman = Peminjaman::with(['buku', 'denda'])
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(5);

        // Ringkasan statistik peminjaman user
        $stats = [
            'total_pinjam'       => Peminjaman::where('user_id', $user->id)->count(),
            'sedang_dipinjam'    => Peminjaman::where('user_id', $user->id)->where('status', 'dipinjam')->count(),
            'sudah_dikembalikan' => Peminjaman::where('user_id', $user->id)->where('status', 'dikembalikan')->count(),
        ];

        return view('profile.show', compact('user', 'profile', 'historyPeminjaman', 'stats'));
    }

    public function edit()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $profile = $user->profile;

        return view('profile.edit', compact('user', 'profile'));
    }

    public function update(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $request->validate([
            'name'          => 'required|string|max:255',
            'no_hp'         => 'nullable|string|max:20',
            'alamat'        => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'foto'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Update nama user
        $user->update(['name' => $request->name]);

        $profileData = $request->only(['no_hp', 'alamat', 'tanggal_lahir']);

        // Handle upload foto
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($user->profile && $user->profile->foto) {
                Storage::disk('public')->delete($user->profile->foto);
            }

            $ext = $request->file('foto')->extension();
            $profileData['foto'] = $request->file('foto')
                ->storeAs('profiles', Str::uuid().'.'.$ext, 'public');
        }

        // Simpan atau perbarui data profil
        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            $profileData
        );

        return redirect()->route('profile.show')
            ->with('success', 'Profil berhasil diperbarui.');
    }
}