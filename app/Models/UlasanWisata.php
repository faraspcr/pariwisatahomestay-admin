<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UlasanWisata extends Model
{
    use HasFactory;

    protected $table = 'ulasan_wisata';
    protected $primaryKey = 'ulasan_id';

    protected $fillable = [
        'destinasi_id',
        'warga_id',
        'rating',
        'komentar',
        'waktu'
    ];

    protected $casts = [
        'waktu' => 'datetime',
        'rating' => 'integer'
    ];

    // Relasi ke DestinasiWisata
    public function destinasi()
    {
        return $this->belongsTo(DestinasiWisata::class, 'destinasi_id', 'destinasi_id');
    }

    // Relasi ke Warga
    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id', 'warga_id');
    }
}
