<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
   public function index(Request $request)
    {
        $categories=Category::all();
        $latestProducts = Product::latest()->take(8)->get();
        return view('client.home.index',compact('categories','latestProducts'));
    }
    public function locale($locale)
    {
        $locale = in_array($locale, ['tm', 'ru']) ? $locale : 'en';
        session()->put('locale', $locale);

        return redirect()->back();
    } 
}



