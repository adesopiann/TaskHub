@extends('components.container')

@section('main')
<section>
    <section class="flex justify-center items-center mt-[100px]">
    <div class=" py-[20px] px-[25px] rounded-[10px] shadow-md ">
        <h1 class="text-xl font-bold text-blue-500 mb-8">TaskHub</h1>
        <div class="mb-14">
            <h1 class=" text-3xl font-semibold text-center text-dark mb-2">Welcome Back!</h1>
            <p class="text-xs text-center text-black/70">Manage your work, with TaskHub.</p>
        </div>

        <form action="{{ route('login') }}" method="post" class="">
            @csrf
            <div class="flex flex-col mb-4">
                <label for="email" class="mb-2">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" class=" rounded-[6px] w-[340px] p-1 shadow-md  focus:ring-2 focus:ring-blue-400 border border-gray-300 focus:outline-none @error('email') is-invalid @enderror" autofocus required>
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex flex-col mb-4">
                <label for="password" class="mb-2">Password</label>
                <input type="password" name="password" id="password" class=" rounded-[6px] p-1  shadow-md focus:ring-2 focus:ring-blue-400 border border-gray-300 focus:outline-none" required>
            </div>

            @if(session()->has('loginError'))
                <div class="text-xs text-red-500">
                    {{ session('loginError') }}
                </div>
            @endif

            <div class="mb-4">
                <h1 class="text-black/70 text-xs text-center">Doesn't have account? <a href="{{ route('registerPage') }}" class="underline">Sign Up</a></h1>
            </div>
            <button type="submit" class="py-1 w-full bg-blue-500 hover:bg-blue-400 font-semibold text-[16px] text-center rounded-[10px] text-white ">Sign In</button>
        </form>
    </div>
</section>
</section>
@endsection