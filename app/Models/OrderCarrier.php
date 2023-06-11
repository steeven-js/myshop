<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderCarrier extends Model
{
    use HasFactory;

    protected $fillable = [
        'carrier_id',
        'order_id',
        'name',
        'price',
        'description',
    ];
}
