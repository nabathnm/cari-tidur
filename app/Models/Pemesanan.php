<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    protected $fillable = ['user_id', 'kosan_id', 'tanggal_masuk', 'durasi_bulan', 'total_harga', 'status', 'catatan'];

    public function user() { return $this->belongsTo(User::class, 'user_id'); }
    public function kosan() { return $this->belongsTo(Kosan::class); }
}
