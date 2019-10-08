@extends('layouts.app')

@section('content')
    <div class="container md:flex mx-auto mt-6">
        <div class="px-4 py-2 lg:w-1/2 lg:text-center text-gray-600">
            <div class="lg:pl-24 lg:py-16">
                <h1 class="text-2xl sm:text-xl md:text-2xl lg:text-4xl xl:text-6xl antialiased  tracking-tight font-semibold">Scaffolding for your brain</h1>
                <p class="italic mt-2 text-gray-600">"Pellentesque posuere. Suspendisse nisl elit, rhoncus eget, elementum ac, condimentum eget, diam. Nullam accumsan lorem in dui. Vivamus quis mi."</p>

                <a href=" {{ route('register') }} " class="inline-block w-full px-8 mr-4 lg:w-auto bg-blue-500 hover:bg-blue-700 text-white font-bold py-2  rounded my-2"> Make account </a>
                <a href="#" class="inline-block w-full px-8 lg:w-auto bg-gray-200 hover:bg-blue-700 text-gray-700 hover:text-white font-bold py-2  rounded my-2"> Browse tests </a>
            </div>
        </div>
        <div class="">
            <img src="https://dummyimage.com/600x400/c2c2c2/f2f2f2&text=intro" class="w-full" alt="">
        </div>
    </div>

@endsection
