<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    protected $table = 'pembayaran';
    protected $primaryKey = 'id';
    protected $fillable = [
        'order_id',
        'user_id',
        'total_pembayaran',
        'metode_pembayaran',
        'tanggal_pembayaran',
        'status',
        'tokens',
        'tanggal_kadaluwarsa',
    ];
}
