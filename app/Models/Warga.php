<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

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

    // ✅ RELASI KE USER (SANGAT PENTING!)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // ✅ RELASI KE HOMESTAY (untuk pemilik)
    public function homestays()
    {
        return $this->hasMany(Homestay::class, 'pemilik_warga_id', 'warga_id');
    }

    // ✅ RELASI KE BOOKING (untuk warga yang booking)
    public function bookings()
    {
        return $this->hasMany(BookingHomestay::class, 'warga_id', 'warga_id');
    }

    // Relasi ke UlasanWisata
    public function ulasanWisata()
    {
        return $this->hasMany(UlasanWisata::class, 'warga_id', 'warga_id');
    }

    // Scope Filter untuk filtering data
    public function scopeFilter(Builder $query, $request, array $filterableColumns): Builder
    {
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                $query->where($column, $request->input($column));
            }
        }
        return $query;
    }

    // Scope Search untuk pencarian data
    public function scopeSearch(Builder $query, $request, array $columns): Builder
    {
        if ($request->filled('search')) {
            $query->where(function($q) use ($request, $columns) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', '%' . $request->search . '%');
                }
            });
        }
        return $query;
    }
}

