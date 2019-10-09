<template>
	<div
		class="newdeckbutton--fixed active"
		@mouseover="active = true"
	    @mouseleave="active = false"
	>
        <i class="material-icons md-3 clickable" v-if="! active">
            add_circle_outline
        </i>
		<div v-if="active">
			<div class="px-5 noselect"><b>New card</b></div>
			<div
				href="#"
				class="px-5"
				v-for="cardtype in cardtypes"
                :key="cardtype.id"
				@click="setAndShowCardmodal(cardtype)"
			>
				{{ cardtype.name }}
			</div>
		</div>
    </div>
</template>

<script>
    export default {
        props: [
        	'cardtypes',
        	'deck_id'
        ],

        data() {
            return {
            	active: false,
            }
        },

        mounted() {
    		// this.$eventBus.$emit('setNewCardType', this.cardtypes[0]);
        },

        computed: {
        },

        methods: {
        	setAndShowCardmodal(cardtype) {
                var carddata = {
                        newCard: true,
                        card: {
                            cardtype: cardtype,
                            deck_id: this.deck_id,
                            front: '',
                            back: '',
                            choices: [],
                        }
                }
        		this.$eventBus.$emit('setNewCardType', carddata);
        	}
        }
    }
</script>
