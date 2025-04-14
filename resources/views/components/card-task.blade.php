<!-- Task Card: Menampilkan kartu untuk setiap tugas -->
<div class="bg-white rounded-[10px] py-2 px-3 mt-3 card-task" data-task-id="{{ $task->id }}">
    <div class="cursor-pointer openDetailModal" data-id="{{ $task->id }}">
     <!-- Judul tugas -->
      <div class="flex justify-between">
          <h1 class="text-lg md:text-xl font-semibold text-dark" id='title'>{{ $task->title }}</h1>
      </div>

      <!-- Deskripsi tugas -->
        <div class="mt-2 border-l-2 border-blue-400 px-2 rounded-[4px]">
            <p class="line-clamp-3 text-sm md:text-base text-[#31363F]" id="description">{{ $task->description }}</p>
        </div>
    </div>

    <!-- Tanggal jatuh tempo dan tombol aksi-->
    <div class="mt-3 flex justify-between">
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

        <!-- Tombol aksi: Edit dan Delete -->
        <div class="flex lg:flex gap-x-4">
            @if (in_array($task->status, ['Open', 'In Progress'])) <!-- Hanya tampilkan tombol edit jika status tugas 'Open' atau 'In Progress' -->
            <button class="text-blue-500 text-xs flex openEditModal" data-id="{{ $task->id }}">Edit </button>
            @endif

            <!-- Tombol untuk menghapus tugas -->
           <button type="button" class="text-red-500 text-xs flex openDeleteModal">Delete</button>
        </div>
    </div>
</div>

