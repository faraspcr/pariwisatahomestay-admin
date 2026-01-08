<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

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
        'fasilitas_json' => 'array', // ✅ CAST KE ARRAY
        'harga' => 'decimal:2',
        'kapasitas' => 'integer'
    ];

    // ============ RELASI ============

    // Relasi ke Homestay (HANYA SATU!)
    public function homestay()
    {
        return $this->belongsTo(Homestay::class, 'homestay_id', 'homestay_id');
    }

    // Relasi ke Booking
    public function bookings()
    {
        return $this->hasMany(BookingHomestay::class, 'kamar_id', 'kamar_id');
    }

    // ============ SCOPE ============

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
                $q->orWhereHas('homestay', function($q2) use ($request) {
                    $q2->where('nama', 'LIKE', '%' . $request->search . '%');
                });
            });
        }
        return $query;
    }

    // ============ ACCESSOR & MUTATOR UNTUK FASILITAS_JSON ============
    // ✅ JAGA GET/SET FASILITAS TETAP ADA!

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

    // ============ HELPER METHOD ============

    /**
     * Cek apakah kamar tersedia untuk tanggal tertentu
     */
    public function isAvailableForDates($checkin, $checkout, $excludeBookingId = null)
    {
        $query = $this->bookings()
            ->where('status', '!=', 'cancelled')
            ->where(function($q) use ($checkin, $checkout) {
                $q->whereBetween('checkin', [$checkin, $checkout])
                  ->orWhereBetween('checkout', [$checkin, $checkout])
                  ->orWhere(function($q2) use ($checkin, $checkout) {
                      $q2->where('checkin', '<=', $checkin)
                         ->where('checkout', '>=', $checkout);
                  });
            });

        if ($excludeBookingId) {
            $query->where('booking_id', '!=', $excludeBookingId);
        }

        return $query->count() === 0;
    }

    /**
     * Format harga dengan Rupiah
     */
    public function getHargaFormattedAttribute()
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }

    /**
     * Format fasilitas sebagai string
     */
    public function getFasilitasStringAttribute()
    {
        $fasilitas = $this->fasilitas_json;
        if (empty($fasilitas)) {
            return 'Tidak ada fasilitas khusus';
        }

        return implode(', ', $fasilitas);
    }
}
