<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_dosen';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_dosen',
        'nama',
        'ndin',
        'bidang_studi',
        'prodi',
        'is_dosen_wali',
        'username',
        'password'
    ];

    protected $hidden = [
        'password',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id_reference', 'id_dosen');
    }

    public function mahasiswas()
    {
        return $this->hasMany(Mahasiswa::class, 'id_dosen_wali', 'id_dosen');
    }

    public function jadwalKuliah()
    {
        return $this->hasMany(JadwalKuliah::class, 'id_dosen', 'id_dosen');
    }

    public function frsWali()
    {
        return $this->hasMany(FRS::class, 'id_dosen_wali', 'id_dosen');
    }
}