<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartSet extends Model
{
    use HasFactory;

    protected $fillable = ['cart_id', 'set_id', 'quantity'];

}
