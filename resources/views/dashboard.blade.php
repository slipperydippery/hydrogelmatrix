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

        <add-to-test-modal
            :tests="{{ json_encode($tests) }}"
            :user="{{ json_encode(Auth::user()) }}"
            :slugs="{{ json_encode($testslugs) }}"
        >
        </add-to-test-modal>
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
        <manage-test-modal>
        </manage-test-modal>

        <tests-by-user
            :tests = " {{ json_encode($tests) }} "
            inline-template
        >
            <div class="flex flex-wrap -mx-4 justify-center sm:justify-start text-teal-900 select-none">
                <div class="w-full max-w-lg sm:w-1/2 md:w-1/2 xl:w-1/3 px-4 overflow-hidden" v-for="test in tests.slice(0, Number(testsToShow ? testsToShow : 100))" :key="test.id">
                    <div class="relative bg-white rounded-xl shadow-lg border-r-4 border-b-8 border-gray-500 h-56 mb-4 p-5 hoverparent overflow-hidden">
                        <h3 class="font-normal text-xl py-4 -mx-5 px-4 w-full border-l-4 border-teal-400 truncate">@{{ test.title }}</h3>

                        <div class="text-gray-600">
                            @{{ stringLimit(test.description) }}
                        </div>
                        @{{ deckCounter(test)  }}
                    </div>
                </div>
            </div>
        </tests-by-user>

    </div>

    <div class="container mx-auto hidden">
        <hr class="my-6">
        <h1 class="text-teal-900 text-lg sm:text-xl md:text-xl lg:text-2xl xl:text-3xl antialiased tracking-tight font-semibold"> Interessant voor jou </h1>
    </div>

@endsection
