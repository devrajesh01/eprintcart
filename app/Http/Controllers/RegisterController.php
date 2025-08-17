<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Import User model
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // Show Register Form
    public function showRegisterForm()
    {
        return view('auth.register'); 
    }
    public function showLoginForm(){
        return view('auth.login');
    }

    
}
