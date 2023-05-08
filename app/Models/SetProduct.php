<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SetProduct extends Model
{
    use HasFactory;

    protected $table = 'set_product';

    protected $fillable = ['set_id', 'product_id', 'quantity'];
}
