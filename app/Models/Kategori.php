<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategoris';
    protected $primaryKey = 'kodeKategori';
    public $timestamps = false;

    protected $fillable = [
        'namaKategori',
    ];

    public function bukus()
    {
        return $this->hasMany(Buku::class, 'kodeKategori', 'kodeKategori');
    }
}
