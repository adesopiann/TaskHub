<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Menampilkan halaman registrasi
    public function registerPage () {
        return view('auth.registration');
    }

    // Proses registrasi user baru
    public function register (Request $request) {

         // Validasi input dari form registrasi
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', Password::defaults()]
        ]);

        // Enkripsi password sebelum disimpan
        $validatedData['password'] = Hash::make($validatedData['password']);

        // Simpan data user ke database
        $user = User::create($validatedData);

        // Jika berhasil, arahkan ke halaman login
        if ($user) {
            return redirect("/login")->with('success', 'Great! You have Successfully Registered!');
        } else {
            return back()->with('fail', 'Something wrong!');
        }
    }


   // Menampilkan halaman login
    public function loginPage() {
        return view('auth.login');
    }

    // Proses login user
    public function login (Request $request) {
        // Validasi data login dari form
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Cari user berdasarkan email
        $user = User::where('email', $credentials['email'])->first();

        // Jika email tidak ditemukan
        if (!$user) {
            return back()->withErrors([
                'email' => 'Email not found.',
            ])->withInput();
        }

        // Cek apakah password sesuai
        if (!Auth::attempt($credentials)) {
            return back()->withErrors([
                'password' => 'Wrong password.',
            ])->withInput();
        }

        // Regenerasi session untuk keamanan
        $request->session()->regenerate();
        // Arahkan ke halaman dashboard
        return redirect('/dashboard');
    }


    // Proses logout user
    public function logout()
    {
        // Logout dari sistem
        Auth::logout(); 

        // Invalidasi session dan regenerate CSRF token
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        // Redirect ke halaman utama
        return redirect('/');
    }
}
