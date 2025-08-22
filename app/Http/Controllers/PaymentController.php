<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PaymentController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    // Show payment form
    public function index(Request $request, $id)
    {
        $order_product = Product::findOrFail($id);
        $customer = auth()->user();
        return view('payment', compact('order_product', 'customer'));
    }


    // Handle payment
    // public function createPayment(Request $request)
    // {
    //     $data = $request->validate([
    //         'product_id'       => 'required|integer',
    //         'product_image'    => 'required|string',
    //         'product_quantity' => 'required|integer|min:1',
    //         'amount'           => 'required|numeric|min:1',
    //         'address'          => 'required|string',
    //         'paymentMethodId'  => 'required|string',
    //     ]);

    //     try {
    //         $paymentIntent = $this->paymentService->createPayment($data);

    //         return response()->json([
    //             'success' => true,
    //             'paymentIntent' => $paymentIntent,
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => $e->getMessage(),
    //         ], 500);
    //     }
    // }
     public function createPayment(Request $request)
    {
        // Validate what comes from the form
        $validated = $request->validate([
            'product_id'       => 'required|integer',
            'product_quantity' => 'required|integer|min:1',
            'address'          => 'required|string|max:255',
            'paymentMethodId'  => 'required|string', // 'cod' or 'pm_xxx' from Stripe.js
        ]);

        // Always compute trusted values server-side (don’t trust hidden inputs)
        $product = Product::findOrFail($validated['product_id']);
        $qty     = $validated['product_quantity'];
        $amount  = round($product->product_price * $qty, 2);

        try {
            $result = $this->paymentService->createPayment([
                'user_id'          => Auth::id(),
                'product_id'       => $product->id,
                'product_image'    => $product->product_image, // server-side
                'product_quantity' => $qty,
                'amount'           => $amount,
                'currency'         => 'usd',
                'address'          => $validated['address'],
                'paymentMethodId'  => $validated['paymentMethodId'],
            ]);

            // Handle response
            if ($result['type'] === 'cod') {
                return redirect()->route('checkout', $product->id)
                    ->with('success', 'Order placed with Cash on Delivery!');
            }

            // Stripe path
            $intent = $result['paymentIntent'];

            if ($intent->status === 'requires_action' || $intent->status === 'requires_source_action') {
                // 3DS or next action required. Send client secret back if using XHR,
                // or redirect to a page that completes the action on client side.
                return back()->with('info', 'Additional authentication required.')->with('client_secret', $intent->client_secret);
            }

            if ($intent->status === 'succeeded') {
                return redirect()->route('checkout', $product->id)
                    ->with('success', 'Payment succeeded!');
            }

            return back()->with('error', 'Unexpected payment status: ' . $intent->status);

        } catch (\Throwable $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
