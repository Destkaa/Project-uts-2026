<?php

namespace App\Imports;

use App\Models\Buku;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class BukuImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        return new Buku([
            'isbn'        => $row['isbn'] ?? null,
            'judul'       => $row['judul'],
            'penulis'     => $row['penulis'],
            'kategori_id' => $row['kategori_id'] ?? null,
            'stok'        => $row['stok'] ?? 0,
            'deskripsi'   => $row['deskripsi'] ?? null,
            'gambar'      => $row['gambar'] ?? null,
        ]);
    }

    public function rules(): array
    {
        return [
            'isbn'        => 'nullable|string|max:20|unique:bukus,isbn',
            'judul'       => 'required|string|max:255',
            'penulis'     => 'required|string|max:255',
            'kategori_id' => 'nullable|exists:kategoris,id',
            'stok'        => 'required|integer|min:0',
            'deskripsi'   => 'nullable|string',
            'gambar'      => 'nullable|string',
        ];
    }
}