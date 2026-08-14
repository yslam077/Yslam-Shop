<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class CartController extends Controller
{
   
    public function addAjax(Request $request, $id)
    {
        $id = (int) $id;
        $quantity = (int) $request->input('quantity', 1);
        $cart = session()->get('cart', []);

        if ($quantity > 0) {
            $product = Product::findOrFail($id);
            $cart[$id] = [
                'id'       => $product->id,
                'name'     => $product->name,
                'quantity' => $quantity,
                'price'    => (float) $product->price,
                'image'    => $product->image
            ];
        } else {
            unset($cart[$id]);
        }

        session()->put('cart', $cart);

        $totalItemsCount = array_sum(array_column($cart, 'quantity'));
        
        $totalPrice = 0;
        foreach ($cart as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }

        return response()->json([
            'success'     => true,
            'cart_count'  => $totalItemsCount,
            'total_price' => $totalPrice
        ]);
    }

    public function index()
    {
        $cart = session()->get('cart', []);
        $categories = Category::all();
        
        $totalPrice = 0;
        if (!empty($cart)) {
            foreach ($cart as $item) {
                $totalPrice += ((float) $item['price']) * ((int) $item['quantity']);
            }
        }

        return view('client.cart.index', compact('cart', 'categories', 'totalPrice'));
    }

    public function add(Request $request, $id)
    {
        $id = (int) $id;
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        $quantity = max(1, (int) $request->input('quantity', 1));

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity;
        } else {
            $cart[$id] = [
                'id'       => $product->id,
                'name'     => $product->name,
                'quantity' => $quantity,
                'price'    => (float) $product->price,
                'image'    => $product->image,
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Haryt sebede gosuldy');
    }

    public function update(Request $request, $id)
    {
        $id = (int) $id;
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = max(1, (int) $request->quantity);
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Sebet tazelendi');
    }

    public function remove($id)
    {
        $id = (int) $id;
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Haryt sebeden pozuldy');
    }
}