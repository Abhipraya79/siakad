<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class Mahasiswa extends Authenticatable
{
    use Notifiable;
    use HasApiTokens;

    protected $table = 'mahasiswa';
    protected $guard = 'mahasiswa';
    protected $primaryKey = 'id_mahasiswa';
    protected $keyType = 'int';

    protected $fillable = [
        'nama',
        'nrp',
        'prodi',
        'tahun_masuk',
        'username',
        'password'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

  
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
        return $this->hasMany(FRS::class, 'id_mahasiswa', 'id_mahasiswa');
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
