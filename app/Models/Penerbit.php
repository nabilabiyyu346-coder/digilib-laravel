<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penerbit extends Model
{
    protected $table = 'penerbits';
    protected $primaryKey = 'kodePenerbit';
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'alamat',
        'telp',
        'email',
    ];

    public function bukus()
    {
        return $this->hasMany(Buku::class, 'kodePenerbit', 'kodePenerbit');
    }
}
