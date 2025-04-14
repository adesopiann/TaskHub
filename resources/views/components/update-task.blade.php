<!-- 
    Modal untuk mengedit task.
    Modal ini disembunyikan secara default dengan class 'hidden' dan akan muncul saat user mengklik tombol tertentu.
-->
<div class="fixed z-50 inset-0 hidden editTaskModal" id="editTaskModal-{{ $task->id }}">
    <div class="flex justify-center items-center w-full h-full">

        <!-- Kontainer isi modal -->
        <div class="bg-white p-6 rounded-md mx-[20px] w-[80%] lg:w-1/3">

            <!-- Header modal -->
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold">Edit Task</h2>
                <button class="text-gray-500 closeEditModal" data-id="{{ $task->id }}">&times;</button>
            </div>

            <!-- Form untuk update task -->
            <form action="{{ route('update', $task->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Input judul task -->
                <div class="mb-4">
                    <label class="block text-sm font-semibold">Title</label>
                    <input type="text" name="title" class="w-full p-2 mt-1 border rounded" value="{{ $task->title }}" required>
                    @error('title')<p class="text-red-500 text-sm">{{ $message }}</p>@enderror
                </div>

                <!-- Input deskripsi task -->
                <div class="mb-4">
                    <label class="block text-sm font-semibold">Description</label>
                    <textarea name="description" class="w-full p-2 mt-1 border rounded">{{ $task->description }}</textarea>
                    @error('description')<p class="text-red-500 text-sm">{{ $message }}</p>@enderror
                </div>

                <!-- Dropdown pilihan status task -->
                <div class="mb-4">
                    <label class="block text-sm font-semibold">Status</label>
                    <select name="status" class="w-full p-2 mt-1 border rounded" required>
                        <option selected>{{ $task->status }}</option>

                        @if ($task->status === 'Open')
                        <option value="In Progress" {{ $task->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                        @else ($task->status === 'In Progress')
                        <option value="Done" {{ $task->status == 'Done' ? 'selected' : '' }}>Done</option>
                        @endif
                    </select>
                </div>

                <!-- Input tanggal deadline -->
                <div class="mb-4">
                    <label class="block text-sm font-semibold">Due Date</label>
                    <input type="date" name="due_date" class="w-full p-2 mt-1 border rounded" value="{{ $task->due_date }}">
                    @error('due_date')<p class="text-red-500 text-sm">{{ $message }}</p>@enderror
                </div>

                <!-- Input upload file baru -->
                 <div class="mb-4">
                    <label for="attachment" class="block text-sm font-semibold">Add attachment</label>
                    <input type="file" id="attachment" name="attachment" class="w-full p-2 mt-1 border rounded">
                    @error('attachment')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>  

                <!-- Daftar file attachment yang sudah ada -->
                <div class="mt-3">
                    @if ($task->attachments->isNotEmpty())
                        <h3 class="text-sm md:text-lg font-semibold mt-4">Attachments:</h3>
                        <ul>
                            @foreach ($task->attachments as $attachment)
                                <li class="flex justify-between">
                                    <!-- Link untuk melihat file di modal -->
                                    <a href="#" class="text-sm md:text-base text-blue-500 open-file-modal" 
                                    data-file='@json([
                                            "url" => asset('storage/' . $attachment->file_path),
                                            "name" => $attachment->file_name,
                                            "uploaded_at" => $attachment->created_at->format('Y-m-d H:i:s')
                                        ])'>
                                        {{ $attachment->file_name }}
                                    </a>
                                    <!-- Tombol untuk menghapus file -->
                                    <button
                                        type="button"
                                        onclick="document.getElementById('deleteAttachmentForm-{{ $attachment->id }}').submit();"
                                        class="text-red-500 text-sm hover:underline">
                                        Delete
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                <!-- Tombol submit untuk update -->
                <div class="mb-4 mt-4">
                    <button id="updateButton" type="submit" class="bg-blue-500 text-sm md:text-base text-white py-2 px-4 rounded">Update Task</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal untuk preview file (gambar, video, dokumen, atau fallback) -->
<x-file-modal />


@foreach ($task->attachments as $attachment)
    <form id="deleteAttachmentForm-{{ $attachment->id }}" action="{{ route('delete.attachment', ['task' => $task->id, 'attachment' => $attachment->id]) }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
@endforeach