<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    // ✅ Table name (optional if it follows convention)
    protected $table = 'contacts';

    // ✅ Columns that are mass assignable
    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
    ];
}