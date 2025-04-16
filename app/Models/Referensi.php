<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referensi extends Model
{
    use HasFactory;

    protected $fillable = [
        'karyawan_id',
        'nama',
        'hubungan',
        'alamat',
        'telepon',
        'profesi',
        'jabatan',
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
}
