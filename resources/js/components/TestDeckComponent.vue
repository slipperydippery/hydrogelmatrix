<template>
	<div class="flex-column d-flex w-100 h-100">
		<div class="flex-grow-1 d-flex flex-row">
			<div 
				class="test-previous px-3 h-100 d-flex align-items-center"
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

			<div class="hydrocard-container h-100 py-5 flex-grow-1 ">
				<div class="h-100 w-100" v-for="card in deck.cards" v-if="card.id == activeCard.id" v-bind:key="card.id">
					<qa-test-component v-if="card.cardtype.slug == 'qa'" :card="card"></qa-test-component>
					<flippable-test-component v-if="card.cardtype.slug == 'flippable'"></flippable-test-component>
					<multiplechoice-test-component v-if="card.cardtype.slug == 'multiplechoice'"></multiplechoice-test-component>
					<doit-test-component v-if="card.cardtype.slug == 'doit'"></doit-test-component>
				</div>
			</div>
			<div 
				class="test-next px-3 h-100 d-flex align-items-center"
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
			<b-progress :value="activeIndex + 1" :max="deck.cards.length" class="mb-3"></b-progress>
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
            }
        },

        mounted() {
        	this.activeCard = this.deck.cards[0];
        },

        computed: {
        	activeIndex() {
        		return this.deck.cards.indexOf(this.activeCard);
        	},

        	firstCardActive() {
        		return (this.activeIndex == 0) ? true : false;
        	},

        	lastCardActive() {
        		return (this.activeIndex + 1 >= this.deck.cards.length) ? true : false;
        	}
        },

        methods: {
        	previousQuestion() {
        		if( ! this.firstCardActive ) {
        			this.activeCard = this.deck.cards[this.activeIndex - 1];
        		}
        	},

        	nextQuestion() {
        		if( ! this.lastCardActive ) {
        			this.activeCard = this.deck.cards[this.activeIndex + 1];
        		}
        	}
        }
    }
</script>