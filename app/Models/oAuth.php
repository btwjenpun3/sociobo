<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class oAuth extends Model
{
    use HasFactory;

    protected $protected = [   
        'id'
    ];
}
