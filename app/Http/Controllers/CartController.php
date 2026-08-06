<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;


class CartController extends Controller
{
    public function index(){
        $cart = session('cart',[]);
        return view("cart.index",compact('cart'));
    }

    public function add(Product $product){
        $cart = session('cart',[]);
        if(isset($cart[$product->id])){
            $cart[$product->id]['quantity']++;
        }
        else{
            $cart[$product->id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image,
            ];
        }
        session(['cart' => $cart]);
        return redirect()->route('cart.index');
    }

    public function update(Request $request,Product $product){
        $cart = session('cart',[]);

        if(!isset($cart[$product->id])){
            return redirect()->route('cart.index');
        }
        if($request->input('action') == 'increase'){
            $cart[$product->id]['quantity']++;
        } elseif ($request->input('action') == 'decrease'){
            $cart[$product->id]['quantity']--;

            if($cart[$product->id]['quantity'] < 1){
                unset($cart[$product->id]);
            }
        }
        session(['cart' => $cart]);
        return redirect()->route('cart.index');
    }

    public function remove(Product $product){
        $cart = session('cart',[]);
        unset($cart[$product->id]);
        session(['cart' => $cart]);
        return redirect()->route('cart.index');
    }

    public function checkout(){

    }
}
