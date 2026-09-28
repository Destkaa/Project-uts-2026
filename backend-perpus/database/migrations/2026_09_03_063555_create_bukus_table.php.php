<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bukus', function (Blueprint $table) {
            $table->id();
<<<<<<< HEAD
            $table->string('isbn', 20)->unique()->nullable()->after('id'); // 💡 Ditambahkan untuk fitur ISBN
=======

>>>>>>> ed4a556 (Update backend API and user controller)
            $table->string('judul');
            $table->string('penulis');

            $table->foreignId('kategori_id')
                ->nullable()
                ->constrained('kategoris')
                ->nullOnDelete();

            $table->integer('stok')->default(0);
            $table->text('deskripsi')->nullable();

            // Menyimpan path/nama file gambar
            $table->string('gambar')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bukus');
    }
};