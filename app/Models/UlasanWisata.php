<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

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

    // Scope Search
    public function scopeSearch(Builder $query, $request, array $columns): Builder
    {
        if ($request->filled('search')) {
            $query->where(function($q) use ($request, $columns) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', '%' . $request->search . '%');
                }
                // Search berdasarkan nama destinasi (relasi)
                $q->orWhereHas('destinasi', function($q2) use ($request) {
                    $q2->where('nama', 'LIKE', '%' . $request->search . '%');
                });
                // Search berdasarkan nama warga (relasi)
                $q->orWhereHas('warga', function($q2) use ($request) {
                    $q2->where('nama', 'LIKE', '%' . $request->search . '%');
                });
            });
        }
        return $query;
    }
}
