<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Str;

class AuthController extends Controller
{
    public function index()
    {
        return view('backend.auth.register');
    }
    public function registration(Request $request)
    {
        // dd($request->all());
        $user = request()->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:6',
            'confirm_password' => 'required_with:password|same:password|min:6',
        ]);

        $user           = new User;
        $user->name     = trim($request->name);
        $user->email    = trim($request->email);
        $user->password = Hash::make($request->password);
        $user->user_type = trim($request->user_type);
        $user->remember_token = Str::random(50);
        $user->save();
        return redirect('/login')->with('success', 'User Registration Successfully');
    }

    public function create()
    {
        return view('backend.auth.login');
    }
    public function login()
    {
        // return view('backend.auth.login');
    }

    public function forgot()
    {
        return view('backend.auth.forgot_password');
    }
}
