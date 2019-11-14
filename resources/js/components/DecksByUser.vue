<script>
    export default {
        props: [
        	'decks'
        ],

        data() {
            return {
                decksToShow: 3
            }
        },

        mounted() {
        	this.$eventBus.$on('addedDeck', this.addDeck);
        },

        computed: {
        },

        methods: {
        	addDeck(deck) {
        	    console.log('adding deck')
        		this.decks.push(deck)
        		this.$forceUpdate()
                console.log(this.filteredDecks)
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
                window.location.href = '/deck/' + deck.slug + '/test'
            },

            editDeck(deck) {
                // this.$eventBus.$emit('editDeckInModal', deck)
                window.location.href = '/deck/' + deck.slug
            },

            showAll() {
                this.decksToShow = null
            },

            showDefault() {
                this.decksToShow = 3
            }
        }
    }
</script>
