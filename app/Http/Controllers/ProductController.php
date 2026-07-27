<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    function index(){
        $products = Product::latest()->paginate(10);
        return view("products.index",compact("products"));
    }
   
    function show(Product $product){
        return view("products.show",compact("product"));
    }
}
