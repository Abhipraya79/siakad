<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Dosen extends Authenticatable
{
    use Notifiable;

    protected $table = 'dosen';
    protected $primaryKey = 'id_dosen';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_dosen',
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

    // Auto-hash password
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    /** Relasi: dosen memiliki banyak mahasiswa bimbingan */
    public function mahasiswaBimbingan()
    {
        return $this->hasMany(Mahasiswa::class, 'id_dosen_wali', 'id_dosen');
    }

    public function jadwal()
    {
        return $this->hasMany(JadwalKuliah::class, 'id_dosen', 'id_dosen');
    }

    public function frsApprovals()
    {
        return $this->hasMany(FRS::class, 'approved_by', 'id_dosen');
    }
}
