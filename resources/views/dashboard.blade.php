@extends('layouts.app')

@section('content')

    <div class="container mx-auto py-6">
        <h1 class="text-teal-700 text-md sm:text-xl md:text-xl lg:text-2xl xl:text-3xl mb-3 antialiased tracking-tight font-semibold">
            Jouw decks
            <span class="text-gray-500 text-md sm:text-lg md:text-lg lg:text-xl xl:text-2xl">
                &bull; {{ $decks->count() }}
            </span>
        </h1>

        @include('partials.decksbyuser')

    </div>

    <div class="container mx-auto py-6">
        <hr class="my-6 border border-gray-400">
        <h1 class="text-teal-700 text-md sm:text-xl md:text-xl lg:text-2xl xl:text-3xl mb-3 antialiased tracking-tight font-semibold">
            Jouw tests
        </h1>

        @include('partials.testsbyuser')

    </div>

@endsection
