<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CutiApproval extends Model
{
    use HasFactory;

    protected $fillable = [
        'cuti_id',
        'user_id',
        'status',
        'catatan',
    ];

    public function cuti()
    {
        return $this->belongsTo(Cuti::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
