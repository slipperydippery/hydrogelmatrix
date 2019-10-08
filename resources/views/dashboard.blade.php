@extends('layouts.app')

@section('content')
    <div class="container md:flex mx-auto mt-6">
        <div class="px-4 py-2 text-center text-gray-600 w-full">
            <h1 class="text-2xl sm:text-xl md:text-2xl lg:text-4xl xl:text-5xl antialiased  tracking-tight font-semibold">Scaffolding for your brain</h1>
            <p class="italic mt-2 text-gray-600">"Pellentesque posuere. Suspendisse nisl elit, rhoncus eget, elementum ac, condimentum eget, diam. Nullam accumsan lorem in dui. Vivamus quis mi."</p>
            <new-deck-modal-button>

            </new-deck-modal-button>

        </div>
    </div>
    <div class="container mx-auto">

        <decks-by-user
            :decks = " {{ json_encode($decks) }} "
            inline-template
        >
            <div class="mt-8">
                <div class="flex mb-4" v-for="chunk in chunkedDecks">
                    <div class="w-1/4 p-2 text-gray-100" v-for="deck in chunk" :key="deck.id">
                        <a :href="'deck/' + deck.id" class="block bg-gray-600 hover:bg-gray-700 rounded shadow p-4">
                            <span class="icons flex flex-row-reverse pb-4 text-gray-400">
                                <span class="pr-2">
                                    @{{ cardCounter(deck) }}
                                </span>
                                <i class="material-icons pr-1">
                                    lock_open
                                </i>

                            </span>
                            <div class="text-2xl mb-2 h-16 overflow-hidden text-center"> @{{ deck.title }} </div>
                        </a>
                    </div>
                </div>
            </div>
        </decks-by-user>
    </div>




@endsection
