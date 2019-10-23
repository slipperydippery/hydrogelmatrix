@extends('layouts.app')

@section('content')
    <div class="container md:flex mx-auto mt-6">
        <div class="px-4 py-2 text-center text-gray-600 w-full">
            <h1 class="text-2xl sm:text-xl md:text-2xl lg:text-4xl xl:text-5xl antialiased  tracking-tight font-semibold">Scaffolding for your brain</h1>
            <p class="italic mt-2 text-gray-600">"Pellentesque posuere. Suspendisse nisl elit, rhoncus eget, elementum ac, condimentum eget, diam. Nullam accumsan lorem in dui. Vivamus quis mi."</p>
            <new-deck-button inline-template>
                <div>
                    <button class="inline-block w-full px-8 py-2 mt-6 md:w-auto bg-secondary hover:bg-secondary-dark  text-white font-bold rounded"
                            @click="newDeckInModal"
                    >
                        Make a new deck
                    </button>

                    <manage-deck-modal
                    >
                    </manage-deck-modal>

                </div>
            </new-deck-button>

        </div>
    </div>
    <div class="container mx-auto">
        <decks-by-user
            :decks = " {{ json_encode($decks) }} "
            inline-template
        >
            <div class="mt-8">
                <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 inline-block p-2 " v-for="deck in decks" :key="deck.id">
                    <a :href="'deck/' + deck.id" class="block bg-gray-200 hover:bg-gray-700 text-gray-700 hover:text-gray-300 rounded shadow p-4">
                        <span class="icons flex flex-row-reverse pb-4 text-gray-400">
                            <span class="pr-2">
                                @{{ cardCounter(deck) }}
                            </span>
                        </span>
                        <div class="text-2xl mb-2 h-16 overflow-hidden text-center"> @{{ deck.title }} </div>
                    </a>
                </div>
            </div>
        </decks-by-user>
    </div>




@endsection
