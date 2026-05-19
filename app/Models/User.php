<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'no_hp',
        'alamat',
        'foto_profil'
    ];

    // Cek role
    public function isPemilik(): bool
    {
        return $this->role === 'pemilik';
    }

    public function isUser(): bool
    {
        return $this->role === 'user';
    }

    // Relasi
    public function kosans()
    {
        return $this->hasMany(Kosan::class);
    }

    public function pemesanans()
    {
        return $this->hasMany(Pemesanan::class);
    }

    public function ulasans()
    {
        return $this->hasMany(Ulasan::class);
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}