<template>
    <div class="row no-gutters">
		<div class="col-4" v-for="card in deck.cards" :key="card.id">
            <div class="ratio-16-9 bg-gray-200 border border-medium">
                <div class="ratio-content d-flex align-items-center justify-content-center text-center p-5" @click="setAndShowCardmodal(card)">
        			<i class="material-icons md-light md-2 abosolute-top-right">
        				{{ card.cardtype.materialicon }} 
        			</i>
        	        <span 
                        class="text-white font-weight-light" 
                        :style="{ fontSize: fontSize(card.front) + 'vw' }"
                    >
                        <vue-markdown :source="card.front" v-if="card.front"></vue-markdown>
                    </span>
                </div>
            </div>
		</div>
		<new-card-card
			:deck_id="deck.id"
			:cardtypes="cardtypes"
		>
		</new-card-card>
	</div>
</template>

<script>
    import VueMarkdown from 'vue-markdown';
    export default {
        props: [
        	'deck',
        	'cardtypes'
        ],

        data() {
            return {
            }
        },

        components: {
            VueMarkdown
        },

        mounted() {
        	this.$eventBus.$on('addedCard', this.addCard);
            this.$eventBus.$on('updatedCard',this.updateCard);
        },

        computed: {
        },

        methods: {
        	addCard(card) {
        		this.deck.cards.push(card);
        		this.$forceUpdate();
        	},

            updateCard(card) {
                var i = this.deck.cards.map(deckcard => deckcard.id).indexOf(card.id);
                this.deck.cards[i] = card;
                this.$forceUpdate()
            },

            setAndShowCardmodal(thiscard) {
                var carddata = {
                        newCard: false,
                        card: thiscard,
                }
                this.$eventBus.$emit('setNewCardType', carddata);
                this.$bvModal.show('newcardmodal');

            },

            fontSize(string) {
                return ((Math.round((10 / Math.pow(string.length, 0.4)) * 10))/ 10) ;
            }
        }
    }
</script>