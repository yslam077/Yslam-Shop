<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = trim($request->input('q'));
        if (empty($query)) {
            $products = Product::whereRaw('1 = 0')->paginate(12);
            return view('client.search', compact('products', 'query'));
        }

        // Ищем товары по названию или описанию
        $products = Product::where('name', 'LIKE', "%{$query}%")->paginate(12);
        return view('client.search', compact('products', 'query'));
    }
}
