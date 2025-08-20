<?php

namespace App\Http\Controllers;

use App\Services\PaymentService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    // Show payment form
    public function index()
    {
        return view('payment');
    }

    // Handle payment
    public function createPayment(Request $request)
    {
        $data = $request->validate([
            'product_id'       => 'required|integer',
            'product_image'    => 'required|string',
            'product_quantity' => 'required|integer|min:1',
            'amount'           => 'required|numeric|min:1',
            'address'          => 'required|string',
            'paymentMethodId'  => 'required|string',
        ]);

        try {
            $paymentIntent = $this->paymentService->createPayment($data);

            return response()->json([
                'success' => true,
                'paymentIntent' => $paymentIntent,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
