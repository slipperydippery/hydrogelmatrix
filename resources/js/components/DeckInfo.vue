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
            console.log(this.initialdeck)
            this.deck = this.initialdeck
            this.$eventBus.$on('updatedDeckInfo', this.updateDeckInfo)
        },

        methods: {
            updateDeckInfo(deck) {
                console.log(deck)
                this.deck = deck
            }
        }
    }
</script>
