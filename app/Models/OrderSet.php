<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderSet extends Model
{
    use HasFactory;

    protected $table = 'order_set';

    protected $fillable = ['order_id', 'set_id', 'quantity'];
}
