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
            chunkedDecks () {
                return _.chunk(this.decks,4)
            }
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
