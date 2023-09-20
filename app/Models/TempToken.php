<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempToken extends Model
{
    use HasFactory;

    protected $fillable = [   
        'user_id',
        'oauth_token',
        'oauth_token_secret'
    ];
}
