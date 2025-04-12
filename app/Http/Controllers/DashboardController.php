<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;

class DashboardController extends Controller
{

public function index() {
   $tasks = Task::where('user_id', Auth::id())
        ->get()
        ->groupBy('status')
        ->sortKeysUsing(function ($key) {
            return ['Open' => 1, 'In Progress' => 2, 'Done' => 3][$key] ?? 4;
        });

    $statusColors = [
        'Open' => 'bg-blue-100',
        'In Progress' => 'bg-yellow-100',
        'Done' => 'bg-green-100',
    ];

    return view('dashboard', compact('tasks', 'statusColors'));
}


    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return view('dashboard', compact('task'));
    }

    public function landingPage() {
        if (auth()->check()) {
            return redirect('dashboard');
        }

    return view('landing-page');
    }
}
