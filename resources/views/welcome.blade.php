@extends('layouts.app')

@section('content')
    <div class="md:flex md:flex-row-reverse mx-auto pt-6 bg-white">
        <div class="">
            <img src="/img/feature.svg" class="w-full" alt="">
        </div>
        <div class="px-4 py-2 lg:w-1/2 text-center lg:text-left text-gray-600">
            <div class="lg:pl-24 lg:py-16">
                <h1 class="text-2xl sm:text-xl md:text-2xl lg:text-4xl xl:text-6xl antialiased  tracking-tight font-semibold">Scaffolding for your brain</h1>
                <p class="italic mt-2 text-gray-600 py-4">"Pellentesque posuere. Suspendisse nisl elit, rhoncus eget, elementum ac, condimentum eget, diam. Nullam accumsan lorem in dui. Vivamus quis mi."</p>

                <a href=" {{ route('register') }} " class="inline-block w-full px-8 mr-4 lg:w-auto bg-secondary hover:bg-secondary-dark text-white font-bold py-2 rounded"> Make account </a>
                <a href="#" class="inline-block w-full px-8 lg:w-auto bg-gray-200 hover:bg-secondary-dark text-gray-700 hover:text-white font-bold py-2 rounded"> Browse tests </a>
            </div>
        </div>
    </div>

@endsection
