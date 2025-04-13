<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Registration
    public function registerPage () {
        return view('auth.registration');
    }

    public function register (Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', Password::defaults()]
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        $user = User::create($validatedData);

        if ($user) {
            return redirect("/login")->with('success', 'Great! You have Successfully Registered!');
        } else {
            return back()->with('fail', 'Something wrong!');
        }
    }


    // Login
    public function loginPage() {
        return view('auth.login');
    }

    public function login (Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Email not found.',
            ])->withInput();
        }

        if (!Auth::attempt($credentials)) {
            return back()->withErrors([
                'password' => 'Wrong password.',
            ])->withInput();
        }

        $request->session()->regenerate();
        return redirect()->intended('/dashboard');
    }


    // Logout
    public function logout()
    {
        Auth::logout(); 
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    }
}
