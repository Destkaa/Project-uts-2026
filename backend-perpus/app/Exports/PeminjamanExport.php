<?php

namespace App\Exports;

use App\Models\Peminjaman;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PeminjamanExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * Ambil data lengkap beserta relasi user, buku, dan denda
    */
    public function collection()
    {
        return Peminjaman::with(['user:id,name,email', 'buku:id,judul', 'denda'])->get();
    }

    /**
    * Header nama kolom pada baris pertama di file Excel
    */
    public function headings(): array
    {
        return [
            'ID Transaksi',
            'Nama Peminjam',
            'Email Peminjam',
            'Judul Buku',
            'Tanggal Pinjam',
            'Tanggal Kembali',
            'Status',
            'Jumlah Denda (Rp)',
        ];
    }

    /**
    * Mapping baris data agar menampilkan data relasi yang jelas
    */
    public function map($peminjaman): array
    {
        return [
            $peminjaman->id,
            $peminjaman->user->name ?? 'User Tidak Ditemukan',
            $peminjaman->user->email ?? '-',
            $peminjaman->buku->judul ?? 'Buku Tidak Ditemukan',
            $peminjaman->tanggal_pinjam,
            $peminjaman->tanggal_kembali ?? 'Belum Dikembalikan',
            strtoupper($peminjaman->status),
            $peminjaman->denda->jumlah_denda ?? 0,
        ];
    }
}