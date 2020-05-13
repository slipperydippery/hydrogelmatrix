@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-6">
        <h1 class="text-teal-700 text-md sm:text-xl md:text-xl lg:text-2xl xl:text-3xl mb-3 antialiased tracking-tight font-semibold">
            Jouw decks
            <span class="text-gray-500 text-md sm:text-lg md:text-lg lg:text-xl xl:text-2xl">
                &bull; {{ $decks->count() }}
            </span>
        </h1>

        @include('partials.decksbyuser')
    </div>

    <div class="container mx-auto">
        <hr class="my-6">
        <h1 class="text-teal-900 text-lg sm:text-xl md:text-xl lg:text-2xl xl:text-3xl antialiased tracking-tight font-semibold"> Jouw tests </h1>
        <manage-test-button
            inline-template
        >
            <div class="w-full text-teal-600 hover:text-teal-900 font-semibold py-2 clickable"
                 @click="openNewTestModal"
            >
                <i class="material-icons">
                    add
                </i> Maak een nieuwe test
            </div>
        </manage-test-button>
        <manage-test-modal
            :slugs-in-storage="{{ json_encode($testslugs) }}"
        >
        </manage-test-modal>

        @include('partials.testsbyuser')

    </div>

    <div class="container mx-auto hidden">
        <hr class="my-6">
        <h1 class="text-teal-900 text-lg sm:text-xl md:text-xl lg:text-2xl xl:text-3xl antialiased tracking-tight font-semibold"> Interessant voor jou </h1>
    </div>

@endsection
