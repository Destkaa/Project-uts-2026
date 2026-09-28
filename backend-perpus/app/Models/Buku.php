<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Buku extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'isbn',
        'judul',
        'penulis',
        'kategori_id',
        'stok',
        'deskripsi',
        'gambar',
    ];

<<<<<<< HEAD
    public function kategori()
=======
    /**
     * Relasi ke Kategori
     */
    public function kategori(): BelongsTo
>>>>>>> ed4a556 (Update backend API and user controller)
    {
        return $this->belongsTo(Kategori::class);
    }

<<<<<<< HEAD
    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class);
=======
    /**
     * Relasi ke Peminjaman
     */
    public function peminjaman(): HasMany
    {
        return $this->hasMany(Peminjaman::class, 'buku_id');
    }

    /**
     * Relasi ke Detail Peminjaman
     */
    public function detailPeminjaman(): HasMany
    {
        return $this->hasMany(DetailPeminjaman::class, 'buku_id');
    }

    /**
     * Relasi ke Denda melalui Peminjaman
     */
    public function denda(): HasManyThrough
    {
        return $this->hasManyThrough(
            Denda::class,
            Peminjaman::class,
            'buku_id',
            'peminjaman_id',
            'id',
            'id'
        );
>>>>>>> ed4a556 (Update backend API and user controller)
    }
}