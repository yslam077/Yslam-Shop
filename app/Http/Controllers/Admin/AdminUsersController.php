<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminUsersController extends Controller
{
    public function index()
    {
       
        $users = User::latest()->paginate(15);

        return view('admin.users.index', compact('users'));
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if (Auth::check() && Auth::id() == $user->id) {
            return redirect()->back()->with('error', 'Özüňizi pozup bilmersiňiz! (Вы не можете удалить самого себя!)');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Ulanyjy üstünlikli pozuldy!');
    }
}
