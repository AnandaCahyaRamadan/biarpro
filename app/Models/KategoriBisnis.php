<?php

namespace App\Models;

use App\Models\KataPembuka;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriBisnis extends Model
{
    use HasFactory;

    protected $table = 'kategori_bisnis';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
    ];
    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function kata_pembuka()
    {
        return $this->belongsTo(KataPembuka::class, 'id');
    }
}
