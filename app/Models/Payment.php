<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'product_image',
        'product_quantity',
        'amount',
        'currency',
        'address',
        'payment_method',
        'transaction_id',
        'status',
    ];

    protected $casts = [
        'product_id' => 'array',
        'product_quantity' => 'array',
        'product_image' => 'array', // since you also store images as JSON
    ];
}
