<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $table = 'invoices';
    protected $guarded = [];

    public function penulis()
    {
        return $this->belongsTo(User::class, 'penulis_id', 'id');
    }
}
