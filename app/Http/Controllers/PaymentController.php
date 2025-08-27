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
            'payment_method' => 'required|in:stripe,paypal,razorpay,cod',
        ]);

        $status = 'pending';
        $transactionId = null;

        if ($request->payment_method === 'stripe') {
            try {
                \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

                $charge = \Stripe\Charge::create([
                    "amount" => $request->amount * 100,
                    "currency" => "INR",
                    "source" => $request->stripeToken,
                    "description" => "Order payment by " . auth()->user()->email,
                ]);

                $status = 'paid';
                $transactionId = $charge->id;
            } catch (\Exception $e) {
                return back()->with('error', $e->getMessage());
            }
        } elseif ($request->payment_method === 'paypal') {
            $status = 'processing';
            $transactionId = 'PAYPAL_ORDER_ID_HERE';
        } elseif ($request->payment_method === 'razorpay') {
            $status = 'paid';
            $transactionId = 'RAZORPAY_PAYMENT_ID_HERE';
        } elseif ($request->payment_method === 'cod') {
            $status = 'pending';
        }

        // ✅ Always fetch the first image of each product
        $productImages = [];
        foreach ($request->product_id as $id) {
            $product = Product::find($id);
            if ($product) {
                $imgs = $product->product_image ? json_decode($product->product_image, true) : [];
                $productImages[] = $imgs[0] ?? 'default.png';
            }
        }

        // ✅ Save payment
        $payment = Payment::create([
            'user_id'          => auth()->id(),
            'product_id'       => json_encode($request->product_id),
            'product_quantity' => json_encode($request->product_quantity),
            'product_image'    => json_encode($productImages),
            'amount'           => $request->amount,
            'currency'         => 'INR',
            'address'          => $request->address,
            'land_mark'        => $request->land_mark,
            'city'             => $request->city,
            'state'            => $request->state,
            'pincode'          => $request->pincode,
            'payment_method'   => $request->payment_method,
            'transaction_id'   => $transactionId,
            'status'           => $status,
        ]);

        return redirect()->route('thankyou', $payment->id)->with('success', 'Payment processed successfully!');
    }


   public function thankYou(Payment $payment)
{
    // Decode stored JSON arrays from Payment table
    $productIds = json_decode($payment->product_id, true) ?? [];
    $quantities = json_decode($payment->product_quantity, true) ?? [];
    $images     = json_decode($payment->product_image, true) ?? [];

    // Fetch products from DB
    $products = Product::whereIn('id', $productIds)->get()->keyBy('id');

    $orderedItems = [];

    foreach ($productIds as $index => $id) {
        $product = $products[$id] ?? null;

        $orderedItems[] = [
            'name'     => $product->product_name ?? 'Unknown Product',
            'price'    => $product->product_price ?? 0,   // fixed column name
            'image'    => $images[$index] ?? 'default.png',
            'quantity' => $quantities[$index] ?? 1,
        ];
    }

    return view('product.thankyou', [
        'payment'       => $payment,
        'transactionId' => $payment->transaction_id ?? 'N/A',
        'orderedItems'  => $orderedItems,
    ]);
}

}
