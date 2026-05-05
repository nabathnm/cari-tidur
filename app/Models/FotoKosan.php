<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FotoKosan extends Model
{
    protected $fillable = ['kosan_id', 'foto', 'is_utama'];

    public function kosan()
    {
        return $this->belongsTo(Kosan::class);
    }
}
