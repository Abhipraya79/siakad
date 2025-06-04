<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';
    protected $primaryKey = 'id_bayar';
    protected $fillable = [
        'token',
        'kode_bayar',
        'id_mahasiswa',
        'id_frs',
        'tanggal_bayar',
        'status_pembayaran',
    ];
}
