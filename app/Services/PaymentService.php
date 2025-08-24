<?php
namespace App\Services;

use App\Models\Payment;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class PaymentService
{
    public function __construct()
    {
        // Load Stripe secret from config/services.php
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    /**
     * Create a payment (COD or Stripe).
     *
     * @param array $payload
     * @return array
     */
    public function createPayment(array $payload)
    {
        // 1️⃣ COD flow (no Stripe)
        if ($payload['paymentMethodId'] === 'cod') {
            $payment = Payment::create([
                'user_id'           => $payload['user_id'],
                'product_id'        => $payload['product_id'],
                'product_image'     => $payload['product_image'] ?? null,
                'product_quantity'  => $payload['product_quantity'],
                'amount'            => $payload['amount'],
                'currency'          => $payload['currency'] ?? 'usd',
                'address'           => $payload['address'],
                'stripe_payment_id' => null,
                'status'            => 'pending',
            ]);

            return [
                'type'    => 'cod',
                'payment' => $payment,
            ];
        }

        // 2️⃣ Stripe flow (expects pm_xxx from Stripe.js)
        $paymentIntent = PaymentIntent::create([
            'amount'              => (int) round($payload['amount'] * 100), // in cents
            'currency'            => $payload['currency'] ?? 'usd',
            'payment_method'      => $payload['paymentMethodId'],
            'confirmation_method' => 'manual',
            'confirm'             => true,
        ]);

        $payment = Payment::create([
            'user_id'           => $payload['user_id'],
            'product_id'        => $payload['product_id'],
            'product_image'     => $payload['product_image'] ?? null,
            'product_quantity'  => $payload['product_quantity'],
            'amount'            => $payload['amount'],
            'currency'          => $payload['currency'] ?? 'usd',
            'address'           => $payload['address'],
            'stripe_payment_id' => $paymentIntent->id,
            'status'            => $paymentIntent->status, // succeeded, requires_action, etc.
        ]);

        return [
            'type'          => 'stripe',
            'paymentIntent' => $paymentIntent,
            'payment'       => $payment,
        ];
    }
}
