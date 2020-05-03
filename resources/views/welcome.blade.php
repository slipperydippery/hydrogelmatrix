@extends('layouts.app')

@section('content')
    <div class="md:flex pt-6 bg-white">
        <div class="hidden md:block absolute top-0 right-0 left-0 z-0 ">
            <img src="/img/herobackground.svg" class="w-full" alt="">
        </div>
        <div class="md:hidden max-w-md mx-auto">
            <img src="/img/mobilehero.svg" class="w-full" alt="">
        </div>
        <div class="relative md:w-2/5 text-center md:text-left text-secondary px-4 py-2 z-10">
            <div class="md:pl-24 md:py-16">
                <h1 class="text-2xl sm:text-xl md:text-2xl lg:text-4xl xl:text-6xl antialiased tracking-tight leading-none"> 
                    <span class="">Superlijm</span> <br>
                    voor je <span class="font-bold">brein</span> </h1>
                <p class=" text-gray-600 pt-4 mt-2 leading-relaxed">Boost je kennis en zet snel tests in elkaar om jezelf te trainen. Leer termen en concepten in een handomdraai.</p>
                <p class="pb-4"><strong>Klaar om te knallen?</strong></p>

                <a href=" {{ route('register') }} " class="inline-block w-full px-8 mr-4 md:w-auto bg-secondary hover:bg-secondary-dark text-white font-bold py-2 rounded-full"> {{ __('Make an account') }} </a>
                <a href="#" class="inline-block w-full px-8 md:w-auto bg-gray-200 hover:bg-secondary-dark text-gray-700 hover:text-white font-bold py-2 rounded-full"> {{ __('Browse tests') }} </a>
            </div>
        </div>
    </div>
@endsection
