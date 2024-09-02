<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfirmationTokens extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'setting_key',
        'token',
        'method',
        'is_confirmed',
        'expires_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isExpired()
    {
        return $this->expires_at->isPast();
    }
}
