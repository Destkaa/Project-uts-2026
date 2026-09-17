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
            'kategori_id' => $row['kategori_id'],
            'judul'       => $row['judul'],
            'penulis'     => $row['penulis'],
            'penerbit'    => $row['penerbit'],
            'tahun_terbit'=> $row['tahun_terbit'],
            'stok'        => $row['stok'] ?? 1,
        ]);
    }

    public function rules(): array
    {
        return [
            'kategori_id' => 'required|exists:kategoris,id',
            'judul'       => 'required|string|max:255',
            'penulis'     => 'required|string|max:255',
            'stok'        => 'required|integer|min:0',
        ];
    }
}