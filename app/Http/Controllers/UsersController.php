<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function login(Request $request) {
        $validated = $request->validate([
                'email'    => 'required|email',
                'password' => 'required|min:8',
            ]);

        if(Auth::guard()->attempt($validated)) {
            return redirect('/dashboard');
        }

        return redirect()->back();

    }

    public function logout(Request $request) {
        Auth::guard()->logout();
        $request->session()->regenerateToken();
        $request->session()->invalidate();

        return redirect('/admin/login');
    }
}
