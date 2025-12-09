<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Homestay extends Model
{
    use HasFactory;

    protected $primaryKey = 'homestay_id';
    protected $table = 'homestay';

    protected $fillable = [
        'pemilik_warga_id',
        'nama',
        'alamat',
        'rt',
        'rw',
        'fasilitas_json',
        'harga_per_malam',
        'status'
    ];

    protected $casts = [
        'fasilitas_json' => 'array',
        'harga_per_malam' => 'decimal:2'
    ];

    public function pemilik()
    {
        return $this->belongsTo(Warga::class, 'pemilik_warga_id', 'warga_id');
    }
}
