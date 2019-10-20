@extends('layouts.clean')

@section('content')
	<test-deck-component
		:deck = " {{ json_encode($deck) }} "
        inline-template
	>

        <div class="flex flex-col w-full h-screen overflow-hidden">
            <div class="flex flex-grow ">
                <div
                    class="flex-1 px-3 h-100 flex items-center justify-end select-none text-gray-600 hover:text-yellow-700"
                    :class="{'clickable': ! firstCardActive}"
                    @click="previousQuestion()"
                >
                    <i
                        class="material-icons md-5"
                        :class="{'md-dark md-inactive': firstCardActive} "
                    >
                        arrow_left
                    </i>
                </div>

                <div class="hydrocard-container relative flex-1 flex items-center justify-center" v-for="card in shuffledDeck" v-if="card.id == activeCard.id" :key="card.id">
                    <qa-test-component v-if="card.cardtype.slug == 'qa'" :card="card"></qa-test-component>
                    <flippable-test-component v-if="card.cardtype.slug == 'flippable'" :card="card"></flippable-test-component>
                    <multiplechoice-test-component v-if="card.cardtype.slug == 'multiplechoice'" :card="card"></multiplechoice-test-component>
                    <doit-test-component v-if="card.cardtype.slug == 'doit'" :card="card"></doit-test-component>
                </div>

                <div
                    class="flex-1 px-3 h-100 flex items-center justify-start select-none text-gray-600 hover:text-yellow-700"
                    :class="{'clickable': ! lastCardActive}"
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
