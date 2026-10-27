<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function toggle(Request $request, Product $product)
    {
        // Добавляет запись в likes, если её нет, и удаляет, если она есть
        $request->user()->likedProducts()->toggle($product->id);

        return back();
    }

    public function favorites(Request $request)
    {
        $products = $request->user()
            ->likedProducts()
            ->orderByPivot('created_at', 'desc')
            ->paginate(12);

        return view('favorites.index', compact('products'));
    }
}