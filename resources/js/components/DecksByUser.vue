<template>
    <div class="row no-gutters bg-light">
		<div class="col-4 hoverparent" v-for="deck in decks" :key="deck.id">
            <div class="hoverbuttons position-absolute w-100 h-100 d-flex flex-column justify-content-center squares--overlay hoverchild p-4">
                <b-list-group>
                    <a :href="'/deck/' + deck.id + '/test'" class="hoverparent">
                        <b-list-group-item button class="text-center "> <b>Test</b> </b-list-group-item>
                    </a>
                    <a :href="'/deck/' + deck.id">
                        <b-list-group-item button class="text-center "> <b>Edit</b> </b-list-group-item>
                    </a>
                </b-list-group>
            </div>
            <div class="ratio-16-9 bg-gray-200 border border-medium">
                <div class="ratio-content d-flex align-items-center justify-content-center text-center p-5">
                    <span class="deck-cardcount abosolute-top-right text-white border border-white rounded px-2">
                        {{ cardCounter(deck) }}
                    </span>
                    <span 
                        class="text-white font-weight-light" 
                        :style="{ fontSize: fontSize(deck.title) + 'vw' }"
                    >
                        {{ deck.title }} 
                    </span>
                </div>
            </div>
		</div>
	</div>
</template>

<script>

    export default {
        props: [
        	'decks'
        ],

        data() {
            return {
            }
        },

        mounted() {
        	this.$eventBus.$on('addedDeck', this.addDeck);
        },

        computed: {
        },

        methods: {
        	addDeck(deck) {
        		this.decks.push(deck);
        		this.$forceUpdate();
        	},

            cardCounter(deck) {
                if('cards' in deck) {
                    return deck.cards.length
                }
                return 0
            },

            fontSize(string) {
                return ((Math.round((10 / Math.pow(string.length, 0.4)) * 10))/ 10) ;
            }
        }
    }
</script>