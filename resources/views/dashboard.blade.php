@extends('components.layouts.container')

@section('main')
    <div class="flex md:hidden justify-between mx-[20px] gap-x-6 mt-4">
        <button id="showOpen" class="toggle-btn bg-blue-500 text-white text-sm md:text-base py-2 px-4 rounded border border-blue-500">Open</button>
        <button id="showInProgress" class="toggle-btn bg-white text-blue-500 text-sm md:text-base py-2 px-4 rounded border border-blue-500">In Progress</button>
        <button id="showDone" class="toggle-btn bg-white text-blue-500 text-sm md:text-base py-2 px-4 rounded border border-blue-500">Done</button>
    </div>
    <section class="mt-[50px] mx-[20px]  md:mx-[100px] "> 
         <button id="openModalAdd" class="bg-blue-500 text-sm md:text-base text-white py-2 px-4 rounded mb-4">Add Task</button>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-x-6">
            <div id="openTasks" class="task-category hidden md:block">
                <x-shows-task :status="'Open'" :tasks="$tasks['Open'] ?? []" />
            </div>
            <div id="inProgressTasks" class="task-category hidden md:block">
                <x-shows-task :status="'In Progress'" :tasks="$tasks['In Progress'] ?? []" />
            </div>
            <div id="doneTasks" class="task-category hidden md:block">
                <x-shows-task :status="'Done'" :tasks="$tasks['Done'] ?? []" />
            </div>
        </div>
        
        <!-- Modal Add -->
        <x-store-task />
        
        <!-- modal box for detail-task -->
        @foreach($tasks as $status => $taskGroup)
            @foreach($taskGroup as $task)
                <x-detail-task :task="$task" />
            @endforeach
        @endforeach


        <!-- modal box edit -->
        @foreach($tasks as $status => $taskGroup)
            @foreach($taskGroup as $task)
                <x-update-task :task="$task" />
            @endforeach
        @endforeach
        
        
        <!-- Overlay -->
        <div id="overlay" class="fixed w-screen h-screen bg-gray-900 inset-0 bg-opacity-50 hidden"></div>

        
    </section>
@endsection

@if ($errors->any())
    <script>
        window.onload = function () {
            document.getElementById("addTaskModal")?.classList.remove("hidden");
            document.getElementById("overlay")?.classList.remove("hidden");
        }
    </script>
@endif

@section('script')
    <script>
        // AddModal
        document.addEventListener('DOMContentLoaded', function() {
            const openAddModal = document.getElementById("openModalAdd");
            const addTaskModal = document.getElementById("addTaskModal");
            const overlay = document.getElementById("overlay");
            const closeAddModal = document.getElementById('closeAddModal');

            console.log("openAddModal:", openAddModal);
            console.log("addTaskModal:", addTaskModal);
            console.log("overlay:", overlay);
            console.log("closeAddModal:", closeAddModal);

            if (!openAddModal || !addTaskModal || !overlay || !closeAddModal) {
                console.error("❌ Salah satu elemen modal tidak ditemukan!");
                return;
            }

            // Tampilkan modal saat tombol "Add Task" diklik
            openAddModal.addEventListener("click", function() {
                console.log('Klik tombol Add Task');
                addTaskModal.classList.remove("hidden");
                overlay.classList.remove("hidden");
            });

            // Menutup Modal
            closeAddModal.addEventListener("click", function() {
                addTaskModal.classList.add('hidden');
                overlay.classList.add('hidden');
            });

            // Tutup modal saat klik di luar modal
            overlay.addEventListener('click', function(event) {
                if (event.target === overlay) {
                    addTaskModal.classList.add('hidden');
                    overlay.classList.add('hidden');
                }
            });
        });
    </script>
@endsection
