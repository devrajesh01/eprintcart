<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Payment;
use App\Models\Product;
use App\Services\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

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
        // Validate
        $request->validate([
            'product_id' => 'required',
            'product_quantity' => 'required|integer|min:1',
            'amount' => 'required|numeric',
            'address' => 'required|string',
            'payment_method' => 'required|in:card,paypal,cod',
        ]);

        // Save to DB
        $payment = Payment::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'product_quantity' => $request->product_quantity,
            'amount' => $request->amount,
            'address' => $request->address,
            'status' => $request->payment_method === 'cod' ? 'pending' : 'processing',
        ]);

        // Redirect to thank you page
        return redirect()->route('thankyou', $payment->id);
    }
}
