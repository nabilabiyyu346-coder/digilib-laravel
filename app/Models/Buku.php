<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = 'bukus';
    protected $primaryKey = 'kodeBuku';
    public $timestamps = false;

    protected $fillable = [
        'judul',
        'kodePenerbit',
        'kodePengarang',
        'tahun',
        'edisi',
        'issn_isbn',
        'seri',
        'abstraksi',
        'kodeKategori',
        'tglInput',
        'tglUpdate',
        'image',
        'lastUpdateBy',
        'stok',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kodeKategori', 'kodeKategori');
    }

    public function pengarang()
    {
        return $this->belongsTo(Pengarang::class, 'kodePengarang', 'kodePengarang');
    }

    public function penerbit()
    {
        return $this->belongsTo(Penerbit::class, 'kodePenerbit', 'kodePenerbit');
    }

    public function pinjamDetails()
    {
        return $this->hasMany(PinjamDetail::class, 'kodeBuku', 'kodeBuku');
    }
}
