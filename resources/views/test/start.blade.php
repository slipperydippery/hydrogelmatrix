@extends('layouts.clean')

@section('content')
	<test-deck-component
		:deck = " {{ json_encode($deck) }} "
        inline-template
	>
        <div class="flex flex-col w-full h-screen overflow-hidden">
            <div class="flex-grow flex items-center">
                <div class="flex-grow flex h-xs9 sm:h-sm9 md:h-md9 lg:h-md9 xl:h-xl9">
                    <div class="flex-grow h-100 flex items-center justify-end text-gray-600 opacity-0 hover:opacity-75 pl-4 py-2 transition-3 clickable"
                         @click="previousQuestion()"
                         v-if="! firstCardActive"
                    >
                        <img src="/img/arrows_prev.svg" class="h-full">
                    </div>
                    <div class="flex-grow h-100 opacity-75 flex items-center justify-end text-gray-600 pl-4 py-2" v-else>
                        <img src="/img/dot_prev.svg" class="h-full">
                    </div>

                    <div class="hydrocard-container relative flex items-center justify-center" v-for="card in shuffledDeck" v-if="card.id == activeCard.id" :key="card.id">
                        <card-content
                            :card="card"
                        >
                        </card-content>
                    </div>

                    <div class="flex-grow h-100 flex items-center justify-start text-gray-600 opacity-0 hover:opacity-75 pr-4 py-2 transition-3 clickable"
                         @click="nextQuestion()"
                         v-if="! lastCardActive"
                    >
                        <img src="/img/arrows_next.svg" class="h-full">
                    </div>
                    <div class="flex-grow h-100 opacity-75 flex items-center justify-start text-gray-600 pr-4 py-2" v-else>
                        <img src="/img/dot_next.svg" class="h-full">
                    </div>
                </div>
            </div>

            <div class="px-5">
                <div class="row flex flex-row items-center text-teal-800">
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
                            <div class="absolute top-0 left-0 bg-teal-900 h-full" :style="{ width: (activeIndex / shuffledDeck.length) * 100 + '%' }"></div>
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
