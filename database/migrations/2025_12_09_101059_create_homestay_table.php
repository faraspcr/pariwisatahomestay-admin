<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('homestay', function (Blueprint $table) {
            $table->id('homestay_id'); // PK
            $table->unsignedBigInteger('pemilik_warga_id'); // FK ke warga
            $table->string('nama', 100);
            $table->text('alamat');
            $table->string('rt', 5);
            $table->string('rw', 5);
            $table->json('fasilitas_json')->nullable();
            $table->decimal('harga_per_malam', 12, 2);
            $table->enum('status', ['aktif', 'nonaktif', 'pending'])->default('pending');
            $table->timestamps();

            // Foreign key ke tabel warga
            $table->foreign('pemilik_warga_id')
                  ->references('warga_id')
                  ->on('warga');
                  // TANPA cascade atau set null, biar simple
        });
    }

    public function down()
    {
        Schema::dropIfExists('homestay');
    }
};
