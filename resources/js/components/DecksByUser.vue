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
            },

            stringLimit(str) {
        	    if(str == null || str.length < 150) {
        	        return str
                }
        	    return str.substring(0,150) + '...'
            },

            startTest(deck) {
                window.location.href = '/deck/' + deck.id + '/test'
            },

            editDeck(deck) {
                // this.$eventBus.$emit('editDeckInModal', deck)
                window.location.href = '/deck/' + deck.id
            },
        }
    }
</script>
