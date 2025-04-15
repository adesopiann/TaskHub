<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Attachment;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;


class TaskController extends Controller
{
    public function store(StoreTaskRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = auth()->id();

        $task = Task::create($validated);

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filePath = $file->store('attachments', 'public');

            Attachment::create([
                'task_id' => $task->id,
                'file_name' => $file->getClientOriginalName(),
                'file_path' => $filePath
            ]);
        }

        return redirect('/')
            ->withInput()
            ->with('showModalAddTask', true);
    }


    // Menampilkan tugas berdasarkan ID
    public function show($id)
    {
        $task = Task::find($id);

        // Menangani jika tugas tidak ditemukan
        if (!$task) {
            return response()->json(['error' => 'Task not found'], 404);
        }

        return response()->json($task);
    }

   public function update(UpdateTaskRequest $request, Task $task)
    {
        // Validasi input otomatis melalui UpdateTaskRequest
        $task->update($request->validated());

        // Cek apakah ada file yang diunggah
        if ($request->hasFile('attachment')) {
        $file = $request->file('attachment');
        $filePath = $file->store('attachments', 'public');

        Attachment::create([
            'task_id' => $task->id,
            'file_name' => $file->getClientOriginalName(),
            'file_path' => $filePath
        ]);
     }

        return redirect('/');
    }
    
    // Menampilkan halaman edit untuk tugas tertentu
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return view('components.update-task', compact('task'));
    }
    
    // Menghapus tugas
    public function destroy(Task $task)
    {
        $task->delete();
        if($task) {
            return redirect('/');
        }
    }

    // Menghapus attachment dari tugas
    public function destroyAttachment(Task $task, Attachment $attachment)
    {
       // Memastikan file yang akan dihapus memang milik tugas ini
        if ($attachment->task_id === $task->id) {
            // Hapus file dari storage
            Storage::delete('public/' . $attachment->file_path);

            // Hapus record attachment dari database
            $attachment->delete();

            return redirect()->back()->with('success', 'Attachment has been deleted!');
        }

        return redirect()->back()->with('error', 'Attachment not found!');
    }
}
