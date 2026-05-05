<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// app/Models/Kosan.php
class Kosan extends Model
{
    protected $fillable = [
        'user_id', 'nama_kosan', 'deskripsi', 'alamat', 'kota',
        'harga_per_bulan', 'jumlah_kamar', 'kamar_tersedia',
        'tipe', 'fasilitas', 'status'
    ];

    protected $casts = ['fasilitas' => 'array'];

    public function pemilik() { return $this->belongsTo(User::class, 'user_id'); }
    public function fotos() { return $this->hasMany(FotoKosan::class); }
    public function fotoUtama() { return $this->hasOne(FotoKosan::class)->where('is_utama', true); }
    public function pemesanans() { return $this->hasMany(Pemesanan::class); }
    public function ulasans() { return $this->hasMany(Ulasan::class); }
    public function ratingRata() { return $this->ulasans()->avg('rating'); }
}