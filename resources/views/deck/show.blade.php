@extends('layouts.app')

@section('content')
    <div class="container md:flex md:flex-row-reverse mx-auto mt-6">
        <div class="">
            <img src="/img/page.svg" class="w-full" alt="">
        </div>
        <div class="px-4 py-2 lg:w-1/2 text-center lg:text-left text-gray-600">
            <div class="lg:pl-24 lg:py-16">
                <h1 class="text-2xl sm:text-xl md:text-2xl lg:text-4xl xl:text-6xl antialiased tracking-tight font-semibold"> {{ $deck->title }} </h1>
                <p class="italic text-gray-600 py-4"> {{ $deck->description }} </p>

                <div class="w-full flex justify-between mt-2 pb-4">
                    <span>
                        {{ $deck->cards->count() }} cards
                    </span>
                    <edit-deck-modal-button
                        :deck = "{{ json_encode($deck)  }}"
                        inline-template
                    >
                        <i class="material-icons clickable" @click="editDeckInModal">
                            edit
                        </i>
                    </edit-deck-modal-button>
                </div>

                <a href=" {{ route('decktest.start', $deck) }} " class="inline-block w-full px-8 mr-4 lg:w-auto bg-secondary hover:bg-secondary-dark text-white font-bold py-2 rounded"> Start test </a>
                <new-card-modal-button inline-template>
                    <button class="inline-block w-full px-8 lg:w-auto bg-gray-200 hover:bg-blue-700 text-gray-700 hover:text-white font-bold py-2 rounded"
                            @click="openNewCardModal"
                    >
                        Add a Card
                    </button>
                </new-card-modal-button>

                <new-deck-modal
                >
                </new-deck-modal>



            </div>
        </div>
    </div>


    <cards-in-deck
        :deck=" {{ json_encode($deck) }} "
        :cardtypes=" {{ json_encode($cardtypes) }} "
        inline-template
    >
        <div class="mt-8">
            <div class=" relative w-full sm:w-1/2 md:w-1/3 lg:w-1/4 inline-block p-2 text-gray-100" v-for="card in deck.cards" :key="'card' + card.id">
                <div class="block bg-secondary-light hover:bg-secondary rounded shadow p-4 clickable" @click="editCard(card)">
                    <span class="icons flex flex-row-reverse pb-4 text-gray-400">
                        <i class="material-icons pr-1">
                            lock_open
                        </i>
                        <i class="material-icons md-light md-2 abosolute-top-right">
                            @{{ card.cardtype.materialicon }}
                        </i>

                    </span>
                    <div class="text-2xl mb-2 h-16 overflow-hidden text-center"> <vue-markdown :source="card.front" v-if="card.front"></vue-markdown> </div>
                </div>
            </div>
        </div>
    </cards-in-deck>

    <new-card-modal
        :cardtypes= " {{ json_encode($cardtypes) }} "
        :deck_id=" {{ $deck->id }} "
    >
    </new-card-modal>


@endsection
