<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = ['name', 'email', 'password', 'role', 'no_hp', 'alamat', 'foto_profil'];

    // Cek role
    public function isPemilik(): bool { return $this->role === 'pemilik'; }
    public function isPencari(): bool { return $this->role === 'pencari'; }

    // Relasi
    public function kosans() { return $this->hasMany(Kosan::class); }
    public function pemesanans() { return $this->hasMany(Pemesanan::class); }
    public function ulasans() { return $this->hasMany(Ulasan::class); }
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
}
