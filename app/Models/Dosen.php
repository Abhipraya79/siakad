<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;


class Dosen extends Authenticatable
{
    use Notifiable, HasApiTokens;
    protected $table = 'dosen';
    protected $guard = 'dosen';
    protected $primaryKey = 'id_dosen';
    protected $keyType = 'int';

    protected $fillable = [
        'nama',
        'nidn',
        'bidang_studi',
        'prodi',
        'id_dosen_wali',
        'username',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

        public function user()
    {
        return $this->hasOne(User::class, 'id_reference', 'id_dosen');
    }
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class, 'id_dosen_wali');
    }

    public function jadwalMataKuliah()
    {
        return $this->hasMany(JadwalKuliah::class, 'id_dosen', 'id_dosen');
    }

       public function frsApprovals()
{
    return $this->hasMany(Frs::class, 'id_dosen_wali', 'id_dosen');
}
public function getAuthIdentifierName()
{
    return 'username';
}


}

