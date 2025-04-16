<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengalamanKerja extends Model
{
    use HasFactory;

    protected $fillable = [
        'karyawan_id',
        'nama_perusahaan',
        'jabatan',
        'mulai_bulan',
        'mulai_tahun',
        'sampai_bulan',
        'sampai_tahun',
        'gaji',
        'alasan_keluar'
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
}
