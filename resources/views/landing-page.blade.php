@extends('components.layouts.container')

@section('main')
<section class="mx-[20px] lg:mx-[100px] mt-[60px] md:mt-[140px]">
    <div class="flex flex-col items-center justify-center">
        <h1 class="mx-[10px] md:mx-[80px] lg:mx-[220px] font-bold text-[32px] md:text-[52px] lg:text-[64px] md:text-center leading-tight z-50">
            Master Your Day with <span class="text-blue-500 text-[38px] md:text-[68px]">TaskHub.</span> The Smarter Way to Organize Life.</span>
        </h1>
        <p class="mx-[10px] mt-[28px] md:mt-[28px] lg:mx-[360px] md:text-center">Say goodbye to scattered notes and missed deadlines. TaskHub brings everything you need into one simple, powerful workspace. Plan your day, track your progress. With an intuitive interface and smart features, TaskHub makes productivity feel effortless. It's time to work smarter, not harder.</p>

        <a href="{{ route('registerPage') }}" class="bg-blue-500 text-lg w-full py-1 px-2  mt-[28px] rounded-md shadow-lg text-white font-semibold block md:w-fit">Let's Get Ready!</a>
        <a href="{{ route('loginPage') }}" class="mt-[10px] font-semibold text-lg py-1 px-2 w-full  bg-white text-blue-500 rounded-md shadow-lg block md:hidden">Already Have an Account?</a>
        
        <!-- Gambar ilustrasi untuk tampilan desktop -->
       <img src="img/image2.png" class="rounded-t-lg border border-gray-200 mt-[28px] hidden md:block" alt="">

       <!-- Gambar ilustrasi untuk tampilan mobile -->
       <img src="img/image-mobile.png" class="rounded-t-lg border border-gray-200 mt-[28px] md:hidden block" alt="">
    </div>
</section>
@endsection
