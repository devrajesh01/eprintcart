<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::all();
        // dd($products);
        return view('pages.home', compact('products'));
    }

    public function productPage(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        return view('product.productpage', compact('product'));
    }



    public function addToCart(Request $request, $id)
    {
        $quantity = $request->quantity ?? 1; // fallback to 1

        $cartItem = Cart::where('product_id', $id)
            ->where('customer_id', auth()->id())
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            Cart::create([
                'customer_id' => auth()->id(),
                'product_id'  => $id,
                'quantity'    => $quantity
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Product added to cart!');
    }



    // Show cart
    public function cartIndex()
    {
        $cartItems = Cart::with('product')->get();
        return view('product.cart', compact('cartItems'));
    }

    // Update quantity
    public function update(Request $request, $id)
    {
        $cartItem = Cart::findOrFail($id);
        $cartItem->update(['quantity' => $request->quantity]);

        // If it's an AJAX request, return JSON instead of redirect
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'quantity' => $cartItem->quantity,
                'total' => $cartItem->product->product_price * $cartItem->quantity
            ]);
        }

        // fallback for non-AJAX requests
        return redirect()->route('cart.index');
    }


    // Remove item
    public function destroy($id)
    {
        $cartItem = Cart::findOrFail($id);
        $cartItem->delete();
        return redirect()->route('cart.index')->with('success', 'Item removed!');
    }


    public function checkCart(Request $request)
    {
        $cartItems = Cart::with('product')
            ->where('customer_id', auth()->id())
            ->get();

        return view('product.cart', compact('cartItems'));
    }


    public function storeContact(Request $request)
{
    // ✅ Validate input
    $request->validate([
        'name'    => 'required|string|max:255',
        'email'   => 'required|email|max:255',
        'phone'   => 'nullable|string|max:20',
        'subject' => 'nullable|string|max:255',
        'message' => 'required|string',
    ]);

    // ✅ Save data
    Contact::create([
        'name'    => $request->name,
        'email'   => $request->email,
        'phone'   => $request->phone,
        'subject' => $request->subject,
        'message' => $request->message,
    ]);

    // ✅ Redirect back with success message
    return redirect()->back()->with('success', 'Thank you! Your message has been sent successfully.');
}



















    public function showMugDesign()
    {
        return view('product.mug');
    }

    public function AboutPage(Request $request)
    {
        return view('pages.about');
    }


    public function ContactPage(Request $request)
    {
        return view('pages.contactus');
    }
    public function showShop(Request $request)
    {
        return view('product.shop');
    }
    public function showPrivacy(Request $request)
    {
        return view('pages.privacy');
    }
    public function showTerms(Request $request)
    {
        return view('pages.terms');
    }
}
