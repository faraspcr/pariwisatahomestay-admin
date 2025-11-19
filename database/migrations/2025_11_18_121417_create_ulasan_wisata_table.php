<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up() // 📝 Ini adalah method yang dijalankan saat kita RUN migration, Fungsinya: MEMBUAT tabel baru di database

    {
        Schema::create('ulasan_wisata', function (Blueprint $table) {
            $table->id('ulasan_id');                                                                                 // PRIMARY KEY - ID utama tabel
            $table->foreignId('destinasi_id')->constrained('destinasi_wisata', 'destinasi_id')->onDelete('cascade'); // FOREIGN KEY ke tabel destinasi_wisata
            $table->foreignId('warga_id')->constrained('warga', 'warga_id')->onDelete('cascade');                    // FOREIGN KEY ke tabel warga
            $table->integer('rating')->unsigned();                                                                   // Data rating (1-5)
            $table->text('komentar');
            $table->timestamp('waktu')->useCurrent();
            $table->timestamps();

            // 🚀 INDEX untuk mempercepat pencarian
            $table->index('destinasi_id');
            $table->index('warga_id');
            $table->index('rating');

        });
    }

    public function down() // 📝 Ini adalah method yang dijalankan saat kita ROLLBACK migration, Fungsinya: MENGHAPUS tabel dari database
    {
        Schema::dropIfExists('ulasan_wisata');
    }
};
