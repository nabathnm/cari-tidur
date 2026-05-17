<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    protected $fillable = ['user_id', 'kosan_id', 'rating', 'komentar'];

    public function user() { return $this->belongsTo(User::class); }
    public function kosan() { return $this->belongsTo(Kosan::class); }
}
