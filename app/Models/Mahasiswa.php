<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Mahasiswa extends Authenticatable
{
    use Notifiable;

    protected $table = 'mahasiswa';
    protected $guard = 'mahasiswa';
    protected $primaryKey = 'id_mahasiswa';    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_mahasiswa',
        'nama',
        'nrp',
        'prodi',
        'tahun_masuk',
        'username',
        'password',
        'id_dosen_wali',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Penting: inform Laravel to use 'username' for login
    public function getAuthIdentifierName()
    {
        return 'username';
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    // Auto-hash password
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id_reference', 'id_mahasiswa');
    }

    public function dosenWali()
    {
        return $this->belongsTo(Dosen::class, 'id_dosen_wali', 'id_dosen');
    }

    public function frs()
    {
        return $this->hasMany(Frs::class, 'id_mahasiswa');
    }

    public function nilai()
    {
        return $this->hasManyThrough(
            Nilai::class,
            FRS::class,
            'id_mahasiswa',
            'id_frs',
            'id_mahasiswa',
            'id_frs'
        );
    }
}
