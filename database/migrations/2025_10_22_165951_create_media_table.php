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
        Schema::create('media', function (Blueprint $table) {
            $table->id('media_id');
            $table->string('ref_table'); // contoh: 'destinasi_wisata'
            $table->unsignedBigInteger('ref_id'); // contoh: id dari destinasi_wisata
            $table->string('file_url'); // lokasi file (URL/path)
            $table->string('caption')->nullable(); // keterangan gambar
            $table->string('mime_type', 100)->nullable(); // tipe file (jpg/png/pdf)
            $table->integer('sort_order')->default(0); // urutan tampilan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
