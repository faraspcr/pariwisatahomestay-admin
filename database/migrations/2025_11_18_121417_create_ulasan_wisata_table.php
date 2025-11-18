<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ulasan_wisata', function (Blueprint $table) {
            $table->id('ulasan_id');
            $table->foreignId('destinasi_id')->constrained('destinasi_wisata', 'destinasi_id')->onDelete('cascade');
            $table->foreignId('warga_id')->constrained('warga', 'warga_id')->onDelete('cascade');
            $table->integer('rating')->unsigned();
            $table->text('komentar');
            $table->timestamp('waktu')->useCurrent();
            $table->timestamps();

            // Index untuk performa
            $table->index('destinasi_id');
            $table->index('warga_id');
            $table->index('rating');

            // Check constraint untuk rating (1-5)
            // Note: MySQL doesn't support check constraints, so we handle in validation
        });
    }

    public function down()
    {
        Schema::dropIfExists('ulasan_wisata');
    }
};
