<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'jenis',
        'waktu',
        'alasan',
        'bukti',
        'status',
        'waktu_mulai',
        'waktu_selesai',
    ];

    protected $casts = [
        'waktu' => 'datetime',
        'waktu_mulai' => 'datetime', // Menambahkan waktu_mulai
        'waktu_selesai' => 'datetime', // Menambahkan waktu_selesai
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
