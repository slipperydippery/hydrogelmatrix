<script>
    export default {
        name: "DeckInfo",

        props: [
            'initialdeck'
        ],

        data() {
            return {
                deck: {}
            }
        },

        mounted() {
            this.deck = this.initialdeck
            this.$eventBus.$on('updatedDeckInfo', this.updateDeckInfo)
            this.$eventBus.$on('addedCard', this.addCard)
        },

        methods: {
            updateDeckInfo(deck) {
                this.deck.title = deck.title
                this.deck.slug = deck.slug
                this.deck.public = deck.public
                this.deck.description = deck.description
            },

            addCard(card){
                this.deck.cards.push(card)
            }
        }
    }
</script>
