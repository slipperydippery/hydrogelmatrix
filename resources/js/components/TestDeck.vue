<script>
    export default {
        name: "TestDeck",

        props: [
            'test'
        ],

        mounted() {
        },

        computed: {
            deckCounter() {
                if('decks' in this.test) {
                    return this.test.decks.length
                }
                return 0
            },

            stringLimitDescription() {
                if(this.test.description == null || this.test.description.length < 150) {
                    return this.test.description
                }
                return this.test.description.substring(0,150) + '...'
            }
        },

        methods: {
            stringLimit(str) {
                if(str == null || str.length < 150) {
                    return str
                }
                return str.substring(0,150) + '...'
            },
        }
    }
</script>
