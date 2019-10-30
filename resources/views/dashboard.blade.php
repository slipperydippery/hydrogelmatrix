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
    <div class="container mx-auto mt-6">
        <decks-by-user
            :decks = " {{ json_encode($decks) }} "
            inline-template
        >
            <div class="flex flex-wrap -mx-4">
                <div class="w-1/3 px-4" v-for="deck in decks" :key="deck.id">
                    <div class="bg-white mb-4 rounded shadow-lg p-5 h-56 relative hoverparent">
                        <h3 class="font-normal text-xl py-4 -mx-5 px-4 w-full border-l-4 border-teal-400 truncate">@{{ deck.title }}</h3>

                        <div class="text-gray-600">
                            @{{ stringLimit(deck.description) }}
                        </div>

                        <div class="absolute bottom-0 left-0 right-0 text-teal-600 border-t border-gray-300 py-1 px-5">
                            <div class="inline-block">

                                <svg class="fill-current h-6 w-6 inline" width="61px" height="54px" viewBox="0 127.116 612 537.768" enable-background="new 0 127.116 612 537.768"
                                     xml:space="preserve">
                                    <g>
                                        <path d="M605.532,484.594l-16.419-10.34c-6.472-4.074-15.021-2.132-19.096,4.339c-3.623,5.754-2.487,13.153,2.359,17.587
                                            L352.436,634.676L39.623,437.699c4.848-4.434,5.983-11.832,2.359-17.588c-4.074-6.47-12.625-8.411-19.095-4.338L6.469,426.112
                                            C2.443,428.647,0,433.071,0,437.829s2.442,9.182,6.468,11.717l338.589,213.209c2.254,1.419,4.817,2.129,7.379,2.129
                                            s5.123-0.71,7.379-2.129l245.718-154.729c4.024-2.535,6.468-6.959,6.468-11.717C612,491.553,609.557,487.129,605.532,484.594z"/>
                                        <path d="M605.532,413.523l-16.419-10.339c-6.472-4.075-15.021-2.134-19.096,4.339c-3.623,5.754-2.487,13.153,2.359,17.587
                                            L352.436,563.606L39.623,366.629c4.848-4.434,5.983-11.832,2.359-17.587c-4.074-6.47-12.625-8.413-19.095-4.338l-16.42,10.339
                                            C2.443,357.577,0,362.002,0,366.76c0,4.757,2.442,9.181,6.468,11.717l338.589,213.208c2.254,1.42,4.817,2.13,7.379,2.13
                                            s5.123-0.71,7.379-2.13l245.718-154.728c4.024-2.535,6.468-6.959,6.468-11.717S609.557,416.059,605.532,413.523z"/>
                                        <path d="M6.468,307.407l338.589,213.208c2.254,1.419,4.817,2.13,7.379,2.13s5.123-0.711,7.379-2.13l245.718-154.728
                                            c4.024-2.535,6.468-6.959,6.468-11.716c0-4.758-2.443-9.182-6.468-11.717l-338.59-213.208c-4.51-2.84-10.246-2.84-14.756,0
                                            L6.468,283.974C2.443,286.507,0,290.933,0,295.69C0,300.448,2.443,304.872,6.468,307.407z M259.564,157.324l312.604,196.847
                                            L352.436,492.537L39.831,295.69L259.564,157.324z"/>
                                    </g>
                                </svg>
                                @{{ cardCounter(deck)  }}
                            </div>
                            <div class="absolute right-0 bottom-0 h-full hoverchild flex">
                                <div class="h-full text-teal-400 hover:bg-teal-100 hover:text-teal-600 px-5 py-1 clickable transition-5"
                                     @click="editDeck(deck)"
                                >
                                    edit deck
                                </div>

                                <div class="h-full bg-teal-400 text-white hover:bg-teal-600 flex items-center py-1 pl-6 pr-5 clickable transition-5"
                                    @click="startTest(deck)"
                                >
                                    <span class="pb-1 pr-1">
                                        test
                                    </span>
                                    <i class="material-icons ">
                                        play_arrow
                                    </i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </decks-by-user>
    </div>




@endsection
