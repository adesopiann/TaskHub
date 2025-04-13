<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;

class DashboardController extends Controller
{

    public function index() {
        // Mengambil tugas yang dimiliki oleh pengguna yang sedang login dan mengelompokkan berdasarkan status
        $tasks = Task::where('user_id', Auth::id())
            ->get()
            ->groupBy('status')
            ->sortKeysUsing(function ($key) { // Menyortir status dengan urutan khusus
                return ['Open' => 1, 'In Progress' => 2, 'Done' => 3][$key] ?? 4 ;
        });

        return view('dashboard', compact('tasks'));
    }

    // Menampilkan landing page jika pengguna belum login
    public function landingPage() {
        // Memeriksa apakah pengguna sudah login
        if (auth()->check()) {
            return redirect('dashboard');
        }

    return view('landing-page');
    }
}
