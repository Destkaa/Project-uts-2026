<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', '!=', 'admin')
            ->latest()
            ->paginate(10);
    
        return response()->json([
            'status' => true,
            'message' => 'Data anggota berhasil diambil.',
            'data' => $users,
        ]);
    }

    public function show(User $user)
    {
        return response()->json([
            'status' => true,
            'message' => 'Detail anggota berhasil diambil.',
            'data' => $user,
        ]);
    }
}