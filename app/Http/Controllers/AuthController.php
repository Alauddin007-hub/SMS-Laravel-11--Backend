<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        return redirect('/')->with('success', 'User Registration Successfully');
    }

    public function create()
    {
        return view('backend.auth.login');
    }
    public function login(Request $request)
    {
        // dd($request->all());
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password ], true))
        {
            if(Auth::user()->user_type == 0 )
            {
                echo "Super Admin"; die();
                // return redirect()->intended('superadmin/dashboard');
            }
            else if (Auth::user()->user_type == 1)
            {
                echo "Admin"; die();
                // return redirect()->intended('admin/dashboard');
            }
            else if (Auth::user()->user_type == 2)
            {
                echo "Normal User"; die();
                // return redirect()->intended('user/dashboard');
            }
            else
            {
                return redirect('/')->with('error', 'Not Availables Email..... Please check');
            }
        }
        else
        {
            return redirect()->back()->with('error', 'Please enter the correct credential');
        }
    }

    public function forgot()
    {
        return view('backend.auth.forgot_password');
    }
}
