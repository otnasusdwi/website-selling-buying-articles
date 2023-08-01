<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tipe_artikel()
    {
        return $this->belongsTo(TipeArtikel::class, 'tipe_artikel_id', 'id');
    }

    public function harga()
    {
        return $this->belongsTo(Harga::class, 'harga_id', 'id');
    }

    public function penulis()
    {
        return $this->belongsTo(User::class, 'penulis_id', 'id');
    }

    public function pembeli()
    {
        return $this->belongsTo(User::class, 'pembeli_id', 'id');
    }

    public function log(){
        return $this->hasMany(Log::class, 'order_id', 'id');
    }
}
