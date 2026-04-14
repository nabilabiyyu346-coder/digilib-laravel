<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswas';
    protected $primaryKey = 'kodeMhs';
    public $timestamps = false;

    protected $fillable = [
        'username',
        'password',
        'nama',
        'email',
        'dateInput',
        'dateUpdate',
        'tempatLahir',
        'tanggalLahir',
        'alamat',
        'image',
        'jurusan',
        'uuid',
        'gambar_profil',
    ];

    protected $hidden = [
        'password',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            if (!$model->uuid) {
                $model->uuid = Str::uuid();
            }
        });
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}

