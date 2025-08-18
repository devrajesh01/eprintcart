<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Mass assignable fields
    protected $fillable = [
        'product_name',
        'product_category',
        'product_description',
        'product_price',
        'product_quantity',
        'product_image',
    ];
}
