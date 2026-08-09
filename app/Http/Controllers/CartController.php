<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Order;
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

    public function checkout(Request $request){
        $cart = session('cart',[]);

        if(empty($cart)){
            return redirect()->route('cart.index')-> with(['error' => 'No items in cart']);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'address' => 'required|string|max:255',
            'card' => 'required|string|max:255',
            'expiry' => 'required|string',
            'cvv' => 'required|string|max:255',
        ]);

        $total = collect($cart)->sum(function($item){
            return $item['quantity'] * $item['price'];
        });

        $order = DB::transaction(function() use($cart, $validated, $total){
            $order = Order::create([
                'user_id' => auth()->id(),
                'name' => $validated['name'],
                'email' => $validated['email'],
                'address' => $validated['address'],
                'total' => $total,
                'status' => 'pending',
            ]);

            foreach($cart as $productId => $item){
                $order->items()->create([
                    'product_id' => $productId,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }
            return $order;
        });
        session()->forget('cart');
        return redirect()->route('cart.index')-> with(['success' => 'Order placed']);
    }
}
