<?php

namespace App\Http\Controllers;

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
        $product = Product::findOrFail($id);   // singular
        return view('product.productpage', compact('product'));
    }

    public function showMugDesign()
    {
        return view('product.mug');
    }

    public function AboutPage(Request $request){
        return view('pages.about');
    }


    public function ContactPage(Request $request){
        return view('pages.contactus');
    }
    public function showShop(Request $request){
        return view('product.shop');
    }
    public function showPrivacy(Request $request){
        return view('pages.privacy');
    }
    public function showTerms(Request $request){
        return view('pages.terms');
    }
}
