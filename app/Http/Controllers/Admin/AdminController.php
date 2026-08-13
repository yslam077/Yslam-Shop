<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $productsCount = Product::count();
        $usersCount = User::count();
        return view('admin.dashboard', compact('productsCount', 'usersCount'));
    }
}