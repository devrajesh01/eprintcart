<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class PaymentController extends Controller
{
    // Show payment form
    public function index()
    {
        return view('payment');
    }

    // Handle payment
    public function createPayment(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'payment_method_id' => 'required|string',
        ]);

        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $paymentIntent = PaymentIntent::create([
                'amount' => $request->amount * 100, // amount in cents
                'currency' => 'usd',
                'payment_method' => $request->payment_method_id,
                'confirmation_method' => 'manual',
                'confirm' => true,
            ]);

            return response()->json(['success' => true, 'paymentIntent' => $paymentIntent]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
