<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Mass assignable fields
    protected $fillable = [
        'product_name',
        'product_category',
        'customize_image',
        'product_type',
        'product_description',
        'product_price',
        'product_quantity',
        'product_image',
        'product_tags',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
