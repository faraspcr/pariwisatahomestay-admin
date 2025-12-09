<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KamarHomestay extends Model
{
    use HasFactory;

    protected $primaryKey = 'kamar_id';
    protected $table = 'kamar_homestay';

    protected $fillable = [
        'homestay_id',
        'nama_kamar',
        'kapasitas',
        'fasilitas_json',
        'harga'
    ];

    protected $casts = [
        'fasilitas_json' => 'array',
        'harga' => 'decimal:2'
    ];

    // Relasi ke Homestay
    public function homestay()
    {
        return $this->belongsTo(Homestay::class, 'homestay_id', 'homestay_id');
    }

    // SCOPE UNTUK FILTER DAN SEARCH
    public function scopeFilter($query, $request, array $filterableColumns)
    {
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                $query->where($column, $request->input($column));
            }
        }
        return $query;
    }

    public function scopeSearch($query, $request, array $searchableColumns)
    {
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request, $searchableColumns) {
                foreach ($searchableColumns as $column) {
                    $q->orWhere($column, 'LIKE', '%' . $request->search . '%');
                }
            });
        }
        return $query;
    }
}
