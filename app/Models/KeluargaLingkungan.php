<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeluargaLingkungan extends Model
{
    use HasFactory;

    protected $fillable = [
        'karyawan_id',
        'hubungan',
        'nama',
        'jenis_kelamin',
        'umur',
        'pendidikan',
        'alamat',
        'profesi',
        'telepon'
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
}
