<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    // Список всех заказов
    public function index()
    {

        $orders = Order::with('items.product')->latest()->paginate(15);

        return view('admin.orders.index', compact('orders'));
    }


    public function show($id)
    {
        $order = Order::with('items.product')->findOrFail($id);

        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,on_the_way,delivered,canceled',
        ]);

        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Sargydyň ýagdaýy täzelendi!');
    }
}