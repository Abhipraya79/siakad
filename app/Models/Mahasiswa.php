<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Mahasiswa extends Authenticatable
{
    use Notifiable;

    protected $table = 'mahasiswa';
    protected $guard = 'mahasiswa';
    protected $primaryKey = 'NRP';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_mahasiswa',
        'nama',
        'nrp',
        'prodi',
        'tahun_masuk',
        'username',
        'password',
        'id_dosen_wali',
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

    /** Relasi: setiap mahasiswa punya satu user (jika pakai tabel users) */
    public function user()
    {
        return $this->hasOne(User::class, 'id_reference', 'id_mahasiswa');
    }

    /** Relasi: mahasiswa memiliki dosen wali */
    public function dosenWali()
    {
        return $this->belongsTo(Dosen::class, 'id_dosen_wali', 'id_dosen');
    }

    /** Relasi: mahasiswa membuat banyak FRS */
    public function frs()
    {
        return $this->hasMany(FRS::class, 'id_mahasiswa', 'id_mahasiswa');
    }

    /** Relasi: mahasiswa memiliki nilai melalui FRS */
    public function nilai()
    {
        return $this->hasManyThrough(
            Nilai::class,
            FRS::class,
            'id_mahasiswa', // FK di tabel frs
            'id_frs',       // FK di tabel nilai
            'id_mahasiswa', // PK di tabel mahasiswa
            'id_frs'        // PK di tabel frs
        );
    }
}
