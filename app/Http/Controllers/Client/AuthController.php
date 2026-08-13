<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return redirect()->route('home.index')->with('openLoginModal', true);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $adminEmail = config('app.admin_email', 'admin@yslamshop.com');
        $adminPassword = config('app.admin_password', 'yslam_shop');

        if ($request->email === $adminEmail && $request->password === $adminPassword) {
            $adminUser = User::firstOrCreate(
                ['email' => $adminEmail],
                [
                    'name' => 'Admin',
                    'password' => bcrypt($adminPassword),
                ]
            );

            Auth::login($adminUser);
            $request->session()->put('is_admin_logged_in', true);
            $request->session()->regenerate();

            return redirect()->route('home.index')->with('success', 'Hoş geldiňiz, Admin!');
        }

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended(route('home.index'))->with('success', 'Hoş geldiňiz!');
        }

        return back()->withErrors([
            'email' => 'Girizilen maglumatlar nälaýyk.',
        ])->with('openLoginModal', true);
    }

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

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home.index');
    }
}