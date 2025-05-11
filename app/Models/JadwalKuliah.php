<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalKuliah extends Model
{
    protected $table = 'jadwal_kuliah';
    protected $primaryKey = 'id_jadwal';
    public $incrementing = false;
    protected $keyType = 'string';

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
        return $this->hasMany(Frs::class, 'id_jadwal_kuliah', 'id_jadwal');
    }
}
