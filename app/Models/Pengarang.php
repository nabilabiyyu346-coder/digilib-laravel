<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengarang extends Model
{
    protected $table = 'pengarangs';
    protected $primaryKey = 'kodePengarang';
    public $timestamps = false;

    protected $fillable = [
        'nama',
    ];

    public function bukus()
    {
        return $this->hasMany(Buku::class, 'kodePengarang', 'kodePengarang');
    }
}
