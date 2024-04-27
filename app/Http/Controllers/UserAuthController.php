<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminAuthRequest;
use App\Utility\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAuthController extends Controller
{
    public function login()
    {
        if (Auth::guard()->check()) {
            return redirect()->route('user.dashboard');
        }
        return view('auth.login');
    }

    public function auth(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        if (!Auth::guard()->attempt($data)) {
            return redirect()->route('admin.login');
        }
        return redirect()->route('user.dashboard');
    }

    public function logout()
    {
        Auth::guard()->logout();
        return redirect()->route('admin.login');
    }

    public function dashboard()
    {
        return view('dashboard.userIndex');
    }

}
