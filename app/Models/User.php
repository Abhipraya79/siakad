<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmailContract
{
    use HasApiTokens, HasFactory, Notifiable, MustVerifyEmailTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'user';
    protected $fillable = [
        'username',
        'password',
        'role',         // mahasiswa/dosen
        'id_reference', // id mahasiswa atau id dosen
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
    ];
    
    /**
     * Scope untuk query mahasiswa
     */
    public function scopeMahasiswa($query)
    {
        return $query->where('role', 'mahasiswa');
    }

    /**
     * Scope untuk query dosen
     */
    public function scopeDosen($query)
    {
        return $query->where('role', 'dosen');
    }

    /**
     * Relasi ke model Mahasiswa (jika role mahasiswa)
     */
    public function mahasiswa() {
    return $this->belongsTo(Mahasiswa::class, 'id_reference', 'id_mahasiswa');
}


    /**
     * Relasi ke model Dosen (jika role dosen)
     */
    public function dosen()
    {
        return $this->hasOne(Dosen::class, 'id_dosen', 'id_reference');
    }
    /**
     * Get the name of the unique identifier for the user.
     */
    public function getAuthIdentifierName()
    {
        return 'username';
    }

    /**
     * Cek apakah user adalah mahasiswa
     */
    public function isMahasiswa()
    {
        return $this->role === 'mahasiswa';
    }

    /**
     * Cek apakah user adalah dosen
     */
    public function isDosen()
    {
        return $this->role === 'dosen';
    }
}
