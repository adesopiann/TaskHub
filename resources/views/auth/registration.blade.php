@extends('components.layouts.container')

@section('main')
<section class="flex justify-center items-center mt-[100px]">
    <div class=" py-[20px] px-[25px] rounded-[10px] shadow-md w-full mx-[20px] md:w-[50%] lg:w-[26%] border border-gray-200">
        <h1 class="text-xl font-bold text-blue-500 mb-8">TaskHub</h1>
        <div class="mb-14">
            <h1 class=" text-3xl font-semibold text-center text-dark mb-2">Sign Up For Free</h1>
            <p class="text-xs text-center text-black/70">Manage your work, with TaskHub.</p>
        </div>

        <!-- Form Registrasi -->
        <form action="{{ route('register') }}" method="post" class="">
            @csrf

            <!-- Input Name -->
            <div class="flex flex-col mb-4">
                <label for="name" class="mb-2">Name</label>
                <input type="text" name="name" id="name" class="w-full rounded-[6px] p-1 shadow-md  focus:ring-2 focus:ring-blue-400 border border-gray-300 focus:outline-none" autofocus required novalidate>
                @error('name')<span class=" text-red-500 text-xs mt-1">{{ $message }}</span>@enderror
            </div>

            <!-- Input Email -->
            <div class="flex flex-col mb-4">
                <label for="email" class="mb-2">Email</label>
                <input type="email" name="email" id="email" class=" rounded-[6px] w-full p-1 shadow-md  focus:ring-2 focus:ring-blue-400 border border-gray-300 focus:outline-none" required>
                @error('email')<span class=" text-red-500 text-xs mt-1">{{ $message }}</span>@enderror
            </div>

            <!-- Input Password -->
            <div class="flex flex-col mb-4">
                <label for="password" class="mb-2">Password</label>
                <input type="password" name="password" id="password" class="w-full rounded-[6px] p-1 shadow-md focus:ring-2 focus:ring-blue-400 border border-gray-300 focus:outline-none" required>
                @error('password')<span class=" text-red-500 text-xs mt-1">{{ $message }}</span>@enderror

                <!-- Password Validations -->
                <ul id="password-rules" class="text-xs ms-6 mt-2 space-y-1 list-disc hidden">
                    <li id="rule-length" class="text-red-500">Minimum 8 characters</li>
                    <li id="rule-letters" class="text-red-500">Must contain letters</li>
                    <li id="rule-mixed" class="text-red-500">Must contain both uppercase and lowercase letters</li>
                    <li id="rule-numbers" class="text-red-500">Must contain numbers</li>
                    <li id="rule-symbols" class="text-red-500">Must contain symbols</li>
                </ul>
            </div>

            <!-- Link ke halaman login -->
            <div class="mb-4">
                <h1 class="text-black/70 text-xs text-center">Already have account? <a href="{{ route('loginPage') }}" class="underline">Sign In</a></h1>
            </div>

            
            <button type="submit" class="py-1 w-full bg-blue-500 hover:bg-blue-400 font-semibold text-[16px] text-center rounded-[10px] text-white ">Get Started</button>
        </form>
    </div>
</section>
@endsection