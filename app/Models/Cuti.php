<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuti extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'alasan',
    ];

    protected $dates = [
        'tanggal_mulai',
        'tanggal_selesai',
    ];

    // Relasi ke user yang mengajukan cuti
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke semua approval dari admin
    public function approvals()
    {
        return $this->hasMany(CutiApproval::class);
    }

    public function getStatusAttribute()
    {
        if ($this->approvals()->where('status', 'rejected')->exists()) {
            return 'rejected';
        }

        if ($this->approvals()->where('status', 'pending')->exists()) {
            return 'pending';
        }

        return 'approved';
    }

    public function scopePendingForAdmin($query, $adminId)
    {
        return $query->whereHas('approvals', function ($q) use ($adminId) {
            $q->where('user_id', $adminId)->where('status', 'pending');
        });
    }
}
