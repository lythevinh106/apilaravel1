<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'token',
        'refresh_token',
        'user_id',
        'token_expired',
        "refresh_token_expired"
    ];
}
