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

            fontSize(string) {
                return ((Math.round((10 / Math.pow(string.length, 0.4)) * 10))/ 10) ;
            },

            editCard(card) {
                this.$eventBus.$emit('openEditCardModal', card)
            }
        }
    }
</script>
