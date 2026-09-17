<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kunjungans', function (Blueprint $table) {
            $table->id();
            // Jika anggota/user terdaftar (opsional)
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            
            // Untuk data pengunjung (baik member maupun tamu non-anggota)
            $table->string('nama_pengunjung');
            $table->string('institusi')->nullable(); // Misal: Kelas/Jurusan/Instansi
            $table->string('tujuan');               // Misal: Membaca, Pinjam Buku, Diskusi
            $table->date('tanggal');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kunjungans');
    }
};