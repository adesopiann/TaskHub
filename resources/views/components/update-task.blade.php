<!-- Modal untuk mengedit task-->
<div class="fixed z-50 inset-0 hidden editTaskModal" id="editTaskModal-{{ $task->id }}">
    <div class="flex justify-center items-center w-full h-full">

        <!-- Kontainer isi modal -->
        <div class="bg-white p-6 rounded-md mx-[20px] md:w-1/3">

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
                                    <form action="{{ route('delete.attachment', ['task' => $task->id, 'attachment' => $attachment->id]) }}" method="POST" class="inline-block ml-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 text-sm hover:underline">Delete</button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                <!-- Modal untuk preview file (gambar, video, dokumen, atau fallback) -->
                <div id="fileModal" class="fixed hidden z-[999] top-0 left-0 w-full h-screen bg-black bg-opacity-70">
                    <div class="flex flex-col p-4 items-center justify-between relative h-full w-full">

                        <!-- Tombol tutup modal file -->
                        <button id="closeFileModal" class="self-end text-gray-500 hover:text-gray-200 font-bold text-3xl md:text-4xl">
                            &times;
                        </button>

                        <!-- Preview gambar -->
                        <img id="fileImage" class="max-w-full max-h-[60vh]hidden rounded shadow-md" />

                        <!-- Preview file dokumen -->
                        <iframe id="fileFrame" class="w-full h-[60vh] hidden rounded shadow-md"></iframe>

                        <!-- Preview video -->
                        <video id="fileVideo" class="max-w-full max-h-[60vh] hidden rounded shadow-md" controls>
                            <source id="videoSource" src="" type="video/mp4" />
                            Your browser does not support the video tag.
                        </video>

                        <!-- Pesan fallback jika tidak bisa ditampilkan -->
                        <div id="fileFallbackMessage" class="hidden text-white text-center mt-4">
                            <p class="text-xl font-semibold">There is no preview available for this attachment.</p>
                            <p class="text-sm">Please download to view the content of the file.</p>
                        </div>

                        <!-- Info file -->
                        <div class="flex flex-col justify-center gap-y-2 text-center mt-10">
                            <h1 id="fileName" class="text-lg md:text-2xl text-white font-bold"></h1>
                            <p id="uploadTime" class="text-sm  text-white font-light"></p>
                            <a id="downloadFile" href="#" class="text-sm text-white font-light">
                                Download File
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Tombol submit untuk update -->
                <div class="mb-4 mt-4">
                    <button type="submit" class="bg-blue-500 text-sm md:text-base text-white py-2 px-4 rounded">Update Task</button>
                </div>
            </form>
        </div>
    </div>
</div>

