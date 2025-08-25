<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function AdminIndex(Request $request)
    {
        return view('Admin.AdminDashboard');
    }

    // public function AddProductPage(Request $request)
    // {
    //     return view('Admin.AddProducts');
    // }


public function AddProductPage()
{
    // Fetch distinct categories dynamically from the Product table
    $categories = Product::query()
        ->whereNotNull('product_category')
        ->where('product_category', '<>', '')
        ->distinct()
        ->pluck('product_category')
        ->toArray();

    return view('Admin.AddProducts', compact('categories'));
}


    // Store Products
    // public function StoreProducts(Request $request)
    // {
    //     $request->validate([
    //         'product_name'        => 'required|string|max:255',
    //         'product_category'    => 'required|string | max:255' ,
    //         'product_description' => 'required|string',
    //         'product_price'       => 'required|numeric|min:0',
    //         'product_quantity'    => 'required|integer|min:1',
    //         'product_image'       => 'required|image|mimes:jpeg,png,jpg,gif|max:10048', // max 2MB
    //     ]);

    //     // Handle file upload
    //     $imageName = time() . '.' . $request->product_image->extension();
    //     $request->product_image->move(public_path('uploads/products'), $imageName);

    //     // Save product
    //     Product::create([
    //         'product_name'        => $request->product_name,
    //         'product_category'    => $request->product_category,
    //         'product_description' => $request->product_description,
    //         'product_price'       => $request->product_price,
    //         'product_quantity'    => $request->product_quantity,
    //         'product_image'       => $imageName,
    //     ]);

    //     return redirect()->back()->with('success', 'Product added successfully!');
    // }
   
public function StoreProducts(Request $request)
{
    // Validate request
    $request->validate([
        'product_name'        => 'required|string|max:255',
        'product_category'    => 'nullable|string|max:255', // Make nullable, because user might use new_category
        'new_category'        => 'nullable|string|max:255', // Validate new_category too
        'product_description' => 'required|string',
        'product_price'       => 'required|numeric|min:0',
        'product_quantity'    => 'required|integer|min:1',
        'product_image'       => 'required',
        'product_image.*'     => 'image|mimes:jpeg,png,jpg,gif|max:10048',
        'product_tags'        => 'nullable|string',
    ]);

    // Handle multiple image upload
    $images = [];
    if ($request->hasFile('product_image')) {
        foreach ($request->file('product_image') as $file) {
            $imageName = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/products'), $imageName);
            $images[] = $imageName;
        }
    }

    // Handle product tags
    $tagsArray = [];
    if ($request->filled('product_tags')) {
        $decoded = json_decode($request->product_tags, true);
        if (is_array($decoded)) {
            $tagsArray = array_column($decoded, 'value');
        } else {
            $tagsArray = array_map('trim', explode(',', $request->product_tags));
        }
    }

    // Decide category: either use dropdown or new_category
    $category = $request->filled('new_category') 
        ? $request->new_category 
        : $request->product_category;

    // Save product
    Product::create([
        'product_name'        => $request->product_name,
        'product_category'    => $category, // <-- FIX: use $category here
        'product_description' => $request->product_description,
        'product_price'       => $request->product_price,
        'product_quantity'    => $request->product_quantity,
        'product_image'       => json_encode($images),
        'product_tags'        => json_encode($tagsArray),
    ]);

    return redirect()->back()->with('success', 'Product added successfully!');
}







    public function ListProductPage(Request $request)
    {
        $products = Product::all();
        return view('Admin.ListProducts', compact('products'));
    }

    public function EditProduct(Request $request, $id)
    {

        $product = Product::findOrFail(($id));

        return view('Admin.EditProduct', compact('product'));
    }

    // public function UpdateProduct(Request $request, $id)
    // {

    //     $request->validate([

    //         'product_name' => 'required|string|max:255',
    //         'product_category' => 'required|string|max:255',
    //         'product_price' => 'required|numeric|min:0',
    //         'product_quantity' => 'required|integer|min:1',
    //         'product_description' => 'nullable|string',
    //         'product_image' => 'nullable|image|mimes:jpg,jpeg,png|max:10048',

    //     ]);

    //     $product = Product::findOrFail($id);

    //     $product->product_name = $request->product_name;
    //     $product->product_category = $request->product_category;
    //     $product->product_price = $request->product_price;
    //     $product->product_quantity = $request->product_quantity;
    //     $product->product_description = $request->product_description;

    //     if ($request->hasFile('product_image')) {
    //         if ($product->product_image && file_exists(public_path('uploads/products/' . $product->product_image))) {
    //             unlink(public_path('uploads/products/' . $product->product_image));
    //         }

    //         $image = $request->file('product_image');
    //         $imageName = time() . '.' . $image->getClientOriginalExtension();
    //         $image->move(public_path('uploads/products'), $imageName);

    //         $product->product_image = $imageName;
    //     }
    //     $product->save();

    //     return redirect()->route('list.products')->with('success', 'Product update succesfully.');
    // }
    public function UpdateProduct(Request $request, $id)
{
    $request->validate([
        'product_name' => 'required|string|max:255',
        'product_category' => 'required|string|max:255',
        'product_price' => 'required|numeric|min:0',
        'product_quantity' => 'required|integer|min:1',
        'product_description' => 'nullable|string',
        'product_tags' => 'nullable|string',
        'product_images.*' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:10048',
        'remove_images.*' => 'nullable|string'
    ]);

    $product = Product::findOrFail($id);

    // Update basic fields
    $product->product_name = $request->product_name;
    $product->product_category = $request->product_category;
    $product->product_price = $request->product_price;
    $product->product_quantity = $request->product_quantity;
    $product->product_description = $request->product_description;

    // Handle tags
    $tagsArray = [];
    if ($request->filled('product_tags')) {
        $decoded = json_decode($request->product_tags, true);
        if (is_array($decoded)) {
            $tagsArray = array_column($decoded, 'value');
        } else {
            $tagsArray = array_map('trim', explode(',', $request->product_tags));
        }
    }
    $product->product_tags = json_encode($tagsArray);

    // Handle images
    $existingImages = $product->product_image ? json_decode($product->product_image, true) : [];

    // Remove selected old images
    if ($request->has('remove_images')) {
        foreach ($request->remove_images as $removeImg) {
            $path = public_path('uploads/products/'.$removeImg);
            if (file_exists($path)) unlink($path);
            $existingImages = array_filter($existingImages, fn($img) => $img != $removeImg);
        }
    }

    // Add new images
    if ($request->hasFile('product_images')) {
        foreach ($request->file('product_images') as $file) {
            $imgName = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/products'), $imgName);
            $existingImages[] = $imgName;
        }
    }

    $product->product_image = json_encode(array_values($existingImages)); // reindex
    $product->save();

    return redirect()->route('list.products')->with('success', 'Product updated successfully!');
}



    
    public function DeleteProduct(Request $request, $id)
    {

        $product = Product::findOrFail($id);
        if ($product->product_image && file_exists(public_path('uploads/products/' . $product->product_image))) {
            unlink(public_path('uploads/products/' . $product->product_image));
        }
        $product->delete();

        return redirect()->route('list.products')->with('success', 'Product deleted successfully');
    }


    public function showContacts()
    {
        $contacts = Contact::latest()->get();        
        return view('admin.Showcontacts', compact('contacts'));
    }


}
