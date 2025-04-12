<div class="bg-white rounded-[10px] py-2 px-3 mt-3 card-task" data-task-id="{{ $task->id }}">
    <div class="cursor-pointer openDetailModal" data-id="{{ $task->id }}">
      <div class="flex justify-between">
          <h1 class="text-lg md:text-xl font-semibold text-dark" id='title'>{{ $task->title }}</h1>
      </div>
        <div class="mt-2 border-l-2 border-blue-400 px-2 rounded-[4px]">
            <p class="line-clamp-3 text-sm md:text-base text-[#31363F]" id="description">{{ $task->description }}</p>
        </div>
    </div>
    <div class="mt-3 flex justify-between">
        <div class="flex gap-x-4">
                <p class="text-xs text-[#31363F] flex gap-x-1">
                    <i data-feather="clock" class="size-14 mt-[2px]"></i> 
                    @if($task->due_date)
                        {{ \Carbon\Carbon::parse($task->due_date)->format('M d') }}
                    @else
                        <span class="">No Due Date</span>
                    @endif
                </p>   
        </div>
        <div class="flex gap-x-4">
            @if (in_array($task->status, ['Open', 'In Progress']))
            <button class="text-blue-800 text-xs flex openEditModal" data-id="{{ $task->id }}">Edit </button>
            @endif
           <button type="button" class="text-red-800 text-xs flex openDeleteModal">Delete</button>
        </div>
    </div>
</div>

<!-- Modal Confirmation -->
<div id="deleteModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center hidden">
    <div class="bg-white p-6 rounded-lg w-96">
        <h2 class="text-lg font-semibold text-center">Are you sure you want to delete this task?</h2>
        <div class="flex justify-center mt-4">
            <form id="deleteForm" action="{{ route('delete', $task->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-300 text-white py-2 px-4 rounded mr-4">Yes, Delete</button>
            </form>
            <button id="cancelDelete" class="bg-gray-300 text-gray-700 py-2 px-4 rounded">Cancel</button>
        </div>
    </div>
</div>
