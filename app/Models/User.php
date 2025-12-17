<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'profile_picture',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Add accessor to array
     */
    protected $appends = ['profile_photo_url'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * ✅ PERBAIKAN: Accessor untuk URL foto profil (seperti temanmu)
     */
    public function getProfilePhotoUrlAttribute()
    {
        if ($this->profile_picture) {
            // ✅ CARA BENAR: Pakai asset('storage/' . path)
            return asset('storage/' . $this->profile_picture);
        }

        // Return default avatar jika tidak ada foto
        return $this->getDefaultAvatarUrl();
    }

    /**
     * Avatar default SVG
     */
    private function getDefaultAvatarUrl()
    {
        $svg = '<?xml version="1.0" encoding="UTF-8"?>
        <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100">
            <circle cx="50" cy="35" r="20" fill="#e0e0e0" stroke="#dee2e6" stroke-width="1"/>
            <ellipse cx="50" cy="75" rx="25" ry="20" fill="#e0e0e0" stroke="#dee2e6" stroke-width="1"/>
        </svg>';

        return 'data:image/svg+xml;base64,' . base64_encode($svg);
    }

    /**
     * ✅ Role checking methods
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isPemilik(): bool
    {
        return $this->role === 'pemilik';
    }

    public function isWarga(): bool
    {
        return $this->role === 'warga';
    }

    /**
     * ✅ Scope untuk filter
     */
    public function scopeFilter(Builder $query, $request, array $filterableColumns): Builder
    {
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                if ($column === 'urutan') {
                    switch ($request->urutan) {
                        case 'terbaru':
                            $query->orderBy('created_at', 'desc');
                            break;
                        case 'terlama':
                            $query->orderBy('created_at', 'asc');
                            break;
                        case 'nama_asc':
                            $query->orderBy('name', 'asc');
                            break;
                        case 'nama_desc':
                            $query->orderBy('name', 'desc');
                            break;
                    }
                } else {
                    $query->where($column, $request->input($column));
                }
            }
        }

        if (!$request->filled('urutan')) {
            $query->orderBy('created_at', 'desc');
        }

        return $query;
    }

    /**
     * ✅ Scope untuk search
     */
    public function scopeSearch(Builder $query, $request, array $columns): Builder
    {
        if ($request->filled("search")) {
            $query->where(function($q) use ($request, $columns) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', '%' . $request->search . '%');
                }
            });
        }
        return $query;
    }
}
