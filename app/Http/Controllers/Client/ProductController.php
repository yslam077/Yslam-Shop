<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::latest()->paginate(12);
        $categories=Category::all();
        return view('client.products.index', compact('products','categories'));
    }
    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        $categories=Category::all();
        return view('client.products.show', compact('product','categories'));
    }
}
