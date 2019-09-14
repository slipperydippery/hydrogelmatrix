<template>
    <div class="row no-gutters">
		<div class="col-4" v-for="card in deck.cards" :key="card.id">
			<i class="material-icons md-light md-2 abosolute-top-right">
				{{ card.cardtype.materialicon }}
			</i>
	        <img :src="'https://dummyimage.com/600x400/c2c2c2/f2f2f2&text=' + card.front " alt="" class="img-fluid clickable" @click="setAndShowCardmodal(card)">
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

            }
        }
    }
</script>