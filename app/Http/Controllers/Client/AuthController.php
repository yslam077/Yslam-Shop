<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller; // Правильный импорт базового контроллера
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

      
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        
        Auth::login($user);

        return redirect()->route('home.index')->with('success', 'Üstünlikli agza bolduňyz!');
    }
}
