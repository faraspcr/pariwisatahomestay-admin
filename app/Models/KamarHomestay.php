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

    /**
     * Accessor untuk fasilitas_json
     * Memastikan selalu return array
     */
    public function getFasilitasJsonAttribute($value)
    {
        // Jika value null atau kosong
        if (empty($value)) {
            return [];
        }

        // Jika sudah array
        if (is_array($value)) {
            return $value;
        }

        // Jika string JSON
        if (is_string($value)) {
            $decoded = json_decode($value, true);
            return is_array($decoded) ? $decoded : [];
        }

        return [];
    }

    /**
     * Mutator untuk fasilitas_json
     * Selalu simpan sebagai JSON string
     */
    public function setFasilitasJsonAttribute($value)
    {
        if (empty($value)) {
            $this->attributes['fasilitas_json'] = null;
            return;
        }

        if (is_array($value)) {
            $this->attributes['fasilitas_json'] = json_encode($value);
        } elseif (is_string($value)) {
            // Coba decode untuk validasi
            $decoded = json_decode($value, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                $this->attributes['fasilitas_json'] = json_encode($decoded);
            } else {
                // Jika bukan JSON valid, simpan sebagai string kosong
                $this->attributes['fasilitas_json'] = json_encode([]);
            }
        } else {
            $this->attributes['fasilitas_json'] = json_encode([]);
        }
    }
}
