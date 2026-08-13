<?php

namespace App\Http\Controllers\Client;
use App\Models\Category;
use App\Http\Controllers\Controller;
class CategoryController extends Controller
{
    public function show($id){
        $category=Category::with('products')->findOrFail($id);
        $categories=Category::all();
        return view('client.categories.show',compact('category','categories'));
    }
}
