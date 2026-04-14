<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Dosen extends Model
{
    protected $table = 'dosens';
    protected $primaryKey = 'kodeDosen';
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

