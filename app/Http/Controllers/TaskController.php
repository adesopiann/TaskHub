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

    public function index()
    {
        //
    }



    public function store(StoreTaskRequest $request)
    {
        // Validasi sudah otomatis berjalan karena StoreTaskRequest
        $task = Task::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'due_date' => $request->due_date
        ]);

        // Cek apakah ada file yang diunggah
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filePath = $file->store('attachments', 'public'); // Simpan di storage/app/public/attachments

            // Simpan informasi file di tabel attachments
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


    public function show($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['error' => 'Task not found'], 404);
        }
        return response()->json($task);
    }

   public function update(UpdateTaskRequest $request, Task $task)
    {
        // Validasi sudah otomatis berjalan karena UpdateTaskRequest
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

    
    public function updateStatus(Request $request, $id)
    {
        
        dd($request->all()); 
        
        $task = Task::findOrFail($id);
        $task->status = $request->status;
        $task->save();
        
        return response()->json(['success' => true, 'message' => 'Status updated successfully']);
    }
    
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        dd($task);
        return view('components.update-task', compact('task'));
    }
    
    public function destroy(Task $task)
    {
        $task->delete();
        if($task) {
            return redirect('/');
        }
    }
}
