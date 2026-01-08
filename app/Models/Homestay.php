<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

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

    // TAMBAHKAN SCOPE FILTER SAMA SEPERTI DI WARGA
    public function scopeFilter(Builder $query, $request, array $filterableColumns): Builder
    {
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                $query->where($column, $request->input($column));
            }
        }
        return $query;
    }

   public function scopeSearch(Builder $query, $request, array $columns): Builder
{
    if ($request->filled('search')) {
        $query->where(function($q) use ($request, $columns) {
            foreach ($columns as $column) {
                $q->orWhere($column, 'LIKE', '%' . $request->search . '%');
            }
            // ✅ FIX: pakai $q bukan $subQuery
            $q->orWhereHas('pemilik', function($q2) use ($request) {
                $q2->where('nama', 'LIKE', '%' . $request->search . '%');
            });
        });
    }
    return $query; // ✅ JANGAN LUPA RETURN
}
}
