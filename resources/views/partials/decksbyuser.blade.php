<decks-by-user
    :decks = " {{ json_encode($decks) }} "
    inline-template
>
    <div class="flex flex-wrap -mx-4 justify-center sm:justify-start text-teal-700 select-none">
        <div class="w-full max-w-lg sm:w-1/2 md:w-1/2 xl:w-1/3 px-4 overflow-hidden" v-for="deck in decks.slice(0, Number(decksToShow ? decksToShow : 100))" :key="deck.id">
            <div class="relative bg-white rounded-lg shadow-lg shadow-lg border-gray-500 h-56 mb-4 p-5 hoverparent overflow-hidden clickable"
                @click.self="startTest(deck)"
            >
                <h3 class="font-semibold text-2xl py-4 -ml-10 pl-10 w-full  border-teal-400 truncate">
                    @{{ deck.title }}
                </h3>

                <div class="">
                    @{{ stringLimit(deck.description) }}
                </div>

                <div class="absolute bottom-0 left-0 right-0 text-teal-600 border-t border-gray-300 py-1 px-5">
                    <div class="inline-block">

                        @include('svg.deck')

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
                        <div class="h-full text-teal-400 hover:bg-teal-600 hover:text-white px-5 py-1 clickable transition-5"
                             @mouseover="mouseOn('addToTest')"
                             @mouseleave="mouseOff('addToTest')"
                             @click="addDeckToTest(deck)"
                        >
                            + test
                        </div>
                        <div class="h-full text-teal-400 hover:bg-teal-600 hover:text-white px-5 py-1 clickable transition-5"
                             @click="editDeck(deck)"
                             @mouseover="mouseOn('view')"
                             @mouseleave="mouseOff('view')"
                        >
                            bekijk deck
                        </div>

                        <div class="h-full flex items-center py-1 pl-6 pr-5 clickable transition-5"
                            :class="{'bg-teal-600 text-white' : !hoverElement.length }"
                            :class="{'bg-white text-teal-400' : hoverElement.length, 'bg-teal-600 text-white' : ! hoverElement.length }"
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
        <div class="w-full relative flex items-center justify-center">
            <span class="clickable text-gray-500" @click="showAll" v-if="decksToShow && decks.length > 3">
                Bekijk alles
            </span>
            <span class="clickable text-gray-500" @click="showDefault" v-if="!decksToShow && decks.length > 3">
                Verberg
            </span>
            <new-deck-button inline-template>
                <span class="absolute right-0 py-2 px-4 text-white text-semibold bg-teal-600 hover:bg-teal-800 rounded-full mr-4"
                    @click="newDeckInModal"
                >
                    + Maak een nieuwe deck
                </span>
            </new-deck-button>
            <manage-deck-modal
                :user = " {{ json_encode( auth()->user() ) }} "
                :slugs-in-storage = " {{ json_encode($deckslugs) }} "
            >
            </manage-deck-modal>
        </div>
    </div>
</decks-by-user>

<add-to-test-modal
    :tests="{{ json_encode($tests) }}"
    :user="{{ json_encode(Auth::user()) }}"
    :slugs-in-storage="{{ json_encode($testslugs) }}"
>
</add-to-test-modal>
