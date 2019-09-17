<template>
    <div class="row no-gutters">
		<div class="col-4" v-for="card in deck.cards" :key="card.id">
            <div class="ratio-16-9 bg-gray-200">
                <div class="ratio-content d-flex align-items-center justify-content-center" @click="setAndShowCardmodal(card)">
        			<i class="material-icons md-light md-2 abosolute-top-right">
        				{{ card.cardtype.materialicon }} 
        			</i>
        	        <span 
                        class="text-white font-weight-light" 
                        :style="{ fontSize: fontSize(card.front) + 'vw' }"
                    >
                        {{ card.front }} 
                    </span>
                </div>
            </div>
		</div>
		<new-card-card
			:deckid="deck.id"
			:cardtypes="cardtypes"
		>
		</new-card-card>
	</div>
</template>

<script>
    export default {
        props: [
        	'deck',
        	'cardtypes'
        ],

        data() {
            return {
            }
        },

        mounted() {
        	this.$eventBus.$on('addedCard', this.addCard);
        },

        computed: {
        },

        methods: {
        	addCard(card) {
        		this.deck.cards.push(card);
        		this.$forceUpdate();
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