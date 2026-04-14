<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PinjamDetail extends Model
{
    protected $table = 'pinjam_details';
    protected $primaryKey = 'kodePinjamDetail';
    public $timestamps = false;

    protected $fillable = [
        'kodePinjam',
        'kodeBuku',
    ];

    public function pinjam()
    {
        return $this->belongsTo(Pinjam::class, 'kodePinjam', 'kodePinjam');
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'kodeBuku', 'kodeBuku');
    }
}

