<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'profile_photo',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

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
     * Helper method untuk cek role
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
     * Get profile photo URL
     */
    public function getProfilePhotoUrlAttribute()
    {
        if ($this->profile_photo) {
            return asset('storage/profile_user/' . $this->profile_photo);
        }
        return null;
    }

    /**
     * Scope untuk filter
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
                        case 'role':
                            $query->orderBy('role', $request->input('role'));
                            break;
                    }
                } else {
                    // Handle filter biasa
                    $query->where($column, $request->input($column));
                }
            }
        }

        // Default ordering jika tidak ada filter
        if (!$request->filled('urutan')) {
            $query->orderBy('created_at', 'desc');
        }

        return $query;
    }

    /**
     * Scope untuk search
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
