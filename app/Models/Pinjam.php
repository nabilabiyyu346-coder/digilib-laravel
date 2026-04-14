<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pinjam extends Model
{
    protected $table = 'pinjams';
    protected $primaryKey = 'kodePinjam';
    public $timestamps = false;

    protected $fillable = [
        'kodePinjam',
        'kodePetugas',
        'kodePeminjam',
        'tipePeminjam',
        'tglPinjam',
        'tglKembali',
        'keterangan',
        'status',
    ];

    protected $casts = [
        'tglPinjam' => 'datetime',
        'tglKembali' => 'datetime',
        'status' => 'integer',
    ];

    public function pinjamDetails()
    {
        return $this->hasMany(PinjamDetail::class, 'kodePinjam', 'kodePinjam');
    }
}

