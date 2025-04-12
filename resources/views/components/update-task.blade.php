@props(['task'])

<div class="fixed z-50 inset-0 hidden editTaskModal" id="editTaskModal-{{ $task->id }}">
    <div class="flex justify-center items-center w-full h-full">
        <div class="bg-white p-6 rounded-md mx-[20px] md:w-1/3">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold">Edit Task</h2>
                <button class="text-gray-500 closeEditModal" data-id="{{ $task->id }}">&times;</button>
            </div>

            <form action="{{ route('update', $task->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="block text-sm font-semibold">Title</label>
                    <input type="text" name="title" class="w-full p-2 mt-1 border rounded"
                        value="{{ $task->title }}" required>
                    @error('title')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold">Description</label>
                    <textarea name="description" class="w-full p-2 mt-1 border rounded">{{ $task->description }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

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

                <div class="mb-4">
                    <label class="block text-sm font-semibold">Due Date</label>
                    <input type="date" name="due_date" class="w-full p-2 mt-1 border rounded"
                        value="{{ $task->due_date }}">
                    @error('due_date')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                 <div class="mb-4">
                    <label for="attachment" class="block text-sm font-semibold">Add attachment</label>
                    <input type="file" id="attachment" name="attachment" class="w-full p-2 mt-1 border rounded">
                    @error('attachment')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>  

                <div class="my-3">
                    @if ($task->attachments->isNotEmpty())
                        <h3 class="text-sm font-semibold mt-4">Attachments:</h3>
                        <ul>
                            @foreach ($task->attachments as $attachment)
                                <li>
                                    <button class="text-blue-500 open-file-modal" 
                                    data-file='@json([
                                            "url" => asset('storage/' . $attachment->file_path),
                                            "name" => $attachment->file_name,
                                            "uploaded_at" => $attachment->created_at->format('Y-m-d H:i:s')
                                        ])'>
                                        {{ $attachment->file_name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                <div id="fileModal" class="fixed hidden z-[999] top-0 left-0 w-full h-screen bg-black bg-opacity-70">
                    <div class="flex flex-col p-4 items-center justify-between relative h-full w-full">
                        <button id="closeFileModal" class="self-end text-gray-500 hover:text-gray-200 font-bold text-3xl md:text-4xl">
                            &times;
                        </button>
                        <img id="fileImage" class="max-w-full max-h-[60vh]hidden rounded shadow-md" />
                        <iframe id="fileFrame" class="w-full h-[60vh] hidden rounded shadow-md"></iframe>
                        <video id="fileVideo" class="max-w-full max-h-[60vh] hidden rounded shadow-md" controls>
                            <source id="videoSource" src="" type="video/mp4" />
                            Your browser does not support the video tag.
                        </video>
                        <div id="fileFallbackMessage" class="hidden text-white text-center mt-4">
                            <p class="text-xl font-semibold">There is no preview available for this attachment.</p>
                            <p class="text-sm">Please download to view the content of the file.</p>
                        </div>
                        <div class="flex flex-col justify-center gap-y-2 text-center mt-10">
                            <h1 id="fileName" class="text-lg md:text-2xl text-white font-bold"></h1>
                            <p id="uploadTime" class="text-sm  text-white font-light"></p>
                            <a id="downloadFile" href="#" class="text-sm text-white font-light">
                                Download File
                            </a>
                        </div>
                    </div>
                </div>
                <div class="mb-4">
                    <button type="submit" class="bg-blue-500 text-sm md:text-base text-white py-2 px-4 rounded">Update Task</button>
                </div>
            </form>
        </div>
    </div>
</div>

