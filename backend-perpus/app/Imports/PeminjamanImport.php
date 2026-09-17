<?php

namespace App\Imports;

use App\Models\Peminjaman;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class PeminjamanImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Peminjaman([
            'user_id'        => $row['user_id'],
            'buku_id'        => $row['buku_id'],
            'tanggal_pinjam' => $row['tanggal_pinjam'],
            'tanggal_kembali' => $row['tanggal_kembali'] ?? null,
            'status'         => $row['status'] ?? 'dipinjam',
        ]);
    }

    /**
    * Aturan validasi untuk setiap baris di file Excel
    */
    public function rules(): array
    {
        return [
            'user_id'        => 'required|exists:users,id',
            'buku_id'        => 'required|exists:bukus,id',
            'tanggal_pinjam' => 'required|date',
            'status'         => 'nullable|in:dipinjam,dikembalikan,terlambat',
        ];
    }
}