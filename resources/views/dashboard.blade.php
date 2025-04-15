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
        
        
        @foreach($tasks as $status => $taskGroup)
            @foreach($taskGroup as $task)
                <!-- Modal detail tugas -->
                <x-detail-task :task="$task" />

                <!-- Modal edit tugas -->
                <x-update-task :task="$task" />


                <!--  Modal Delete Confirmation -->
                  <div id="deleteModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center hidden">
                    <div class="bg-white p-6 rounded-lg w-96">
                        <h2 class="text-lg font-semibold text-center">Are you sure you want to delete this task?</h2>
                        <div class="flex justify-center mt-4">
                            <!-- Form untuk menghapus tugas -->
                            <form id="deleteForm" action="{{ route('delete', $task->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-300 text-white py-2 px-4 rounded mr-4">Yes, Delete</button>
                            </form>
                            <button id="cancelDelete" class="bg-gray-300 text-gray-700 py-2 px-4 rounded">Cancel</button>
                        </div>
                    </div>
                </div>
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

