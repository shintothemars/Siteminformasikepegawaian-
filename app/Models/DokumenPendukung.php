<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenPendukung extends Model
{
    use HasFactory;

    protected $fillable = [
        'karyawan_id',
        'nama_dokumen',
        'file_path'
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
}
