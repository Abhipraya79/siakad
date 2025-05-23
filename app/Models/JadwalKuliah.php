<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalKuliah extends Model
{
    protected $table = 'jadwal_kuliah';
    public $incrementing = false;
    protected $keyType = 'int';

    protected $fillable = [
        'id_jadwal',
        'id_mata_kuliah',
        'id_dosen',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'ruangan',
        'semester',
    ];

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'id_mata_kuliah', 'id_mata_kuliah');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'id_dosen', 'id_dosen');
    }

    public function frs()
    {
        return $this->hasMany(FRS::class, 'id_jadwal', 'id_jadwal');
    }

    public function ruangan()
    {
    return $this->belongsTo(Ruangan::class, 'id_ruangan', 'id_ruangan');
    }

}
