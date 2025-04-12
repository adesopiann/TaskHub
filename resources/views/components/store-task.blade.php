<div class="fixed z-50 inset-0  hidden" id="addTaskModal">
    <div class="flex justify-center items-center w-full h-full">
        <div class="bg-white p-6 rounded-md w-[80%] md:w-1/3" id="modalContent">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold">Add New Task</h2>
                <button id="closeAddModal" class="text-gray-500">&times;</button>
            </div>
            
            <form action="{{ route('store') }}" method="POST" id="addTaskForm" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="mb-4">
                    <label for="title" class="block text-sm font-semibold">Title</label>
                    <input type="text" id="title" name="title" class="w-full p-2 mt-1 border rounded"  required>
                    @error('title')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-sm font-semibold">Description</label>
                    <textarea id="description" name="description" class="w-full p-2 mt-1 border rounded"></textarea>
                    @error('description')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="status" class="block text-sm font-semibold">Status</label>
                    <select name="status" id="status" class="w-full p-2 mt-1 border rounded" required>
                        <option value="Open" {{ old('status') == 'Open' ? 'selected' : '' }}>Open</option>
                        <option value="In Progress" {{ old('status') == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="Done" {{ old('status') == 'Done' ? 'selected' : '' }}>Done</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="due_date" class="block text-sm font-semibold">Due Date</label>
                    <input type="date" id="due_date" name="due_date" class="w-full p-2 mt-1 border rounded" >
                    @error('due_date')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="attachment" class="block text-sm font-semibold">Attachment</label>
                    <input type="file" id="attachment" name="attachment" class="w-full p-2 mt-1 border rounded">
                    @error('attachment')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>  

                <div class="mb-4">
                    <button type="submit" class="bg-blue-500 text-sm md:text-base text-white py-2 px-4 rounded">Add Task</button>
                </div>
            </form>
        </div>
    </div>
</div>


