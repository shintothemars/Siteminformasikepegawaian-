<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Karyawan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'foto_profil',
        'jabatan',
        'nama_panggilan',
        'tempat_lahir',
        'tanggal_lahir',
        'golongan_darah',
        'agama',
        'alamat',
        'no_hp',
        'status',
        'jumlah_anak',
        'tinggi_badan',
        'berat_badan',
        'no_ktp',
        'ktp_berlaku_sampai',
        'tinggal_dengan_keluarga',
        'anak_ke',
        'darurat_nama',
        'darurat_hubungan',
        'darurat_telepon',
        'darurat_alamat',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function keluargaLingkungan()
    {
        return $this->hasMany(KeluargaLingkungan::class);
    }

    public function pengalamanKerja()
    {
        return $this->hasMany(PengalamanKerja::class);
    }

    public function referensi()
    {
        return $this->hasMany(Referensi::class);
    }

    public function dokumenPendukung()
    {
        return $this->hasMany(DokumenPendukung::class);
    }
}
