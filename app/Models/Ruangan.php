<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_ruang';
    protected $keyType = 'int';

    protected $fillable = [
        'id_ruang',
        'kode_ruang',
        'nama_ruang',
        'kapasitas_ruang'
    ];

    public function jadwalKuliah()
    {
        return $this->hasMany(JadwalKuliah::class, 'id_ruang', 'id_ruang');
    }
}