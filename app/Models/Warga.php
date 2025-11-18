<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{
    use HasFactory;

    protected $table = 'warga';
    protected $primaryKey = 'warga_id';

    protected $fillable = [
        'no_ktp',
        'nama',
        'jenis_kelamin',
        'agama',
        'pekerjaan',
        'telp',
        'email',
    ];

    public $timestamps = true;

    // Tambahkan relasi ke UlasanWisata
    public function ulasanWisata()
    {
        return $this->hasMany(UlasanWisata::class, 'warga_id', 'warga_id');
    }
}
