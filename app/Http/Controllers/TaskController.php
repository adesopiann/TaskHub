<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;


class TaskController extends Controller
{

    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:250',
            'description' => 'string|nullable',
            'status' =>  'required|in:Open,In Progress,Done',
            'due_date' => 'date|nullable'
        ]);

        $task = Task::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'due_date' => $request->due_date
        ]);

        if($task) {
            return redirect('/');
        }

    }

    public function show(Task $task)
    {
        //
    }

    public function update(Request $request, Task $task)
    {
        $validatedData =  $request->validate([
            'title' => 'required|string|max:250',
            'description' => 'string|nullable',
            'status' =>  'required|in:Open,In Progress,Done',
            'due_date' => 'date|nullable'
        ]);

        $task->update($validatedData);

        if($task) {
            return redirect('/');
        }
    }

    public function destroy(Task $task)
    {
        $task->delete();
        if($task) {
            return redirect('/');
        }
    }

}
