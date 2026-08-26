<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            if (Auth::user()->is_admin) {
                $request->session()->regenerate();
                $request->session()->put('is_admin_logged_in', true);
                return redirect()->route('admin.dashboard')->with('success', 'Hoş geldiňiz, Admin!');
            }

            Auth::logout();
            return redirect()->back()->withErrors([
                'email' => 'Sizde admin amallaryny geçirmäge rugsat ýok!'
            ])->with('openLoginModal', true);
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