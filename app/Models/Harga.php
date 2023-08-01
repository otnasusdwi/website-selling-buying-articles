<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Harga extends Model
{
    use HasFactory;
    protected $table = 'hargas';
    protected $guarded = [];

    public function tipe_artikel()
    {
        return $this->belongsTo(TipeArtikel::class, 'tipe_artikel_id', 'id');
    }
}
