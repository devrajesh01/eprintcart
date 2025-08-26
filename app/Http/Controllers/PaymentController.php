<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Payment;
use App\Models\Product;
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
    public function index(Request $request, $id)
    {
        $order_product = Product::findOrFail($id);
        $customer = auth()->user();
        $quantity = $request->input('quantity', 1);
        return view('payment', compact('order_product', 'customer', 'quantity'));
    }

    public function checkOutAll(Request $request)
    {
        $customer = auth()->user(); // Logged-in user

        // Get all cart items for the user, including related product info
        $cartItems = Cart::with('product')
            ->where('customer_id', $customer->id)
            ->get();

        return view('payment', compact('cartItems', 'customer'));
    }


    public function processToPay(Request $request, $product_id)
    {
        // Get the cart item for this customer and product
        $cart_product = Cart::with('product')
            ->where('customer_id', auth()->id())
            ->where('product_id', $product_id)
            ->first();

        if (!$cart_product) {
            return redirect()->route('cart.index')->with('error', 'Product not found in cart.');
        }

        // Calculate total amount (product price × quantity)
        $totalAmount = $cart_product->product->product_price * $cart_product->quantity;

        // Here you can redirect to your payment page or call a payment API
        // For now, let's just return a view
        return view('payment.checkout', [
            'cart_product' => $cart_product,
            'totalAmount' => $totalAmount
        ]);
    }

    public function createPayment(Request $request)
    {

        $request->validate([
            'product_id' => 'required|array',
            'product_id.*' => 'integer|exists:products,id',
            'product_quantity' => 'required|array',
            'product_quantity.*' => 'integer|min:1',
            'amount' => 'required|numeric',
            'address' => 'required|string',
            'land_mark' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'pincode' => 'required|string',
            'payment_method' => 'required|in:stripe,paypal,cod',
        ]);

        $status = 'pending';
        $transactionId = null;

        if ($request->payment_method === 'stripe') {
            try {
                \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

                $charge = \Stripe\Charge::create([
                    "amount" => $request->amount * 100,
                    "currency" => "usd",
                    "source" => $request->stripeToken,
                    "description" => "Order payment by " . auth()->user()->email,
                ]);

                $status = 'paid';
                $transactionId = $charge->id;
            } catch (\Exception $e) {
                return back()->with('error', $e->getMessage());
            }
        } elseif ($request->payment_method === 'paypal') {
            // integrate PayPal API
            $status = 'processing';
            $transactionId = 'PAYPAL_ORDER_ID_HERE';
        } elseif ($request->payment_method === 'razorpay') {
            // integrate Razorpay API
            $status = 'paid';
            $transactionId = 'RAZORPAY_PAYMENT_ID_HERE';
        } elseif ($request->payment_method === 'cod') {
            $status = 'pending';
        }
        
        // Save payment record
        $payment = Payment::create([
            'user_id' => auth()->id(),
            'product_id' => $request->product_id,
            'product_image' => $request->product_image ?? null,
            'product_quantity' => $request->product_quantity,
            'amount' => $request->amount,
            'currency' => 'INR',
            'address' => $request->address,
            'land_mark' => $request-> land_mark,
            'city' => $request->city,
            'state' => $request->state,
            'pincode'=> $request->pincode,
            'payment_method' => $request->payment_method,
            'transaction_id' => $transactionId,
            'status' => $status,
        ]);

        return redirect()->route('thankyou', $payment->id)->with('success', 'Payment processed successfully!');
    }


    public function thankYou(Payment $payment)
    {
        // product_id and product_quantity should already be arrays
        $productIds = $payment->product_id;
        $quantities = $payment->product_quantity;

        $products = Product::whereIn('id', $productIds)->get();

        $orderedItems = [];
        foreach ($products as $index => $product) {
            // Safely get first image
            $image = null;

            if (is_array($product->product_image)) {
                $image = $product->product_image[0] ?? 'default.png';
            } else {
                // if stored as JSON string, decode it
                $decoded = json_decode($product->product_image, true);
                if (is_array($decoded)) {
                    $image = $decoded[0] ?? 'default.png';
                } else {
                    // plain string case
                    $image = $product->product_image ?? 'default.png';
                }
            }

            $orderedItems[] = [
                'name' => $product->product_name,
                'image' => $image,
                'quantity' => $quantities[$index] ?? 1,
                'price' => $product->product_price,
            ];
        }

        return view('product.thankyou', [
            'payment'       => $payment,
            'orderedItems'  => $orderedItems,
            'transactionId' => $payment->transaction_id,
        ]);
    }
}
