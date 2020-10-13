<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExpiredTokens extends Model
{
    protected $fillable = [
        'jwt_token'
    ];
}
