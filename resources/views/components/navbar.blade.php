<nav class="z-[999] navbar p-4 text-white flex justify-between items-center shadow-lg shadow-blue-500/30">
    <a href="{{ route('landingPage') }}" class="text-2xl font-bold text-blue-500">TaskHub</a>

    <!-- Menampilkan menu user setelah login -->
    @auth
    <div class="hidden md:flex items-center gap-4">
        <span class="text-blue-500 font-semibold">Halo, {{ Auth::user()->name }}</span>
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded openLogoutModal">
            Logout
        </button>
    </div>

    <!-- Menu Burger pada versi mobile -->
    <div class="md:hidden">
        <button id="burgerBtn" class="focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-500" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>

    <!-- Menu popup user (hanya tampil di mobile) -->
    <div id="userMenu" class="hidden absolute top-16 right-4 bg-white text-blue-500 rounded-lg shadow-lg p-4 flex flex-col gap-2 md:hidden z-[9999] border border-gray-300">
        <span class="font-semibold">Halo, {{ Auth::user()->name }}</span>
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded openLogoutModal">
            Logout
        </button>
    </div>
    @endauth

    <!-- Menampilkan menu bagi pengguna yang belum login -->
    @guest
    <div class="hidden md:flex gap-x-6">
        <a href="{{ route('registerPage') }}" class="bg-blue-500 shadow-xl text-lg rounded-md py-1 px-4">Sign Up</a>
        <a href="{{ route('loginPage') }}" class="bg-white text-blue-500 shadow-xl text-lg rounded-md py-1 px-4">Sign In</a>
    </div>
    @endguest
</nav>  

<!--Logout Modal Confirmation -->
<div id="logoutModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center hidden">
    <div class="bg-white p-6 rounded-lg w-96">
        <h2 class="text-lg font-semibold text-center">Are you sure you want to logout?</h2>
        <div class="flex justify-center mt-4">
            <form id="logoutForm" action="{{ route('logout') }}" method="POST">
                @csrf
                @method('POST')
                <button type="submit" class="bg-red-300 text-white py-2 px-4 rounded mr-4">Yes</button>
            </form>
            <button id="cancelLogout" class="bg-gray-300 text-gray-700 py-2 px-4 rounded">Cancel</button>
        </div>
    </div>
</div>
