@extends('components.layouts.container')

@section('main')
    <!-- Tombol filter kategori tugas (hanya muncul di mobile) -->
    <div class="flex lg:hidden justify-between mx-[20px] md:mx-[60px] gap-x-6 mt-4">
        <button id="showOpen" class="toggle-btn bg-blue-500 text-white text-sm md:text-base py-2 px-4 rounded border border-blue-500">Open</button>
        <button id="showInProgress" class="toggle-btn bg-white text-blue-500 text-sm md:text-base py-2 px-4 rounded border border-blue-500">In Progress</button>
        <button id="showDone" class="toggle-btn bg-white text-blue-500 text-sm md:text-base py-2 px-4 rounded border border-blue-500">Done</button>
    </div>

    <!-- Bagian utama tampilan tugas -->
    <section class="mt-[50px] mx-[20px] md:mx-[60px]  lg:mx-[100px] "> 

        <!-- Tombol untuk membuka modal tambah tugas -->
        <button id="openModalAdd" class="bg-blue-500 text-sm md:text-base text-white py-2 px-4 rounded mb-4">Add Task</button>

        <!-- Grid tampilan tugas berdasarkan status (desktop) -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-x-6">

            <!-- Tugas dengan status "Open"  -->
            <div id="openTasks" class="task-category hidden lg:block">
                <x-shows-task :status="'Open'" :tasks="$tasks['Open'] ?? []" />  <!-- Memanggil komponen shows-task -->
            </div>

            <!-- Tugas dengan status "In Progress"  -->
            <div id="inProgressTasks" class="task-category hidden lg:block">
                <x-shows-task :status="'In Progress'" :tasks="$tasks['In Progress'] ?? []" /> <!-- Memanggil komponen shows-task -->
            </div>

            <!-- Tugas dengan status "Done"  -->
            <div id="doneTasks" class="task-category hidden lg:block">
                <x-shows-task :status="'Done'" :tasks="$tasks['Done'] ?? []" /> <!-- Memanggil komponen shows-task -->
            </div>
        </div>
        
        <!-- Komponen modal untuk tambah tugas -->
        <x-store-task />
        
        <!-- Modal detail tugas (looping semua tugas untuk masing-masing status) -->
        @foreach($tasks as $status => $taskGroup)
            @foreach($taskGroup as $task)
                <x-detail-task :task="$task" />
            @endforeach
        @endforeach


        <!-- Modal edit tugas -->
        @foreach($tasks as $status => $taskGroup)
            @foreach($taskGroup as $task)
                <x-update-task :task="$task" />
            @endforeach
        @endforeach
        
        
        <!-- Overlay -->
        <div id="overlay" class="fixed w-screen h-screen bg-gray-900 inset-0 bg-opacity-50 hidden"></div>

        
    </section>
@endsection

    <!-- Jika terjadi error validasi, tampilkan modal tambah tugas secara otomatis  -->
    @if ($errors->any())
        <script>
            window.onload = function () {
                document.getElementById("addTaskModal")?.classList.remove("hidden");
                document.getElementById("overlay")?.classList.remove("hidden");
            }
        </script>
    @endif