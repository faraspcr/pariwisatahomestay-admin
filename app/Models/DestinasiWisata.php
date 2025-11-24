<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class DestinasiWisata extends Model
{
    use HasFactory;

    protected $table      = 'destinasi_wisata';
    protected $primaryKey = 'destinasi_id';

    protected $fillable = [
        'nama',
        'deskripsi',
        'alamat',
        'rt',
        'rw',
        'jam_buka',
        'tiket',
        'kontak',
    ];

    protected $casts = [
        'tiket'    => 'decimal:2',
        'jam_buka' => 'datetime:H:i',
    ];

    // Relasi ke UlasanWisata
    public function ulasan()
    {
        return $this->hasMany(UlasanWisata::class, 'destinasi_id', 'destinasi_id');
    }
// Scope untuk filter - SESUAIKAN DENGAN CONTROLLER
    public function scopeFilter(Builder $query, Request $request, array $filterableColumns): Builder
    {
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                if ($column === 'jam_buka') {
                    // Handle filter jam_buka dengan rentang waktu
                    $jamRange = $request->jam_buka;
                    if ($jamRange === 'dini_hari') {
                        $query->where('jam_buka', '>=', '00:00')->where('jam_buka', '<=', '05:59');
                    } elseif ($jamRange === 'pagi') {
                        $query->where('jam_buka', '>=', '06:00')->where('jam_buka', '<=', '10:59');
                    } elseif ($jamRange === 'siang') {
                        $query->where('jam_buka', '>=', '11:00')->where('jam_buka', '<=', '14:59');
                    } elseif ($jamRange === 'sore') {
                        $query->where('jam_buka', '>=', '15:00')->where('jam_buka', '<=', '18:59');
                    } elseif ($jamRange === 'malam') {
                        $query->where('jam_buka', '>=', '19:00')->where('jam_buka', '<=', '23:59');
                    }
                } else {
                    $query->where($column, $request->input($column));
                }
            }
        }
        return $query;
    }


    public function scopeSearch($query, $request, array $columns)
{
    if ($request->filled('search')) {
        $query->where(function ($q) use ($request, $columns) {
            foreach ($columns as $column) {
                if ($column === 'tiket') {
                    // Handle numeric search untuk tiket
                    if (is_numeric($request->search)) {
                        $q->orWhere($column, '=', $request->search);
                    }
                } else {
                    $q->orWhere($column, 'LIKE', '%' . $request->search . '%');
                }
            }
        });
    }
}
}
