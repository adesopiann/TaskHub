<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attachment;

class AttachmentController extends Controller
{
    public function store(Request $request, Task $task) {
        $request->validate([
            'file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5020'
        ]);

        if($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = $file->hashName();
            $filepath = $file->storeAs('attachments', $filename, 'public');

            $attachment = $task->attachments()->create([
                'file' => $filename,
                'file_path' => $filepath
            ]);

            return redirect('/')->with('success', 'File has been uploaded!');
        }

        return back()->with('fail', 'Something wrong!');
    }

    public function destroy(Attachment $attachment) {
        Storage::delete('public/' . $attachment->file_path);
        $attachment->delete();
        return redirect('/');
    }
}
