<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalKuliah extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_jadwal_kuliah';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_jadwal_kuliah',
        'id_mata_kuliah',
        'id_dosen',
        'id_ruang',
        'kelas',
        'hari',
        'jam_mulai',
        'jam_selesai'
    ];

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'id_mata_kuliah', 'id_mata_kuliah');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'id_dosen', 'id_dosen');
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'id_ruang', 'id_ruang');
    }

    public function frs()
    {
        return $this->hasMany(FRS::class, 'id_jadwal_kuliah', 'id_jadwal_kuliah');
    }
}