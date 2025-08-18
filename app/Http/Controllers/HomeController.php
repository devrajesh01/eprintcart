<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class HomeController extends Controller
{
     public function index(Request $request){        
        return view('pages.home');
    }

    public function productPage(Request $request, $p_id){
        $product = Product::all();
        return view('product.productpage',compact('product'));
    }
    public function showMugDesign(){
        return view('product.mug');
    }
    
}