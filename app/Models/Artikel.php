<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Artikel extends Model
{
    use HasFactory;
    protected $table = 'artikels';
    protected $guarded = [];
    protected $fillable = ['penulis_id', 'tipe_artikel_id', 'artikel'];

    public function getIncrementing()
    {
        return false;
    }


    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    public function penulis()
    {
        return $this->belongsTo(User::class, 'penulis_id', 'id');
    }

    public function tipe_artikel()
    {
        return $this->belongsTo(TipeArtikel::class, 'tipe_artikel_id', 'id');
    }
}
