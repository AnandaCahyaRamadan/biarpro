<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sinonim extends Model
{
    use HasFactory;
    protected $table = 'sinonim';
    protected $primaryKey = 'id';
    protected $fillable = [
        'data',
    ];
}
