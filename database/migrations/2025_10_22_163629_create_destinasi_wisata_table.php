<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('destinasi_wisata', function (Blueprint $table) {
            $table->id('destinasi_id');
            $table->string('nama');
            $table->text('deskripsi');
            $table->text('alamat');
            $table->string('rt', 3);
            $table->string('rw', 3);
            $table->time('jam_buka');
            $table->decimal('tiket', 10, 2);
            $table->string('kontak', 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destinasi_wisata');
    }
};
