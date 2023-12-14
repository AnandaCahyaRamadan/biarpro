<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;
// use Haruncpi\LaravelIdGenerator\IdGenerator;


class Artikel extends Model
{
    use HasFactory;
    
    protected $table = 'artikels';
    protected $primaryKey = 'id';
    protected $fillable = [
        'provinsi',
        'kabupaten',
        'kecamatan',
        'judul',
        'keyword',
        'kata_pembuka',
        'artikel',
        'keyword_tanya',
        'keyword_terkait',
        'history',
    ];

    public function provinsis()
    {
        return $this->belongsTo(Province::class, 'provinsi');
    }

    public function kabupatens()
    {
        return $this->belongsTo(Regency::class, 'kabupaten');
    }

    public function kecamatans()
    {
        return $this->belongsTo(District::class, 'kecamatan');
    }
}
