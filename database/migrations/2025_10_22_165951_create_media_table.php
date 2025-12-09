<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id('media_id'); // Primary key
            $table->string('ref_table'); // Contoh: 'destinasi_wisata'
            $table->unsignedBigInteger('ref_id'); // Contoh: 5
            $table->string('file_name'); // Nama file: foto1.jpg
            $table->string('caption')->nullable(); // Keterangan optional
            $table->string('mime_type'); // Contoh: image/jpeg
            $table->integer('sort_order')->default(1); // Urutan tampilan
            $table->timestamps(); // created_at, updated_at

            // Index untuk pencarian cepat
            $table->index(['ref_table', 'ref_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('media');
    }
};
