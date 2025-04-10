<div class="fixed z-50 bg-white w-[40%] top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 p-4 rounded-[10px] hidden" id="detailModal-{{ $task->id }}">
    <div class="flex justify-between">
        <h1 class="text-xl font-semibold text-dark">{{ $task->title }}</h1>
    </div>
    <div class=" mt-3">
        <p class="text-xs font-semibold">Due date</p>
        <p class="text-xs flex gap-x-1 py-[2px] px-[4px] w-fit bg-gray-200 mt-1 rounded-[2px]"><i data-feather="clock" class="size-14"></i>
             @if($task->due_date)
                {{ \Carbon\Carbon::parse($task->due_date)->format('M d') }}
            @else
                <span class="">No Due Date</span>
            @endif
        </p>
    </div>
    <div class="mt-6">
        <h1 class="font-semibold text-lg mb-2">Description</h1>
        <div class="mt-3 border-l-2 border-blue-400 px-2 rounded-[4px]">
            <p class="text-[#31363F]">{{ $task->description }}</p>
        </div>
    </div>

    <div class="mt-3">
        @if ($task->attachments->isNotEmpty())
            <h3 class="text-lg font-semibold mt-4">Attachments:</h3>
            <ul>
                @foreach ($task->attachments as $attachment)
                    <li>
                        <a href="#" class="text-blue-500 open-file-modal" 
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
</div>

<div id="fileModal" class="fixed hidden z-[999] top-0 left-0 w-full h-screen bg-black bg-opacity-70">
    <div class=" flex flex-col p-4 items-center  justify-between relative h-full w-full">
        <button id="closeFileModal" class="self-end text-gray-500 hover:text-gray-200 font-bold text-4xl">&times;</button>
        <img id="fileImage" class="max-w-full max-h-[70vh] hidden rounded shadow-md" />
        <iframe id="fileFrame" class="w-full h-[80vh] hidden"></iframe>
        <div id="fileFallbackMessage" class="hidden text-white text-center mt-4">
            <p class="text-xl font-semibold">There is no preview available for this attachment.</p>
            <p class="text-sm">Please download to view the content of the file.</p>
        </div>
        <div class="flex flex-col justify-center gap-y-2 text-center mt-10">
            <h1 id="fileName" class="text-3xl text-white font-bold "></h1>
            <p id="uploadTime" class="text-[16px] text-white font-light"></p>
            <a id="downloadFile" href="#" class=" text-[16px] text-white font-light">
                Download File
            </a>
        </div>
    </div>
</div>