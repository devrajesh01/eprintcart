<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // instead of Model
use Illuminate\Notifications\Notifiable;

class CustomerRegsister extends Authenticatable
{
    use Notifiable;

    protected $table = 'customer_regsisters'; // table name

    protected $fillable = [
        'name',
        'email',
        'user_type',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function orders()
{
    return $this->hasMany(Order::class, 'customer_id');
}

}
