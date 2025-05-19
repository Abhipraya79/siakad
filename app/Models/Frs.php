<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Frs extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_frs';
    public $incrementing = false;
    protected $keyType = 'int';

    protected $fillable = [
        'id_frs',
        'id_mahasiswa',
        'id_jadwal_kuliah',
        'id_dosen_wali',
        'status_acc',
        'semester'
    ];

    protected $casts = [
        'status_acc' => 'string', // pending, approved, rejected
        'semester' => 'integer'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa', 'id_mahasiswa');
    }

    public function jadwalKuliah()
    {
        return $this->belongsTo(JadwalKuliah::class, 'id_jadwal_kuliah', 'id_jadwal_kuliah');
    }

    public function dosenWali()
    {
        return $this->belongsTo(Dosen::class, 'id_dosen_wali', 'id_dosen');
    }

    public function nilai()
    {
        return $this->hasOne(Nilai::class, 'id_frs', 'id_frs');
    }

    public function scopePending($query)
    {
        return $query->where('status_acc', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status_acc', 'approved');
    }

    public function scopeRejected($query)
    {
        return $query->where('status_acc', 'rejected');
    }
}