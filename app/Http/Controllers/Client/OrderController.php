<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Category;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'phone'   => 'required|string',
            'address' => 'required|string|max:500',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Sebetiňiz boş!');
        }

        $totalPrice = 0;
        foreach ($cart as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }

        $order = Order::create([
            'phone'       => '+993' . $request->phone,
            'address'     => $request->address,
            'total_price' => $totalPrice,
            'status'      => 'pending',
        ]);

        foreach ($cart as $productId => $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $productId,
                'quantity'   => $item['quantity'],
                'price'      => $item['price'],
            ]);
        }

        session()->push('user_orders', $order->id);


        session()->forget('cart');

        return redirect()->route('home.index')->with('success', 'Sargydyňyz üstünlikli kabul edildi!');
    }


    public function myOrders()
    {

        $userOrdersIds = session()->get('user_orders', []);
        $categories = Category::all();
        $orders = Order::whereIn('id', $userOrdersIds)
            ->with('items.product')
            ->latest()
            ->paginate(10);

        return view('client.orders.index', compact('orders', 'categories'));
    }
}