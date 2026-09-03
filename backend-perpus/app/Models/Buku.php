<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Buku extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'bukus';

    protected $fillable = [
        'kategori_id',
        'judul',
        'penulis',
        'stok',
        'deskripsi',
        'gambar',
    ];

    /**
     * Relasi ke model Kategori
     */
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    /**
     * Relasi ke model Peminjaman
     */
    public function peminjaman(): HasMany
    {
        return $this->hasMany(Peminjaman::class, 'buku_id');
    }

    /**
     * Relasi ke model DetailPeminjaman
     */
    public function detailPeminjaman(): HasMany
    {
        return $this->hasMany(DetailPeminjaman::class, 'buku_id');
    }

    /**
     * Relasi melalui (HasManyThrough) ke model Denda
     */
    public function denda(): HasManyThrough
    {
        return $this->hasManyThrough(
            Denda::class,
            Peminjaman::class,
            'buku_id',       // Foreign key di tabel peminjamans
            'peminjaman_id', // Foreign key di tabel dendas
            'id',            // Primary key di tabel bukus
            'id'             // Primary key di tabel peminjamans
        );
    }
}