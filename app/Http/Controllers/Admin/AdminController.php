<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;

class AdminController extends Controller
{
    public function index()
    {
        $productsCount = Product::count();
        $usersCount = User::count();
        $ordersCount = Order::where('status', '!=', 'canceled')->count();
        $pendingOrders = Order::where('status', 'pending')->latest()->get();
        return view('admin.dashboard', compact('productsCount', 'usersCount','ordersCount','pendingOrders'));
    }
}