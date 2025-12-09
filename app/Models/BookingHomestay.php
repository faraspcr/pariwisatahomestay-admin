<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingHomestay extends Model
{
    use HasFactory;

    protected $primaryKey = 'booking_id';
    protected $table = 'booking_homestay';

    protected $fillable = [
        'kamar_id',
        'warga_id',
        'checkin',
        'checkout',
        'total',
        'status',
        'metode_bayar'
    ];

    protected $casts = [
        'checkin' => 'date',
        'checkout' => 'date',
        'total' => 'decimal:2'
    ];

    // Relasi ke Kamar Homestay
    public function kamar()
    {
        return $this->belongsTo(KamarHomestay::class, 'kamar_id', 'kamar_id');
    }

    // Relasi ke Warga
    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id', 'warga_id');
    }

    // Relasi ke Homestay (via Kamar)
    public function homestay()
    {
        return $this->hasOneThrough(
            Homestay::class,
            KamarHomestay::class,
            'kamar_id', // Foreign key pada KamarHomestay
            'homestay_id', // Foreign key pada Homestay
            'kamar_id', // Local key pada BookingHomestay
            'homestay_id' // Local key pada KamarHomestay
        );
    }

    // SCOPE UNTUK FILTER DAN SEARCH
    public function scopeFilter($query, $request, array $filterableColumns)
    {
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                if ($column === 'tanggal') {
                    $query->whereDate('checkin', '<=', $request->tanggal)
                          ->whereDate('checkout', '>=', $request->tanggal);
                } else {
                    $query->where($column, $request->input($column));
                }
            }
        }
        return $query;
    }

    public function scopeSearch($query, $request, array $searchableColumns)
    {
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request, $searchableColumns) {
                foreach ($searchableColumns as $column) {
                    if ($column === 'warga_nama') {
                        $q->orWhereHas('warga', function ($subQuery) use ($request) {
                            $subQuery->where('nama', 'LIKE', '%' . $request->search . '%');
                        });
                    } else {
                        $q->orWhere($column, 'LIKE', '%' . $request->search . '%');
                    }
                }
            });
        }
        return $query;
    }

    // Hitung jumlah hari
    public function getJumlahHariAttribute()
    {
        return $this->checkin->diffInDays($this->checkout);
    }

    // Cek apakah booking aktif
    public function getIsAktifAttribute()
    {
        $today = now()->format('Y-m-d');
        return $this->checkin <= $today && $this->checkout >= $today;
    }
}
