<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komisi extends Model
{
    use HasFactory;
    protected $table = 'komisi';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'pembayaran_id',
        'tanggal',
        'status',
    ];
}
