@extends('layouts.app')

@section('content')
    <div class="md:flex bg-white">
        <deck-info
            :initialdeck="{{ json_encode($deck) }}"
            inline-template
        >
            <div class="container md:flex md:flex-row-reverse justify-end mx-auto" v-if="deck.id">
                <div class="md:pl-12 flex items-center justify-center">
                    <a href=" {{ route('decktest.start', $deck) }} " class="text-teal-600 hover:text-teal-800 transition-5 flex items-center hoverparent">
                        <i class="material-icons md-9">
                            play_circle_filled
                        </i>
                        <span class="hidden md:inline-block md:text-4xl lg:text-5xl xl:text-6xl hoverchild font-semibold">START TEST</span>
                    </a>
                </div>
                <div class="px-4 py-2 md:w-1/2 text-center md:text-left text-gray-600">
                    <div class="md:pl-24 md:py-12">
                        <h1 class="text-xl sm:text-lg md:text-xl lg:text-2xl xl:text-3xl antialiased tracking-tight font-semibold"> @{{ deck.title }} </h1>
                        <p class="italic text-gray-600 py-4"> @{{ deck.description }} </p>

                        <div class="w-full flex justify-start mt-2">
                            <span>
                                @{{ deck.cards.length }} kaarten
                            </span>
                            <edit-deck-button
                                :deck = "{{ json_encode($deck)  }}"
                                inline-template
                                v-if=" {{ $owner  }} "
                            >
                                <i class="material-icons clickable ml-4" @click="editDeckInModal">
                                    edit
                                </i>
                            </edit-deck-button>
                            <a href=" {{ route('decktest.start', $deck) }} " class="inline-block w-full px-8 mr-4 bg-secondary hover:bg-secondary-dark text-white text-center font-bold py-2 rounded hidden"> Start test </a>
                        </div>

                    </div>
                </div>
            </div>
        </deck-info>
    </div>


    <cards-in-deck
        :deck=" {{ json_encode($deck) }} "
        :cardtypes=" {{ json_encode($cardtypes) }} "
        inline-template
    >
        <div class="container mx-auto flex flex-wrap pt-8">
            <new-card-modal-button inline-template>
                <div class="w-full text-teal-600 hover:text-teal-900 font-semibold py-2 clickable"
                        @click="openNewCardModal"
                >
                    <i class="material-icons">
                        add
                    </i> Voeg een kaart toe
                </div>
            </new-card-modal-button>

            <manage-deck-modal
                :slugs=" {{ json_encode($slugs)  }} "
            >
            </manage-deck-modal>

            <div class="relative w-full sm:w-1/2 md:w-1/3 lg:w-1/4 inline-block p-2 text-teal-600" v-for="card in deck.cards" :key="'card' + card.id">
                <div class="bg-white mb-4 rounded-xl border-b border-r border-gray-400 shadow p-5 h-48 relative flex flex-col hoverparent overflow-hidden">
                    <div class="absolute top-0 left-0 right-0 text-teal-500 border-gray-300 py-1 px-5">

                    </div>
                    <div class="text-base h-40 py-5 flex -ml-5">
                        <span class="h-20 overflow-hidden border-teal-400 pl-5">
                            <vue-markdown :source="card.front" v-if="card.front">
                            </vue-markdown>
                        </span>
                    </div>
                    <div class="absolute bottom-0 left-0 right-0 border-t border-gray-300 text-teal-600 py-1 px-5 hoverchild">
                        <div class="inline-block ">
                            <i class="material-icons-outlined md-1 pt-1 float-right">
                                @{{ card.cardtype.materialicon }}
                            </i>
                        </div>
                        <div class="absolute right-0 bottom-0 h-full">
                            <div class="h-full bg-teal-600 text-white px-4 clickable transition-5 flex items-center"
                                 @click="editCard(card)"
                            >
                                <i class="material-icons md-1">
                                    edit
                                </i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </cards-in-deck>

    <manage-card-modal
        :cardtypes= " {{ json_encode($cardtypes) }} "
        :deck_id=" {{ $deck->id }} "
    >
    </manage-card-modal>


@endsection
