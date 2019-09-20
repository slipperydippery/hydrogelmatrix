<template>
	<div class="container flex-column d-flex w-100 h-100 overflow-hidden">
		<div class="flex-grow-1 d-flex flex-row">
			<div 
				class="testnav testnav--previous px-3 h-100 d-flex align-items-center"
				:class="{'clickable': ! firstCardActive}"
				@click="previousQuestion()"
			>
				<i 
					class="material-icons md-3"
					:class="{'md-dark md-inactive': firstCardActive} "
				>
					arrow_left
				</i>
			</div>

			<div class="hydrocard-container h-100 py-5 flex-grow-1 " v-for="card in shuffledDeck" v-if="card.id == activeCard.id" v-bind:key="card.id">
				<qa-test-component v-if="card.cardtype.slug == 'qa'" :card="card"></qa-test-component>
				<flippable-test-component v-if="card.cardtype.slug == 'flippable'" :card="card"></flippable-test-component>
				<multiplechoice-test-component v-if="card.cardtype.slug == 'multiplechoice'" :card="card"></multiplechoice-test-component>
				<doit-test-component v-if="card.cardtype.slug == 'doit'" :card="card"></doit-test-component>
			</div>
			<div 
				class="testnav testnav--next px-3 h-100 d-flex align-items-center"
				:class="{'clickable': ! lastCardActive}"
				@click="nextQuestion()"
			>
				<i 
					class="material-icons md-3"
					:class="{'md-dark md-inactive': lastCardActive}"
				>
					arrow_right
				</i>
			</div>
		</div>
		<div class="px-5">
			<div class="row d-flex flex-row align-items-center">
				<div 
					class="px-2" 
					@mouseover="mouseBack = true" 
					@mouseleave="mouseBack = false"
				>
					<i class="material-icons md-2 clickable" v-if="! mouseBack">
						reorder
					</i>
					<i class="material-icons md-2 clickable" @click="backToDeck()"  v-b-tooltip.hover title="Back to deck" v-else>
						arrow_back
					</i>
				</div>
				<div class="px-2">
					{{ activeIndex + 1 }}/{{ shuffledDeck.length }}		
				</div>
				<div class="flex-grow-1 px-2">
					 <b-progress :value="activeIndex" :max="shuffledDeck.length" class=""></b-progress>
				</div>
				<div class="px-2">
					<i class="material-icons md-2 clickable" v-b-tooltip.hover title="Shuffle deck and restart" @click="shuffleAndRestart">
						autorenew
					</i>
				</div>
			</div>
		</div>
	</div>

</template>

<script>
    export default {
        props: [
        	'deck'
        ],

        data() {
            return {
            	activeCard: {},
            	mouseBack: false,
            	shuffledDeck: [],
            }
        },

        mounted() {
        	this.shuffledDeck = this.shuffleDeck(this.deck.cards);
        	this.activeCard = this.shuffledDeck[0];
        },

        computed: {
        	activeIndex() {
        		return this.shuffledDeck.indexOf(this.activeCard);
        	},

        	firstCardActive() {
        		return (this.activeIndex == 0) ? true : false;
        	},

        	lastCardActive() {
        		return (this.activeIndex + 1 >= this.shuffledDeck.length) ? true : false;
        	}
        },

        methods: {
        	previousQuestion() {
        		if( ! this.firstCardActive ) {
        			this.activeCard = this.shuffledDeck[this.activeIndex - 1];
        		}
        	},

        	nextQuestion() {
        		if( ! this.lastCardActive ) {
        			this.activeCard = this.shuffledDeck[this.activeIndex + 1];
        		}
        	},

        	backToDeck() {
        		window.location.href = "/deck/" + this.deck.id;
        	},

        	shuffleDeck(array) {
        		for(let i = array.length - 1; i > 0; i--){
					const j = Math.floor(Math.random() * i)
					const temp = array[i]
					array[i] = array[j]
					array[j] = temp
        		}
        		return array;
        	},

        	shuffleAndRestart() {
        		this.shuffledDeck = this.shuffleDeck(this.deck.cards)
	        	this.activeCard = this.shuffledDeck[0];		
        	}
        }
    }
</script>