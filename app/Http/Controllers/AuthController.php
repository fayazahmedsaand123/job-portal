<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller {

    // Show Register Page
    public function showRegister() {
        return view('auth.register');
    }

    // Handle Register
    public function register(Request $request) {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role'     => 'required|in:employer,candidate',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
            'role'     => $request->role,
        ]);

        session(['login_id' => $user->id]);
        session(['login_role' => $user->role]);
        session(['login_name' => $user->name]);

        if ($user->role == 'employer') {
            return redirect('/employer/dashboard');
        }

        return redirect('/candidate/dashboard');
    }

    // Show Login Page
    public function showLogin() {
        return view('auth.login');
    }

    // Handle Login
    public function login(Request $request) {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !password_verify($request->password, $user->password)) {
            return back()->with('error', 'Invalid email or password.');
        }

        session(['login_id'   => $user->id]);
        session(['login_role' => $user->role]);
        session(['login_name' => $user->name]);

        if ($user->role == 'admin') {
            return redirect('/admin/dashboard');
        } elseif ($user->role == 'employer') {
            return redirect('/employer/dashboard');
        }

        return redirect('/candidate/dashboard');
    }

    // Logout
    public function logout() {
        session()->flush();
        return redirect('/login');
    }
}