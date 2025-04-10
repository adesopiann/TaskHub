@extends('components.layouts.container')

@section('main')
    <section class="mt-[50px] mx-[100px] "> 
        <button id="openModalAdd" class="bg-blue-500 text-white py-2 px-4 rounded mb-4">Add Task</button>
        <div class="grid grid-cols-3 gap-x-6">
            <x-shows-task :status="'Open'" :tasks="$tasks['Open'] ?? []" />
            <x-shows-task :status="'In Progress'" :tasks="$tasks['In Progress'] ?? []" />
            <x-shows-task :status="'Done'" :tasks="$tasks['Done'] ?? []" />
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
