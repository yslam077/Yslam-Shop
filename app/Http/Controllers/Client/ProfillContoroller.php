<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfillContoroller extends Controller
{
    public function index(){
        /** @var User $user*/
        $user=Auth::user();
        $categories=Category::all();
        return view("client.profile.index",compact('user','categories'));
    }
    public function update(Request $request){
        /** @var User $user*/
        $user=Auth::user();
        $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|string|email|max:255|unique:users,email,'.$user->id,
            'phone'=>'nullable|string|max:30',
        ]);
        User::where('id',$user->id)->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
        ]);
        return back()->with('success','Maglumatynyz kabul edildi');
    }
    public function updatePassword(Request $request){
        $request->validate([
            'current_password'=>'required',
            'password'=>'required|string|min:6|confirmed',
        ]);
        $user = Auth::user();
        if(!Hash::check($request->current_password,$user->password)){
            return back()->withErrors(['current_password'=>'Acarsozi yanys']);
        }
        /** @var User $user*/
        $user->update([
            'password'=>Hash::make($request->password),
        ]);
        return back()->with('success','Acarsozi utgedildi');
    }
}
