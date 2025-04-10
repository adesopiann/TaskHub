<div class="bg-blue-200 rounded-[8px] p-3 flex flex-col gap-y-3 h-fit">
    <h1 class="font-bold text-xl text-gray-800">{{ $status }}</h1>
    @foreach ($tasks as $task)
        <x-card-task :task="$task"  />
    @endforeach
</div>