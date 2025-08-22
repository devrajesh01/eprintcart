<?php

namespace App\Services;

use App\Models\Payment;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class PaymentService
{
    public function __construct()
    {
        // Set Stripe secret key from config/services.php
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    public function createPayment($data)
    {
        // 1. Create Stripe PaymentIntent
        $paymentIntent = PaymentIntent::create([
            'amount' => $data['amount'] * 100, // Stripe works in cents
            'currency' => 'usd',
            'payment_method' => $data['paymentMethodId'],
            'confirmation_method' => 'manual',
            'confirm' => true,
        ]);

        // 2. Save payment details in your database
        Payment::create([
            // 'user_id' => auth()->id(),
            'product_id' => $data['product_id'],
            'product_image' => $data['product_image'],
            'product_quantity' => $data['product_quantity'],
            'amount' => $data['amount'],
            'currency' => 'usd',
            'address' => $data['address'],
            'stripe_payment_id' => $paymentIntent->id,
            'status' => $paymentIntent->status,
        ]);

        // 3. Return Stripe response
        return $paymentIntent;
    }
}
