<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kamar_homestay', function (Blueprint $table) {
            $table->id('kamar_id');
            $table->unsignedBigInteger('homestay_id');
            $table->string('nama_kamar', 100);
            $table->integer('kapasitas');
            $table->json('fasilitas_json')->nullable();
            $table->decimal('harga', 12, 2);
            $table->timestamps();

            $table->foreign('homestay_id')
                  ->references('homestay_id')
                  ->on('homestay')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('kamar_homestay');
    }
};
