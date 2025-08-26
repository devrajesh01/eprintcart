<?php

namespace App\Http\Controllers;

use App\Models\CustomerRegsister;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;


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
            'phone' => 'required|digits:10',
            'password' => 'required|min:6|confirmed',
        ]);

        $customer = CustomerRegsister::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
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
    public function showDashboard()
    {
        return view('admin.dashboard');
    }

    //     public function login(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required|min:6',
    //     ]);

    //     // Attempt login with default "web" guard
    //     if (Auth::attempt($request->only('email', 'password'))) {
    //         $user = Auth::user();

    //         if ($user->user_type === 'customer') {
    //             return redirect()->route('home')
    //                 ->with('success', 'Welcome, ' . $user->name);
    //         } elseif ($user->user_type === 'admin') {
    //             return redirect()->route('admin.dashboard')
    //                 ->with('success', 'Welcome Admin, ' . $user->name);
    //         }
    //     }

    //     return back()->with('error', 'Invalid email or password.');
    // }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::validate($request->only('email', 'password'))) {
            // Find customer by email (your table)
            $user = CustomerRegsister::where('email', $request->email)->first();

            if (!$user) {
                return back()->with('error', 'Customer not found.');
            }

            // Generate OTP
            $otp = rand(100000, 999999);
            Cache::put('otp_' . $user->id, $otp, now()->addMinutes(5));

            // Send OTP to email
            Mail::to($user->email)->send(new OtpMail($otp));

            // Store id in session until verified
            session(['otp_user_id' => $user->id]);

            return redirect()->route('otp.form')->with('success', 'OTP sent to your email.');
        }

        return back()->with('error', 'Invalid email or password.');
    }





    public function showOtpForm()
    {
        return view('auth.verify-otp');
    }



    public function verifyOtp(Request $request)
    {
        $request->validate(['otp' => 'required|numeric']);

        $userId = session('otp_user_id');
        $cachedOtp = Cache::get('otp_' . $userId);

        if ($cachedOtp && $cachedOtp == $request->otp) {
            $user = CustomerRegsister::find($userId);

            if (!$user) {
                return redirect()->route('login')->with('error', 'User not found.');
            }

            // ✅ Log the customer in
            Auth::login($user);

            // 🧹 Cleanup OTP & session
            Cache::forget('otp_' . $userId);
            session()->forget('otp_user_id');

            // 🔀 Role-based redirection
            if ($user->user_type === 'customer') {
                return redirect()->route('home')
                    ->with('success', 'Welcome, ' . $user->name . ' 🎉');
            } elseif ($user->user_type === 'admin') {
                return redirect()->route('admin.dashboard')
                    ->with('success', 'Welcome Admin, ' . $user->name . ' 🎉');
            } else {
                // default fallback
                return redirect()->route('home')->with('success', 'Login successful 🎉');
            }
        }

        return back()->with('error', 'Invalid or expired OTP.');
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
