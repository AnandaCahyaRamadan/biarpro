<?php

namespace App\Models;

use App\Models\KategoriBisnis;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KataPembuka extends Model
{
    use HasFactory;
    protected $table = 'ref_kata_pembuka';
    protected $primaryKey = 'id';
    protected $fillable = [
        'kategori',
        'kata_pembuka',
    ];

    public function kategoris()
    {
        return $this->belongsTo(KategoriBisnis::class, 'kategori');
    }
}
