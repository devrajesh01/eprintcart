<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function AdminIndex(Request $request)
    {
        return view('Admin.AdminDashboard');
    }

    public function AddProductPage(Request $request)
    {
        return view('Admin.AddProducts');
    }

    // Store Products
    public function StoreProducts(Request $request)
    {
        $request->validate([
            'product_name'        => 'required|string|max:255',
            'product_category'    => 'required|string|max:255',
            'product_description' => 'required|string',
            'product_price'       => 'required|numeric|min:0',
            'product_quantity'    => 'required|integer|min:1',
            'product_image'       => 'required|image|mimes:jpeg,png,jpg,gif|max:10048', // max 2MB
        ]);

        // Handle file upload
        $imageName = time() . '.' . $request->product_image->extension();
        $request->product_image->move(public_path('uploads/products'), $imageName);

        // Save product
        Product::create([
            'product_name'        => $request->product_name,
            'product_category'    => $request->product_category,
            'product_description' => $request->product_description,
            'product_price'       => $request->product_price,
            'product_quantity'    => $request->product_quantity,
            'product_image'       => $imageName,
        ]);

        return redirect()->back()->with('success', 'Product added successfully!');
    }


    public function ListProductPage(Request $request)
    {
        $products = Product::all();
        return view('Admin.ListProducts',compact('products'));
    }
}
