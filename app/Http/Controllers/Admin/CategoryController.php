<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        Category::create(['name' => $request->name]);

        return redirect()->route('admin.faq.create')->with('success', 'Categorie aangemaakt!');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->back()
            ->with('success', 'Categorie verwijderd.');
    }
}
