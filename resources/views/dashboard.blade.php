@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-6">
        <h1 class="text-teal-900 text-lg sm:text-xl md:text-xl lg:text-2xl xl:text-3xl antialiased tracking-tight font-semibold"> Jouw decks </h1>
        <new-deck-button inline-template>
            <div>
                <div class="inline-block md:w-auto text-teal-600 hover:text-teal-900 font-semibold  mb-6 clickable"
                        @click="newDeckInModal"
                >
                    <i class="material-icons">
                        add
                    </i> Maak een nieuwe deck
                </div>

                <manage-deck-modal
                    :slugs = " {{ json_encode($deckslugs) }} "
                >
                </manage-deck-modal>

            </div>
        </new-deck-button>
        <decks-by-user
            :decks = " {{ json_encode($decks) }} "
            inline-template
        >
            <div class="flex flex-wrap -mx-4 justify-center sm:justify-start text-teal-900 select-none">
                <div class="w-full max-w-lg sm:w-1/2 md:w-1/2 xl:w-1/3 px-4 overflow-hidden" v-for="deck in decks.slice(0, Number(decksToShow ? decksToShow : 100))" :key="deck.id">
                    <div class="relative bg-white rounded-xl shadow-lg border-r-4 border-b-8 border-gray-500 h-56 mb-4 p-5 hoverparent overflow-hidden">
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
                            <div class="inline-block h-full px-2">
                                <i class="material-icons md-1-2" v-if="deck.public">
                                    link
                                </i>
                                <i class="material-icons md-1-2" v-else>
                                    link_off
                                </i>
                            </div>
                            <div class="absolute right-0 bottom-0 h-full hoverchild opacity-0 flex">
                                <div class="h-full text-teal-400 hover:bg-teal-100 hover:text-teal-600 px-5 py-1 clickable transition-5"
                                     @click="addDeckToTest(deck)"
                                >
                                    + test
                                </div>
                                <div class="h-full text-teal-400 hover:bg-teal-100 hover:text-teal-600 px-5 py-1 clickable transition-5"
                                     @click="editDeck(deck)"
                                >
                                    bekijk deck
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
                <div class="w-full" v-if="decks.length > 3">
                    <span class="float-right flex items-center text-teal-800 clickable" @click="showAll" v-if="decksToShow">
                        Bekijk alles
                        <i class="material-icons md-1-5">
                            arrow_right
                        </i>
                    </span>
                    <span class="float-right flex items-center text-teal-800 clickable" @click="showDefault" v-else>
                        Verberg
                        <i class="material-icons md-1-5">
                            arrow_drop_up
                        </i>
                    </span>
                </div>
            </div>
        </decks-by-user>
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
