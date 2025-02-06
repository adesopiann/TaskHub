@extends('components.container')

@section('main')
<section class="flex justify-center items-center mt-[100px]">
    <div class=" py-[20px] px-[25px] rounded-[10px] shadow-md ">
        <h1 class="text-xl font-bold text-blue-500 mb-8">TaskHub</h1>
        <div class="mb-14">
            <h1 class=" text-3xl font-semibold text-center text-dark mb-2">Sign Up For Free</h1>
            <p class="text-xs text-center text-black/70">Manage your work, with TaskHub.</p>
        </div>
        <form action="{{ route('register') }}" method="post" class="">
            @csrf
            <div class="flex flex-col mb-4">
                <label for="name" class="mb-2">Name</label>
                <input type="text" name="name" id="name" class=" rounded-[6px] w-[340px] p-1 shadow-md  focus:ring-2 focus:ring-blue-400 border border-gray-300 focus:outline-none" autofocus required novalidate>
                @error('name')<span class=" text-red-500 text-xs mt-1">{{ $message }}</span>@enderror
            </div>
            <div class="flex flex-col mb-4">
                <label for="email" class="mb-2">Email</label>
                <input type="email" name="email" id="email" class=" rounded-[6px] w-[340px] p-1 shadow-md  focus:ring-2 focus:ring-blue-400 border border-gray-300 focus:outline-none" required>
                @error('email')<span class=" text-red-500 text-xs mt-1">{{ $message }}</span>@enderror
            </div>
            <div class="flex flex-col mb-4">
                <label for="password" class="mb-2">Password</label>
                <input type="password" name="password" id="password" class=" rounded-[6px] p-1  shadow-md focus:ring-2 focus:ring-blue-400 border border-gray-300 focus:outline-none" required> 
                @error('password')<span class=" text-red-500 text-xs mt-1">{{ $message }}</span>@enderror
            </div>
            <div class="mb-4">
                <h1 class="text-black/70 text-xs text-center">Already have account? <a href="{{ route('loginPage') }}" class="underline">Sign In</a></h1>
            </div>
            <button type="submit" class="py-1 w-full bg-blue-500 hover:bg-blue-400 font-semibold text-[16px] text-center rounded-[10px] text-white ">Get Started</button>
        </form>
    </div>
</section>
@endsection