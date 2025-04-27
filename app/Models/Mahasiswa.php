<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_mahasiswa';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_mahasiswa',
        'nama',
        'nfp',
        'prodi',
        'tahun_masuk',
        'username',
        'password',
        'id_dosen_wali'
    ];

    protected $hidden = [
        'password',
    ];

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