<!-- Modal Detail Tugas: Menampilkan detail tugas seperti judul, tanggal jatuh tempo, deskripsi, dan lampiran -->
<div class="fixed z-50 bg-white w-[90%] md:w-[40%] top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 p-4 rounded-[10px] hidden" id="detailModal-{{ $task->id }}">
    
    <!-- Judul tugas -->
    <div class="flex justify-between">
        <h1 class="text-lg md:text-xl font-semibold text-dark">{{ $task->title }}</h1>
    </div>

    <!-- Tanggal jatuh tempo -->
    <div class="flex gap-x-4"> 
            <!-- Menampilkan tanggal jatuh tempo -->
            <p class="text-xs flex gap-x-1  py-[2px] px-[2px] rounded-sm shadow-sm
                 @if($task->due_date)
                    @if(\Carbon\Carbon::parse($task->due_date)->isPast())
                        text-red-600 bg-red-100 <!-- Menandakan jika tanggal jatuh tempo sudah lewat -->
                    @else
                        text-green-600 bg-green-100 <!-- Menandakan jika tanggal jatuh tempo belum lewat -->
                    @endif
                @else
                    text-gray-600 bg-gray-100 <!-- Menandakan jika tidak ada tanggal jatuh tempo -->
                @endif">
                <i data-feather="clock" class="size-14 mt-[2px]"></i> 
                @if($task->due_date)
                    {{ \Carbon\Carbon::parse($task->due_date)->format('Y-m-d ') }} <!-- Format tanggal -->
                @else
                    <span>No Due Date</span> <!-- Menampilkan pesan jika tidak ada tanggal jatuh tempo -->
                @endif
            </p>   
    </div>

    <!-- Deskripsi tugas -->
    <div class="mt-6">
        <h1 class="font-semibold text-sm md:text-lg mb-2">Description</h1>
        <div class="mt-3 border-l-2 border-blue-400 px-2 rounded-[4px]">
            <p class="text-[#31363F]">{{ $task->description }}</p>
        </div>
    </div>

    <!-- Menampilkan lampiran tugas jika ada -->
    <div class="mt-3">
        @if ($task->attachments->isNotEmpty())
            <h3 class="text-sm md:text-lg font-semibold mt-4">Attachments:</h3>
            <ul>
                @foreach ($task->attachments as $attachment)
                    <li class="flex justify-between">
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
</div>

<!-- Modal Preview File: Digunakan untuk menampilkan preview file lampiran -->
<div id="fileModal" class="fixed hidden z-[999] top-0 left-0 w-full h-screen bg-black bg-opacity-70">
    <div class="flex flex-col p-4 items-center justify-between relative h-full w-full">

        <!-- Tombol untuk menutup modal -->
        <button id="closeFileModal" class="self-end text-gray-500 hover:text-gray-200 font-bold text-3xl md:text-4xl">
            &times;
        </button>

        <!-- Tampilan gambar jika file adalah gambar -->
        <img id="fileImage" class="max-w-full max-h-[60vh]  hidden rounded shadow-md" />

        <!-- Tampilan iframe jika file adalah dokumen (misalnya PDF) -->
        <iframe id="fileFrame" class="w-full h-full hidden rounded shadow-md"></iframe>

        <!-- Tampilan video jika file adalah video -->
        <video id="fileVideo" class="max-w-full max-h-[60vh] hidden rounded shadow-md" controls>
            <source id="videoSource" src="" type="video/mp4" />
            Your browser does not support the video tag.
        </video>

        <!-- Pesan jika file tidak dapat dipratinjau -->
        <div id="fileFallbackMessage" class="hidden text-white text-center mt-4">
            <p class="text-xl font-semibold">There is no preview available for this attachment.</p>
            <p class="text-sm">Please download to view the content of the file.</p>
        </div>

        <!-- Informasi file dan link download -->
        <div class="flex flex-col justify-center gap-y-2 text-center mt-10">
            <h1 id="fileName" class="text-lg md:text-2xl text-white font-bold"></h1>
            <p id="uploadTime" class="text-sm  text-white font-light"></p>
            <a id="downloadFile" href="#" class="text-sm text-white font-light">
                Download File
            </a>
        </div>
    </div>
</div>
