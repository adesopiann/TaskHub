<nav class="navbar p-4 text-white flex justify-between items-center shadow-lg shadow-blue-500/30">
    <div class="text-2xl font-bold text-blue-500">TaskHub</div>
    @auth
    <div class="flex items-center gap-4">
        <span class="text-blue-500 font-semibold">Halo, {{ Auth::user()->name }}</span>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded">
                Logout
            </button>
        </form>
    </div>
    @endauth
</nav>  