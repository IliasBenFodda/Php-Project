<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    function index(){
        $products = Product::latest()->paginate(10);
        return view("products.index",compact("products"));
    }

    function show(Product $product){
        return view("products.show",compact("product"));
    }

    function create()
    {
        return view("admin.products.create");
    }

    function store(Request $request){
        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'stock' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if($request->hasFile("image")){
           $validated['image'] = $request->file("image")->store("products", "public");
        }
        Product::create($validated);
         return redirect()->route("products.index");
    }

    public function edit(Product $product)
    {
        return view("admin.products.edit",compact("product"));
    }

    public function update(Request $request, Product $product){
        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'stock' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if($request->hasFile("image")){
            if ($product->image){
                Storage::disk("public")->delete($product->image);
            }
            $validated['image'] = $request->file("image")->store("products", "public");
        }
        $product->update($validated);
        return redirect()->route("products.index");
    }

    public function destroy(Product $product){
        if ($product->image){
            Storage::disk("public")->delete($product->image);
        }
        $product->delete();

        return redirect()->route("products.index");
    }
}
