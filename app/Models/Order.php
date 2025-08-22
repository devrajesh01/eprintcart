<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customer_id',
        'product_id',
        'quantity',
        'total_price',
    ];

    // Relationships
    public function customer()
    {
        return $this->belongsTo(CustomerRegsister::class, 'customer_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
