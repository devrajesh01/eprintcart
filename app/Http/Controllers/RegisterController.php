<?php

namespace App\Http\Controllers;

use App\Models\CustomerRegsister;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    // Show Register Form
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'regex:/^[a-zA-Z\s]+$/'],
            'email' => 'required|email|unique:customer_regsisters,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $customer = CustomerRegsister::create([
            'name' => $request->name,
            'email' => $request->email,
            'user_type' => 'customer',
            'password' => Hash::make($request->password),
        ]);

        // ✅ After registration, redirect to login page
        return redirect()->route('login')
            ->with('success', 'Registration successful! Please login.');
    }

    // Show Login Form
    public function showLoginForm()
    {
        return view('auth.login');
    }
    public function showDashboard(){
        return view('admin.dashboard');
    }

    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:6',
    ]);

    // Attempt login with default "web" guard
    if (Auth::attempt($request->only('email', 'password'))) {
        $user = Auth::user();

        if ($user->user_type === 'customer') {
            return redirect()->route('home')
                ->with('success', 'Welcome, ' . $user->name);
        } elseif ($user->user_type === 'admin') {
            return redirect()->route('admin.dashboard')
                ->with('success', 'Welcome Admin, ' . $user->name);
        }
    }

    return back()->with('error', 'Invalid email or password.');
}

    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();

        // Invalidate session & regenerate token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/customer-login');
    }
}
