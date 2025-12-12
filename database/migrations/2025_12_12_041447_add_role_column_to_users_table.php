<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Tambah kolom role dengan 3 pilihan
            $table->enum('role', ['admin', 'pemilik', 'warga'])->default('warga')->after('password');
            // Tambah kolom profile_photo
            $table->string('profile_photo')->nullable()->after('role');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'profile_photo']);
        });
    }
};
