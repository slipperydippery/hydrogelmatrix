@extends('layouts.clean')

@section('content')
	<test-deck-component
		:deck = " {{ json_encode($deck) }} "
        inline-template
	>
        <div class="flex flex-col w-full h-screen overflow-hidden">
            <div class="flex flex-grow ">
                <div class="flex-1 h-100 flex items-center pl-4">
                    <div class="h-xs9sm:h-sm9 md:h-md9 lg:h-md9 xl:h-xl9 w-full py-2">
                        <div class="w-full h-full select-none text-gray-600 flex items-center justify-end"
                             :class="{'clickable hover:text-yellow-700 hover:bg-gray-200': ! firstCardActive}"
                             @click="previousQuestion()"
                        >
                            <i
                                class="material-icons md-5"
                                :class="{'md-dark md-inactive': firstCardActive} "
                            >
                                arrow_left
                            </i>
                        </div>
                    </div>
                </div>

                <div class="hydrocard-container relative flex-1 flex items-center justify-center" v-for="card in shuffledDeck" v-if="card.id == activeCard.id" :key="card.id">
                    <card-content
                        :card="card"
                    >
                    </card-content>
                </div>

                <div class="flex-1 h-100 flex items-center pr-4">
                    <div class="h-xs9sm:h-sm9 md:h-md9 lg:h-md9 xl:h-xl9 w-full py-2">
                        <div class="w-full h-full select-none text-gray-600 flex items-center justify-start"
                             :class="{'clickable hover:text-yellow-700 hover:bg-gray-200': ! lastCardActive}"
                             @click="nextQuestion()"
                        >
                            <i
                                class="material-icons md-5"
                                :class="{'md-dark md-inactive': lastCardActive}"
                            >
                                arrow_right
                            </i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="px-5">
                <div class="row flex flex-row items-center">
                    <div
                        class="px-2"
                        @mouseover="mouseBack = true"
                        @mouseleave="mouseBack = false"
                    >
                        <i class="material-icons md-2 clickable" v-if="! mouseBack">
                            reorder
                        </i>
                        <i class="material-icons md-2 clickable" @click="backToDeck()" v-else>
                            arrow_back
                        </i>
                    </div>
                    <div class="px-2">
                        @{{ activeIndex + 1 }}/@{{ shuffledDeck.length }}
                    </div>
                    <div class="flex-1 px-2">
                        <div class="w-full h-3 bg-gray-300 relative">
                            <div class="absolute top-0 left-0 bg-blue-900 h-full" :style="{ width: (activeIndex / shuffledDeck.length) * 100 + '%' }"></div>
                        </div>
                    </div>
                    <div class="px-2">
                        <i class="material-icons md-2 clickable" @click="shuffleAndRestart">
                            autorenew
                        </i>
                    </div>
                </div>
            </div>
        </div>

	</test-deck-component>
@endsection

@section('additional-scripts')

@endsection
