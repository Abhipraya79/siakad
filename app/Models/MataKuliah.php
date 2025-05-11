<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_mata_kuliah';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_mata_kuliah',
        'kode_mata_kuliah',
        'nama_mata_kuliah',
        'sks'
    ];

    public function jadwalKuliah()
    {
        return $this->hasMany(JadwalKuliah::class, 'id_mata_kuliah', 'id_mata_kuliah');
    }
}
