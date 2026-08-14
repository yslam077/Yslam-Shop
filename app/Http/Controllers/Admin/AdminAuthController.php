<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
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

            return redirect()->route('admin.dashboard')->with('success', 'Hoş geldiňiz, Admin!');
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->put('is_admin_logged_in', true);
            $request->session()->regenerate();

            return redirect()->route('admin.dashboard');
        }

        return redirect()->back()->withErrors([
            'email' => 'E-mail ýalňyş ýa-da parol näsaz!'
        ])->with('openLoginModal', true);
    }

    public function logout(Request $request)
    {
        $request->session()->forget('is_admin_logged_in');
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home.index');
    }
}