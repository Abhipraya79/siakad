<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;
    protected $table = 'nilai';
    protected $primaryKey = 'id_nilai';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_nilai',
        'id_frs',
        'nilai_angka',
        'nilai_huruf'
    ];

    public function frs()
    {
        return $this->belongsTo(FRS::class, 'id_frs', 'id_frs');
    }

    public function mahasiswa()
    {
        return $this->hasOneThrough(
            Mahasiswa::class,
            FRS::class,
            'id_frs',
            'id_mahasiswa',
            'id_frs',
            'id_mahasiswa'
        );
    }

    public function mataKuliah()
    {
        return $this->hasOneThrough(
            MataKuliah::class,
            JadwalKuliah::class,
            'id_jadwal_kuliah',
            'id_mata_kuliah',
            'id_frs',
            'id_mata_kuliah'
        )->through('frs');
    }
}