@props(['task'])

<div class="fixed z-50 inset-0 hidden editTaskModal" id="editTaskModal-{{ $task->id }}">
    <div class="flex justify-center items-center w-full h-full">
        <div class="bg-white p-6 rounded-md w-1/3">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold">Edit Task</h2>
                <button class="text-gray-500 closeEditModal" data-id="{{ $task->id }}">&times;</button>
            </div>

            <form action="{{ route('update', $task->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="block text-lg font-semibold">Title</label>
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
                        <h3 class="text-lg font-semibold mt-4">Attachments:</h3>
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

                <div id="fileModal" class="fixed inset-0 bg-black hidden   bg-opacity-50  z-[999]">
                    <div class=" p-4 rounded-lg shadow-lg w-full h-full flex flex-col">
                        <button id="closeFileModal" class="self-end text-gray-500 hover:text-gray-200 font-bold text-4xl">&times;</button>
                        <iframe id="fileFrame" class="w-full h-full"></iframe>
                        <div class="flex flex-col justify-center text-center mt-10">
                            <h1 id="fileName" class="text-3xl text-white font-bold "></h1>
                            <p id="uploadTime" class="text-[16px] text-white font-light"></p>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Update Task</button>
                </div>
            </form>
        </div>
    </div>
</div>

