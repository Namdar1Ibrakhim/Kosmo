<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class ClientLogin extends Authenticatable
{
    use HasApiTokens, HasFactory;

    protected $fillable = [
        'phone',
        'code'
    ];
}
